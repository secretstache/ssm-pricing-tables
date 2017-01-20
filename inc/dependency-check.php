<?php
// No direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Check if ACF_PRO active
function ssmpt_check_if_acf_pro_is_active() {
  if ( is_admin() && current_user_can( 'activate_plugins' ) &&  !is_plugin_active( 'advanced-custom-fields-pro/acf.php' ) ) {
    add_action( 'admin_notices', 'ssmpt_check_if_acf_pro_active_notice' );

    deactivate_plugins( SSM_PRICING_TABLES_BASENAME );

    if ( isset( $_GET['activate'] ) ) {
      unset( $_GET['activate'] );
    }
  }
}
add_action( 'admin_init', 'ssmpt_check_if_acf_pro_is_active' );

// Dependency missing notice
function ssmpt_check_if_acf_pro_active_notice(){ ?>
  <div class="error"><p>SSM Pricing Tables requires <a href="#">Advanced Custom Fields PRO</a>. As a result it has been deactivated.</p></div>
    <?php
}