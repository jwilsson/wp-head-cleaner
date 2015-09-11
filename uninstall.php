<?php
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
    die();
}

delete_option( 'wp_head_cleaner_hooks' );
