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
        border: 1px solid #f0f0f0;
        border-radius: 4px;
        margin-bottom: 30px;
    }

    .skeleton-brand-item .skeleton-img {
        width: 150px;
        height: 80px;
        margin: 0 auto;
        border-radius: 4px;
    }
</style>

<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="heading_s1">
                    <div class="skeleton-loading-bg" style="height: 32px; width: 150px; border-radius: 4px; margin-bottom: 30px;"></div>
                </div>
            </div>
        </div>
        <div class="row align-items-center">
            @for ($i = 0; $i < 12; $i++)
                <div class="col-6 col-md-4 col-lg-2">
                    <div class="skeleton-brand-item">
                        <div class="skeleton-img skeleton-loading-bg"></div>
                    </div>
                </div>
            @endfor
        </div>
    </div>
</div>