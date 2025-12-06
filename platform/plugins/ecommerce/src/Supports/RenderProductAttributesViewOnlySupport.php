<?php

namespace Botble\Ecommerce\Supports;

use Botble\Ecommerce\Facades\EcommerceHelper as EcommerceHelperFacade;
use Botble\Ecommerce\Models\Product;
use Botble\Ecommerce\Models\ProductAttributeSet;
use Botble\Ecommerce\Repositories\Interfaces\ProductInterface;
use Illuminate\View\View;

class RenderProductAttributesViewOnlySupport
{
    public function __construct(
        protected Product $product,
        protected ProductAttributeSet $productAttributeSet,
        protected ProductInterface $productRepository
    ) {
    }

    public function render(array $options = []): View
    {
        $product = $this->product;
        $attributeSet = $this->productAttributeSet;

        $view = EcommerceHelperFacade::viewPath('attributes.attributes-view-only');

        $options = apply_filters('ecommerce_render_product_attributes_view_only_options_before', $options);

        if (isset($options['view'])) {
            $view = $options['view'];
        }

        // Get all attributes of the attribute set, not just the current variation's attributes
        $allAttributes = $attributeSet->attributes()->get()->sortBy('order');
        
        // Get attributes that this product actually has variations for
        $productAttributes = $this
            ->productRepository
            ->getRelatedProductAttributes($product)
            ->where('attribute_set_id', $attributeSet->getKey())
            ->pluck('id')
            ->toArray();

        return view($view, compact('allAttributes', 'productAttributes', 'attributeSet'));
    }
}
