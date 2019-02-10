import {
  hasClass,
  addClass,
  removeClass,
  setAriaHidden,
  setTabIndex } from './helpers';

/**
 * Add event from js the keep the marup clean
 */
export const initSearch = () => {

  const searchToggle = document.getElementById( 'search-toggle' );

  if ( null === searchToggle ) {
    return;
  }

  const body         = document.getElementsByTagName( 'body' )[0];
  const search       = document.getElementById( 'search-form-container' );

  // Handle search toggle button.
  searchToggle.addEventListener( 'click', toggleSearch );

  // Handle keyboard escape.
  document.addEventListener( 'keydown', ( event ) => {

    // If the search is open and we hit escape, close the search.
    if ( hasClass( body, 'search-open' ) && 'Escape' === event.key ) {
      toggleSearch();
    }
  } );

  // Handle click events.
  document.addEventListener( 'click', ( event ) => {
    let isOutside = ! search.contains( event.target ) && ! searchToggle.contains( event.target );

    // If the search is open and we click outside, close the search.
    if ( hasClass( body, 'search-open' ) && isOutside ) {
      toggleSearch();
    }
  });
};

/**
 * The actual fuction.
 * Toggle Menu values.
 */
export const toggleSearch = () => {
  const body        = document.getElementsByTagName( 'body' )[0];
  const searchInput = document.querySelector( 'form.search-form input' );

  console.log( searchInput );

  if ( ! hasClass( body, 'search-open' ) ) {
    addClass( body, 'search-open' );
    setAriaHidden( 'search-form-container', 'false' );
    setTabIndex( searchInput, '0' );
    searchInput.focus();
  } else {
    removeClass( body, 'search-open' );
    setAriaHidden( 'search-form-container', 'true' );
    setTabIndex( searchInput, '-1' );
    searchInput.blur();
  }
};
