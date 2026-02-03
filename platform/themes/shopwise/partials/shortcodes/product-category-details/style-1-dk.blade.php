<div class="product-category-details style-1-dk pt-3 pb-3">
    <div class="container">
        @php
            $itemsDesktop = (int) ($shortcode->items_desktop ?: 4);
            $itemsTablet = (int) ($shortcode->items_tablet ?: 2);
            $itemsMobile = (int) ($shortcode->items_mobile ?: 1);

            $limit = (int) ($shortcode->total_items ?: ($shortcode->limit ?: 10));
            $mobileLimit = (int) ($shortcode->total_items_mobile ?: $limit);

            $itemsDesktop = min(max($itemsDesktop, 1), 12);
            $itemsTablet = min(max($itemsTablet, 1), 12);
            $itemsMobile = min(max($itemsMobile, 1), 6);

            $productsDesktop = $products->take($limit);
            $productsMobile = $products->take($mobileLimit);

            $mobileCol = 12;
            if (12 % $itemsMobile === 0) {
                $mobileCol = 12 / $itemsMobile;
            } else {
                $mobileCol = 6;
            }
        @endphp

        <div class="row align-items-center">
            <div class="col-12 col-md-3">
                <div class="pcd-text-block h-100 d-flex flex-column text-md-start">
                    @if ($shortcode->title)
                        <div class="heading_s4">
                            <h3>{!! BaseHelper::clean($shortcode->title) !!}</h3>
                        </div>
                    @endif

                    @if ($shortcode->description)
                        <blockquote class="text-muted w-100">{!! BaseHelper::clean($shortcode->description) !!}</blockquote>
                    @endif

                    <div class="d-none d-md-block mt-2 w-100">
                        <a href="{{ $category->url }}" class="btn btn-fill-out">{!! BaseHelper::clean(__('View all')) !!}</a>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-9">
                {{-- Min-width: 768px -> slider + prev/next --}}
                <div class="d-none d-md-block">
                    <div
                        class="product_slider carousel_slider owl-carousel owl-theme nav_style1"
                        data-nav="true"
                        data-dots="false"
                        data-loop="false"
                        data-margin="20"
                        data-responsive='{
                            "0":   {"items": 1, "nav": false, "dots": false, "loop": false},
                            "576": {"items": 1, "nav": false, "dots": false, "loop": false},
                            "768": {"items": {{ $itemsTablet }}, "nav": true, "dots": false, "loop": false},
                            "991": {"items": {{ $itemsDesktop }}, "nav": true, "dots": false, "loop": false}
                        }'
                    >
                        @forelse ($productsDesktop as $product)
                            <div class="item">
                                {!! Theme::partial('product-item', compact('product')) !!}
                            </div>
                        @empty
                            <div class="item">
                                <p class="text-muted">{{ __('No products found') }}</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                {{-- Max-width: 767px -> grid + button moved below list --}}
                <div class="d-block d-md-none">
                    <div class="row">
                        @forelse ($productsMobile as $product)
                            <div class="col-{{ $mobileCol }} mb-3">
                                {!! Theme::partial('product-item', compact('product')) !!}
                            </div>
                        @empty
                            <div class="col-12">
                                <p class="text-muted">{{ __('No products found') }}</p>
                            </div>
                        @endforelse
                    </div>

                    <div class="btn-mb-pcd text-center mt-3">
                        <a href="{{ $category->url }}" class="btn btn-fill-out">{!! BaseHelper::clean(__('View all')) !!}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>