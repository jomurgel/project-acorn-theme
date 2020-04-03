<img src="https://user-images.githubusercontent.com/5230729/33617107-17ebf23c-d99c-11e7-8aa6-ec559bd23027.png" alt="project acorn" title="project acorn" />

# Project Acorn Theme [![Build Status](https://travis-ci.org/jomurgel/project-acorn-theme.svg?branch=master)](https://travis-ci.org/jomurgel/project-acorn-theme) [![License: GPL v2](https://img.shields.io/badge/License-GPL%20v2-blue.svg)](https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html)
<img src="https://img.shields.io/badge/version-1.0.1-green.svg" alt="Version 1.1.0" />

An optinionated theme for [WordPress](https://wordpress.org).

**Requires at least:** 4.0\
**Tested up to:** 5.4\
**Stable tag:** 1.1.1

## Welcome
This theme was built as a launching point for discussion around what is necessary for the web, how we can improve basic functionality of a WordPress theme, and how we can potentially improve performance all around with some modification of how we approach our script and styles.

![b4709e62-d4e8-4a2c-9099-7e79fc2c3a1e](https://user-images.githubusercontent.com/5230729/52818012-c7e34780-3062-11e9-8830-dc4a4514d40c.png)

## Description
### Features
I've built an opinionated WordPress theme with the following features:
- Function namespacing.
- Compiling with WebPack.
- Section-specific SCSS (below) and normalization with [Sanitize](https://gist.github.com/jomurgel/88084c6f3c10de5e47a9238087508e63) and linting with [Stylelint](https://stylelint.io/user-guide/configuration/#configuration).
- Vanilla JavaScript with [ESLint](https://eslint.org/docs/user-guide/configuring).
- SVG support.
- Write all styles in PX, and handle the proper unit conversions after the fact with [PostCSS Unit Conversion](https://github.com/jomurgel/postcss-unit-conversion).
- WordPress Blocks styles support.
- Accessible Off-canvas or Inline menu navigation.
- Accessible global full-page search.

### Opinionated Elements
These are all the basics, but what makes it more opinionated are the following key features.
- IE11 is not supported. I didn't go out of my way to avoid IE11, but I did not build it with IE11 support in mind. It's about time we give up on trying to accomodate an older, outdated, and potentially unsecure browser.
- SVGs are controlled inline via the [inc/social-icons.php](https://github.com/jomurgel/project-acorn-theme/blob/master/inc/social-icons.php) file. No need to worry about an external or inlined svg file.
- The [inc/scripts.php](https://github.com/jomurgel/project-acorn-theme/blob/master/inc/scripts.php) file enqueues scripts and styles based on the location desired. No longer needing to load everything on every page all the time. Entrypoints handled in the [webpack.config.js](https://github.com/jomurgel/project-acorn-theme/blob/master/webpack.config.js) file. Only load what you need for that page, both styles and javascript.
- Nesting depth of the navigations are limited to 1. No more dropdowns. I believe that if your data architecture is properly considered, you won't need it. This helps us be a little bit more a thoughtful with our pages.
- Removes widget support. Widgets feel like a crutch over adding content programatically. Should you desire to add this feature back, you can do so with [this function](https://gist.github.com/jomurgel/35ca88ab71fdc3f1431cc9f16bef7277).
- I've removed the dependency on [jQuery](https://jquery.com/) unless it's required by WordPress to function (when the admin bar is present).

### Theme Options
In customizer there are two features available.
- Show/hide the search functionality.
- Show/hide inline-navigation. The default is inside the off-canvas drawer.

### Default Menus
- **Primary** Will display in the off-canvas drawer or inline based on the Customizer setting.
- **Social** Displays in the footer. Requires that the link name match one of the following supported icons: Facebook, Github, Twitter, Dribbble, Instagram, Youtube, Vimeo, Tumblr, Pinterest, Vk, Skype, Snapchat, LinkedIn, Github, Slack, Email.

![screenshot 2019-02-14 14 14 45](https://user-images.githubusercontent.com/5230729/52818144-26a8c100-3063-11e9-963b-c1fe38d2c674.jpg)

#### Adding new icons.
Adding new icons can be done by hooking into the `social_icons` filter. You can get that code here [social_icons gist](https://gist.github.com/jomurgel/ddf5a916ab8ac61cf880268dc28f9271).

``` php
/**
 * Add custom icon to social media support.
 *
 * @param array $social_icons array of social icons.
 * @return array new social icons array.
 */
function add_social_icon( $social_icons ) {

  $custom_icons = array(
      'apple' => '<svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 384.1" xml:space="preserve"><title>' . __( 'Apple', 'acorn-theme' ) . '</title><path d="M237.6,89.9c-33.6,0-47.8,16.5-71.2,16.5c-24,0-42.3-16.4-71.4-16.4c-28.5,0-58.9,17.9-78.2,48.4c-27.1,43-22.5,124,21.4,193c15.7,24.7,36.7,52.4,64.2,52.7c0.2,0,0.3,0,0.5,0c23.9,0,31-16.1,63.9-16.3c0.2,0,0.3,0,0.5,0c32.4,0,38.9,16.2,62.7,16.2c0.2,0,0.3,0,0.5,0c27.5-0.3,49.6-31,65.3-55.6c11.3-17.7,15.5-26.6,24.2-46.6c-63.5-24.8-73.7-117.4-10.9-152.9C289.9,104.2,263,89.9,237.6,89.9L237.6,89.9z M230.2,0c-20,1.4-43.3,14.5-57,31.6c-12.4,15.5-22.6,38.5-18.6,60.8c0.5,0,1,0,1.6,0c21.3,0,43.1-13.2,55.8-30.1C224.3,46.2,233.6,23.4,230.2,0L230.2,0z"/></svg>',
  );

  return wp_parse_args( $custom_icons, $social_icons );
}
add_filter( 'social_icons', __NAMESPACE__ . '\add_social_icon', 10, 1 );
```

## Getting Started
Clone the repo into your `themes` directory.
``` bash
$ git clone git@github.com:jomurgel/project-acorn-theme.git acorn-theme
```
Drill down into the new theme and install all the dependencies.
``` bash
$ cd acorn-theme
$ npm install
```
If you're using [VSCode](https://code.visualstudio.com/) I might also suggest a Workspace settings that look like this:
``` json
{
	// The name or path of the coding standard to use. Defaults to the one set in phpcs global config.
	"phpcs.standard": "WordPress",

	"phpcbf.standard": "WordPress",

	"sasslint.enable": false,

	// ESLint Configuration.
	"eslint.options"     : {
		"configFile": "../.eslintrc"
	},
}
```

### Using Acorn Theme as your own starter theme
At this time, if you want to use the `Acorn Theme` as a starter theme, you'll want to replace all occurances of the following with your theme name throughout:

1. Search for `ACORN_` to capture the theme constants.
1. Search for `'acorn-theme'` to replace the text domain.
1. Search for `"acorn-theme"` to replace the PHPCS text domain.
1. Search for `acorn_theme_` tto replace the all the function names.
1. Search for `Text Domain: acorn-theme` in style.css.
1. Search for ` acorn-theme` to replace the DocBlocks.
1. Search for `acorn-theme-` to replace the prefixed handles.

### NPM
Out of the box there are several scripts that can be used for development and production to make your life a little easier.

Build all files for production as well as your `.pot` file:
``` bash
$ npm run build
```

Dev mode. Browsersync hot reloading and unminified scripts and styles:
``` bash
$ npm run watch
```

Just want to lint your Scss and JavaScript? No problem:
``` bash
$ npm run lint
```

You can fix those problems with:
``` bash
$ npm run lint:fix
```

And handle all of that language `.pot` (ﾉ◕ヮ◕)ﾉ*:･ﾟ✧  by itself:
``` bash
$ npm run wp-pot
```

## Roadmap
- Add Theme Hooks.
- Add E2E Testing.
- Inline PHP SVG optimization.
- Automated prefix/namespace/text domain replacement.

## Changelog
### 1.0.0
- Initial Release
### 1.0.1
- Bugfixes
### 1.1.0
- Updates namespacing
- Adds grid units to stylint whitelist
- Updates editor styles for WP 5.4
- Updates readme
- Addresses vulnerabilities in dependencies