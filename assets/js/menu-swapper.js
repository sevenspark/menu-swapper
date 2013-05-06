jQuery( document ).ready( function( $ ){

	var $tlcount = $( '#theme_location_count' );
	var count = $tlcount.val() - 1;
	var $ondeck = $( '.mswp-ondeck' );

	var addNewThemeLocation = function(){
		
		var $row = $ondeck.clone();

		var $slug = $row.find( '.mswp_theme_locations_slug' );
		$slug.attr( 'name' , $slug.attr( 'name' ) + '['+count+'][slug]' );
		$slug.attr( 'disabled' , false );

		var $name = $row.find( '.mswp_theme_locations_name' );
		$name.attr( 'name' , $name.attr( 'name' ) + '['+count+'][name]' );
		$name.attr( 'disabled' , false );

		$row.appendTo( '.menu-swapper-theme-locs-table' );
		$row.removeClass( 'mswp-ondeck' );

		count++;
		$tlcount.val( count );
		//console.log( 'done' );
	}
	

	$( '#mswp_new_theme_location' ).click( function( e ){
		e.preventDefault();

		addNewThemeLocation();

	});

	$( '.menu-swapper-theme-locs-table' ).on( 'click', 'a.mswp-delete-theme-location' , function( e ) {
		e.preventDefault();

		$( this ).parent( 'td' ).parent( 'tr' ).find( 'input' ).val( '' );
	});

});