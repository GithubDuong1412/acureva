<div class="section pb_20">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8">
                <div class="heading_s1 text-center">
                    <h2><?php echo BaseHelper::clean($title); ?></h2>
                </div>
                <p class="leads text-center">
                <?php if($description): ?>
                    <?php echo BaseHelper::clean($description); ?>

                <?php endif; ?>
                <?php if($subtitle): ?>
                    <?php echo BaseHelper::clean($subtitle); ?>

                <?php endif; ?>
                </p>
            </div>
        </div>
        <div class="justify-content-center">
            <div class="row">
                <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-lg-4 col-md-6">
                        <div class="blog_post blog_style2 box_shadow1">
                            <div class="blog_img">
                                <a href="<?php echo e($post->url); ?>">
                                    <img src="<?php echo e(RvMedia::getImageUrl($post->image, 'small', false, RvMedia::getDefaultImage())); ?>" alt="<?php echo e($post->name); ?>" loading="lazy" />
                                </a>
                            </div>
                            <div class="blog_content bg-white">
                                <div class="blog_text">
                                    <h3 class="blog_title"><a href="<?php echo e($post->url); ?>"><?php echo e($post->name); ?></a></h3>
                                    <ul class="list_none blog_meta">
                                        <li><i class="ti-calendar"></i> <?php echo e(Theme::formatDate($post->created_at)); ?></li>
                                        <li><i class="eye"></i> <?php echo e(number_format($post->views)); ?> <?php echo e(__('Views')); ?></li>
                                    </ul>
                                    <p><?php echo e(Str::words($post->description, 35)); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\laragon\www\acureva\platform\themes/shopwise/partials/shortcodes/featured-news.blade.php ENDPATH**/ ?>