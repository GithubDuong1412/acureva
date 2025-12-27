<div class="section product-collection-details style-2 pt-0">
    <div class="container">

        @php
            $columnsDesktop = (int) ($shortcode->columns_desktop ?: 4);
            $columnsTablet = (int) ($shortcode->columns_tablet ?: 3);
            $columnsMobile = (int) ($shortcode->columns_mobile ?: 2);

            $columnsDesktop = min(max($columnsDesktop, 1), 6);
            $columnsTablet = min(max($columnsTablet, 1), 6);
            $columnsMobile = min(max($columnsMobile, 1), 6);
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
            <div class="col-12">

                <div
                    class="product_slider carousel_slider owl-carousel owl-theme nav_style1"
                    data-nav="true"
                    data-dots="false"
                    data-loop="false"
                    data-margin="20"
                    data-responsive='{
                        "0": {"items": {{ $columnsMobile }}},
                        "576": {"items": {{ $columnsMobile }}},
                        "768": {"items": {{ $columnsTablet }}},
                        "991": {"items": {{ $columnsDesktop }} }
                    }'
                >
                    @foreach ($products as $product)
                        <div class="item">
                            {!! Theme::partial('product-item', [
                                'product' => $product,
                                'lazyLoad' => $shortcode->lazy_loading === 'yes',
                            ]) !!}
                        </div>
                    @endforeach
                </div>

            </div>
        </div>

    </div>
</div>

<!-- 
<li class=" dropdown   ">
    <a class="dropdown-toggle nav-link show" href="http://acureva.test/en/products" data-bs-toggle="dropdown" aria-expanded="true">
        Products
    </a>
    
    <div class="dropdown-menu dropdown-reverse show" data-bs-popper="static">
        <ul>
            <li>
                <a class=" dropdown-item menu-link " href="http://acureva.test/en/mental-health-humor-collection">
                    Mental Health Humor Collection
                </a>
            </li>
            <li>
                <a class=" dropdown-item menu-link " href="http://acureva.test/en/dilly-dally-collection">
                    Dilly Dally Collection
                </a>
            </li>
            <li>
                <a class=" dropdown-item menu-link " href="http://acureva.test/en/introvert-humor-collection">
                    Introvert Humor Collection
                </a>
            </li>
        </ul>
    </div>
</li>




<li>
    <a class=" nav-link nav_item " href="http://acureva.test/en/products">
        Products
    </a>
</li> -->














