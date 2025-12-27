@php
    $style = $shortcode->style ?: 'style-1';
@endphp

@includeIf(
    Theme::getThemeNamespace('partials.shortcodes.product-collection-details.' . $style),
    compact('shortcode', 'collection', 'products')
)
