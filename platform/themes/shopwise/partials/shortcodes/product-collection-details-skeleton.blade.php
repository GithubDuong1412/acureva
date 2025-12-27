<div class="section small_pb small_pt">
    <div class="container">
        <div class="row mb-3">
            <div class="col-md-4">
                <div class="skeleton-loading-bg" style="height: 32px;"></div>
            </div>
        </div>

        <div class="row">
            @for ($i = 0; $i < 4; $i++)
                <div class="col-md-3 col-sm-6">
                    <div class="product skeleton-product-item">
                        <div class="skeleton-img skeleton-loading-bg"></div>
                        <div class="skeleton-title skeleton-loading-bg"></div>
                        <div class="skeleton-price skeleton-loading-bg"></div>
                    </div>
                </div>
            @endfor
        </div>
    </div>
</div>