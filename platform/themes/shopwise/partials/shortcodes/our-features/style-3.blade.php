<!-- START SECTION SHIPPING INFO -->
<div class="section small_pb">
    <div class="container">
        <div class="row g-0">
            @for ($i = 1; $i <= 4; $i++)
                <div class="col-lg-3 col-sm-6 d-flex">
                    <div class="icon_box icon_box_style3 flex-fill">
                        <div class="icon">
                            <i class="{!! BaseHelper::clean($shortcode->{'icon' . $i}) !!}"></i>
                        </div>
                        <div class="icon_box_content">
                            <p class="icon_box_title">{!! BaseHelper::clean($shortcode->{'title' . $i}) !!}</p>
                            @if ($sub = $shortcode->{'subtitle' . $i})
                                <p>{!! BaseHelper::clean($sub) !!}</p>
                            @endif
                        </div>
                    </div>
                </div>
            @endfor
        </div>
    </div>
</div>
<!-- START SECTION SHIPPING INFO -->
