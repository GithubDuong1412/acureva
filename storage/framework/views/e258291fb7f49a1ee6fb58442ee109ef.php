<?php
    $groupedCategories = $categories->groupBy('parent_id');

    $currentCategories = $groupedCategories->get(0);
?>

<?php if($currentCategories): ?>
    <?php $__currentLoopData = $currentCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
            $categoryHtml = Theme::partial('product-categories-dropdown-item', ['category' => $category, 'groupedCategories' => $groupedCategories]);
        ?>

        <?php if($loop->index < 10): ?>
            <?php echo $categoryHtml; ?>

        <?php else: ?>
            <?php if($loop->index == 10): ?>
                <li>
                    <ul class="more_slide_open" style="display: none;">
            <?php endif; ?>

            <?php echo $categoryHtml; ?>


            <?php if($loop->last): ?>
                </ul>
            </li>
            <?php endif; ?>
        <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>
<?php /**PATH C:\laragon\www\acureva\platform\themes/shopwise/partials/product-categories-dropdown.blade.php ENDPATH**/ ?>