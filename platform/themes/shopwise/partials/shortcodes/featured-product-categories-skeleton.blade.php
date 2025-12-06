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

    .skeleton-categories-box {
        text-align: center;
        padding: 20px;
    }

    .skeleton-categories-box .skeleton-img {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        margin: 0 auto 10px;
    }

    .skeleton-categories-box .skeleton-text {
        height: 16px;
        width: 80px;
        margin: 0 auto;
        border-radius: 4px;
    }
</style>

<div class="section small_pb small_pt">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="heading_s4 text-center">
                    <div class="skeleton-loading-bg" style="height: 32px; width: 300px; margin: 0 auto 15px; border-radius: 4px;"></div>
                </div>
                <div class="text-center">
                    <div class="skeleton-loading-bg" style="height: 20px; width: 400px; margin: 0 auto 10px; border-radius: 4px;"></div>
                    <div class="skeleton-loading-bg" style="height: 20px; width: 350px; margin: 0 auto; border-radius: 4px;"></div>
                </div>
            </div>
        </div>
        <div class="row align-items-center">
            <div class="col-12">
                <div class="mt-4 mt-md-0 d-flex justify-content-between">
                    @for ($i = 0; $i < 7; $i++)
                        <div class="skeleton-categories-box">
                            <div class="skeleton-img skeleton-loading-bg"></div>
                            <div class="skeleton-text skeleton-loading-bg"></div>
                        </div>
                    @endfor
                </div>
            </div>
        </div>
    </div>
</div>