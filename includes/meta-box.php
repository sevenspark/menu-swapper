<?php

function mswp_add_swap_meta_box() {  
	$post_types = array(
		'post',
		'page',
	);

	$post_types = apply_filters( 'mswp_post_types' , $post_types );

	foreach( $post_types as $post_type ){

		add_meta_box(  
			'mswp_meta_box', // $id  
			'Menu Swapper', // $title   
			'mswp_show_swap_meta_box', // $callback  
			$post_type, // $page  
			'side', // $context  
			'default' // $priority  
		); 
	}
}  
add_action( 'add_meta_boxes', 'mswp_add_swap_meta_box' );  


function mswp_show_swap_meta_box() {  
	global $post;  
	$target_loc = get_post_meta( $post->ID, MSWP_TARGET_POST_META, true );
	$current_loc = get_post_meta( $post->ID, MSWP_LOC_POST_META, true );
	//$theme_locations = get_option( MSWP_THEME_LOC_OPTION );
	$theme_locations = get_registered_nav_menus();
	//tinder_ssd( $theme_locations );

	?>
	<input type="hidden" name="swap_meta_box_nonce" value="<?php echo wp_create_nonce(basename(__FILE__)); ?>" />
	
	<h4>Replace this Theme Location</h4>
	<select name="mswp-target-theme-loc">
		<option value="all">Any/All (will affect all menus)</option>
		<?php foreach( $theme_locations as $slug => $name ): ?>
		<option value="<?php echo $slug;?>" <?php if( $target_loc == $slug ): ?>selected="selected"<?php endif; ?> ><?php echo $name; ?></option>
		<?php endforeach; ?>	
	</select>
	<p><small><em>(The one set in wp_nav_menu in your template)</em></small></p>

	<h4>With this Theme Location</h4>
	<select name="mswp-swap-theme-loc">
		<?php foreach( $theme_locations as $slug => $name ): ?>
		<option value="<?php echo $slug;?>" <?php if( $current_loc == $slug ): ?>selected="selected"<?php endif; ?> ><?php echo $name; ?></option>
		<?php endforeach; ?>	
	</select>
	<p><small><em>(The one that you want to display on the page)</em></small></p>

	<?php
}


function mswp_save_meta( $post_id ) {  

	if( !isset( $_POST[ 'mswp-swap-theme-loc' ] ) ) 
		return $post_id;

	// verify nonce  
	if( isset( $_POST['swap_meta_box_nonce'] ) && !wp_verify_nonce( $_POST['swap_meta_box_nonce'], basename(__FILE__) ) )
		return $post_id;  
    // check autosave  
	if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
		return $post_id;  
	// check permissions  
	if( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type']) {  
		if( !current_user_can( 'edit_page', $post_id ) )  
			return $post_id;  
	} 
	elseif( !current_user_can('edit_post', $post_id ) ) {  
		return $post_id;  
	}
      

    //SWAP
	$old = get_post_meta( $post_id, MSWP_LOC_POST_META, true );  
	$new = $_POST[ 'mswp-swap-theme-loc' ];  
	if( $new && $new != $old) {  
		update_post_meta( $post_id, MSWP_LOC_POST_META, $new );  
	} 
	elseif( '' == $new && $old ) {  
		delete_post_meta( $post_id, MSWP_LOC_POST_META, $old );  
	}  

	//TARGET
	$old = get_post_meta( $post_id, MSWP_TARGET_POST_META, true );  
	$new = $_POST[ 'mswp-target-theme-loc' ];  
	if( $new && $new != $old) {  
		update_post_meta( $post_id, MSWP_TARGET_POST_META, $new );  
	} 
	elseif( '' == $new && $old ) {  
		delete_post_meta( $post_id, MSWP_TARGET_POST_META, $old );  
	}
} 
add_action( 'save_post', 'mswp_save_meta' );    