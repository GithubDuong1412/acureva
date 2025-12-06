<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="heading_tab_header">
                <div class="heading_s2">
                    <h2 class="h4"><?php echo BaseHelper::clean($shortcode->title); ?></h2>
                </div>
                <div class="tab-style2">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#tabmenubar" aria-expanded="false">
                        <span class="ion-android-menu"></span>
                    </button>
                    <?php echo $__env->make(Theme::getThemeNamespace('partials.shortcodes.product-collections.nav-tabs', ['attributes' => ['class' => 'justify-content-md-end']]), array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="tab_slider">
                <?php $__currentLoopData = $collections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $collection): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                        'tab-pane fade',
                        'show active' => $collection->id == $collectionId
                    ]); ?>" id="<?php echo e($collection->slug); ?>" role="tabpanel" aria-labelledby="<?php echo e($collection->slug); ?>-tab">
                        <?php if($collection->id == $collectionId): ?>
                            <div class="product_slider carousel_slider owl-carousel owl-theme nav_style1" data-loop="true" data-dots="false"
                                data-nav="true" data-margin="20" data-responsive='{"0":{"items": "1"}, "481":{"items": "2"}, "768":{"items": "3"}, "1199":{"items": "4"}}'>
                                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="item">
                                        <?php echo Theme::partial('product-item', compact('product')); ?>

                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        <?php else: ?>
                            <div class="half-circle-spinner">
                                <div class="circle circle-1"></div>
                                <div class="circle circle-2"></div>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
</div>

<script type="text/x-custom-template" class="product-collection-items">
    <div class="product_slider carousel_slider owl-carousel owl-theme nav_style1" data-loop="true" data-dots="false"
        data-nav="true" data-margin="20" data-responsive='{"0":{"items": "1"}, "481":{"items": "2"}, "768":{"items": "3"}, "1199":{"items": "4"}}'>
        __data__
    </div>
</script>

<?php /**PATH C:\laragon\www\acureva\platform\themes/shopwise/partials/shortcodes/product-collections/style-1.blade.php ENDPATH**/ ?>