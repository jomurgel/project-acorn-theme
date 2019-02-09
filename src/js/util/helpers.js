/**
 * Vanilla JS hasClass Handler.
 *
 * @exports const hasClass.
 * @param {object} element elementment target.
 * @param {string} selectorClass classname.
 * @returns {bool} if has class.
 */
export const hasClass = ( element, selectorClass ) => {
  return !! element.className.match( new RegExp( '(\\s|^)' + selectorClass + '(\\s|$)' ) );
};

/**
 * Vanilla JS addClass Handler.
 *
 * @exports const addClass.
 * @param {object} element elementment target.
 * @param {string} selectorClass classname.
 * @returns null
 */
export const addClass = ( element, selectorClass ) => {
  if ( ! hasClass( element, selectorClass ) ) {
    element.className += ' ' + selectorClass;
  }
};

/**
 * Vanilla JS removeClass Handler.
 *
 * @exports const removeClass.
 * @param {object} element elementment target.
 * @param {string} selectorClass classname.
 * @returns null
 */
export const removeClass = ( element, selectorClass ) => {

  if ( hasClass( element, selectorClass ) ) {
    let reg = new RegExp( '(\\s|^)' + selectorClass + '(\\s|$)' );

    element.className = element.className.replace( reg, ' ' );
  }
};

/**
 * Set value of attribute.
 *
 * @exports const setAriaHidden.
 * @param {string} id elementment target.
 * @param {string} value true or false string.
 * @returns null
 */
export const setAriaHidden = ( id, value ) => {
  document.getElementById( id ).setAttribute( 'aria-hidden', value );
};

/**
 * Change/Set tabindex for menu links.
 *
 * @param {array} links links.
 * @param {string} value -1, 0, or 1+.
 */
export const setTabIndex = ( links, value ) => {

  for( let i = 0; i < links.length; i++ ) {
    let link = links[i];

    link.setAttribute( 'tabindex', value );
  };
};

