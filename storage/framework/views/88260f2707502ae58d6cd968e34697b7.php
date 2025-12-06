<?php
    $style = $shortcode->style;
    if (! in_array($style, ['style-1', 'style-4', 'style-1-dk', 'style-4-dk'])) {
        $style = 'style-1';
    }
?>

<?php if(count($categories) > 0): ?>
    <?php echo $__env->make(Theme::getThemeNamespace('partials.shortcodes.featured-product-categories.' . $style), array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php endif; ?>
<?php /**PATH C:\laragon\www\acureva\platform\themes/shopwise/partials/shortcodes/featured-product-categories/index.blade.php ENDPATH**/ ?>