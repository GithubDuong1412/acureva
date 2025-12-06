<ul <?php echo $options; ?>>
    <?php $menu_nodes->loadMissing('metadata'); ?>
    <?php $__currentLoopData = $menu_nodes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li <?php if($row->has_child || $row->css_class || $row->active): ?> class="<?php if($row->has_child): ?> dropdown <?php endif; ?> <?php if($row->css_class): ?> <?php echo e($row->css_class); ?> <?php endif; ?> <?php if($row->active): ?> active <?php endif; ?>" <?php endif; ?>>
            <a class="<?php if($row->has_child): ?> dropdown-toggle nav-link <?php else: ?> nav-link nav_item <?php endif; ?>" href="<?php echo e($row->has_child ? '#' : url($row->url)); ?>" <?php if($row->target !== '_self'): ?> target="<?php echo e($row->target); ?>" <?php endif; ?> <?php if($row->has_child): ?> data-bs-toggle="dropdown" <?php endif; ?>>
                <?php echo $row->icon_html; ?><?php echo e($row->title); ?>

            </a>
            <?php if($row->has_child): ?>
                <div class="dropdown-menu dropdown-reverse">
                    <?php echo Menu::generateMenu([
                        'menu'       => $menu,
                        'menu_nodes' => $row->child,
                        'view'       => 'sub-menu',
                    ]); ?>

                </div>
            <?php endif; ?>
        </li>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <li class="mobile-menu-item mobile-menu-item-first-item">
        <?php if(is_plugin_active('language')): ?>
            <div class="language-wrapper">
                <?php echo Theme::partial('language-switcher'); ?>

            </div>
        <?php endif; ?>
    </li>
    <li class="mobile-menu-item">
        <?php if(is_plugin_active('ecommerce')): ?>
            <?php $currencies = get_all_currencies(); ?>
            <!-- <?php if(count($currencies) > 1): ?>
                <div class="language-wrapper choose-currency">
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle btn-select-language" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            <?php echo e(get_application_currency()->symbol); ?> - <?php echo e(get_application_currency()->title); ?>

                            <span class="language-caret"></span>
                        </button>
                        <ul class="dropdown-menu language_bar_chooser">
                            <?php $__currentLoopData = $currencies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $currency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li>
                                    <a href="<?php echo e(route('public.change-currency', $currency->title)); ?>" <?php if(get_application_currency_id() == $currency->id): ?> class="active" <?php endif; ?>><span><?php echo e($currency->symbol); ?> - <?php echo e($currency->title); ?></span></a>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                </div>
            <?php endif; ?> -->
        <?php endif; ?>
    </li>
</ul>
<?php /**PATH C:\laragon\www\acureva\platform\themes/shopwise/partials/menu.blade.php ENDPATH**/ ?>