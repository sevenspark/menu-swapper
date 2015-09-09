<?php

function mswp_load_admin_resources(){
	$assets = MSWP_PLUGIN_URL . 'assets/';
	wp_enqueue_style( 'mswp-style' , $assets.'css/menu-swapper.css' );
	wp_enqueue_script( 'mswp' , $assets.'js/menu-swapper.js' );
}
add_action( 'admin_print_styles-settings_page_menu-swapper' , 'mswp_load_admin_resources' );


function mswp_register_menus(){

	$theme_locations = get_option( MSWP_THEME_LOC_OPTION );

	if( $theme_locations ){
		foreach( $theme_locations as $loc ){
			register_nav_menus( array(
				$loc['slug'] => $loc['name']
			) );
		}
	}
}
add_action( 'init', 'mswp_register_menus' , 20 );


function mswp_swap_theme_location_filter( $args ){
	global $post;

	if( ( is_single() || is_front_page() ) && $post && $post->ID ){
		$swap_loc = get_post_meta( $post->ID , MSWP_LOC_POST_META , true );
		$target_loc = get_post_meta( $post->ID , MSWP_TARGET_POST_META , true );

		//Check if swap & target are set at all 
		if( $swap_loc != '' && $target_loc != 'none' ){

			//Check whether we should swap this location
			if( $target_loc == $args['theme_location'] ||
				$target_loc == 'all' ){
				$args['theme_location'] = $swap_loc;

				if( isset( $args['menu'] ) ){
					//Special for WPML
					if( defined( 'ICL_SITEPRESS_VERSION' ) && function_exists( 'icl_object_id' ) ) {
						if( is_object( $args['menu'] ) ){
							$locations = get_nav_menu_locations();
							if ( isset( $args[ 'theme_location' ] ) && isset( $locations[ $args[ 'theme_location' ] ] ) ) {
								$args[ 'menu' ] = icl_object_id( $locations[ $args[ 'theme_location' ] ], 'nav_menu' );
							}
						}
					}
					else $args['menu'] = ''; //unset( $args['menu'] );
				}
			}
		}
	}

	return $args;
}
add_filter( 'wp_nav_menu_args' , 'mswp_swap_theme_location_filter' , 30 );



function mswpp( $data ){
	echo '<pre>';
	print_r( $data );
	echo '</pre>';
}