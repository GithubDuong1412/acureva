@php
    $style = $shortcode->style ?? 'style-1';

    if (! in_array($style, ['style-1', 'style-2'])) {
        $style = 'style-1';
    }
@endphp

@include(
    Theme::getThemeNamespace('partials.shortcodes.all-products.' . $style),
    compact('products', 'title')
)

