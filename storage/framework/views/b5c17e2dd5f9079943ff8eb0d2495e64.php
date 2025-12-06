<?php
    $supportedLocales = Language::getSupportedLocales();
    if (!isset($options) || empty($options)) {
        $options = [
            'before' => '',
            'lang_flag' => true,
            'lang_name' => true,
            'class' => '',
            'after' => '',
        ];
    }
?>

<?php if($supportedLocales && count($supportedLocales) > 1): ?>
    <?php
        $languageDisplay = setting('language_display', 'all');
    ?>
    <?php if(setting('language_switcher_display', 'dropdown') == 'dropdown'): ?>
        <?php echo Arr::get($options, 'before'); ?>

        <div class="dropdown me-4">
            <button class="btn btn-secondary dropdown-toggle btn-select-language" type="button" data-bs-toggle="dropdown" data-bs-auto-close="false" aria-haspopup="true" aria-expanded="true">
                <?php if(Arr::get($options, 'lang_flag', true) && ($languageDisplay == 'all' || $languageDisplay == 'flag')): ?>
                    <?php echo language_flag(Language::getCurrentLocaleFlag(), Language::getCurrentLocaleName()); ?>

                <?php endif; ?>
                <?php if(Arr::get($options, 'lang_name', true) && ($languageDisplay == 'all' || $languageDisplay == 'name')): ?>
                    <?php echo e(Language::getCurrentLocaleName()); ?>

                <?php endif; ?>
                <span class="language-caret"></span>
            </button>
            <ul class="dropdown-menu dk-dropdown_menu language_bar_chooser <?php echo e(Arr::get($options, 'class')); ?>">
                <?php $__currentLoopData = $supportedLocales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $localeCode => $properties): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($localeCode != Language::getCurrentLocale()): ?>
                        <li>
                            <a href="<?php echo e(Language::getSwitcherUrl($localeCode, $properties['lang_code'])); ?>">
                                <?php if(Arr::get($options, 'lang_flag', true) && ($languageDisplay == 'all' || $languageDisplay == 'flag')): ?><?php echo language_flag($properties['lang_flag'], $properties['lang_name']); ?><?php endif; ?>
                                <?php if(Arr::get($options, 'lang_name', true) && ($languageDisplay == 'all' || $languageDisplay == 'name')): ?><span><?php echo e($properties['lang_name']); ?></span><?php endif; ?>
                            </a>
                        </li>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
        <?php echo Arr::get($options, 'after'); ?>

    <?php else: ?>
        <ul class="language_bar_list me-2 <?php echo e(Arr::get($options, 'class')); ?>">
            <?php $__currentLoopData = $supportedLocales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $localeCode => $properties): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($localeCode != Language::getCurrentLocale()): ?>
                    <li>
                        <a href="<?php echo e(Language::getSwitcherUrl($localeCode, $properties['lang_code'])); ?>">
                            <?php if(Arr::get($options, 'lang_flag', true) && ($languageDisplay == 'all' || $languageDisplay == 'flag')): ?><?php echo language_flag($properties['lang_flag'], $properties['lang_name']); ?><?php endif; ?>
                            <?php if(Arr::get($options, 'lang_name', true) && ($languageDisplay == 'all' || $languageDisplay == 'name')): ?><span><?php echo e($properties['lang_name']); ?></span><?php endif; ?>
                        </a>
                    </li>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
        <div class="clearfix"></div>
    <?php endif; ?>
<?php endif; ?>

<?php $__env->startPush('scripts'); ?>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var toggles = document.querySelectorAll('.btn-select-language[data-bs-toggle="dropdown"]');
            toggles.forEach(function (btn) {
                btn.addEventListener('shown.bs.dropdown', function () {
                    btn.classList.add('show', 'active');
                });
                btn.addEventListener('hidden.bs.dropdown', function () {
                    btn.classList.remove('show', 'active');
                });
            });
        });
    </script>
<?php $__env->stopPush(); ?>
<?php /**PATH C:\laragon\www\acureva\platform\themes/shopwise/partials/language-switcher.blade.php ENDPATH**/ ?>