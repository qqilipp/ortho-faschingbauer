<?php
add_action( 'admin_menu', 'tigris_backup_menu_page' );

function tigris_backup_menu_page() {
	if ( is_plugin_active( 'backupwordpress/backupwordpress.php' ) ) {
		add_menu_page( 'Backup', 'Backup', 'edit_posts', 'tools.php?page=backupwordpress', '', 'dashicons-backup', 0 );
	}
	if ( is_plugin_active( 'updraftplus/updraftplus.php' ) ) {
		add_menu_page( 'Backups', 'Backups', 'edit_posts', 'options-general.php?page=updraftplus', '', 'dashicons-backup', 0 );
	}
}
	
?>