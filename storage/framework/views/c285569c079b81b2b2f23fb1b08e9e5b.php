<!-- START SECTION SUBSCRIBE NEWSLETTER -->
<div class="section bg_default small_pt small_pb">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="newsletter_text text_white">
                    <h3><?php echo BaseHelper::clean($shortcode->title); ?></h3>
                    <?php if($shortcode->description): ?>
                        <p><?php echo BaseHelper::clean($shortcode->description); ?></p>
                    <?php endif; ?>
                    <?php if($shortcode->subtitle): ?>
                        <p><?php echo BaseHelper::clean($shortcode->subtitle); ?></p>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="newsletter_form2 rounded_input">
                    <?php echo Theme::partial('shortcodes.newsletter-form.form'); ?>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- START SECTION SUBSCRIBE NEWSLETTER -->
<?php /**PATH C:\laragon\www\acureva\platform\themes/shopwise/partials/shortcodes/newsletter-form/style-1.blade.php ENDPATH**/ ?>