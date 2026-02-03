<div class="section small_pb small_pt">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="heading_s4 text-center">
                    <h2>{!! BaseHelper::clean($shortcode->title) !!}</h2>
                </div>
                <p class="text-center leads">
                    @if ($shortcode->description)
                        {!! BaseHelper::clean($shortcode->description) !!}
                    @endif
                    @if ($shortcode->subtitle)
                        {!! BaseHelper::clean($shortcode->subtitle) !!}
                    @endif
                </p>
            </div>
        </div>
        <div class="row align-items-center">
            <div class="col-12">

                <?php
                    $wrapperClass = 'dk-cat-img-wrapper';
                    $imgClass = 'dk-cat-image';

                    $gridCategories = $categories->take(7)->values();

                    $sliderWrapperClass = $wrapperClass;
                    $ratio = $shortcode->image_aspect_ratio ?? 'default';
                    switch ($ratio) {
                        case 'square':
                            $sliderWrapperClass .= ' ratio-1-1';
                            break;
                        case 'vertical':
                            $sliderWrapperClass .= ' ratio-3-5';
                            break;
                        case 'horizontal':
                            $sliderWrapperClass .= ' ratio-5-3';
                            break;
                        default:
                            $sliderWrapperClass .= ' ratio-auto';
                            break;
                    }

                    $totalCategories = $gridCategories->count();
                    $itemsMobile = min(2, $totalCategories);
                    $itemsTablet = min(3, $totalCategories);
                    $itemsDesktop = min(4, $totalCategories);

                    $sliderMobile = $totalCategories > 2;
                    $sliderTablet = $totalCategories > 3;

                    $responsiveItem = [
                        0 => [
                            'items' => $itemsMobile,
                            'loop' => $sliderMobile,
                            'nav' => $sliderMobile,
                        ],
                        576 => [
                            'items' => $itemsTablet,
                            'loop' => $sliderTablet,
                            'nav' => $sliderTablet,
                        ],
                        768 => [
                            'items' => $itemsDesktop,
                            'loop' => $sliderTablet,
                            'nav' => $sliderTablet,
                        ],
                    ];

                ?>

                <div class="mt-4 mt-md-0 dk-feature_categories dk-fpc-grid-7--style-4-dk">
                    <div class="dk-fpc-gallery dk-fpc-gallery--style-4-dk">
                        <div class="dk-fpc-gallery__left">
                            @if ($gridCategories->get(0))
                                @php($category = $gridCategories->get(0))
                                <div class="categories_box d-flex dk-fpc-gallery__item dk-fpc-gallery__item--1">
                                    <div class="{{ $wrapperClass }}">
                                        <a class="link-cate-image" href="{{ $category->url }}">
                                            <img class="h-100 object-fit-cover {{ $imgClass }}" src="{{ RvMedia::getImageUrl($category->image, null, false, RvMedia::getDefaultImage()) }}" alt="category-image" loading="lazy" />
                                        </a>
                                        <a class="link-cate-text-line" href="{{ $category->url }}">
                                            <span>{{ $category->name }}</span>
                                        </a>
                                    </div>
                                </div>
                            @endif

                            <div class="dk-fpc-gallery__left-bottom">
                                @if ($gridCategories->get(1))
                                    @php($category = $gridCategories->get(1))
                                    <div class="categories_box d-flex dk-fpc-gallery__item dk-fpc-gallery__item--2">
                                        <div class="{{ $wrapperClass }}">
                                            <a class="link-cate-image" href="{{ $category->url }}">
                                                <img class="h-100 object-fit-cover {{ $imgClass }}" src="{{ RvMedia::getImageUrl($category->image, null, false, RvMedia::getDefaultImage()) }}" alt="category-image" loading="lazy" />
                                            </a>
                                            <a class="link-cate-text-line" href="{{ $category->url }}">
                                                <span>{{ $category->name }}</span>
                                            </a>
                                        </div>
                                    </div>
                                @endif

                                @if ($gridCategories->get(2))
                                    @php($category = $gridCategories->get(2))
                                    <div class="categories_box d-flex dk-fpc-gallery__item dk-fpc-gallery__item--3">
                                        <div class="{{ $wrapperClass }}">
                                            <a class="link-cate-image" href="{{ $category->url }}">
                                                <img class="h-100 object-fit-cover {{ $imgClass }}" src="{{ RvMedia::getImageUrl($category->image, null, false, RvMedia::getDefaultImage()) }}" alt="category-image" loading="lazy" />
                                            </a>
                                            <a class="link-cate-text-line" href="{{ $category->url }}">
                                                <span>{{ $category->name }}</span>
                                            </a>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                        @if ($gridCategories->get(3))
                            @php($category = $gridCategories->get(3))
                            <div class="categories_box d-flex dk-fpc-gallery__item dk-fpc-gallery__item--4">
                                <div class="{{ $wrapperClass }}">
                                    <a class="link-cate-image" href="{{ $category->url }}">
                                        <img class="h-100 object-fit-cover {{ $imgClass }}" src="{{ RvMedia::getImageUrl($category->image, null, false, RvMedia::getDefaultImage()) }}" alt="category-image" loading="lazy" />
                                    </a>
                                    <a class="link-cate-text-line" href="{{ $category->url }}">
                                        <span>{{ $category->name }}</span>
                                    </a>
                                </div>
                            </div>
                        @endif

                        <div class="dk-fpc-gallery__right">
                            <div class="dk-fpc-gallery__right-top">
                                @if ($gridCategories->get(4))
                                    @php($category = $gridCategories->get(4))
                                    <div class="categories_box d-flex dk-fpc-gallery__item dk-fpc-gallery__item--5">
                                        <div class="{{ $wrapperClass }}">
                                            <a class="link-cate-image" href="{{ $category->url }}">
                                                <img class="h-100 object-fit-cover {{ $imgClass }}" src="{{ RvMedia::getImageUrl($category->image, null, false, RvMedia::getDefaultImage()) }}" alt="category-image" loading="lazy" />
                                            </a>
                                            <a class="link-cate-text-line" href="{{ $category->url }}">
                                                <span>{{ $category->name }}</span>
                                            </a>
                                        </div>
                                    </div>
                                @endif

                                @if ($gridCategories->get(5))
                                    @php($category = $gridCategories->get(5))
                                    <div class="categories_box d-flex dk-fpc-gallery__item dk-fpc-gallery__item--6">
                                        <div class="{{ $wrapperClass }}">
                                            <a class="link-cate-image" href="{{ $category->url }}">
                                                <img class="h-100 object-fit-cover {{ $imgClass }}" src="{{ RvMedia::getImageUrl($category->image, null, false, RvMedia::getDefaultImage()) }}" alt="category-image" loading="lazy" />
                                            </a>
                                            <a class="link-cate-text-line" href="{{ $category->url }}">
                                                <span>{{ $category->name }}</span>
                                            </a>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            @if ($gridCategories->get(6))
                                @php($category = $gridCategories->get(6))
                                <div class="categories_box d-flex dk-fpc-gallery__item dk-fpc-gallery__item--7">
                                    <div class="{{ $wrapperClass }}">
                                        <a class="link-cate-image" href="{{ $category->url }}">
                                            <img class="h-100 object-fit-cover {{ $imgClass }}" src="{{ RvMedia::getImageUrl($category->image, null, false, RvMedia::getDefaultImage()) }}" alt="category-image" loading="lazy" />
                                        </a>
                                        <a class="link-cate-text-line" href="{{ $category->url }}">
                                            <span>{{ $category->name }}</span>
                                        </a>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="dk-fpc-gallery-slider dk-fpc-gallery-slider--style-4-dk cat_slider cat_style1-dk dk-feature_categories carousel_slider owl-carousel owl-theme nav_style5"
                         data-loop="{{  ($sliderMobile || $sliderTablet) ? 'true' : 'false'  }}"
                         data-dots="false"
                         data-nav="{{  ($sliderMobile || $sliderTablet) ? 'true' : 'false'  }}"
                         data-margin="20"
                         data-responsive='@json($responsiveItem)'>

                        @foreach ($gridCategories as $category)
                            <div class="item d-flex">
                                <div class="categories_box d-flex">
                                    <div class="{{ $sliderWrapperClass }}">
                                        <a class="link-cate-image" href="{{ $category->url }}">
                                            <img class="h-100 object-fit-cover {{ $imgClass }}" src="{{ RvMedia::getImageUrl($category->image, null, false, RvMedia::getDefaultImage()) }}" alt="category-image" loading="lazy" />
                                        </a>
                                        <a class="link-cate-text-line" href="{{ $category->url }}">
                                            <span>{{ $category->name }}</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        @if ($shortcode->link)
            <div class="dk-product_button">
                <a href="{{ url($shortcode->link) }}" class="btn btn-fill-out">{!! BaseHelper::clean($shortcode->link_text ?: __('View All')) !!}</a>
            </div>
        @endif
    </div>
</div>