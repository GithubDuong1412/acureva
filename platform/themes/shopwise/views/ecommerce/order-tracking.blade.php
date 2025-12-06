@php Theme::set('pageName', __('Order Tracking')) @endphp

<div class="section">
    <div class="container order-tracking-wrapper">
        <div class="row justify-content-center">
            <div class="col-md-8 col-12">
                <form method="GET" action="{{ route('public.orders.tracking') }}" class="tracking-form w-100">
                    <div class="text-center">
                        <h3>{{ __('Order Tracking') }}</h3>
                        <p>{{ __('Tracking your order status') }}</p>
                    </div>
                    <div class="form__content d-flex flex-column align-center gap-4 mt-4">
                        <div class="form-group d-flex flex-column w-100">
                            <label class="pb-2" for="txt-order-id">{{ __('Order ID') }}<sup>*</sup></label>
                            <input class="form-control" name="order_id" id="txt-order-id" type="text" value="{{ old('order_id', request()->input('order_id')) }}" placeholder="{{ __('Order ID') }}">
                            @if ($errors->has('order_id'))
                                <span class="text-danger">{{ $errors->first('order_id') }}</span>
                            @endif
                        </div>
                        <div class="form-group d-flex flex-column w-100">
                            <label class="pb-2" for="txt-email">{{ __('Email Address') }}<sup>*</sup></label>
                            <input class="form-control" name="email" id="txt-email" type="email" value="{{ old('email', request()->input('email')) }}" placeholder="{{ __('Your Email') }}">
                            @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                        <div class="form__actions text-center">
                            <button type="submit" class="btn btn-fill-out btn-block">{{ __('Find') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        @include('plugins/ecommerce::themes.includes.order-tracking-detail', compact('order'))
    </div>
</div>
