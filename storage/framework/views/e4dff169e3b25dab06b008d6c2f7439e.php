<?php
    $style = $shortcode->style;
    if (! in_array($style, ['style-1', 'style-2'])) {
        $style = 'style-1';
    }
?>
<?php echo $__env->make(Theme::getThemeNamespace('partials.shortcodes.newsletter-form.' . $style), array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php /**PATH C:\laragon\www\acureva\platform\themes/shopwise/partials/shortcodes/newsletter-form/index.blade.php ENDPATH**/ ?>