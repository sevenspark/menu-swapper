<?php

add_action( 'admin_menu', 'mswp_add_plugin_page' );
add_action( 'admin_init', 'mswp_page_init' );

function mswp_add_plugin_page(){
	add_options_page( 'Menu Swapper', 'Menu Swapper', 'manage_options', 
		'menu-swapper', 'mswp_create_admin_page' );
}

function mswp_create_admin_page(){
	?>
	<div class="wrap mswp-wrap">
		<?php screen_icon(); ?>
		<h2>Menu Swapper Settings <small>v<?php echo MSWP_VERSION; ?></small></h2>			
		<form method="post" action="options.php">
		<?php
			settings_fields( 'mswp_option_group' );	
			do_settings_sections( 'mswp-setting-admin' );
		?>
		<?php submit_button( 'Save Custom Theme Locations' ); ?>
		</form>
	</div>
	<?php
}




function mswp_page_init(){		
	register_setting( 'mswp_option_group', 'mswp_theme_locations' , 'mswp_save_settings' ); //, 'mswp_check_ID' );
		
	add_settings_section(
		'mswp_section_1',
		'Custom Theme Locations',
		'mswp_print_section_info',
		'mswp-setting-admin'
	);	
		
	add_settings_field(
		'mswp_theme_locations', 
		'', 
		'mswp_create_multitext_field', 
		'mswp-setting-admin',
		'mswp_section_1'			
	);		
}

function mswp_save_settings( $input ){

	//tinder_ssd( $input );

	$theme_locs = array();
	$k = 1;

	foreach( $input as $loc ){
		if( $loc['slug'] != '' ){
			//$slug = $loc['slug'];
			//$name = $loc['name'];
			if( $loc['name'] == '' ){
				$loc['name'] = "Untitled Theme Location $k";
			}
			$loc['slug'] = sanitize_title( $loc['slug'] );
			$theme_locs[] = $loc;
			$k++;
		}

	}
	//tinder_ssd( $theme_locs );
	//die();

	/*if( get_option( 'mswp_theme_locations' ) === FALSE){
		add_option( 'mswp_theme_locations', $theme_locs );
	}
	else{
		update_option( 'mswp_theme_locations', $theme_locs );
	}*/

	return $theme_locs;

}


function mswp_print_section_info(){
	//print 'Enter your setting below:';
}

function mswp_create_multitext_field( $args ){

	
	$k = 0;
	$theme_locations = get_option( MSWP_THEME_LOC_OPTION ); //array( 'one' => 'One', 'two' => 'Two' );

	//tinder_ssd( $theme_locations );

	if( !is_array( $theme_locations ) || empty( $theme_locations ) ){
		$theme_locations = array( array( 'slug' => 'mswp_sample_custom_theme_loc' , 'name' => 'Sample Custom Theme Location' ) );
	}

	?>
	<div class="mswp-tips">
		<ol>
			<li>Create a new theme location below and save your changes</li>
			<li>Visit <a href="<?php echo admin_url( 'nav-menus.php?action=locations' ); ?>">Appearance > Menus > Manage Locations</a> to assign a menu to this theme location</li>
			<li>Go to any post and select which theme location to replace in the Menu Swapper meta box.</li>
		</ol>
	</div>

	<table class="menu-swapper-theme-locs-table wp-list-table widefat" >
		<tr>
			<th class="mswp-delete">Remove</th>
			<th class="mswp-slug">Theme Location Slug</th>
			<th>Theme Location Name</th>
		</tr>
	<?php foreach( $theme_locations as $loc ): 
		if( $k%2 == 0 ) $class=' class="alternate"';
		?>
		<tr <?php echo $class; ?>>
			<td class="mswp-delete mswp-delete-x"><a href="#" class="mswp-delete-theme-location">&times;</a></td>
			<td>
			<input type="text" class="mswp_theme_locations_slug"
				id="mswp_theme_locations_slug_<?php echo $k; ?>"
				name="mswp_theme_locations[<?php echo $k; ?>][slug]" 
				value="<?php echo $loc['slug']; ?>" /> 
			<span class="mswp-tl-arrow">&rarr;</span>
			</td>
			<td>
			<input type="text"  class="mswp_theme_locations_name"
				id="mswp_theme_locations_name_<?php echo $k; ?>"
				name="mswp_theme_locations[<?php echo $k; ?>][name]" 
				value="<?php echo $loc['name']; ?>" />
			</td>
		</tr>
	<?php
	$k++;
	endforeach;

	?>

		<tr class="mswp-ondeck">
			<td class="mswp-delete mswp-delete-x"><a href="#" class="mswp-delete-theme-location">&times;</a></td>
			<td>
			<input type="text" class="mswp_theme_locations_slug"
				name="mswp_theme_locations" 
				value="" 
				disabled />
			</td>
			<td>
			<input type="text" class="mswp_theme_locations_name"
				name="mswp_theme_locations" 
				value="" 
				disabled />
			</td>
		</tr>

	</table>

	<a id="mswp_new_theme_location" href="#">+ New Theme Location</a>

	<input type="hidden" id="theme_location_count" name="theme_location_count" value="<?php echo $k+1; ?>" />

	<br/><br/>
	<p>Make sure your Theme Location slugs are unique!  
		A good slug might be <code>mswp_secondary_theme_location</code>. <br/>
		You can change your Theme Location Names any time, but if you change or delete a slug, the theme location to menu associations will be lost.</p>
	<?php
}
