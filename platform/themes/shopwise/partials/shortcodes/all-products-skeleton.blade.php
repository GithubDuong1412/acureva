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

    .skeleton-product-item {
        margin-bottom: 30px;
    }

    .skeleton-product-img {
        width: 100%;
        padding-bottom: 100%;
        position: relative;
        border-radius: 4px;
        overflow: hidden;
    }

    .skeleton-product-img .skeleton-img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
    }

    .skeleton-product-info {
        padding: 15px 0;
    }

    .skeleton-product-info .skeleton-title {
        height: 18px;
        margin-bottom: 10px;
        border-radius: 4px;
    }

    .skeleton-product-info .skeleton-price {
        height: 20px;
        width: 80px;
        border-radius: 4px;
    }
</style>

<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="heading_s1">
                    <div class="skeleton-loading-bg" style="height: 32px; width: 200px; border-radius: 4px; margin-bottom: 30px;"></div>
                </div>
            </div>
        </div>
        <div class="row shop_container">
            @for ($i = 0; $i < 12; $i++)
                <div class="col-lg-3 col-md-4 col-6">
                    <div class="product skeleton-product-item">
                        <div class="product_img skeleton-product-img">
                            <div class="skeleton-img skeleton-loading-bg"></div>
                        </div>
                        <div class="product_info skeleton-product-info">
                            <div class="skeleton-title skeleton-loading-bg"></div>
                            <div class="skeleton-price skeleton-loading-bg"></div>
                        </div>
                    </div>
                </div>
            @endfor
        </div>
    </div>
</div>