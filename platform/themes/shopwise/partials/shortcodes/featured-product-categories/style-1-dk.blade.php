<div class="section small_pb small_pt">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="heading_s4 text-center">
                    <h2>{!! BaseHelper::clean($shortcode->title) !!}</h2>
                </div>
                <p class="text-center leads">
                    @if ($shortcode->description)
                        {!! BaseHelper::clean($shortcode->description) !!}
                    @endif
                    @if ($shortcode->subtitle)
                        {!! BaseHelper::clean($shortcode->subtitle) !!}
                    @endif
                </p>
            </div>
        </div>
        <div class="row align-items-center">
            <div class="col-12">

                <?php
                    $ratio = $shortcode->image_aspect_ratio ?? 'default';
                    $wrapperClass = 'dk-cat-img-wrapper';
                    $imgClass = 'dk-cat-image';

                    switch ($ratio) {
                        case 'square':
                            $wrapperClass .= ' ratio-1-1';
                            break;
                        case 'vertical':
                            $wrapperClass .= ' ratio-3-5';
                            break;
                        case 'horizontal':
                            $wrapperClass .= ' ratio-5-3';
                            break;
                        default: 
                            $wrapperClass .= ' ratio-auto';
                            break;
                    }
                ?>

                <div class="cat_slider cat_style1-dk mt-4 mt-md-0 dk-feature_categories carousel_slider owl-carousel owl-theme nav_style5"
                     data-loop="false" data-dots="false" data-nav="true" data-margin="30"
                     data-responsive='{"0":{"items": "2"}, "480":{"items": "3"}, "576":{"items": "3"}, "768":{"items": "4"}, "991":{"items": "4"}, "1199":{"items": "4"}}'>
                    @foreach ($categories as $category)
                        <div class="item d-flex">
                            <div class="categories_box d-flex">
                                <div class="{{  $wrapperClass  }}">
                                    <a class="link-cate-image" href="{{ $category->url }}">
                                        <img class="h-100 object-fit-cover {{  $imgClass  }} " src="{{ RvMedia::getImageUrl($category->image, null, false, RvMedia::getDefaultImage()) }}" alt="category-image" loading="lazy" />
                                    </a>
                                    <a class="link-cate-text-line" href="{{ $category->url }}">
                                        <span>{{ $category->name }}</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>