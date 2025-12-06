<?php if (! $__env->hasRenderedOnce('1ab7c832-936c-4bb3-b41a-735db70e7077')): $__env->markAsRenderedOnce('1ab7c832-936c-4bb3-b41a-735db70e7077'); ?>
    <div
        class="offcanvas offcanvas-end"
        tabindex="-1"
        id="notification-sidebar"
        aria-labelledby="notification-sidebar-label"
        data-url="<?php echo e(route('notifications.index')); ?>"
        data-count-url="<?php echo e(route('notifications.count-unread')); ?>"
    >
        <button
            type="button"
            class="btn-close text-reset"
            data-bs-dismiss="offcanvas"
            aria-label="Close"
        ></button>

        <div class="notification-content"></div>
    </div>

    <script src="<?php echo e(asset('vendor/core/core/base/js/notification.js')); ?>"></script>
<?php endif; ?>
<?php /**PATH C:\laragon\www\acureva\platform/core/base/resources/views/notification/notification.blade.php ENDPATH**/ ?>