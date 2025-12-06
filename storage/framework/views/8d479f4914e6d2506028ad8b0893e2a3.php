<?php if($product): ?>
    <div class="product_wrap">
        <?php if($product->isOutOfStock()): ?>
            <span class="pr_flash bg-secondary"><?php echo e(__('Out Of Stock')); ?></span>
        <?php else: ?>
            <?php if($product->productLabels->count()): ?>
                <?php $__currentLoopData = $product->productLabels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <span class="pr_flash" <?php echo $label->css_styles; ?>><?php echo e($label->name); ?></span>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
                <?php if($product->front_sale_price !== $product->price): ?>
                    <div class="pr_flash bg-success" dir="ltr"><?php echo e(get_sale_percentage($product->price, $product->front_sale_price)); ?></div>
                <?php endif; ?>
            <?php endif; ?>
        <?php endif; ?>

        <div class="position-relative">
            <div class="product_img">
                <a href="<?php echo e($product->url); ?>" class="product-link">
                    <img src="<?php echo e(RvMedia::getImageUrl($product->image, 'medium', false, RvMedia::getDefaultImage())); ?>" alt="<?php echo e($product->name); ?>" loading="lazy" />
                    <?php if(isset($product->images[1])): ?>
                        <img class="product_hover_img" src="<?php echo e(RvMedia::getImageUrl($product->images[1], 'medium', false, RvMedia::getDefaultImage())); ?>" alt="<?php echo e($product->name); ?>" loading="lazy" />
                    <?php endif; ?>
                </a>
            </div>
            <div class="product_action_box">
                <ul class="list_none pr_action_btn">
                    <?php if(EcommerceHelper::isCartEnabled()): ?>
                        <li class="add-to-cart"><a class="add-to-cart-button" data-id="<?php echo e($product->id); ?>" href="#" data-url="<?php echo e(route('public.cart.add-to-cart')); ?>" title="<?php echo e(__('Cart')); ?>"><i class="icon-basket-loaded"></i> <?php echo e(__('Add To Cart')); ?></a></li>
                    <?php endif; ?>
                    <?php if(EcommerceHelper::isCompareEnabled()): ?>
                        <li><a href="#" class="js-add-to-compare-button" data-url="<?php echo e(route('public.compare.add', $product->id)); ?>" title="<?php echo e(__('Compare')); ?>"><i class="icon-shuffle"></i></a></li>
                    <?php endif; ?>
                    <li><a href="<?php echo e(route('public.ajax.quick-view', $product->id)); ?>" class="popup-ajax" rel="nofollow" title="<?php echo e(__('Quick view')); ?>"><i class="icon-magnifier-add"></i></a></li>
                    <?php if(EcommerceHelper::isWishlistEnabled()): ?>
                        <li><a class="js-add-to-wishlist-button" href="#" data-url="<?php echo e(route('public.wishlist.add', $product->id)); ?>" title="<?php echo e(__('Wishlist')); ?>"><i class="icon-heart"></i></a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
        <div class="product_info">
            <div class="product_title"><a href="<?php echo e($product->url); ?>"><?php echo e($product->name); ?></a></div>

            <?php echo apply_filters('ecommerce_before_product_price_in_listing', null, $product); ?>

            <div class="product_price">
                <span class="price"><?php echo e(format_price($product->front_sale_price_with_taxes)); ?></span>
                <?php if($product->front_sale_price !== $product->price): ?>
                    <del><?php echo e(format_price($product->price_with_taxes)); ?></del>
                    <div class="on_sale">
                        <span><?php echo e(__(':percentage Off', ['percentage' => get_sale_percentage($product->price, $product->front_sale_price)])); ?></span>
                    </div>
                <?php endif; ?>
            </div>
            <?php echo apply_filters('ecommerce_after_product_price_in_listing', null, $product); ?>


            <?php if(EcommerceHelper::isReviewEnabled()): ?>
                <div class="rating_wrap">
                    <div class="rating">
                        <div class="product_rate" style="width: <?php echo e($product->reviews_avg * 20); ?>%"></div>
                    </div>
                    <span class="rating_num">(<?php echo e($product->reviews_count); ?>)</span>
                </div>
            <?php endif; ?>
            <div class="pr_desc">
                <p><?php echo BaseHelper::clean($product->description); ?></p>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            'use strict';
            function carousel_slider() {
                $('.carousel_slider').each( function() {
                    var $carousel = $(this);
                    $carousel.owlCarousel({
                        dots : $carousel.data("dots"),
                        loop : $carousel.data("loop"),
                        items: $carousel.data("items"),
                        margin: $carousel.data("margin"),
                        mouseDrag: $carousel.data("mouse-drag"),
                        touchDrag: $carousel.data("touch-drag"),
                        autoHeight: $carousel.data("autoheight"),
                        center: $carousel.data("center"),
                        nav: $carousel.data("nav"),
                        rewind: $carousel.data("rewind"),
                        navText: ['<i class="ion-ios-arrow-left"></i>', '<i class="ion-ios-arrow-right"></i>'],
                        autoplay : $carousel.data("autoplay"),
                        animateIn : $carousel.data("animate-in"),
                        animateOut: $carousel.data("animate-out"),
                        autoplayTimeout : $carousel.data("autoplay-timeout"),
                        smartSpeed: $carousel.data("smart-speed"),
                        responsive: $carousel.data("responsive")
                    });
                });
            }

            function slick_slider() {
                $('.slick_slider').each( function() {
                    var $slick_carousel = $(this);
                    $slick_carousel.slick({
                        arrows: $slick_carousel.data("arrows"),
                        dots: $slick_carousel.data("dots"),
                        infinite: $slick_carousel.data("infinite"),
                        centerMode: $slick_carousel.data("center-mode"),
                        vertical: $slick_carousel.data("vertical"),
                        fade: $slick_carousel.data("fade"),
                        cssEase: $slick_carousel.data("css-ease"),
                        autoplay: $slick_carousel.data("autoplay"),
                        verticalSwiping: $slick_carousel.data("vertical-swiping"),
                        autoplaySpeed: $slick_carousel.data("autoplay-speed"),
                        speed: $slick_carousel.data("speed"),
                        pauseOnHover: $slick_carousel.data("pause-on-hover"),
                        draggable: $slick_carousel.data("draggable"),
                        slidesToShow: $slick_carousel.data("slides-to-show"),
                        slidesToScroll: $slick_carousel.data("slides-to-scroll"),
                        asNavFor: $slick_carousel.data("as-nav-for"),
                        focusOnSelect: $slick_carousel.data("focus-on-select"),
                        responsive: $slick_carousel.data("responsive")
                    });
                });
            }

            $('.popup-ajax').magnificPopup({
                type: 'ajax',
                callbacks: {
                    ajaxContentAdded: function() {
                        carousel_slider();
                        slick_slider();
                    }
                }
            });
        });
    </script>
<?php endif; ?>
<?php /**PATH C:\laragon\www\acureva\platform\themes/shopwise/partials/product-item.blade.php ENDPATH**/ ?>