<style>
    @keyframes skeleton-loading {
        0% {
            background-position: -200% 0;
        }
        100% {
            background-position: 200% 0;
        }
    }

    .skeleton-loading-bg {
        background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
        background-size: 200% 100%;
        animation: skeleton-loading 1.5s infinite;
    }

    .skeleton-brand-item {
        padding: 20px;
        text-align: center;
    }

    .skeleton-brand-item .skeleton-img {
        width: 150px;
        height: 80px;
        margin: 0 auto;
        border-radius: 4px;
    }
</style>

<div class="section small_pb small_pt">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="heading_tab_header">
                    <div class="heading_s2">
                        <div class="skeleton-loading-bg" style="height: 28px; width: 200px; border-radius: 4px;"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="client_logo carousel_slider owl-carousel owl-theme nav_style3" data-dots="false" data-nav="true" data-margin="30" data-loop="true" data-autoplay="true" data-responsive='{"0":{"items": "2"}, "480":{"items": "3"}, "767":{"items": "4"}, "991":{"items": "5"}}'>
                    @for ($i = 0; $i < 5; $i++)
                        <div class="item">
                            <div class="cl_logo skeleton-brand-item">
                                <div class="skeleton-img skeleton-loading-bg"></div>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>
        </div>
    </div>
</div>