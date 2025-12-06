<div class="pt-3 mb-5 order-item-info">
    <div class="align-items-center">
        <h6 class="d-inline-block">{{ __('Order number') }}: {{ $order->code }}</h6>
    </div>

    <div class="checkout-success-products">
        <div id="{{ 'cart-item-' . $order->id }}">
            @foreach ($order->products as $orderProduct)
                <div class="row cart-item">
                    <div class="col-lg-3 col-md-3">
                        <div class="checkout-product-img-wrapper d-inline-block">
                            <img
                                class="item-thumb img-thumbnail img-rounded mb-2 mb-md-0"
                                src="{{ RvMedia::getImageUrl($orderProduct->product_image, 'thumb', false, RvMedia::getDefaultImage()) }}"
                                alt="{{ $orderProduct->product_name }}"
                            >
                            <span class="checkout-quantity">{{ $orderProduct->qty }}</span>
                        </div>
                    </div>

                    <div class="col-lg-5 col-md-5">
                        <p class="mb-2 mb-md-0">{!! BaseHelper::clean($orderProduct->product_name) !!}</p>

                        {{-- SỬA 1: Xử lý attributes nếu là mảng --}}
                        @php
                            $attributes = Arr::get($orderProduct->options ?? [], 'attributes', []);
                        @endphp

                        @if (is_array($attributes) && !empty($attributes))
                            @php
                                $attrTexts = [];
                                foreach ($attributes as $key => $value) {
                                    $attrTexts[] = ucfirst($key) . ': ' . $value;
                                }
                                $attrString = implode(' | ', $attrTexts);
                            @endphp
                            <p class="mb-2 mb-md-0">
                                <small class="text-muted">{{ $attrString }}</small>
                            </p>
                        @endif

                        {{-- Hiển thị product options --}}
                        @if (!empty($orderProduct->product_options) && is_array($orderProduct->product_options))
                            {!! render_product_options_html($orderProduct->product_options, $orderProduct->price) !!}
                        @endif

                        {{-- Include extras --}}
                        @include(EcommerceHelper::viewPath('includes.cart-item-options-extras'), [
                            'options' => $orderProduct->options ?? [],
                        ])

                        {{-- SỬA 2: Hiển thị thuế an toàn --}}
                        @if (EcommerceHelper::isTaxEnabled() && $orderProduct->tax_amount > 0 && count($order->products) > 1)
                            <p class="mb-0">
                                <small class="text-muted">
                                    {{ __('Tax') }}: {{ format_price($orderProduct->tax_amount) }}
                                    @php
                                        $taxInfo = [];
                                        if (!empty($orderProduct->options['taxClasses']) && is_array($orderProduct->options['taxClasses'])) {
                                            foreach ($orderProduct->options['taxClasses'] as $taxName => $taxRate) {
                                                $taxInfo[] = $taxName . ' ' . $taxRate . '%';
                                            }
                                        } elseif (!empty($orderProduct->options['taxRate']) && $orderProduct->options['taxRate'] > 0) {
                                            $taxInfo[] = $orderProduct->options['taxRate'] . '%';
                                        }
                                    @endphp
                                    @if (!empty($taxInfo))
                                        ({{ implode(', ', $taxInfo) }})
                                    @endif
                                </small>
                            </p>
                        @endif
                    </div>

                    <div class="col-lg-4 col-md-4 col-4 float-md-end text-md-end">
                        <p class="mb-1">{{ format_price($orderProduct->price) }}</p>

                        @if (count($order->products) > 1)
                            @php
                                $unitPriceWithTax = $orderProduct->price + ($orderProduct->tax_amount / $orderProduct->qty);
                                $totalWithTax = $unitPriceWithTax * $orderProduct->qty;
                            @endphp

                            @if (EcommerceHelper::isTaxEnabled() && $orderProduct->tax_amount > 0)
                                <p class="mb-0">
                                    <small class="text-muted">
                                        {{ __('Total') }}: {{ format_price($totalWithTax) }}
                                    </small>
                                </p>
                            @else
                                <p class="mb-0">
                                    <small class="text-muted">
                                        {{ __('Total') }}: {{ format_price($orderProduct->price * $orderProduct->qty) }}
                                    </small>
                                </p>
                            @endif
                        @endif
                    </div>
                </div>
            @endforeach

            @if (!empty($isShowTotalInfo))
                @include('plugins/ecommerce::orders.thank-you.total-info', compact('order'))
            @endif
        </div>
    </div>
</div>