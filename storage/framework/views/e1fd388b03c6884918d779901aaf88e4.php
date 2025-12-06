<!-- START SECTION SHOP -->
<div class="section small_pt pb_20">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-6">
                <div class="heading_s3 text-center">
                    <h2><?php echo BaseHelper::clean($shortcode->title); ?></h2>
                </div>
                <div class="small_divider clearfix"></div>
            </div>
		</div>
        <div class="row">
        	<div class="col-md-12">
            	<div class="product_slider carousel_slider owl-carousel owl-theme nav_style4" data-loop="true"
                    data-dots="false" data-nav="true" data-margin="30"
                    data-responsive='{"0":{"items": "1"}, "481":{"items": "2"}, "768":{"items": "3"}, "1199":{"items": "4"}}'>
                    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="item">
                            <?php echo Theme::partial('product-item', compact('product')); ?>

                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div> 
    </div>
</div>
<!-- END SECTION SHOP -->
<?php /**PATH C:\laragon\www\acureva\platform\themes/shopwise/partials/shortcodes/trending-products/style-3.blade.php ENDPATH**/ ?>