<div class="banner_section shop_banner_slider staggered-animation-wrap dk-slider">
    <?php if($collapsingProductCategories): ?>
        <div class="container">
            <div class="row">
                <div class="col-lg-9 offset-lg-3">
    <?php endif; ?>
        <div id="carouselExampleControls" class="carousel slide carousel-fade light_arrow" data-bs-ride="carousel">
            <div class="carousel-inner">
                <?php $__currentLoopData = $sliders->loadMissing('metadata'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $tabletImage = $slider->getMetaData('tablet_image', true) ?: $slider->image;
                        $mobileImage = $slider->getMetaData('mobile_image', true) ?: $tabletImage;
                    ?>

                    <div class="carousel-item <?php if($loop->first): ?> active <?php endif; ?> background_bg"
                        data-img-src="<?php echo e(RvMedia::getImageUrl($slider->image, null, false, RvMedia::getDefaultImage())); ?>"
                        <?php if($tabletImage): ?> data-tablet-img-src="<?php echo e(RvMedia::getImageUrl($tabletImage, null, false, RvMedia::getDefaultImage())); ?>" <?php endif; ?>
                        <?php if($mobileImage): ?> data-mobile-img-src="<?php echo e(RvMedia::getImageUrl($mobileImage, null, false, RvMedia::getDefaultImage())); ?>" <?php endif; ?>
                    >
                        <div class="banner_slide_content">
                            <div class="container"><!-- STRART CONTAINER -->
                                <div class="row">
                                    <div class="col-lg-7 col-9">
                                        <div class="banner_content overflow-hidden">
                                            <?php if($slider->subtitle): ?>
                                                <h4 class=""><?php echo e($slider->subtitle); ?></h4>
                                            <?php endif; ?>
                                            <?php if($slider->title): ?>
                                                <h2 class="staggered-animation" data-animation="slideInLeft" data-animation-delay="1s"><?php echo e($slider->title); ?></h2>
                                            <?php endif; ?>
                                            <?php if($slider->description): ?>
                                                <p class="banner_content_subtitle mb-3 staggered-animation fw-light" data-animation="slideInLeft" data-animation-delay="0.5s"><?php echo e($slider->description); ?></p>
                                            <?php endif; ?>
                                            <?php if($slider->link): ?>
                                                <a class="btn btn-fill-out rounded-0 staggered-animation text-uppercase" href="<?php echo e($slider->link); ?>"
                                                    data-animation="slideInLeft" data-animation-delay="1.5s"><?php echo BaseHelper::clean($slider->getMetaData('button_text', true) ?: __('Shop Now')); ?></a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-bs-slide="prev"><i class="ion-chevron-left"></i></a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-bs-slide="next"><i class="ion-chevron-right"></i></a>
        </div>
    <?php if($collapsingProductCategories): ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>
<?php /**PATH C:\laragon\www\acureva\platform\themes/shopwise/partials/shortcodes/simple-slider/style-2-dk_custom.blade.php ENDPATH**/ ?>