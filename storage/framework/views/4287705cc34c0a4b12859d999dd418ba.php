<ol class="breadcrumb justify-content-md-end">
    <?php $__currentLoopData = $crumbs = Theme::breadcrumb()->getCrumbs(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $crumb): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if($i != (count($crumbs) - 1)): ?>
            <li class="breadcrumb-item">
                <a href="<?php echo e($crumb['url']); ?>" title="<?php echo e($crumb['label']); ?>">
                    <?php echo BaseHelper::clean($crumb['label']); ?>

                </a>
            </li>
        <?php else: ?>
            <li class="breadcrumb-item active"><?php echo BaseHelper::clean($crumb['label']); ?></li>
        <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</ol>
<?php /**PATH C:\laragon\www\acureva\platform\themes/shopwise/partials/breadcrumbs.blade.php ENDPATH**/ ?>