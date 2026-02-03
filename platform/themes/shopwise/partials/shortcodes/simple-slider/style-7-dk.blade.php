<div class="banner_section slide_medium shop_banner_slider staggered-animation-wrap dk-simple-slider-style-7-dk">
    @if ($collapsingProductCategories)
        <div class="container">
            <div class="row">
                <div class="col-lg-9 offset-lg-3">
    @endif
        @php
            $carouselId = 'carouselSimpleSlider7Dk_' . uniqid();
        @endphp
        <div id="{{ $carouselId }}" class="carousel slide light_arrow" data-bs-ride="carousel">
            <div class="carousel-inner">
                @foreach($sliders->loadMissing('metadata') as $slider)
                    @php
                        $tabletImage = $slider->getMetaData('tablet_image', true) ?: $slider->image;
                        $mobileImage = $slider->getMetaData('mobile_image', true) ?: $tabletImage;
                    @endphp

                    <div class="carousel-item @if ($loop->first) active @endif background_bg"
                        data-img-src="{{ RvMedia::getImageUrl($slider->image, null, false, RvMedia::getDefaultImage()) }}"
                        @if ($tabletImage) data-tablet-img-src="{{ RvMedia::getImageUrl($tabletImage, null, false, RvMedia::getDefaultImage()) }}" @endif
                        @if ($mobileImage) data-mobile-img-src="{{ RvMedia::getImageUrl($mobileImage, null, false, RvMedia::getDefaultImage()) }}" @endif
                    >
                        <div class="banner_slide_content">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-7 col-9">
                                        <div class="banner_content overflow-hidden">
                                            @if ($slider->description)
                                                <p class="banner_content_subtitle mb-3 staggered-animation fw-light" data-animation="slideInLeft" data-animation-delay="0.5s">{{ $slider->description }}</p>
                                            @endif
                                            @if ($slider->title)
                                                <h2 class="staggered-animation" data-animation="slideInLeft" data-animation-delay="1s">{{ $slider->title }}</h2>
                                            @endif
                                            @if ($slider->link)
                                                <a class="btn btn-fill-out rounded-0 staggered-animation text-uppercase" href="{{ $slider->link }}"
                                                    data-animation="slideInLeft" data-animation-delay="1.5s">{!! BaseHelper::clean($slider->getMetaData('button_text', true) ?: __('Shop Now')) !!}</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="dk-simple-slider-7-dk__controls">
                <button class="dk-simple-slider-7-dk__nav dk-simple-slider-7-dk__nav--prev" type="button" data-bs-target="#{{ $carouselId }}" data-bs-slide="prev">
                    <i class="ion-chevron-left"></i>
                </button>

                <div class="dk-simple-slider-7-dk__dots">
                    <div class="carousel-indicators indicators_style2">
                        @foreach($sliders as $indicatorSlider)
                            <button type="button" data-bs-target="#{{ $carouselId }}" data-bs-slide-to="{{ $loop->index }}" @if($loop->first) class="active" aria-current="true" @endif aria-label="Slide {{ $loop->iteration }}"></button>
                        @endforeach
                    </div>
                </div>

                <button class="dk-simple-slider-7-dk__nav dk-simple-slider-7-dk__nav--next" type="button" data-bs-target="#{{ $carouselId }}" data-bs-slide="next">
                    <i class="ion-chevron-right"></i>
                </button>
            </div>
        </div>
    @if ($collapsingProductCategories)
                </div>
            </div>
        </div>
    @endif
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var carouselEl = document.getElementById('{{ $carouselId }}');
    if (carouselEl) {
        var isDown = false;
        var startX = 0;
        var threshold = 50;

        carouselEl.addEventListener('pointerdown', function (e) {
            isDown = true;
            startX = e.clientX;
            carouselEl.style.cursor = 'grabbing';
            e.preventDefault();
        });

        carouselEl.addEventListener('pointermove', function (e) {
            if (!isDown) return;
        });

        carouselEl.addEventListener('pointerup', function (e) {
            if (!isDown) return;
            isDown = false;
            carouselEl.style.cursor = '';
            var endX = e.clientX;
            var diff = startX - endX;
            if (Math.abs(diff) > threshold) {
                var carousel = bootstrap.Carousel.getInstance(carouselEl);
                if (!carousel) carousel = new bootstrap.Carousel(carouselEl);
                if (diff > 0) {
                    carousel.next();
                } else {
                    carousel.prev();
                }
            }
        });

        carouselEl.addEventListener('pointerleave', function () {
            isDown = false;
            carouselEl.style.cursor = '';
        });
    }
});
</script>