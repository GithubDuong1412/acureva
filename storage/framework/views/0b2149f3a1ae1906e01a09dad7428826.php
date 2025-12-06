<div class="section bg_redon">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="heading_s1 text-center">
                    <h2><?php echo BaseHelper::clean($title); ?></h2>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div
                     class="testimonial_wrap testimonial_style1 carousel_slider owl-carousel owl-theme nav_style2"
                     data-nav="true" data-dots="false" data-center="true" data-loop="false" data-autoplay="true" data-items='1'>
                    <?php $__currentLoopData = $testimonials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $testimonial): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="testimonial_box">
                            <div class="testimonial_desc">
                                <div><?php echo BaseHelper::clean($testimonial->content); ?></div>
                            </div>
                            <div class="author_wrap">
                                <div class="author_img">
                                    <img src="<?php echo e(RvMedia::getImageUrl($testimonial->image, null, false, RvMedia::getDefaultImage())); ?>" alt="<?php echo e($testimonial->name); ?>" loading="lazy" />
                                </div>
                                <div class="author_name">
                                    <p class="author_name_text"><?php echo e($testimonial->name); ?></p>
                                    <span><?php echo e($testimonial->company); ?></span>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\laragon\www\acureva\platform\themes/shopwise/partials/shortcodes/testimonials.blade.php ENDPATH**/ ?>