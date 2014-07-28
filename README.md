# [Roots Theme](http://roots.io/)

**This is a custom fork of [Roots Theme](http://roots.io/) which uses SASS version of Bootstrap, Autoprefixer, Gulp and other modifications.**

Roots is a WordPress starter theme based on [HTML5 Boilerplate](http://html5boilerplate.com/) & [Bootstrap](http://getbootstrap.com/) that will help you make better themes.

* Source: [https://github.com/bostondv/roots](https://github.com/bostondv/roots)
* Home Page: [http://roots.io/](http://roots.io/)
* Twitter: [@bostondv](https://twitter.com/bostondv)
* Newsletter: [Subscribe](http://roots.io/subscribe/)
* Forum: [http://discourse.roots.io/](http://discourse.roots.io/)

## Features

* [Gulp](http://gulpjs.com) for compiling the SCSS and JS, Autoprefixing CSS, checking for JS errors,concatenating and minifying files, and deploying theme files to staging and production servers.
* [Bower](http://bower.io/) for front-end package management
* [HTML5 Boilerplate](http://html5boilerplate.com/)
* An optimized Google Analytics snippet
* [Bootstrap](http://getbootstrap.com/)
* Organized file and template structure
* ARIA roles and microformats
* [Theme activation](http://roots.io/roots-101/#theme-activation)
* [Theme wrapper](http://roots.io/an-introduction-to-the-roots-theme-wrapper/)
* Cleaner HTML output of navigation menus
* Posts use the [hNews](http://microformats.org/wiki/hnews) microformat
* [Multilingual ready](http://roots.io/wpml/) and over 30 available [community translations](https://github.com/roots/roots-translations)

## Installation

Clone the git repo - `git clone git://github.com/bostondv/roots.git` - or [download it](https://github.com/bostondv/roots/zipball/master) and then rename the directory to the name of your theme or website. 

If you don't use [Bedrock](https://github.com/roots/bedrock), you'll need to add the following to your `wp-config.php` on your development installation:

```php
define('WP_ENV', 'development');
```

## Theme activation

Reference the [theme activation](http://roots.io/roots-101/#theme-activation) documentation to understand everything that happens once you activate Roots.

## Configuration

Edit `lib/config.php` to enable or disable theme features and to define a Google Analytics ID.

Edit `lib/init.php` to setup navigation menus, post thumbnail sizes, post formats, and sidebars.

Edit `config.json` to setup the staging and production deployment servers.

## Theme development

Roots uses [Gulp](http://gulpjs.com/) for compiling the SCSS and JS, Autoprefixing CSS, checking for JS errors,concatenating and minifying files, and deploying theme files to staging and production servers.

### Install Gulp

**Unfamiliar with npm? Don't have node installed?** [Download and install node.js](http://nodejs.org/download/) before proceeding.

**Ruby Sass:** Gulp is configured to use the [Ruby version of Sass](https://github.com/sindresorhus/gulp-ruby-sass). You'll need to have [Ruby](http://rubylang.org) and [Sass](http://sass-lang.com) installed.

**Bower:** It is recommended you install [Bower](http://bower.io) globally with `npm install -g bower` so you can run it from the command line.

From the command line:

1. Install `gulp` globally with `npm install -g gulp`.
2. Navigate to the theme directory, then run `npm install`. npm will look at `package.json` and automatically install the necessary dependencies. It will also automatically run `bower install`, which installs front-end packages defined in `bower.json`.

When completed, you'll be able to run the various Gulp commands provided from the command line.

### Available Gulp commands

* `gulp` — Compile SCSS and JS, validate JS, concatenate and minify SCSS, JS and images
* `gulp watch` — Compile assets when file changes are made
* `gulp deploy [--target=staging|production]` — Build and deploy all theme files to a staging or production server (defaults to staging)
* `gulp clearCache` — Clears gulp cache

## Additional features

### Soil

Install the [Soil](https://github.com/bostondv/soil) plugin to enable additional features:

* Root relative URLs
* Nice search (`/search/query/`)
* Cleaner output of `wp_head` and enqueued assets markup
* Image captions use `<figure>` and `<figcaption>`
* and more...

### Recommended plugins

These are plugins we recommend and use on most projects alongside Roots theme. They are completely optional and Roots will work with or without them. Roots theme specifically inlcudes some special support for WordPress SEO, Gravity Forms, WooCommerce and AffiliateWP.

* [Soil](https://github.com/bostondv/soil)
* [Wordpress SEO](https://wordpress.org/plugins/wordpress-seo/)
* [Bootstrap 3 Shortcodes](https://wordpress.org/plugins/bootstrap-3-shortcodes/)
* [Font Awesome Shortcodes](https://wordpress.org/plugins/font-awesome-shortcodes/)
* [Simple Page Ordering](https://wordpress.org/plugins/simple-page-ordering/)
* [Enhanced Text Widget](https://wordpress.org/plugins/enhanced-text-widget/)
* [Gravity Forms](http://gravityforms.com)
* [WooCommerce](http://wordpress.org/plugins/woocommerce/)
* [Wordfence](http://wordpress.org/plugins/wordfence/)
* [AffiliateWP](https://github.com/affiliatewp/AffiliateWP)

### WooCommerce

[Woocommerce](http://www.woothemes.com/woocommerce/) support in included in the theme by default. It extends default WooCommerce markup and styles to work with Roots and Bootstrap. If you do not need WooCommerce support, remove the include from `functions.php` and the `@import` from `main.scss`. You can optionally also remove the woocommerce support files.

## Documentation

* [Roots 101](http://roots.io/roots-101/) — A guide to installing Roots, the files, and theme organization
* [Theme Wrapper](http://roots.io/an-introduction-to-the-roots-theme-wrapper/) — Learn all about the theme wrapper
* [Build Script](http://roots.io/using-grunt-for-wordpress-theme-development/) — A look into how Roots uses Grunt
* [Roots Sidebar](http://roots.io/the-roots-sidebar/) — Understand how to display or hide the sidebar in Roots

## Contributing

Everyone is welcome to help [contribute](CONTRIBUTING.md) and improve this project. There are several ways you can contribute:

* Reporting issues (please read [issue guidelines](https://github.com/necolas/issue-guidelines))
* Suggesting new features
* Writing or refactoring code
* Fixing [issues](https://github.com/roots/roots/issues)
* Replying to questions on the [forum](http://discourse.roots.io/)

## Support

Use the [Roots Discourse](http://discourse.roots.io/) to ask questions and get support.
