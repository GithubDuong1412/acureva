<div class="section product-collection-details style-1 pt-0">
    <div class="container">

        @php
            $columnsDesktop = (int) ($shortcode->columns_desktop ?: 4);
            $columnsTablet = (int) ($shortcode->columns_tablet ?: 3);
            $columnsMobile = (int) ($shortcode->columns_mobile ?: 2);

            $columnsDesktop = min(max($columnsDesktop, 1), 6);
            $columnsTablet = min(max($columnsTablet, 1), 6);
            $columnsMobile = min(max($columnsMobile, 1), 6);

            $desktopCol = 12 / $columnsDesktop;
            $tabletCol = 12 / $columnsTablet;
            $mobileCol = 12 / $columnsMobile;

            if (12 % $columnsDesktop !== 0) {
                $desktopCol = 3;
            }

            if (12 % $columnsTablet !== 0) {
                $tabletCol = 4;
            }

            if (12 % $columnsMobile !== 0) {
                $mobileCol = 6;
            }
        @endphp

        @if ($shortcode->title)
            <div class="row">
                <div class="col-12">
                    <div class="heading_s2">
                        <h2>{{ $shortcode->title }}</h2>
                    </div>
                </div>
            </div>
        @endif

        <div class="row">
            @forelse ($products as $product)
                <div class="col-lg-{{ $desktopCol }} col-md-{{ $tabletCol }} col-sm-{{ $mobileCol }} col-{{ $mobileCol }}">
                    {!! Theme::partial('product-item', [
                        'product' => $product,
                        'lazyLoad' => $shortcode->lazy_loading === 'yes',
                    ]) !!}
                </div>
            @empty
                <div class="col-12">
                    <p class="text-muted">{{ __('No products found') }}</p>
                </div>
            @endforelse
        </div>

    </div>
</div>
