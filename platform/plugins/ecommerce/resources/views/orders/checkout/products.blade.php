@php
    // Lấy giỏ hàng hiện tại (nếu chưa có $cartItems được truyền)
    use Botble\Ecommerce\Facades\Cart;
    $cartItems = $cartItems ?? Cart::instance('cart')->content();

    // Lấy danh sách sản phẩm từ DB (để lấy thông tin chi tiết)
    $productIds = $cartItems->pluck('id')->all();
    $products = \Botble\Ecommerce\Models\Product::whereIn('id', $productIds)->get()->keyBy('id');
@endphp

@if($cartItems->count() > 0)
    @foreach($cartItems as $cartItem)
        @php
            $product = $products->get($cartItem->id);
        @endphp

        @if($product)
            <div class="d-flex align-items-center mb-3 pb-3 border-bottom position-relative">
                <!-- Hình ảnh + Số lượng (badge nhỏ gọn) -->
                <div class="position-relative me-3">
                    <img
                        src="{{ RvMedia::getImageUrl($cartItem->options->image ?? $product->image, 'thumb', false, RvMedia::getDefaultImage()) }}"
                        alt="{{ $product->name }}"
                        class="rounded"
                        style="width: 60px; height: 60px; object-fit: cover;"
                    >
                    <span class="badge bg-primary rounded-pill position-absolute top-0 start-100 translate-middle"
                          style="font-size: 10px; padding: 4px 6px;">
                        {{ $cartItem->qty }}
                    </span>
                </div>

                <!-- Thông tin sản phẩm -->
                <div class="flex-grow-1">
                    <p class="mb-1 fw-bold text-dark">{{ $product->original_product->name }}</p>

                    <!-- HIỂN THỊ ATTRIBUTE -->
                    @if(!empty($cartItem->options->attributes ?? null))
                        <p class="mb-1 dk-products_attribute">
                            <small class="text-muted">
                                @foreach($cartItem->options->attributes as $key => $value)
                                    <span class="badge bg-light text-dark me-1" style="font-size: 14px; font-weight: 500;">
                                        {{ ucfirst($key) }}: {{ $value }}
                                    </span>
                                @endforeach
                            </small>
                        </p>
                    @endif

                    @if(!empty($cartItem->options->options ?? null))
                        <div class="mb-1">
                            {!! render_product_options_html($cartItem->options->options, $product->original_price) !!}
                        </div>
                    @endif
                </div>

                <!-- Giá -->
                <div class="text-end ms-3">
                    <p class="mb-0 fw-bold">{{ format_price($cartItem->price) }}</p>
                    <p class="mb-0 text-muted small">
                        {{ __('Total') }}: {{ format_price($cartItem->price * $cartItem->qty) }}
                    </p>
                </div>
            </div>
        @endif
    @endforeach
@else
    <div class="text-center py-4 text-muted">
        <p>Giỏ hàng trống</p>
    </div>
@endif