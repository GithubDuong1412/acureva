<div class="section pt-0 small_pb">
	<div class="container">
    	<div class="row">
        	<div class="col-12">
            	<div class="cat_overlap radius_all_5">
                	<div class="row align-items-center">
        				<div class="col-lg-3 col-md-4">
                        	<div class="text-center text-md-left">
                                <h2 class="h4"><?php echo BaseHelper::clean($shortcode->title); ?></h2>
                                <?php if($shortcode->subtitle): ?>
                                    <p class="mb-2"><?php echo BaseHelper::clean($shortcode->subtitle); ?></p>
                                <?php endif; ?>
                                <?php if($shortcode->link): ?>
                                    <a href="<?php echo e(url($shortcode->link)); ?>" class="btn btn-line-fill btn-sm"><?php echo BaseHelper::clean($shortcode->link_text ?: __('View All')); ?></a>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-lg-9 col-md-8">

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

                            <div class="cat_slider mt-4 mt-md-0 carousel_slider owl-carousel owl-theme nav_style5" data-loop="true" data-dots="false" data-nav="true" data-margin="30" data-responsive='{"0":{"items": "1"}, "380":{"items": "2"}, "991":{"items": "3"}, "1199":{"items": "4"}}'>
                                <?php $__currentLoopData = $categories->loadMissing('metadata'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="item">
                                        <div class="categories_box">
                                            <div class="<?php echo e($wrapperClass); ?>">
                                                <a href="<?php echo e($category->url); ?>">
                                                <?php if($icon = $category->getMetaData('icon', true)): ?>
                                                    <i class="<?php echo e($icon); ?>"></i>
                                                <?php else: ?>
                                                    <img src="<?php echo e(RvMedia::getImageUrl($category->getMetaData('icon_image', true) ?: $category->image, null, false, RvMedia::getDefaultImage())); ?>" alt="category-image" loading="lazy" />
                                                <?php endif; ?>
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
        </div>
    </div>
</div>
<!-- END SECTION CATEGORIES -->
<?php /**PATH C:\laragon\www\acureva\platform\themes/shopwise/partials/shortcodes/featured-product-categories/style-4.blade.php ENDPATH**/ ?>