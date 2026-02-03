@php
    $style = $shortcode->style ?: 'style-1-dk';
@endphp

@includeIf(
    Theme::getThemeNamespace('partials.shortcodes.product-category-details.' . $style),
    compact('shortcode', 'category', 'products')
)