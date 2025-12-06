<?php
    $hasChildren = $groupedCategories->has($category->id);
?>

<li <?php if($hasChildren): ?> class="dropdown dropdown-mega-menu" <?php endif; ?>>
    <a class="dropdown-item nav-link <?php if($hasChildren): ?> dropdown-toggler <?php endif; ?>" href="<?php echo e(route('public.single', $category->url)); ?>" <?php if($hasChildren): ?> data-bs-toggle="dropdown" <?php endif; ?>>
        <?php if($category->icon_image): ?>
            <img src="<?php echo e(RvMedia::getImageUrl($category->icon_image)); ?>" alt="<?php echo e($category->name); ?>" width="22" height="22" loading="lazy" />
        <?php elseif($category->icon): ?>
            <i class="<?php echo e($category->icon); ?>"></i>
        <?php endif; ?>
        <span><?php echo e($category->name); ?></span>
    </a>
    <?php if($hasChildren): ?>
        <div class="dropdown-menu">
            <ul class="mega-menu d-lg-flex">
                <li class="mega-menu-col">
                    <ul>
                        <?php
                            $currentCategories = $groupedCategories->get($category->id);
                        ?>
                        <?php if($currentCategories): ?>
                            <?php $__currentLoopData = $currentCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $childCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><a class="dropdown-item nav-link nav_item" href="<?php echo e(route('public.single', $childCategory->url)); ?>"><?php echo e($childCategory->name); ?></a></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </ul>
                </li>
            </ul>
        </div>
    <?php endif; ?>
</li>
<?php /**PATH C:\laragon\www\acureva\platform\themes/shopwise/partials/product-categories-dropdown-item.blade.php ENDPATH**/ ?>