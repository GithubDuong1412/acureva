<?php

namespace Botble\Ecommerce\Supports;

use Botble\Base\Models\BaseQueryBuilder;
use Botble\Ecommerce\Facades\EcommerceHelper as EcommerceHelperFacade;
use Botble\Ecommerce\Models\ProductAttributeSet;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

class RenderProductAttributeSetsOnSearchPageSupport
{
    public function __construct(protected Request $request)
    {
    }

    public function getAttributeSets(): Collection
    {
        $categoryIds = array_filter((array) $this->request->input('categories', []));

        $with = [
            'categories:id',
            'attributes' => fn (HasMany $query) => $query
                ->whereHas('productVariationItems', function (EloquentBuilder $query) use ($categoryIds): void {
                    $query->when($categoryIds, function (EloquentBuilder $query) use ($categoryIds): void {
                        $query->whereHas(
                            'productVariation.configurableProduct.categories',
                            fn (EloquentBuilder $query) => $query->whereIn('ec_product_categories.id', $categoryIds)
                        );
                    });
                }),
        ];

        if (is_plugin_active('language') && is_plugin_active('language-advanced')) {
            $with[] = 'attributes.translations';
        }

        return ProductAttributeSet::query()
            ->where('is_searchable', true)
            ->wherePublished()
            ->when((array) $this->request->input('categories', []), function (BaseQueryBuilder $query, $categoryIds): void {
                $query->where(function (BaseQueryBuilder $query) use ($categoryIds): void {
                    $query
                        ->whereDoesntHave('categories')
                        ->orWhereHas(
                            'categories',
                            fn (BaseQueryBuilder $query) => $query->whereIn('id', $categoryIds)
                        );
                });
            })
            ->oldest('order')
            ->with($with)
            ->get()
            ->filter(fn (ProductAttributeSet $attributeSet) => $attributeSet->attributes->isNotEmpty())
            ->values();
    }

    public function getSelectedAttributes(Collection $attributeSets): array
    {
        $selectedAttrs = [];

        $allowedAttributesBySetSlug = $attributeSets
            ->mapWithKeys(fn (ProductAttributeSet $attributeSet) => [$attributeSet->slug => $attributeSet->attributes->pluck('id')->all()])
            ->all();

        $allowedAttributes = collect($allowedAttributesBySetSlug)->flatten()->map(fn ($id) => (int) $id)->all();

        $attributesInput = (array) $this->request->input('attributes', []);

        if (! array_is_list($attributesInput)) {
            foreach ($attributeSets as $attributeSet) {
                $attributeInput = Arr::get($attributesInput, $attributeSet->slug, []);

                if (! is_array($attributeInput)) {
                    continue;
                }

                $allowed = array_map('intval', $allowedAttributesBySetSlug[$attributeSet->slug] ?? []);
                $selectedAttrs[$attributeSet->slug] = array_values(array_intersect($allowed, array_map('intval', array_filter($attributeInput))));
            }
        } else {
            $selectedAttrs = array_values(array_intersect($allowedAttributes, array_map('intval', array_filter($attributesInput))));
        }

        return $selectedAttrs;
    }

    public function render(array $params = []): string
    {
        if (! EcommerceHelperFacade::isEnabledFilterProductsByAttributes()) {
            return '';
        }

        $params = ['view' => EcommerceHelperFacade::viewPath('attributes.attributes-filter-renderer'), ...$params];

        $attributeSets = $this->getAttributeSets();
        $selectedAttrs = $this->getSelectedAttributes($attributeSets);

        return view(
            $params['view'],
            array_merge($params, compact('attributeSets', 'selectedAttrs'))
        )->render();
    }
}
