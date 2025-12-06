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

    .skeleton-testimonial {
        padding: 30px;
        background: #f8f8f8;
        border-radius: 8px;
        margin-bottom: 30px;
    }

    .skeleton-testimonial .skeleton-avatar {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        margin: 0 auto 20px;
    }

    .skeleton-testimonial .skeleton-content {
        margin-bottom: 20px;
    }

    .skeleton-testimonial .skeleton-content .skeleton-line {
        height: 16px;
        margin-bottom: 8px;
        border-radius: 4px;
    }

    .skeleton-testimonial .skeleton-author {
        text-align: center;
    }

    .skeleton-testimonial .skeleton-author .skeleton-name {
        height: 18px;
        width: 120px;
        margin: 0 auto 8px;
        border-radius: 4px;
    }

    .skeleton-testimonial .skeleton-author .skeleton-title {
        height: 14px;
        width: 100px;
        margin: 0 auto;
        border-radius: 4px;
    }
</style>

<div class="section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="heading_s1 text-center">
                    <div class="skeleton-loading-bg" style="height: 32px; width: 200px; margin: 0 auto 30px; border-radius: 4px;"></div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="testimonial_slider testimonial_style1 carousel_slider owl-carousel owl-theme nav_style2" data-nav="true" data-dots="false" data-center="true" data-loop="true" data-autoplay="true" data-items="3" data-responsive='{"0":{"items": "1"}, "768":{"items": "2"}, "991":{"items": "3"}}'>
                    @for ($i = 0; $i < 3; $i++)
                        <div class="item">
                            <div class="testimonial_box skeleton-testimonial">
                                <div class="skeleton-avatar skeleton-loading-bg"></div>
                                <div class="skeleton-content">
                                    <div class="skeleton-line skeleton-loading-bg"></div>
                                    <div class="skeleton-line skeleton-loading-bg" style="width: 90%;"></div>
                                    <div class="skeleton-line skeleton-loading-bg" style="width: 95%;"></div>
                                    <div class="skeleton-line skeleton-loading-bg" style="width: 85%;"></div>
                                </div>
                                <div class="skeleton-author">
                                    <div class="skeleton-name skeleton-loading-bg"></div>
                                    <div class="skeleton-title skeleton-loading-bg"></div>
                                </div>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>
        </div>
    </div>
</div>