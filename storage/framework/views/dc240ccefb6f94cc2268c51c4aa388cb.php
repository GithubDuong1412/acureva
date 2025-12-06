<div class="section small_pb small_pt">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="heading_s4 text-center">
                    <h2><?php echo BaseHelper::clean($shortcode->title); ?></h2>
                </div>
                <p class="text-center leads">
                    <?php if($shortcode->description): ?>
                        <?php echo BaseHelper::clean($shortcode->description); ?>

                    <?php endif; ?>
                    <?php if($shortcode->subtitle): ?>
                        <?php echo BaseHelper::clean($shortcode->subtitle); ?>

                    <?php endif; ?>
                </p>
            </div>
        </div>
        <div class="row align-items-center">
            <div class="col-12">

                <?php
                    $ratio = $shortcode->image_aspect_ratio ?? 'default';
                    $wrapperClass = 'dk-cat-img-wrapper';
                    $imgClass = 'dk-cat-image';

                    switch ($ratio) {
                        case 'square':
                            $wrapperClass .= ' ratio-1-1';
                            break;
                        case 'vertical':
                            $wrapperClass .= ' ratio-3-5';
                            break;
                        case 'horizontal':
                            $wrapperClass .= ' ratio-5-3';
                            break;
                        default: 
                            $wrapperClass .= ' ratio-auto';
                            break;
                    }
                ?>

                <div class="cat_slider cat_style1-dk mt-4 mt-md-0 dk-feature_categories carousel_slider owl-carousel owl-theme nav_style5"
                     data-loop="false" data-dots="false" data-nav="true" data-margin="30"
                     data-responsive='{"0":{"items": "2"}, "480":{"items": "3"}, "576":{"items": "3"}, "768":{"items": "4"}, "991":{"items": "4"}, "1199":{"items": "4"}}'>
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="item d-flex">
                            <div class="categories_box d-flex">
                                <div class="<?php echo e($wrapperClass); ?>">
                                    <a class="link-cate-image" href="<?php echo e($category->url); ?>">
                                        <img class="h-100 object-fit-cover <?php echo e($imgClass); ?> " src="<?php echo e(RvMedia::getImageUrl($category->image, null, false, RvMedia::getDefaultImage())); ?>" alt="category-image" loading="lazy" />
                                    </a>
                                    <a class="link-cate-text-line" href="<?php echo e($category->url); ?>">
                                        <span><?php echo e($category->name); ?></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\laragon\www\acureva\platform\themes/shopwise/partials/shortcodes/featured-product-categories/style-1-dk.blade.php ENDPATH**/ ?>