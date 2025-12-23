<div class="section pt-0 all-products style-2">
    <div class="container">
        @if ($title)
            <div class="heading_tab_header">
                <div class="heading_s2">
                    <h2 class="h4">{!! BaseHelper::clean($title) !!}</h2>
                </div>
            </div>
        @endif

        @if ($products->isNotEmpty())
            <div class="row all-products-wrapper" >
                @foreach ($products as $product)
                    <div class="col-lg-3 col-md-4 col-6 all-products-item">
                        {!! Theme::partial('product-item', compact('product')) !!}
                    </div>
                @endforeach
            </div>


        @endif


    </div>
</div>


<style>

    @media screen and (max-width: 767px) {
        .all-products.style-2 .all-products-wrapper {
            display: flex;
            flex-wrap: nowrap;
            overflow-x: auto;
            overflow-y: hidden;
            scroll-snap-type: x mandatory;
            -webkit-overflow-scrolling: touch;
            margin-left: -8px;
            margin-right: -8px;
        }
        .all-products.style-2 .all-products-item {
            flex: 0 0 42%;
            max-width: 42%;
            padding: 0 8px;
            scroll-snap-align: start;
        }

        /* Hide Scroll */
        /* .all-products.style-2 .all-products-wrapper::-webkit-scrollbar {
            display: none;
        }
        .all-products.style-2 .all-products-wrapper {
            scrollbar-width: none;
        } */
    }
</style>