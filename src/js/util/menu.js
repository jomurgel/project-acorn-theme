import {
  hasClass,
  addClass,
  removeClass,
  setAriaHidden,
  setTabIndex } from './helpers';

/**
 * Add event from js the keep the marup clean
 */
export const initMenu = () => {
  const body       = document.getElementsByTagName( 'body' )[0];
  const menuToggle = document.getElementById( 'menu-toggle' );
  const menu       = document.getElementById( 'primary' );

  // Return if no menu exists.
  if ( null === menu ) {
    return;
  }

  const menuLinks  = document.getElementById( 'primary' ).getElementsByTagName( 'a' );

  if ( hasClass( body, 'nav-is-visible' ) ) {
    setTabIndex( menuLinks, '0' );
  } else {
    setTabIndex( menuLinks, '-1' );
  }

  // Handle menu toggle button.
  menuToggle.addEventListener( 'click', toggleMenu );

  // Handle keyboard escape.
  document.addEventListener( 'keydown', ( event ) => {

    // If the menu is open and we hit escape, close the menu.
    if ( hasClass( body, 'menu-open' ) && 'Escape' === event.key ) {
      toggleMenu();
    }
  } );

  // Handle click events.
  document.addEventListener( 'click', ( event ) => {
    let isOutside = ! menu.contains( event.target ) && ! menuToggle.contains( event.target );

    // If the menu is open and we click outside, close the menu.
    if ( hasClass( body, 'menu-open' ) && isOutside ) {
      toggleMenu();
    }
  });
};

/**
 * The actual fuction.
 * Toggle Menu values.
 */
export const toggleMenu = () => {
  const body      = document.getElementsByTagName( 'body' )[0];
  const menuLinks = document.getElementById( 'primary' ).getElementsByTagName( 'a' );

  if ( ! hasClass( body, 'menu-open' ) ) {
    addClass( body, 'menu-open' );
    setAriaHidden( 'primary', 'false' );
    setTabIndex( menuLinks, '0' );
  } else {
    removeClass( body, 'menu-open' );
    setAriaHidden( 'primary', 'true' );
    setTabIndex( menuLinks, '-1' );
  }
};