@php
    $style = $shortcode->style;
    if (! in_array($style, ['style-1', 'style-1-dk', 'style-5', 'style-6'])) {
        $style = 'style-1';
    }
@endphp

<div class="section small_pt small_pb section-full_width-custom">
    <div class="custom-container product-collections-tab container-width-dk">
        <div class="row">
            @if (is_plugin_active('ads') && $shortcode->ads_key && $ads = AdsManager::displayAds($shortcode->ads_key, ['class' => 'sale-banner'], ['class' => 'hover_effect1']))
                <div class="col-xl-3 d-none d-xl-block">
                    {!! $ads !!}
                </div>
        	    <div class="col-xl-9">
            @else
                <div class="col-12">
            @endif
                @include(Theme::getThemeNamespace('partials.shortcodes.product-collections.' . $style))
            </div>
        </div>
    </div>
</div>


