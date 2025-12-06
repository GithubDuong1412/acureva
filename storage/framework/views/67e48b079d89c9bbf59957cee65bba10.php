<?php
    $style = $shortcode->style;
    if (! in_array($style, ['style-1', 'style-5', 'style-6'])) {
        $style = 'style-1';
    }
?>

<div class="section small_pt pb-0">
    <div class="custom-container product-collections-tab">
        <div class="row">
            <?php if(is_plugin_active('ads') && $shortcode->ads_key && $ads = AdsManager::displayAds($shortcode->ads_key, ['class' => 'sale-banner'], ['class' => 'hover_effect1'])): ?>
                <div class="col-xl-3 d-none d-xl-block">
                    <?php echo $ads; ?>

                </div>
        	    <div class="col-xl-9">
            <?php else: ?>
                <div class="col-12">
            <?php endif; ?>
                <?php echo $__env->make(Theme::getThemeNamespace('partials.shortcodes.product-collections.' . $style), array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\laragon\www\acureva\platform\themes/shopwise/partials/shortcodes/product-collections/index.blade.php ENDPATH**/ ?>