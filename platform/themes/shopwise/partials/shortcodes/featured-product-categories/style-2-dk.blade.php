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
                    $ratio = $shortcode->image_aspect_ratio ?? 'default';
                    $wrapperClass = 'dk-cat-img-wrapper';
                    $imgClass = 'dk-cat-image';

                    switch ($ratio) {
                        case 'square':
                            $wrapperClass .= ' ratio-1-1';
                            break;
                        case 'vertical':
                            $wrapperClass .= ' ratio-3-5';
                            break;
                        case 'horizontal':
                            $wrapperClass .= ' ratio-5-3';
                            break;
                        default:
                            $wrapperClass .= ' ratio-auto';
                            break;
                    }

                    $gridCategories = $categories->take(7)->values();
                ?>

                <div class="dk-feature_categories dk-fpc-grid-7 mt-4 mt-md-0">
                    <div class="dk-fpc-grid-7__col dk-fpc-grid-7__col--1">
                        @if ($gridCategories->get(0))
                            @php($category = $gridCategories->get(0))
                            <div class="categories_box d-flex dk-fpc-grid-7__item dk-fpc-grid-7__item--1">
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

                        <div class="dk-fpc-grid-7__row dk-fpc-grid-7__row--2">
                            @if ($gridCategories->get(1))
                                @php($category = $gridCategories->get(1))
                                <div class="categories_box d-flex dk-fpc-grid-7__item dk-fpc-grid-7__item--2">
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
                                <div class="categories_box d-flex dk-fpc-grid-7__item dk-fpc-grid-7__item--3">
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

                    <div class="dk-fpc-grid-7__col dk-fpc-grid-7__col--2">
                        @if ($gridCategories->get(3))
                            @php($category = $gridCategories->get(3))
                            <div class="categories_box d-flex dk-fpc-grid-7__item dk-fpc-grid-7__item--4">
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

                    <div class="dk-fpc-grid-7__col dk-fpc-grid-7__col--3">
                        <div class="dk-fpc-grid-7__row dk-fpc-grid-7__row--1">
                            @if ($gridCategories->get(4))
                                @php($category = $gridCategories->get(4))
                                <div class="categories_box d-flex dk-fpc-grid-7__item dk-fpc-grid-7__item--5">
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
                                <div class="categories_box d-flex dk-fpc-grid-7__item dk-fpc-grid-7__item--6">
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
                            <div class="categories_box d-flex dk-fpc-grid-7__item dk-fpc-grid-7__item--7">
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
            </div>
        </div>

        @if ($shortcode->link)
            <div class="dk-product_button">
                <a href="{{ url($shortcode->link) }}" class="btn btn-fill-out">{!! BaseHelper::clean($shortcode->link_text ?: __('View All')) !!}</a>
            </div>
        @endif
    </div>
</div>
