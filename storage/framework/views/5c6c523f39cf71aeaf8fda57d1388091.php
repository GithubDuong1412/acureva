    <footer class="footer_dark dk-footer">
        <div class="footer_top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="widget">
                            <?php if(theme_option('logo_footer') || theme_option('logo')): ?>
                                <div class="footer_logo">
                                    <a href="<?php echo e(route('public.single')); ?>">
                                        <img src="<?php echo e(RvMedia::getImageUrl(theme_option('logo_footer') ? theme_option('logo_footer') : theme_option('logo'))); ?>" alt="<?php echo e(theme_option('site_title')); ?>"  loading="lazy" />
                                    </a>
                                </div>
                            <?php endif; ?>
                            <p><?php echo e(theme_option('about-us')); ?></p>
                        </div>
                        <?php if(theme_option('social_links')): ?>
                            <div class="widget">
                                <ul class="social_icons social_white">
                                    <?php $__currentLoopData = json_decode(theme_option('social_links'), true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $socialLink): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if(count($socialLink) == 4): ?>
                                            <li>
                                                <a href="<?php echo e($socialLink[2]['value']); ?>"
                                                   title="<?php echo e($socialLink[0]['value']); ?>" style="background-color: <?php echo e($socialLink[3]['value']); ?>; border: 1px solid <?php echo e($socialLink[3]['value']); ?>;" target="_blank">
                                                    <i class="<?php echo e($socialLink[1]['value']); ?>"></i>
                                                </a>
                                            </li>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                        <div class="widget">
                            <!-- <h3 class="widget_title"><?php echo e(__('Contact Info')); ?></h3> -->
                            <ul class="contact_info contact_info_light">
                                <?php if(theme_option('company-name')): ?>
                                    <li>
                                        <i class="ti-briefcase"></i>
                                        <p><?php echo e(theme_option('company-name')); ?></p>
                                    </li>
                                <?php endif; ?>
                                <?php if(theme_option('address')): ?>
                                    <li>
                                        <i class="ti-location-pin"></i>
                                        <p><?php echo e(theme_option('address')); ?></p>
                                    </li>
                                <?php endif; ?>
                                <?php if(theme_option('email')): ?>
                                    <li>
                                        <i class="ti-email"></i>
                                        <a href="mailto:<?php echo e(theme_option('email')); ?>"><?php echo e(theme_option('email')); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(theme_option('hotline')): ?>
                                    <li>
                                        <i class="ti-mobile"></i>
                                        <p><?php echo e(theme_option('hotline')); ?></p>
                                    </li>
                                <?php endif; ?>
                                <?php if(theme_option('support-hour')): ?>
                                    <li>
                                        <i class="ti-headphone"></i>
                                        <p><?php echo e(theme_option('support-hour')); ?></p>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                    <?php echo dynamic_sidebar('footer_sidebar'); ?>

                    <!-- <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="widget">
                            <h3 class="widget_title"><?php echo e(__('Contact Info')); ?></h3>
                            <ul class="contact_info contact_info_light">
                                <?php if(theme_option('company-name')): ?>
                                    <li>
                                        <i class="ti-briefcase"></i>
                                        <p><?php echo e(theme_option('company-name')); ?></p>
                                    </li>
                                <?php endif; ?>
                                <?php if(theme_option('address')): ?>
                                    <li>
                                        <i class="ti-location-pin"></i>
                                        <p><?php echo e(theme_option('address')); ?></p>
                                    </li>
                                <?php endif; ?>
                                <?php if(theme_option('email')): ?>
                                    <li>
                                        <i class="ti-email"></i>
                                        <a href="mailto:<?php echo e(theme_option('email')); ?>"><?php echo e(theme_option('email')); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(theme_option('hotline')): ?>
                                    <li>
                                        <i class="ti-mobile"></i>
                                        <p><?php echo e(theme_option('hotline')); ?></p>
                                    </li>
                                <?php endif; ?>
                                <?php if(theme_option('support-hour')): ?>
                                    <li>
                                        <i class="ti-headphone"></i>
                                        <p><?php echo e(theme_option('support-hour')); ?></p>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
        <div class="bottom_footer border-top-tran">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <p class="mb-md-0 text-center text-md-start text-lg-start"><?php echo Theme::getSiteCopyright(); ?></p>
                    </div>
                    <div class="col-md-6">
                        <ul class="footer_payment text-center text-md-end text-lg-end">
                            <?php $__currentLoopData = json_decode(theme_option('payment_methods', []), true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $method): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if(!empty($method)): ?>
                                    <li><img src="<?php echo e(RvMedia::getImageUrl($method)); ?>" alt="payment method" loading="lazy" /></li>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>

     <?php if(is_plugin_active('ecommerce') && EcommerceHelper::isCartEnabled()): ?>
         <div id="remove-item-modal" class="modal" tabindex="-1" role="dialog">
             <div class="modal-dialog modal-dialog-centered" role="document">
                 <div class="modal-content">
                     <div class="modal-header">
                         <h5 class="modal-title"><?php echo e(__('Warning')); ?></h5>
                         <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                             <span aria-hidden="true">&times;</span>
                         </button>
                     </div>
                     <div class="modal-body">
                         <p><?php echo e(__('Are you sure you want to remove this product from cart?')); ?></p>
                     </div>
                     <div class="modal-footer">
                         <button type="button" class="btn btn-fill-out" data-bs-dismiss="modal"><?php echo e(__('Cancel')); ?></button>
                         <button type="button" class="btn btn-fill-line confirm-remove-item-cart"><?php echo e(__('Yes, remove it!')); ?></button>
                     </div>
                 </div>
             </div>
         </div>
     <?php endif; ?>

    <a href="#" class="scrollup" style="display: none;" title="back to top"><i class="ion-ios-arrow-up"></i></a>


    <script>
        window.trans = {
            "No reviews!": "<?php echo e(__('No reviews!')); ?>",
            "Days": "<?php echo e(__('Days')); ?>",
            "Hours": "<?php echo e(__('Hours')); ?>",
            "Minutes": "<?php echo e(__('Minutes')); ?>",
            "Seconds": "<?php echo e(__('Seconds')); ?>",
        };

        window.siteUrl = "<?php echo e(route('public.index')); ?>";
    </script>

    <?php echo Theme::footer(); ?>


    </body>
</html>
<?php /**PATH C:\laragon\www\acureva\platform\themes/shopwise/partials/footer.blade.php ENDPATH**/ ?>