<nav class="navbar navbar-expand-lg">
    <button class="navbar-toggler side_navbar_toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSidetoggle" aria-expanded="false">
        <span class="ion-android-menu"></span>
    </button>
    <div class="collapse navbar-collapse mobile_side_menu" id="navbarSidetoggle">
        <?php echo Menu::renderMenuLocation('main-menu', ['view' => 'menu', 'options' => ['class' => 'navbar-nav']]); ?>

    </div>
    <?php if(is_plugin_active('ecommerce')): ?>
        <ul class="navbar-nav attr-nav align-items-center">
            <li><a href="<?php if(!auth('customer')->check()): ?> <?php echo e(route('customer.overview')); ?> <?php else: ?> <?php echo e(route('customer.login')); ?> <?php endif; ?>" class="nav-link"  title="<?php echo e(__('Account')); ?>"><i class="linearicons-user"></i></a></li>
            <?php if(EcommerceHelper::isWishlistEnabled()): ?>
                <li><a href="<?php echo e(route('public.wishlist')); ?>" class="nav-link btn-wishlist" title="<?php echo e(__('Wishlist')); ?>"><i class="linearicons-heart"></i><span class="wishlist_count"><?php echo e(!auth('customer')->check() ? Cart::instance('wishlist')->count() : auth('customer')->user()->wishlist()->count()); ?></span></a></li>
            <?php endif; ?>

            <?php if(EcommerceHelper::isCartEnabled()): ?>
                <li class="dropdown cart_dropdown"><a class="nav-link cart_trigger btn-shopping-cart" href="#" data-bs-toggle="dropdown"><i class="linearicons-cart"></i><span class="cart_count"><?php echo e(Cart::instance('cart')->count()); ?></span></a>
                    <div class="cart_box dropdown-menu dropdown-menu-end">
                        <?php echo Theme::partial('cart'); ?>

                    </div>
                </li>
            <?php endif; ?>
        </ul>
        <div class="pr_search_icon">
            <span class="nav-link pr_search_trigger cursor-pointer text-white" title="<?php echo e(__('Search')); ?>"><i class="linearicons-magnifier"></i></span>
        </div>
    <?php endif; ?>
</nav>
<?php /**PATH C:\laragon\www\acureva\platform\themes/shopwise/partials/header-menu.blade.php ENDPATH**/ ?>