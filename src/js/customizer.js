/**
 * File livepreview.js.
 *
 * Deal with real time changes asynchronously.
 */
( function( $ ) {

	// Hook into the API.
	let api = wp.customize;

	// Site title.
	api( 'blogname', ( value ) => {
		value.bind( ( to ) => {
			$( '.site-title a' ).text( to );
		} );
	} );

	// Search Toggle
	api( 'search_toggle', ( value ) => {
		value.bind( ( to ) => {
			$( '.search-toggle' ).text( to );
		} );
	} );

	// Nav Toggle
	api( 'nav_toggle', ( value ) => {
		value.bind( ( to ) => {
			$( '.primary' ).text( to );
		} );
	} );

	// Site title.
	api( 'footer_copyright', ( value ) => {
		value.bind( ( to ) => {
			$( '.copyright-language' ).text( to );
		} );
	} );
} )( jQuery );
