/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 7);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./src/js/global.js":
/*!**************************!*\
  !*** ./src/js/global.js ***!
  \**************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _util_menu__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./util/menu */ "./src/js/util/menu.js");
/* harmony import */ var _util_search__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./util/search */ "./src/js/util/search.js");


/**
 * Init Menu JS.
 * Prevent the function to run before the document is loaded
 */

document.addEventListener('readystatechange', function () {
  if ('complete' === document.readyState) {
    Object(_util_menu__WEBPACK_IMPORTED_MODULE_0__["initMenu"])();
    Object(_util_search__WEBPACK_IMPORTED_MODULE_1__["initSearch"])();
  }
});

/***/ }),

/***/ "./src/js/single.js":
/*!**************************!*\
  !*** ./src/js/single.js ***!
  \**************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _global__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./global */ "./src/js/global.js");
/**
 * This is the partial for our single posts.
 */

/**
 * Import our global elements.
 */


/***/ }),

/***/ "./src/js/util/helpers.js":
/*!********************************!*\
  !*** ./src/js/util/helpers.js ***!
  \********************************/
/*! exports provided: hasClass, addClass, removeClass, setAriaHidden, setTabIndex */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "hasClass", function() { return hasClass; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "addClass", function() { return addClass; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "removeClass", function() { return removeClass; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "setAriaHidden", function() { return setAriaHidden; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "setTabIndex", function() { return setTabIndex; });
/**
 * Vanilla JS hasClass Handler.
 *
 * @exports const hasClass.
 * @param {object} element elementment target.
 * @param {string} selectorClass classname.
 * @returns {bool} if has class.
 */
var hasClass = function hasClass(element, selectorClass) {
  return !!element.className.match(new RegExp('(\\s|^)' + selectorClass + '(\\s|$)'));
};
/**
 * Vanilla JS addClass Handler.
 *
 * @exports const addClass.
 * @param {object} element elementment target.
 * @param {string} selectorClass classname.
 * @returns null
 */

var addClass = function addClass(element, selectorClass) {
  if (!hasClass(element, selectorClass)) {
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

var removeClass = function removeClass(element, selectorClass) {
  if (hasClass(element, selectorClass)) {
    var reg = new RegExp('(\\s|^)' + selectorClass + '(\\s|$)');
    element.className = element.className.replace(reg, ' ');
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

var setAriaHidden = function setAriaHidden(id, value) {
  document.getElementById(id).setAttribute('aria-hidden', value);
};
/**
 * Change/Set tabindex for menu links.
 *
 * @param {array} links links.
 * @param {string} value -1, 0, or 1+.
 */

var setTabIndex = function setTabIndex(links, value) {
  for (var i = 0; i < links.length; i++) {
    var link = links[i];
    link.setAttribute('tabindex', value);
  }

  ;
};

/***/ }),

/***/ "./src/js/util/menu.js":
/*!*****************************!*\
  !*** ./src/js/util/menu.js ***!
  \*****************************/
/*! exports provided: initMenu, toggleMenu */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "initMenu", function() { return initMenu; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "toggleMenu", function() { return toggleMenu; });
/* harmony import */ var _helpers__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./helpers */ "./src/js/util/helpers.js");

/**
 * Add event from js the keep the marup clean
 */

var initMenu = function initMenu() {
  var body = document.getElementsByTagName('body')[0];
  var menuToggle = document.getElementById('menu-toggle');
  var menu = document.getElementById('primary');
  var menuLinks = document.getElementById('primary').getElementsByTagName('a');
  Object(_helpers__WEBPACK_IMPORTED_MODULE_0__["setTabIndex"])(menuLinks, '-1'); // Handle menu toggle button.

  menuToggle.addEventListener('click', toggleMenu); // Handle keyboard escape.

  document.addEventListener('keydown', function (event) {
    // If the menu is open and we hit escape, close the menu.
    if (Object(_helpers__WEBPACK_IMPORTED_MODULE_0__["hasClass"])(body, 'menu-open') && 'Escape' === event.key) {
      toggleMenu();
    }
  }); // Handle click events.

  document.addEventListener('click', function (event) {
    var isOutside = !menu.contains(event.target) && !menuToggle.contains(event.target); // If the menu is open and we click outside, close the menu.

    if (Object(_helpers__WEBPACK_IMPORTED_MODULE_0__["hasClass"])(body, 'menu-open') && isOutside) {
      toggleMenu();
    }
  });
};
/**
 * The actual fuction.
 * Toggle Menu values.
 */

var toggleMenu = function toggleMenu() {
  var body = document.getElementsByTagName('body')[0];
  var menuLinks = document.getElementById('primary').getElementsByTagName('a');

  if (!Object(_helpers__WEBPACK_IMPORTED_MODULE_0__["hasClass"])(body, 'menu-open')) {
    Object(_helpers__WEBPACK_IMPORTED_MODULE_0__["addClass"])(body, 'menu-open');
    Object(_helpers__WEBPACK_IMPORTED_MODULE_0__["setAriaHidden"])('primary', 'false');
    Object(_helpers__WEBPACK_IMPORTED_MODULE_0__["setTabIndex"])(menuLinks, '0');
  } else {
    Object(_helpers__WEBPACK_IMPORTED_MODULE_0__["removeClass"])(body, 'menu-open');
    Object(_helpers__WEBPACK_IMPORTED_MODULE_0__["setAriaHidden"])('primary', 'true');
    Object(_helpers__WEBPACK_IMPORTED_MODULE_0__["setTabIndex"])(menuLinks, '-1');
  }
};

/***/ }),

/***/ "./src/js/util/search.js":
/*!*******************************!*\
  !*** ./src/js/util/search.js ***!
  \*******************************/
/*! exports provided: initSearch, toggleSearch */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "initSearch", function() { return initSearch; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "toggleSearch", function() { return toggleSearch; });
/* harmony import */ var _helpers__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./helpers */ "./src/js/util/helpers.js");

/**
 * Add event from js the keep the marup clean
 */

var initSearch = function initSearch() {
  var searchToggle = document.getElementById('search-toggle');

  if (null === searchToggle) {
    return;
  }

  var body = document.getElementsByTagName('body')[0];
  var search = document.getElementById('search-form-container'); // Handle search toggle button.

  searchToggle.addEventListener('click', toggleSearch); // Handle keyboard escape.

  document.addEventListener('keydown', function (event) {
    // If the search is open and we hit escape, close the search.
    if (Object(_helpers__WEBPACK_IMPORTED_MODULE_0__["hasClass"])(body, 'search-open') && 'Escape' === event.key) {
      toggleSearch();
    }
  }); // Handle click events.

  document.addEventListener('click', function (event) {
    var isOutside = !search.contains(event.target) && !searchToggle.contains(event.target); // If the search is open and we click outside, close the search.

    if (Object(_helpers__WEBPACK_IMPORTED_MODULE_0__["hasClass"])(body, 'search-open') && isOutside) {
      toggleSearch();
    }
  });
};
/**
 * The actual fuction.
 * Toggle Menu values.
 */

var toggleSearch = function toggleSearch() {
  var body = document.getElementsByTagName('body')[0];
  var searchInput = document.querySelector('form.search-form input');
  console.log(searchInput);

  if (!Object(_helpers__WEBPACK_IMPORTED_MODULE_0__["hasClass"])(body, 'search-open')) {
    Object(_helpers__WEBPACK_IMPORTED_MODULE_0__["addClass"])(body, 'search-open');
    Object(_helpers__WEBPACK_IMPORTED_MODULE_0__["setAriaHidden"])('search-form-container', 'false');
    Object(_helpers__WEBPACK_IMPORTED_MODULE_0__["setTabIndex"])(searchInput, '0');
    searchInput.focus();
  } else {
    Object(_helpers__WEBPACK_IMPORTED_MODULE_0__["removeClass"])(body, 'search-open');
    Object(_helpers__WEBPACK_IMPORTED_MODULE_0__["setAriaHidden"])('search-form-container', 'true');
    Object(_helpers__WEBPACK_IMPORTED_MODULE_0__["setTabIndex"])(searchInput, '-1');
    searchInput.blur();
  }
};

/***/ }),

/***/ "./src/scss/single.scss":
/*!******************************!*\
  !*** ./src/scss/single.scss ***!
  \******************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

// extracted by mini-css-extract-plugin

/***/ }),

/***/ 7:
/*!*******************************************************!*\
  !*** multi ./src/js/single.js ./src/scss/single.scss ***!
  \*******************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! ./src/js/single.js */"./src/js/single.js");
module.exports = __webpack_require__(/*! ./src/scss/single.scss */"./src/scss/single.scss");


/***/ })

/******/ });
//# sourceMappingURL=single.js.map