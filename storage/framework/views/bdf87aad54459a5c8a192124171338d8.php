<!-- START SECTION SHIPPING INFO -->
<div class="section small_pb">
    <div class="container">
        <div class="row g-0">
            <?php for($i = 1; $i <= 4; $i++): ?>
                <div class="col-lg-3 col-sm-6 d-flex">
                    <div class="icon_box icon_box_style3 flex-fill">
                        <div class="icon">
                            <i class="<?php echo BaseHelper::clean($shortcode->{'icon' . $i}); ?>"></i>
                        </div>
                        <div class="icon_box_content">
                            <p class="icon_box_title"><?php echo BaseHelper::clean($shortcode->{'title' . $i}); ?></p>
                            <?php if($sub = $shortcode->{'subtitle' . $i}): ?>
                                <p><?php echo BaseHelper::clean($sub); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endfor; ?>
        </div>
    </div>
</div>
<!-- START SECTION SHIPPING INFO -->
<?php /**PATH C:\laragon\www\acureva\platform\themes/shopwise/partials/shortcodes/our-features/style-3.blade.php ENDPATH**/ ?>