<nav class="dash-sidebar light-sidebar <?php echo e(empty($company_settings['site_transparent']) || $company_settings['site_transparent'] == 'on' ? 'transprent-bg' : ''); ?>">
    <div class="navbar-wrapper">
        <div class="m-header main-logo">
            <a href="<?php echo e(route('home')); ?>" class="b-brand">
                <!-- ========   change your logo hear   ============ -->
                <img src="<?php echo e(get_file(sidebar_logo())); ?><?php echo e('?' . time()); ?>" alt="" class="logo logo-lg" />
                
            </a>
        </div>
        <?php if(!empty($company_settings['category_wise_sidemenu']) && $company_settings['category_wise_sidemenu'] == 'on'): ?>
          <div class="tab-container">
            <div class="tab-sidemenu">
              <ul class="dash-tab-link nav flex-column" role="tablist" id="dash-layout-submenus">
              </ul>
            </div>
            <div class="tab-link">
              <div class="navbar-content">
                <div class="tab-content" id="dash-layout-tab">
                </div>
                <ul class="dash-navbar">
                    <?php echo getMenu(); ?>

                    <?php echo $__env->yieldPushContent('custom_side_menu'); ?>
                </ul>
              </div>
            </div>
          </div>
        <?php else: ?>
          <div class="navbar-content">
              <ul class="dash-navbar">
                  <?php echo getMenu(); ?>

                  <?php echo $__env->yieldPushContent('custom_side_menu'); ?>
              </ul>
          </div>
        <?php endif; ?>  
        
    </div>
</nav>
<?php /**PATH C:\Users\Espacegamers\Documents\lumex\resources\views/partials/sidebar.blade.php ENDPATH**/ ?>