<ul class="nav nav-tabs justify-content-center <?php echo e(Arr::get($attributes ?? [], 'class')); ?>" id="tabmenubar" role="tablist" aria-label="Collections list">
    <?php $__currentLoopData = $collections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $collection): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li class="nav-item" role="tab" aria-controls="<?php echo e($collection->slug); ?>" aria-selected="true"
            id="<?php echo e($collection->slug); ?>-tab"
            aria-labelledby="#tabmenubar">
            <a class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                'nav-link',
                'active' => $collection->id == $collectionId,
            ]); ?>"
            data-bs-toggle="tab"
            href="#<?php echo e($collection->slug); ?>"
            <?php if($collection->id == $collectionId): ?> data-loaded <?php endif; ?> data-ref="<?php echo e($collection->slug); ?>"
            data-url="<?php echo e(route('public.ajax.products', ['collection_id' => $collection->id, 'limit' => $limit])); ?>"><?php echo e($collection->name); ?></a>
        </li>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</ul>
<?php /**PATH C:\laragon\www\acureva\platform\themes/shopwise/partials/shortcodes/product-collections/nav-tabs.blade.php ENDPATH**/ ?>