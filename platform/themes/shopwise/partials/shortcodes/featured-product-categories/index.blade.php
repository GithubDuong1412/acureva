@php
    $style = $shortcode->style;
    if (! in_array($style, ['style-1', 'style-4', 'style-1-dk', 'style-4-dk'])) {
        $style = 'style-1';
    }
@endphp

@if (count($categories) > 0)
    @include(Theme::getThemeNamespace('partials.shortcodes.featured-product-categories.' . $style))
@endif
