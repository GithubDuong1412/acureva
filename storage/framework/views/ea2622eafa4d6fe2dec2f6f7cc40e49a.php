<!DOCTYPE html>
<html <?php echo Theme::htmlAttributes(); ?>>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=5, user-scalable=1" name="viewport"/>
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

        <?php echo Theme::typography()->renderCssVariables(); ?>


        <style>
            :root {
                --color-1st: <?php echo e(theme_option('primary_color', '#FF324D')); ?>;
                --primary-color: <?php echo e(theme_option('primary_color', '#FF324D')); ?>;
                --color-2nd: <?php echo e(theme_option('secondary_color', '#1D2224')); ?>;
                --secondary-color: <?php echo e(theme_option('secondary_color', '#1D2224')); ?>;
            }
        </style>

        <?php echo Theme::header(); ?>

    </head>
    <body <?php echo Theme::bodyAttributes(); ?>>
    <?php echo apply_filters(THEME_FRONT_BODY, null); ?>


    <div id="alert-container"></div>

    <?php if(is_plugin_active('newsletter') && theme_option('enable_newsletter_popup', 'yes') === 'yes'): ?>
        <div data-session-domain="<?php echo e(config('session.domain') ?? request()->getHost()); ?>"></div>
        <div class="modal fade subscribe_popup" id="newsletter-modal" data-time="<?php echo e((int)theme_option('newsletter_show_after_seconds', 10) * 1000); ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-label="Subscribe popup" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><i class="ion-ios-close-empty"></i></span>
                        </button>
                        <div class="row g-0">
                            <div class="col-sm-5">
                                <?php if(theme_option('newsletter_image')): ?>
                                    <div class="background_bg h-100" data-img-src="<?php echo e(RvMedia::getImageUrl(theme_option('newsletter_image'))); ?>"></div>
                                <?php endif; ?>
                            </div>
                            <div class="col-sm-7">
                                <div class="popup_content">
                                    <div class="popup-text">
                                        <div class="heading_s4">
                                            <h4><?php echo e(__('Subscribe and Get 25% Discount!')); ?></h4>
                                        </div>
                                        <p><?php echo e(__('Subscribe to the newsletter to receive updates about new products.')); ?></p>
                                    </div>
                                    <?php echo \Botble\Newsletter\Forms\Fronts\NewsletterForm::create()
                                            ->setFormInputClass('form-control rounded-0')
                                            ->modify('email', 'email', [
                                                'attr' => ['placeholder' => __('Enter Your Email')],
                                            ])
                                            ->modify('submit', 'submit', [
                                                'attr' => [
                                                    'class' => 'btn btn-block text-uppercase rounded-0"',
                                                    'style' => 'background: #333; color: #fff;',
                                                ],
                                            ])
                                            ->renderForm(); ?>

                                    <div class="chek-form text-start mb-3">
                                        <div class="custome-checkbox">
                                            <input class="form-check-input" type="checkbox" name="dont_show_again" id="dont_show_again" value="">
                                            <label class="form-check-label" for="dont_show_again"><span><?php echo e(__("Don't show this popup again!")); ?></span></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <header class="header_wrap dk-header_wrap-custom <?php if(Theme::get('transparentHeader')): ?> dd_dark_skin transparent_header <?php endif; ?>">
        <div class="top-header d-none d-md-block">
            <div class="container">
                <div class="row align-items-center">
                        <div class="col-md-6 col-left">
                            <div class="d-flex align-items-center justify-content-center justify-content-md-start">
                                <?php if(is_plugin_active('language')): ?>
                                    <div class="language-wrapper">
                                        <?php echo Theme::partial('language-switcher'); ?>

                                    </div>
                                <?php endif; ?>
                                <?php if(is_plugin_active('ecommerce')): ?>
                                    <?php $currencies = get_all_currencies(); ?>
                                    <!-- <?php if(count($currencies) > 1): ?>
                                        <div class="language-wrapper choose-currency me-3">
                                            <div class="dropdown">
                                                <button class="btn btn-secondary dropdown-toggle btn-select-language" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                    <?php echo e(get_application_currency()->title); ?>

                                                    <span class="language-caret"></span>
                                                </button>
                                                <ul class="dropdown-menu dk-dropdown_menu language_bar_chooser">
                                                    <?php $__currentLoopData = $currencies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $currency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <li>
                                                            <a href="<?php echo e(route('public.change-currency', $currency->title)); ?>" <?php if(get_application_currency_id() == $currency->id): ?> class="active" <?php endif; ?>><span><?php echo e($currency->title); ?></span></a>
                                                        </li>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </ul>
                                            </div>
                                        </div>
                                    <?php endif; ?> -->
                                <?php endif; ?>
                                <?php if(theme_option('hotline')): ?>
                                    <ul class="contact_detail text-center text-lg-left">
                                        <li><i class="ti-mobile"></i><span><?php echo e(theme_option('hotline')); ?></span></li>
                                    </ul>
                                <?php endif; ?>
                                <?php if(theme_option('email')): ?>
                                    <ul>
                                        <li>
                                            <i class="ti-email"></i><span><a href="mailto:<?php echo e(theme_option('email')); ?>"><?php echo e(theme_option('email')); ?></a></span>
                                        </li>
                                    </ul>
                                <?php endif; ?>
                            </div>
                        </div>
                    <div class="col-md-6 col-right">
                        <div class="d-flex align-items-center justify-content-center justify-content-md-end">
                            <?php if(is_plugin_active('ecommerce')): ?>
                                <ul class="header_list">
                                    <?php if(EcommerceHelper::isCompareEnabled()): ?>
                                        <li><a href="<?php echo e(route('public.compare')); ?>"><i class="ti-control-shuffle"></i><span><?php echo e(__('Compare')); ?></span></a></li>
                                    <?php endif; ?>
                                    <?php if(!auth('customer')->check()): ?>
                                        <li><a href="<?php echo e(route('customer.login')); ?>"><i class="ti-user"></i><span><?php echo e(__('Login')); ?></span></a></li>
                                    <?php else: ?>
                                        <li><a href="<?php echo e(route('customer.overview')); ?>"><i class="ti-user"></i><span><?php echo e(auth('customer')->user()->name); ?></span></a></li>
                                        <li><a href="<?php echo e(route('customer.logout')); ?>"><i class="ti-lock"></i><span><?php echo e(__('Logout')); ?></span></a></li>
                                    <?php endif; ?>
                                </ul>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="middle-header dark_skin">
            <div class="container">
                <div class="nav_block">
                    <a class="navbar-brand" href="<?php echo e(route('public.index')); ?>">
                        <img class="logo_dark" src="<?php echo e(RvMedia::getImageUrl(theme_option('logo'))); ?>" alt="<?php echo e(theme_option('site_title')); ?>" loading="lazy" />
                    </a>
                    <?php if(theme_option('hotline')): ?>
                        <div class="contact_phone order-md-last">
                            <i class="linearicons-phone-wave"></i>
                            <span><?php echo e(theme_option('hotline')); ?></span>
                        </div>
                    <?php endif; ?>
                    <?php if(is_plugin_active('ecommerce')): ?>
                        <div class="product_search_form">
                            <form action="<?php echo e(route('public.products')); ?>" data-ajax-url="<?php echo e(route('public.ajax.search-products')); ?>" method="GET">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="custom_select">
                                            <select name="categories[]" class="first_null product-category-select" aria-label="Product categories">
                                                <option value=""><?php echo e(__('All')); ?></option>
                                                <?php echo ProductCategoryHelper::renderProductCategoriesSelect(); ?>

                                            </select>
                                        </div>
                                    </div>
                                    <input class="form-control input-search-product" name="q" value="<?php echo e(BaseHelper::stringify(request()->query('q'))); ?>" placeholder="<?php echo e(__('Search Product')); ?>..." required  type="text">
                                    <button type="submit" class="search_btn" title="<?php echo e(__('Search')); ?>"><i class="linearicons-magnifier"></i></button>
                                </div>
                                <div class="panel--search-result"></div>
                            </form>
                        </div>
                    <?php endif; ?>
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
                </div>
            </div>
        </div>
        <div class="bottom_header light_skin main_menu_uppercase <?php if(! Theme::get('transparentHeader')): ?> bg_dark <?php endif; ?> <?php if(url()->current() === route('public.index')): ?> <?php endif; ?>">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-4 col-sm-6 col-4">
                        <?php if(is_plugin_active('ecommerce')): ?>
                            <div class="categories_wrap">
                                <button type="button" data-bs-toggle="collapse" data-bs-target="#navCatContent" aria-expanded="false" class="categories_btn">
                                    <i class="linearicons-menu"></i><span><?php echo e(__('All Categories')); ?> </span>
                                </button>
                                <?php
                                    $categories = ProductCategoryHelper::getProductCategoriesWithUrl();
                                ?>
                                    <div id="navCatContent" class="<?php if(Theme::get('collapsingProductCategories')): ?> nav_cat <?php endif; ?> navbar collapse">
                                        <ul>
                                            <?php echo Theme::partial('product-categories-dropdown', ['categories' => $categories]); ?>

                                        </ul>

                                        <!-- DK-custom Add code -->
                                        <span class="close-icon">x</span>
                                    <?php if(count($categories) > 10): ?>
                                        <div class="more_categories"><?php echo e(__('More Categories')); ?></div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="col-lg-9 col-md-8 col-sm-6 col-8">
                        <?php echo $__env->make(Theme::getThemeNamespace('partials.header-menu'), array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    </div>
                </div>
            </div>
        </div>

        <?php if(theme_option('enable_sticky_header', 'yes') == 'yes'): ?>
            <div class="bottom_header bottom_header_sticky light_skin main_menu_uppercase bg_dark fixed-top header_with_topbar d-none">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3 col-md-4 col-sm-6 col-4">
                            <a class="navbar-brand" href="<?php echo e(route('public.index')); ?>">
                                <img src="<?php echo e(RvMedia::getImageUrl(theme_option('logo_footer') ? theme_option('logo_footer') : theme_option('logo'))); ?>" alt="<?php echo e(theme_option('site_title')); ?>" loading="lazy" />
                            </a>
                        </div>
                        <div class="col-lg-9 col-md-8 col-sm-6 col-8">
                            <?php echo $__env->make(Theme::getThemeNamespace('partials.header-menu'), array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </header>
<?php /**PATH C:\laragon\www\acureva\platform\themes/shopwise/partials/header.blade.php ENDPATH**/ ?>