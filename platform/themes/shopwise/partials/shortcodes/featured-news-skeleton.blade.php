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

    .skeleton-blog-item {
        margin-bottom: 30px;
    }

    .skeleton-blog-img {
        width: 100%;
        height: 250px;
        border-radius: 4px;
        overflow: hidden;
        margin-bottom: 15px;
    }

    .skeleton-blog-content {
        padding: 0 15px;
    }

    .skeleton-blog-content .skeleton-meta {
        height: 14px;
        width: 150px;
        margin-bottom: 10px;
        border-radius: 4px;
    }

    .skeleton-blog-content .skeleton-title {
        height: 24px;
        margin-bottom: 10px;
        border-radius: 4px;
    }

    .skeleton-blog-content .skeleton-excerpt {
        margin-bottom: 15px;
    }

    .skeleton-blog-content .skeleton-excerpt .skeleton-line {
        height: 16px;
        margin-bottom: 6px;
        border-radius: 4px;
    }

    .skeleton-blog-content .skeleton-link {
        height: 18px;
        width: 100px;
        border-radius: 4px;
    }
</style>

<div class="section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="heading_s1 text-center">
                    <div class="skeleton-loading-bg" style="height: 32px; width: 200px; margin: 0 auto 10px; border-radius: 4px;"></div>
                    <div class="skeleton-loading-bg" style="height: 20px; width: 300px; margin: 0 auto 8px; border-radius: 4px;"></div>
                    <div class="skeleton-loading-bg" style="height: 20px; width: 350px; margin: 0 auto 30px; border-radius: 4px;"></div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            @for ($i = 0; $i < 3; $i++)
                <div class="col-lg-4 col-md-6">
                    <div class="blog_post skeleton-blog-item">
                        <div class="blog_img skeleton-blog-img skeleton-loading-bg"></div>
                        <div class="blog_content skeleton-blog-content">
                            <div class="skeleton-meta skeleton-loading-bg"></div>
                            <div class="skeleton-title skeleton-loading-bg"></div>
                            <div class="skeleton-excerpt">
                                <div class="skeleton-line skeleton-loading-bg"></div>
                                <div class="skeleton-line skeleton-loading-bg" style="width: 90%;"></div>
                                <div class="skeleton-line skeleton-loading-bg" style="width: 80%;"></div>
                            </div>
                            <div class="skeleton-link skeleton-loading-bg"></div>
                        </div>
                    </div>
                </div>
            @endfor
        </div>
    </div>
</div>