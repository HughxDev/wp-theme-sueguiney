<?php if ( !is_front_page() ) : ?>
<?php
	$implied = '';

	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	if ( is_plugin_active('advanced-custom-fields/acf.php') && !is_archive() ) {
		$implied = ( get_field( 'show_title' ) ? $implied : ' implied' );
	}
	//var_dump(get_option( 'active_plugins', array() ));
?>
<h2 class="h headline section-title<?php echo $implied; ?>"><?php echo roots_title(); ?></h2>
<?php endif; ?>