@extends('plugins/ecommerce::orders.master')

@section('title', __('Checkout'))

@section('content')
    @if (Cart::instance('cart')->isNotEmpty())
        @if (is_plugin_active('payment'))
            @include('plugins/payment::partials.header')
        @endif

        @php
            $cartItems = Cart::instance('cart')->content();
            $products  = collect();

            if ($cartItems->isNotEmpty()) {
                // Lấy ID của các VARIATION trong giỏ
                $variationIds = $cartItems->pluck('id')->unique()->toArray();

                // Lấy variation + load product cha (quan hệ đúng: 'product')
                $variations = \Botble\Ecommerce\Models\ProductVariation::whereIn('id', $variationIds)
                    ->with('product')  // <-- QUAN HỆ ĐÚNG
                    ->get()
                    ->keyBy('id');     // key theo variation_id

                // Gán vào $products để view cũ dùng $products->get($cartItem->id)
                $products = $variations;
            }
        @endphp

        {!! $checkoutForm->renderForm() !!}

        @if (is_plugin_active('payment'))
            @include('plugins/payment::partials.footer')
        @endif
    @else
        <div class="container">
            <div class="alert alert-warning my-5">
                <span>{!! BaseHelper::clean(__('No products in cart. :link!', ['link' => Html::link(BaseHelper::getHomepageUrl(), __('Back to shopping'))])) !!}</span>
            </div>
        </div>
    @endif
@stop

@push('footer')
    <script type="text/javascript" src="{{ asset('vendor/core/core/js-validation/js/js-validation.js') }}?v={{ EcommerceHelper::getAssetVersion() }}"></script>
@endpush
