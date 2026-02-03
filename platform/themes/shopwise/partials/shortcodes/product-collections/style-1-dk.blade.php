<!-- START SECTION SHOP -->
<div class="section small_pb small_pt dk-product-collection-1">
	<div class="container">
		@php
			$itemsDesktop = (int) ($shortcode->items_desktop ?: 4);
			$itemsTablet = (int) ($shortcode->items_tablet ?: 3);
			$itemsMobile = (int) ($shortcode->items_mobile ?: 2);
		@endphp
        <div class="row justify-content-center bg-dark-dk">
			<div class="col-md-9">
            	<div class="heading_s4 text-center">
                	<h2>{!! BaseHelper::clean($shortcode->title) !!}</h2>
                </div>
                @if ($shortcode->description)
					<p class="text-center">{!! BaseHelper::clean($shortcode->description) !!}</p>
				@endif
            </div>
		</div>
        <div class="row">
            <div class="col-12">
            	<div class="tab-style1">
                    @include(Theme::getThemeNamespace('partials.shortcodes.product-collections.nav-tabs', ['attributes' => ['id' => 'tabmenubar-style-1-dk', 'class' => 'justify-content-start flex-nowrap overflow-auto']]))
                </div>
                <div class="tab_slider tab-content">
                    @foreach ($collections as $collection)
                        <div @class([
                                'tab-pane fade',
                                'show active' => $collection->id == $collectionId
                            ]) id="{{ $collection->slug }}" role="tabpanel" aria-labelledby="{{ $collection->slug }}-tab">
                            @if ($collection->id == $collectionId)
                                <div class="product_slider carousel_slider owl-carousel owl-theme dot_style1"
                                    data-loop="false"
                                    data-rewind="true"
                                    data-dots="true"
                                    data-dots-each="1"
                                    data-slide-by="1"
                                    data-margin="20"
                                    data-responsive='{"0":{"items": "{{ $itemsMobile }}"}, "768":{"items": "{{ $itemsTablet }}"}, "992":{"items": "{{ $itemsDesktop }}"}}'>
                                    @foreach($products as $product)
                                        <div class="item">
                                            {!! Theme::partial('product-item', compact('product')) !!}
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="half-circle-spinner">
                                    <div class="circle circle-1"></div>
                                    <div class="circle circle-2"></div>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END SECTION SHOP -->

<script type="text/x-custom-template" class="product-collection-items">
    <div class="product_slider carousel_slider owl-carousel owl-theme dot_style1"
        data-loop="false"
        data-rewind="true"
        data-dots="true"
        data-dots-each="1"
        data-slide-by="1"
        data-margin="20"
        data-responsive='{"0":{"items": "{{ $itemsMobile }}"}, "768":{"items": "{{ $itemsTablet }}"}, "992":{"items": "{{ $itemsDesktop }}"}}'>
        __data__
    </div>
</script>

<style>
    .dk-product-collection-1 #tabmenubar-style-1-dk .nav-link.active span.pc-collection-tab__content {
        border: 1px solid var(--color-1st);
        background-color: #d1d1d1;
    }
    .dk-product-collection-1 #tabmenubar-style-1-dk .pc-collection-tab__content {
        gap: 0px;
        padding: 8px 20px;
        border: 1px solid transparent;
        border-radius: 8px;
    }

</style>