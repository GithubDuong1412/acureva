<div class="col-lg-3 col-md-6 col-sm-12 d-flex justify-content-center">
    <div class="widget">
        <h3 class="widget_title"><?php echo e($config['name']); ?></h3>
        <?php echo Menu::generateMenu(['slug' => $config['menu_id'], 'options' => ['class' => 'widget_links']]); ?>

    </div>
</div>
<?php /**PATH C:\laragon\www\acureva\platform\themes/shopwise/////widgets/custom-menu/templates/frontend.blade.php ENDPATH**/ ?>