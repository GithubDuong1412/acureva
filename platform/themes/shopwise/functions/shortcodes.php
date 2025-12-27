<?php

use Botble\Ads\Facades\AdsManager;
use Botble\Ads\Models\Ads;
use Botble\Base\Enums\BaseStatusEnum;
use Botble\Base\Forms\FieldOptions\MediaImageFieldOption;
use Botble\Base\Forms\FieldOptions\NumberFieldOption;
use Botble\Base\Forms\FieldOptions\SelectFieldOption;
use Botble\Base\Forms\FieldOptions\TextareaFieldOption;
use Botble\Base\Forms\FieldOptions\TextFieldOption;
use Botble\Base\Forms\Fields\MediaImageField;
use Botble\Base\Forms\Fields\NumberField;
use Botble\Base\Forms\Fields\SelectField;
use Botble\Base\Forms\Fields\TextareaField;
use Botble\Base\Forms\Fields\TextField;
use Botble\Blog\Repositories\Interfaces\PostInterface;
use Botble\Ecommerce\Facades\EcommerceHelper;
use Botble\Ecommerce\Models\FlashSale;
use Botble\Ecommerce\Models\ProductCollection;
use Botble\Faq\Models\FaqCategory;
use Botble\Shortcode\Compilers\Shortcode;
use Botble\Shortcode\Forms\ShortcodeForm;
use Botble\SimpleSlider\Models\SimpleSlider;
use Botble\Testimonial\Models\Testimonial;
use Botble\Theme\Facades\Theme;
use Botble\Theme\Forms\Fields\ThemeIconField;
use Botble\Theme\Supports\ThemeSupport;

app()->booted(function (): void {
    ThemeSupport::registerGoogleMapsShortcode();
    ThemeSupport::registerYoutubeShortcode();

    if (is_plugin_active('ecommerce')) {
        add_shortcode(
            'featured-product-categories',
            __('Featured Product Categories'),
            __('Featured Product Categories'),
            function (Shortcode $shortcode) {
                $categories = get_featured_product_categories();

                return Theme::partial('shortcodes.featured-product-categories.index', [
                    'shortcode' => $shortcode,
                    'categories' => $categories,
                ]);
            }
        );

        shortcode()->setAdminConfig('featured-product-categories', function (array $attributes) {
            return ShortcodeForm::createFromArray($attributes)
                ->withLazyLoading()
                ->add('title', TextField::class, TextFieldOption::make()
                    ->label(__('Title'))
                    ->placeholder(__('Title')))
                ->add('description', TextareaField::class, TextareaFieldOption::make()
                    ->label(__('Description'))
                    ->rows(3))
                ->add('subtitle', TextareaField::class, TextareaFieldOption::make()
                    ->label(__('Subtitle'))
                    ->rows(3))
                ->add('link', TextField::class, TextFieldOption::make()
                    ->label(__('Link')))
                ->add('link_text', TextField::class, TextFieldOption::make()
                    ->label(__('Link text')))
                ->add('style', SelectField::class, SelectFieldOption::make()
                    ->label(__('Style'))
                    ->choices([
                        'style-1' => __('Style 1'),
                        'style-4' => __('Style 4'),
                        'style-1-dk' => __('Style DK-1'),
                        'style-4-dk' => __('Style DK-4'),
                    ]))
                ->add('image_aspect_ratio', SelectField::class, SelectFieldOption::make()
                    ->label(__('Image Aspect Ratio'))
                    ->choices([
                        'default' => __('Default'),
                        'square' => __('Square'),
                        'vertical' => __('Vertical'),
                        'horizontal' => __('Horizontal'),
                    ])
                    ->toArray()
                    );
        });

        shortcode()->registerLoadingState('featured-product-categories', Theme::getThemeNamespace('partials.shortcodes.featured-product-categories-skeleton'));

        add_shortcode('featured-brands', __('Featured Brands'), __('Featured Brands'), function (Shortcode $shortcode) {
            $brands = get_featured_brands();

            return Theme::partial('shortcodes.featured-brands.index', compact('brands', 'shortcode'));
        });

        shortcode()->setAdminConfig('featured-brands', function (array $attributes) {
            return ShortcodeForm::createFromArray($attributes)
                ->withLazyLoading()
                ->add('title', TextField::class, TextFieldOption::make()
                    ->label(__('Title')))
                ->add('style', SelectField::class, SelectFieldOption::make()
                    ->label(__('Style'))
                    ->choices([
                        'style-1' => __('Style 1'),
                        'style-3' => __('Style 3'),
                    ]));
        });

        shortcode()->registerLoadingState('featured-brands', Theme::getThemeNamespace('partials.shortcodes.featured-brands-skeleton'));

        add_shortcode(
            'product-collections',
            __('Product Collections'),
            __('Product Collections'),
            function (Shortcode $shortcode) {
                $collections = ProductCollection::query()
                    ->wherePublished()
                    ->select('id', 'name', 'slug')
                    ->get();

                if ($collections->isEmpty()) {
                    return null;
                }

                $collectionId = $collections->first()->getKey();
                if ($shortcode->collection_id && $collections->firstWhere('id', $shortcode->collection_id)) {
                    $collectionId = $shortcode->collection_id;
                }

                $limit = (int) $shortcode->limit ?: 10;

                $products = get_products_by_collections(
                    array_merge([
                        'collections' => [
                            'by' => 'id',
                            'value_in' => [$collectionId],
                        ],
                        'take' => $limit,
                        'with' => EcommerceHelper::withProductEagerLoadingRelations(),
                    ], EcommerceHelper::withReviewsParams())
                );

                return Theme::partial(
                    'shortcodes.product-collections.index',
                    compact('limit', 'shortcode', 'products', 'collectionId', 'collections')
                );
            }
        );

        shortcode()->setAdminConfig('product-collections', function (array $attributes) {
            $form = ShortcodeForm::createFromArray($attributes)
                ->withLazyLoading()
                ->add('title', TextField::class, TextFieldOption::make()
                    ->label(__('Title')));

            if (is_plugin_active('ads')) {
                $ads = Ads::query()
                    ->wherePublished()
                    ->notExpired()
                    ->get();

                if ($ads->isNotEmpty()) {
                    $adsOptions = ['' => '-- ' . __('None') . ' --'];
                    foreach ($ads as $ad) {
                        $adsOptions[$ad->key] = $ad->name;
                    }

                    $form->add('ads_key', SelectField::class, SelectFieldOption::make()
                        ->label(__('Ads'))
                        ->choices($adsOptions));
                }
            }

            $form->add('style', SelectField::class, SelectFieldOption::make()
                ->label(__('Style'))
                ->choices([
                    'style-1' => __('Style 1'),
                    'style-5' => __('Style 5'),
                    'style-6' => __('Style 6'),
                ]));

            return $form;
        });

        shortcode()->registerLoadingState('product-collections', Theme::getThemeNamespace('partials.shortcodes.product-collections-skeleton'));

        add_shortcode(
            'product-collection-details',
            __('Product Collection Details'),
            __('Display products from a single collection'),

            function (Shortcode $shortcode) {
                if( ! $shortcode->collection_id) {
                    return null;
                }

                $collection = ProductCollection::query()
                    ->wherePublished()
                    ->where('id', $shortcode->collection_id)
                    ->first();

                if( ! $collection) {
                    return null;
                }

                $products = get_products_by_collections(
                    array_merge([
                        'collections' => [
                            'by' => 'id',
                            'value_in' => [$collection->id], 
                        ],
                        'take' => (int) ($shortcode->limit ?: 8),
                        'with' => EcommerceHelper::withProductEagerLoadingRelations(),
                    ], EcommerceHelper::withReviewsParams())
                );

                return Theme::partial(
                    'shortcodes.product-collection-details.index',
                    compact('shortcode', 'collection', 'products')
                );
            }
        );

        shortcode()->setAdminConfig('product-collection-details', function (array $attributes) {
            $collections = ProductCollection::query()
                ->wherePublished()
                ->pluck('name', 'id')
                ->all();

            $collectionOptions = ['' => '-- ' . __('Selection collection') . ' --'] + $collections;

            return ShortcodeForm::createFromArray($attributes)
                ->add('title', TextField::class, TextFieldOption::make()
                    ->label(__('Title'))
                )

                ->add('limit', NumberField::class, NumberFieldOption::make()
                    ->label(__('Number of products'))
                    ->defaultValue(8)
                    ->toArray()
                )

                ->add('collection_id', SelectField::class, SelectFieldOption::make() 
                    ->label(__('Choose Product Collecion'))
                    ->choices($collectionOptions)
                    ->toArray()
                )

                ->add('columns_desktop', NumberField::class, NumberFieldOption::make()
                    ->label(__('Column (Desktop)'))
                    ->defaultValue(4)
                    ->toArray()
                )

                ->add('columns_tablet', NumberField::class, NumberFieldOption::make()
                    ->label(__('Column (Tablet)'))
                    ->defaultValue(3)
                    ->toArray()
                )

                ->add('columns_mobile', NumberField::class, NumberFieldOption::make()
                    ->label(__('Column (Mobile)'))
                    ->defaultValue(2)
                    ->toArray()
                )

                ->add('style', SelectField::class, SelectFieldOption::make()
                    ->label(__('Style'))
                    ->choices([
                        'style-1' => __('Style 1'),
                        'style-2' => __('Style 2'),
                    ])
                    ->defaultValue('style-1')
                    ->toArray()
                )

                ->add('lazy_loading', SelectField::class, SelectFieldOption::make()
                    ->label(__('Enable lazy loading'))
                    ->choices([
                        'yes' => __('Yes'),
                        'no' => __('No'),
                    ])
                    ->toArray()
                );
        });

        shortcode()->registerLoadingState('product-collection-details', Theme::getThemeNamespace('partials.shortcodes.product-collection-details-skeleton'));


        add_shortcode(
            'trending-products',
            __('Trending Products'),
            __('Trending Products'),
            function (Shortcode $shortcode) {
                $products = get_trending_products(
                    [
                        'take' => min(
                            max((int) $shortcode->number_of_displays ?: 10, 2),
                            20
                        ),
                    ] + EcommerceHelper::withReviewsParams()
                );

                return Theme::partial('shortcodes.trending-products.index', compact('products', 'shortcode'));
            }
        );

        shortcode()->setAdminConfig('trending-products', function (array $attributes) {
            $form = ShortcodeForm::createFromArray($attributes)
                ->add('title', TextField::class, TextFieldOption::make()
                    ->label(__('Title')))
                ->add('description', TextField::class, TextFieldOption::make()
                    ->label(__('Description')))
                ->add('number_of_displays', NumberField::class, NumberFieldOption::make()
                    ->label(__('Number of products'))
                    ->defaultValue(10))
                ->add('style', SelectField::class, SelectFieldOption::make()
                    ->label(__('Style'))
                    ->choices([
                        'style-1' => __('Style 1'),
                        'style-3' => __('Style 3'),
                        'style-4' => __('Style 4'),
                    ]));

            if (is_plugin_active('ads')) {
                $ads = Ads::query()
                    ->wherePublished()
                    ->notExpired()
                    ->get();

                if ($ads->isNotEmpty()) {
                    $adsOptions = ['' => '-- ' . __('None') . ' --'];
                    foreach ($ads as $ad) {
                        $adsOptions[$ad->key] = $ad->name;
                    }

                    $form->add('ads_key', SelectField::class, SelectFieldOption::make()
                        ->label(__('Ads'))
                        ->choices($adsOptions));
                }
            }

            return $form;
        });

        shortcode()->registerLoadingState('trending-products', Theme::getThemeNamespace('partials.shortcodes.trending-products-skeleton'));

        add_shortcode('product-blocks', __('Product Blocks'), __('Product Blocks'), function (Shortcode $shortcode) {
            $numberOfDisplays = min(max((int) $shortcode->number_of_displays ?: 10, 2), 20);
            $featuredProducts = collect();
            if ($shortcode->featured_product_title) {
                $featuredProducts = get_featured_products(
                    ['take' => $numberOfDisplays] + EcommerceHelper::withReviewsParams()
                );
            }

            $topRatedProducts = collect();
            if ($shortcode->top_rated_product_title && EcommerceHelper::isReviewEnabled()) {
                $topRatedProducts = get_top_rated_products(
                    $numberOfDisplays,
                    [],
                    EcommerceHelper::withReviewsParams()['withCount']
                );
            }

            $onSaleProducts = collect();
            if ($shortcode->on_sale_product_title) {
                $onSaleProducts = get_products_on_sale(
                    ['take' => $numberOfDisplays] + EcommerceHelper::withReviewsParams()
                );
            }

            $data = collect([
                'featured_product' => $featuredProducts,
                'top_rated_product' => $topRatedProducts,
                'on_sale_product' => $onSaleProducts,
            ])->filter(fn ($item) => $item->isNotEmpty());

            return Theme::partial('shortcodes.product-blocks.index', compact('data', 'shortcode'));
        });

        shortcode()->setAdminConfig('product-blocks', function (array $attributes) {
            $form = ShortcodeForm::createFromArray($attributes)
                ->withLazyLoading()
                ->add('featured_product_title', TextField::class, TextFieldOption::make()
                    ->label(__('Featured Product Title')))
                ->add('featured_product_description', TextField::class, TextFieldOption::make()
                    ->label(__('Featured Product Description')));

            if (EcommerceHelper::isReviewEnabled()) {
                $form->add('top_rated_product_title', TextField::class, TextFieldOption::make()
                        ->label(__('Top Rated Product Title')))
                    ->add('top_rated_product_description', TextField::class, TextFieldOption::make()
                        ->label(__('Top Rated Product Description')));
            }

            $form->add('on_sale_product_title', TextField::class, TextFieldOption::make()
                    ->label(__('On Sale Product Title')))
                ->add('on_sale_product_description', TextField::class, TextFieldOption::make()
                    ->label(__('On Sale Product Description')))
                ->add('number_of_displays', NumberField::class, NumberFieldOption::make()
                    ->label(__('Limit'))
                    ->defaultValue(10))
                ->add('style', SelectField::class, SelectFieldOption::make()
                    ->label(__('Style'))
                    ->choices([
                        'style-1' => __('Style 1'),
                        'style-2' => __('Style 2'),
                        'style-4' => __('Style 4'),
                    ]));

            return $form;
        });

        shortcode()->registerLoadingState('product-blocks', Theme::getThemeNamespace('partials.shortcodes.product-blocks-skeleton'));


        // Begin - All Products

        add_shortcode('all-products', __('All Products'), __('All Products'), function (Shortcode $shortcode) {
            $products = get_products([
                'paginate' => [
                    'per_page' => $shortcode->per_page,
                    'current_paged' => (int) request()->input('page'),
                ],
            ] + EcommerceHelper::withReviewsParams());

            return Theme::partial('shortcodes.all-products.index', [
                'title' => $shortcode->title,
                'products' => $products,
                'shortcode' => $shortcode,
            ]);
        });


        shortcode()->setAdminConfig('all-products', function (array $attributes) {
            return ShortcodeForm::createFromArray($attributes)
                ->withLazyLoading()

                ->add('title', TextField::class, TextFieldOption::make()
                    ->label(__('Title'))
                    ->toArray()
                )

                ->add('description', TextField::class, TextFieldOption::make()
                    ->label(__('Description'))
                    ->toArray()
                )

                ->add('per_page', NumberField::class, NumberFieldOption::make()
                    ->label(__('Total products / Number of products per page.'))
                    ->defaultValue(12)
                    ->toArray()
                )

                ->add('style', SelectField::class, SelectFieldOption::make()
                    ->label(__('Style'))
                    ->choices([
                        'style-1' => __('Style 1'),
                        'style-2' => __('Style 2 DK'),
                    ])
                    ->defaultValue($attributes['style'] ?? 'style-1')
                    ->toArray()
                );
        });

        shortcode()->registerLoadingState(
            'all-products',
            Theme::getThemeNamespace('partials.shortcodes.all-products-skeleton')
        );

        // End - All Products

        add_shortcode('all-brands', __('All Brands'), __('All Brands'), function (Shortcode $shortcode) {
            $brands = get_all_brands();

            return Theme::partial('shortcodes.all-brands', [
                'title' => $shortcode->title,
                'brands' => $brands,
            ]);
        });

        shortcode()->setAdminConfig('all-brands', function (array $attributes) {
            return ShortcodeForm::createFromArray($attributes)
                ->withLazyLoading()
                ->add('title', TextField::class, TextFieldOption::make()
                    ->label(__('Title')));
        });

        shortcode()->registerLoadingState('all-brands', Theme::getThemeNamespace('partials.shortcodes.all-brands-skeleton'));

        add_shortcode('flash-sale', __('Flash sale'), __('Flash sale'), function (Shortcode $shortcode) {
            $with = [
                'products' => function ($query) {
                    $reviewParams = EcommerceHelper::withReviewsParams();

                    if (EcommerceHelper::isReviewEnabled()) {
                        $query->withAvg($reviewParams['withAvg'][0], $reviewParams['withAvg'][1]);
                    }

                    return $query
                        ->wherePublished()
                        ->withCount($reviewParams['withCount'])
                        ->with(EcommerceHelper::withProductEagerLoadingRelations());
                },
            ];

            if (in_array($shortcode->style, ['style-4', 'style-2'])) {
                if ($shortcode->flash_sale_id) {
                    $flashSale = FlashSale::query()
                        ->notExpired()
                        ->where([
                            'status' => BaseStatusEnum::PUBLISHED,
                            'id' => $shortcode->flash_sale_id,
                        ])
                        ->when($shortcode->style == 'style-2', fn ($query) => $query->with($with))
                        ->first();
                    if (! $flashSale) {
                        return null;
                    }

                    return Theme::partial('shortcodes.flash-sale.index', compact('flashSale', 'shortcode'));
                }

                return null;
            }
            $flashSales = FlashSale::query()
                ->notExpired()
                ->wherePublished()
                ->with($with)
                ->when($shortcode->flash_sale_id, fn ($query) => $query->where('id', $shortcode->flash_sale_id))
                ->get();

            if ($flashSales->isEmpty()) {
                return null;
            }

            return Theme::partial('shortcodes.flash-sale.index', compact('flashSales', 'shortcode'));
        });

        shortcode()->setAdminConfig('flash-sale', function (array $attributes) {
            $flashSales = FlashSale::query()
                ->notExpired()
                ->wherePublished()
                ->get();

            $flashSaleOptions = ['' => '-- ' . __('Select') . ' --'];
            foreach ($flashSales as $flashSale) {
                $flashSaleOptions[$flashSale->id] = $flashSale->name;
            }

            $form = ShortcodeForm::createFromArray($attributes)
                ->withLazyLoading()
                ->add('title', TextField::class, TextFieldOption::make()
                    ->label(__('Title')))
                ->add('description', TextField::class, TextFieldOption::make()
                    ->label(__('Description')))
                ->add('flash_sale_id', SelectField::class, SelectFieldOption::make()
                    ->label(__('Flash sale'))
                    ->choices($flashSaleOptions))
                ->add('background_image', MediaImageField::class, MediaImageFieldOption::make()
                    ->label(__('Background image')))
                ->add('button_url', TextField::class, TextFieldOption::make()
                    ->label(__('Button URL')))
                ->add('button_text', TextField::class, TextFieldOption::make()
                    ->label(__('Button text')))
                ->add('style', SelectField::class, SelectFieldOption::make()
                    ->label(__('Style'))
                    ->choices([
                        'style-1' => __('Style 1'),
                        'style-4' => __('Style 4'),
                    ]));

            if (is_plugin_active('newsletter')) {
                $form->add('show_newsletter', SelectField::class, SelectFieldOption::make()
                    ->label(__('Show newsletter'))
                    ->choices([
                        'yes' => __('Yes'),
                        'no' => __('No'),
                    ]));
            }

            return $form;
        });

        shortcode()->registerLoadingState('flash-sale', Theme::getThemeNamespace('partials.shortcodes.flash-sale-skeleton'));
    }

    add_shortcode('banners', __('Banners'), __('Banners'), function (Shortcode $shortcode) {
        return Theme::partial('shortcodes.banners', [
            'image1' => $shortcode->image1,
            'url1' => $shortcode->url1,
            'image2' => $shortcode->image2,
            'url2' => $shortcode->url2,
            'image3' => $shortcode->image3,
            'url3' => $shortcode->url3,
        ]);
    });

    shortcode()->setAdminConfig('banners', function (array $attributes) {
        return ShortcodeForm::createFromArray($attributes)
            ->add('image1', MediaImageField::class, MediaImageFieldOption::make()
                ->label('Image 1 (540x300)'))
            ->add('url1', TextField::class, TextFieldOption::make()
                ->label('URL 1')
                ->placeholder('URL 1'))
            ->add('image2', MediaImageField::class, MediaImageFieldOption::make()
                ->label('Image 2 (540x300)'))
            ->add('url2', TextField::class, TextFieldOption::make()
                ->label('URL 2')
                ->placeholder('URL 2'))
            ->add('image3', MediaImageField::class, MediaImageFieldOption::make()
                ->label('Image 3 (540x300)'))
            ->add('url3', TextField::class, TextFieldOption::make()
                ->label('URL 3')
                ->placeholder('URL 3'));
    });

    add_shortcode('our-features', __('Our features'), __('Our features'), function (Shortcode $shortcode) {
        return Theme::partial('shortcodes.our-features.index', compact('shortcode'));
    });

    shortcode()->setAdminConfig('our-features', function (array $attributes) {
        $form = ShortcodeForm::createFromArray($attributes);

        for ($i = 1; $i <= 4; $i++) {
            $form
                ->add("icon{$i}", ThemeIconField::class, TextFieldOption::make()
                    ->label(__('Icon :number', ['number' => $i])))
                ->add("title{$i}", TextField::class, TextFieldOption::make()
                    ->label(__('Title :number', ['number' => $i])))
                ->add("subtitle{$i}", TextField::class, TextFieldOption::make()
                    ->label(__('Subtitle :number', ['number' => $i])));
        }

        $form->add('style', SelectField::class, SelectFieldOption::make()
            ->label(__('Style'))
            ->choices([
                'style-1' => __('Style 1'),
                'style-3' => __('Style 3'),
            ]));

        return $form;
    });

    add_shortcode('instagram', __('Instagram images'), __('Instagram images'), function (Shortcode $shortcode) {
        return Theme::partial('shortcodes.instagram.index', compact('shortcode'));
    });

    shortcode()->setAdminConfig('instagram', function (array $attributes) {
        $form = ShortcodeForm::createFromArray($attributes)
            ->add('title', TextField::class, TextFieldOption::make()
                ->label(__('Title')))
            ->add('subtitle', TextareaField::class, TextareaFieldOption::make()
                ->label(__('Instagram username'))
                ->placeholder(__('@yourinstagram')));

        $form->add('images', MediaImageField::class, MediaImageFieldOption::make()
            ->label(__('Instagram images')));

        return $form;
    });

    if (is_plugin_active('testimonial')) {
        add_shortcode('testimonials', __('Testimonials'), __('Testimonials'), function (Shortcode $shortcode) {
            $testimonials = Testimonial::query()
                ->where(['status' => BaseStatusEnum::PUBLISHED])
                ->get();

            return Theme::partial('shortcodes.testimonials', [
                'title' => $shortcode->title,
                'testimonials' => $testimonials,
            ]);
        });

        shortcode()->setAdminConfig('testimonials', function (array $attributes) {
            return ShortcodeForm::createFromArray($attributes)
                ->withLazyLoading()
                ->add('title', TextField::class, TextFieldOption::make()
                    ->label(__('Title')));
        });

        shortcode()->registerLoadingState('testimonials', Theme::getThemeNamespace('partials.shortcodes.testimonials-skeleton'));
    }

    if (is_plugin_active('newsletter')) {
        add_shortcode('newsletter-form', __('Newsletter Form'), __('Newsletter Form'), function (Shortcode $shortcode) {
            return Theme::partial('shortcodes.newsletter-form.index', compact('shortcode'));
        });

        shortcode()->setAdminConfig('newsletter-form', function (array $attributes) {
            return ShortcodeForm::createFromArray($attributes)
                ->add('title', TextField::class, TextFieldOption::make()
                    ->label(__('Title')))
                ->add('subtitle', TextareaField::class, TextareaFieldOption::make()
                    ->label(__('Subtitle'))
                    ->rows(3))
                ->add('description', TextareaField::class, TextareaFieldOption::make()
                    ->label(__('Description'))
                    ->rows(3))
                ->add('style', SelectField::class, SelectFieldOption::make()
                    ->label(__('Style'))
                    ->choices([
                        'style-1' => __('Style 1'),
                        'style-2' => __('Style 2'),
                    ]));
        });
    }

    if (is_plugin_active('contact')) {
        add_filter(CONTACT_FORM_TEMPLATE_VIEW, function () {
            return Theme::getThemeNamespace('partials.shortcodes.contact-form');
        }, 120);
    }

    if (is_plugin_active('blog')) {
        add_shortcode('featured-news', __('Featured News'), __('Featured News'), function (Shortcode $shortcode) {
            $posts = app(PostInterface::class)->getFeatured(3);

            return Theme::partial('shortcodes.featured-news', [
                'title' => $shortcode->title,
                'description' => $shortcode->description,
                'subtitle' => $shortcode->subtitle,
                'posts' => $posts,
            ]);
        });
        shortcode()->setAdminConfig('featured-news', function (array $attributes) {
            return ShortcodeForm::createFromArray($attributes)
                ->withLazyLoading()
                ->add('title', TextField::class, TextFieldOption::make()
                    ->label(__('Title')))
                ->add('subtitle', TextareaField::class, TextareaFieldOption::make()
                    ->label(__('Subtitle'))
                    ->rows(3))
                ->add('description', TextareaField::class, TextareaFieldOption::make()
                    ->label(__('Description'))
                    ->rows(3));
        });

        shortcode()->registerLoadingState('featured-news', Theme::getThemeNamespace('partials.shortcodes.featured-news-skeleton'));
    }

    if (is_plugin_active('simple-slider')) {
        add_filter(SIMPLE_SLIDER_VIEW_TEMPLATE, function () {
            return Theme::getThemeNamespace('partials.shortcodes.simple-slider.index');
        }, 120);

        shortcode()->setAdminConfig('simple-slider', function (array $attributes) {
            $sliders = SimpleSlider::query()
                ->wherePublished()
                ->pluck('name', 'key')
                ->all();

            $form = ShortcodeForm::createFromArray($attributes)
                ->add('key', SelectField::class, SelectFieldOption::make()
                    ->label(trans('plugins/simple-slider::simple-slider.select_slider'))
                    ->choices($sliders));

            if (is_plugin_active('ecommerce')) {
                $form->add('collapsing_product_categories', SelectField::class, SelectFieldOption::make()
                    ->label(__('Collapsing product categories?'))
                    ->choices([
                        '' => __('Inherit from theme option'),
                        'yes' => __('Yes'),
                        'no' => __('No'),
                    ]));
            }

            $form->add('style', SelectField::class, SelectFieldOption::make()
                ->label(__('Style'))
                ->choices([
                    'style-1' => __('Style 1'),
                    'style-2' => __('Style 2'),
                    'style-2-dk_custom' => __('Style 2 DK'),
                    'style-3' => __('Style 3'),
                    'style-4' => __('Style 4'),
                    'style-5' => __('Style 5'),
                    'style-6' => __('Style 6'),
                ]));

            if (is_plugin_active('ads')) {
                $ads = Ads::query()
                    ->wherePublished()
                    ->notExpired()
                    ->get();

                if ($ads->isNotEmpty()) {
                    $adsOptions = ['' => __('-- None --')] + $ads->pluck('name', 'key')->toArray();

                    $form->add('ads_1', SelectField::class, SelectFieldOption::make()
                        ->label(__('Ads 1'))
                        ->choices($adsOptions));

                    $form->add('ads_2', SelectField::class, SelectFieldOption::make()
                        ->label(__('Ads 2'))
                        ->choices($adsOptions));
                }
            }

            return $form;
        });
    }

    if (is_plugin_active('ads')) {
        add_shortcode('theme-ads', __('Theme ads'), __('Theme ads'), function (Shortcode $shortcode) {
            $style = $shortcode->style;

            if (! in_array($style, ['style-1', 'style-2', 'style-3'])) {
                $style = 'style-1';
            }

            $bannerClass = null;
            switch ($style) {
                case 'style-1':
                    $bannerClass = 'sale-banner mb-3 mb-md-4';

                    break;
                case 'style-2':
                case 'style-3':
                    $bannerClass = 'single_banner';

                    break;
            }

            $ads = [];
            for ($i = 1; $i < 5; $i++) {
                if ($key = $shortcode->{'key_' . $i}) {
                    $ad = AdsManager::displayAds((string) $key, ['class' => $bannerClass], $style == 'style-1' ? ['class' => 'hover_effect1'] : []);
                    if ($ad) {
                        $ads[] = $ad;
                    }
                }
            }

            $ads = array_filter($ads);

            if (empty($ads)) {
                return null;
            }

            return Theme::partial('shortcodes.theme-ads.index', compact('shortcode', 'ads', 'style'));
        });

        shortcode()->setAdminConfig('theme-ads', function (array $attributes) {
            $ads = Ads::query()
                ->wherePublished()
                ->notExpired()
                ->get();

            $adsOptions = ['' => '-- ' . __('Select ads') . ' --'];
            foreach ($ads as $ad) {
                $adsOptions[$ad->key] = $ad->name;
            }

            $form = ShortcodeForm::createFromArray($attributes)
                ->add('style', SelectField::class, SelectFieldOption::make()
                    ->label(__('Style'))
                    ->choices([
                        'style-1' => __('Style 1'),
                        'style-2' => __('Style 2'),
                        'style-3' => __('Style 3'),
                    ]));

            for ($i = 1; $i <= 4; $i++) {
                $form->add("key_{$i}", SelectField::class, SelectFieldOption::make()
                    ->label(__('Ad :number', ['number' => $i]))
                    ->choices($adsOptions));
            }

            return $form;
        });
    }

    if (is_plugin_active('faq')) {
        add_shortcode('faqs', __('FAQs'), __('List of FAQs'), function (Shortcode $shortcode) {
            $categories = FaqCategory::query()
                ->wherePublished()
                ->with([
                    'faqs' => function ($query): void {
                        $query->wherePublished();
                    },
                ])
                ->orderBy('order')->latest()
                ->when($shortcode->category_id, function ($query, $categoryId): void {
                    $query->where('id', $categoryId);
                })
                ->get();

            return Theme::partial('shortcodes.faqs', compact('categories'));
        });

        shortcode()->setAdminConfig('faqs', function (array $attributes) {
            $categories = FaqCategory::query()
                ->wherePublished()
                ->pluck('name', 'id')
                ->all();

            $categoryOptions = ['' => '-- ' . __('All') . ' --'] + $categories;

            return ShortcodeForm::createFromArray($attributes)
                ->add('category_id', SelectField::class, SelectFieldOption::make()
                    ->label(__('Category'))
                    ->choices($categoryOptions));
        });
    }
});
