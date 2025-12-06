<?php

use Botble\Media\Facades\RvMedia;
use Botble\SimpleSlider\Forms\SimpleSliderItemForm;
use Botble\Theme\Facades\Theme;
use Botble\Theme\Supports\ThemeSupport;
use Botble\Theme\Typography\TypographyItem;

register_page_template([
    'homepage' => __('Homepage'),
    'blog-sidebar' => __('Blog Sidebar'),
]);

register_sidebar([
    'id' => 'footer_sidebar',
    'name' => __('Footer sidebar'),
    'description' => __('Sidebar in the footer of site'),
]);

RvMedia::addSize('medium', 540, 600)
    ->addSize('small', 540, 300);

app()->booted(function (): void {
    ThemeSupport::registerToastNotification();
    ThemeSupport::registerPreloader();
    ThemeSupport::registerSiteCopyright();
    ThemeSupport::registerDateFormatOption();
    ThemeSupport::registerSocialSharing();

    Theme::typography()
        ->registerFontFamily(
            new TypographyItem('primary', __('Primary'), theme_option('primary_font', 'Poppins'), [200, 300, 400, 500, 600, 700, 800, 900]),
        );
    
        Theme::asset()->container('footer')->usePath()->add('dk-custom', 'js/dk-custom.js');

    if (is_plugin_active('simple-slider')) {
        SimpleSliderItemForm::extend(function (SimpleSliderItemForm $form): void {
            $form
                ->addAfter('description', 'sub_title', 'text', [
                    'label' => __('Subtitle'),
                    'metadata' => true,
                    'attr' => [
                        'placeholder' => __('Enter subtitle'),
                    ],
                ])
                ->addAfter('link', 'button_text', 'text', [
                    'label' => __('Button text'),
                    'metadata' => true,
                    'attr' => [
                        'placeholder' => __('Ex: Shop now'),
                    ],
                ]);
        }, 124);
    }
});


// use Botble\Ecommerce\Facades\CartFacade as Cart;
// use Botble\Ecommerce\Repositories\Interfaces\ProductInterface;

// app('events')->listen('themes.shopwise.init', function () {

//     // OVERRIDE HOÀN TOÀN RENDER SẢN PHẨM TRONG CHECKOUT
//     add_action('renderProductsInCheckoutPage', function () {
//         // LẤY TRỰC TIẾP TỪ CART (KHÔNG DÙNG SESSION)
//         $cartItems = Cart::instance('cart')->content();

//         if ($cartItems->isEmpty()) {
//             return;
//         }

//         $productIds = $cartItems->pluck('id')->toArray();

//         $products = app(ProductInterface::class)->getProducts([
//             'condition' => [
//                 ['ec_products.id', 'IN', $productIds]
//             ],
//             'take' => count($productIds),
//             'with' => ['slugable', 'original_product']
//         ]);

//         // Render view với dữ liệu mới
//         echo view('plugins/ecommerce::orders.checkout.products', [
//             'cartItems' => $cartItems,
//             'products' => $products
//         ])->render();
//     }, 999);
// });