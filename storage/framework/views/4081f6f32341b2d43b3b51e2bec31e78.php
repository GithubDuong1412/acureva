<?php if(count($sliders) > 0): ?>
    <?php
        $collapsingProductCategories = theme_option('collapsing_product_categories_on_homepage', 'no');
        if (is_plugin_active('ecommerce')) {
            $collapsingProductCategories = $shortcode->collapsing_product_categories ?: $collapsingProductCategories;
        }
        $collapsingProductCategories = $collapsingProductCategories == 'no';
        $style = $shortcode->style;
        if (! in_array($style, ['style-1', 'style-2', 'style-2-dk_custom', 'style-3', 'style-4', 'style-5', 'style-6'])) {
            $style = 'style-1';
        }
        Theme::set('collapsingProductCategories', $collapsingProductCategories);

        Theme::set('transparentHeader', in_array($style, ['style-4']));
    ?>
    <?php echo $__env->make(Theme::getThemeNamespace('partials.shortcodes.simple-slider.' . $style), array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php endif; ?>
<?php /**PATH C:\laragon\www\acureva\platform\themes/shopwise/partials/shortcodes/simple-slider/index.blade.php ENDPATH**/ ?>