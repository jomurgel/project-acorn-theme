import { initMenu } from './util/menu';
import { initSearch } from './util/search';

/**
 * Init Menu JS.
 * Prevent the function to run before the document is loaded
 */
document.addEventListener( 'readystatechange', () => {
  if ( 'complete' === document.readyState ) {
    initMenu();
    initSearch();
  }
} );
