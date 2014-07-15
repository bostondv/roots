# [Roots Theme](http://roots.io/)

This is a custom fork of [Roots Theme](http://roots.io/) which uses SASS version of Bootstrap, Autoprefixer, Gulp and other modifications.

Roots is a WordPress starter theme based on [HTML5 Boilerplate](http://html5boilerplate.com/) & [Bootstrap](http://getbootstrap.com/) that will help you make better themes.

* Source: [https://github.com/bostondv/roots](https://github.com/bostondv/roots)
* Home Page: [http://roots.io/](http://roots.io/)
* Twitter: [@bostondv](https://twitter.com/bostondv)
* Newsletter: [Subscribe](http://roots.io/subscribe/)
* Forum: [http://discourse.roots.io/](http://discourse.roots.io/)

### Additional features

Install the [Soil](https://github.com/bostondv/soil) plugin to enable additional features:

* Root relative URLs
* Nice search (`/search/query/`)
* Cleaner output of `wp_head` and enqueued assets markup
* Image captions use `<figure>` and `<figcaption>`
* and more...

## Installation

Clone the git repo - `git clone git://github.com/bostondv/roots.git` - or [download it](https://github.com/bostondv/roots/zipball/master) and then rename the directory to the name of your theme or website. Install [npm](http://nodejs.org), [Bower](http://bower.io), and [Gulp](http://gulpjs.com/), then install the dependencies for Roots contained in `package.json` by running the following from the Roots theme directory:

```
npm install
```

Once Node dependencies are installed you need to [install Bower](http://bower.io/), then install it's dependencies with the following command.

```
bower install
```

**Note:** Gulp is configured to use the [Ruby version of Sass](https://github.com/sindresorhus/gulp-ruby-sass) which is more feature-rich but slower. To compile you'll need to have [Ruby](http://rubylang.org) and [Sass](http://sass-lang.com) installed as well.

Reference the [theme activation](http://roots.io/roots-101/#theme-activation) documentation to understand everything that happens once you activate Roots.

## Configuration

Edit `lib/config.php` to enable or disable support for various theme functions and to define constants that are used throughout the theme.

Edit `lib/init.php` to setup custom navigation menus and post thumbnail sizes.

Edit `lib/custom.php` to setup any custom functions and scripts.

Edit `config.json` to setup the staging and production deployment servers.

## Components

It is recommended to install any 3rd-party javascript or css libraries with Bower. Bower libraries are saved to the `components` directory.

Once a library is installed, include any necessary js files in the `gulpfile.js` build script and import any necessary scss files in your `src/main.scss`.

## Building

Gulp is used to build and deploy the theme source files, it runs a variety of functions including minification, css autoprefixing, imagemin, and more.

`gulp` - default task will build all files.

`gulp watch` - watches the css, js, and img directories for changes and builds automatically.

`gulp deploy` - deploys the theme to the destination server. Use `--target production` or `--target staging` to choose deployment target, this parameter can be omitted and will default to `staging`.

## WooCommerce

[Woocommerce](http://www.woothemes.com/woocommerce/) support in included in the theme by default. It extends default WooCommerce markup and styles to work with Roots and Bootstrap. If you do not need WooCommerce support, remove the theme support from `config.php` and `@import "base/woocommerce";` from `main.scss`. You can optionally also remove the woocommerce support files.

## Documentation

### [Roots Docs](http://roots.io/docs/)

* [Roots 101](http://roots.io/roots-101/) — A guide to installing Roots, the files and theme organization
* [Theme Wrapper](http://roots.io/an-introduction-to-the-roots-theme-wrapper/) — Learn all about the theme wrapper
* [Roots Sidebar](http://roots.io/the-roots-sidebar/) — Understand how to display or hide the sidebar in Roots

## Features

* Organized file and template structure
* HTML5 Boilerplate's markup along with ARIA roles and microformat
* Bootstrap
* [Theme activation](http://roots.io/roots-101/#theme-activation)
* [Theme wrapper](http://roots.io/an-introduction-to-the-roots-theme-wrapper/)
* Root relative URLs
* Cleaner HTML output of navigation menus
* Cleaner output of `wp_head` and enqueued scripts/styles
* Nice search (`/search/query/`)
* Image captions use `<figure>` and `<figcaption>`
* Posts use the [hNews](http://microformats.org/wiki/hnews) microformat
* [Multilingual ready](http://roots.io/wpml/) (Brazilian Portuguese, Bulgarian, Catalan, Danish, Dutch, English, Finnish, French, German, Hungarian, Indonesian, Italian, Korean, Macedonian, Norwegian, Polish, Russian, Simplified Chinese, Spanish, Swedish, Traditional Chinese, Turkish, Vietnamese, Serbian)

## Contributing

Everyone is welcome to help [contribute](CONTRIBUTING.md) and improve this project. There are several ways you can contribute:

* Reporting issues (please read [issue guidelines](https://github.com/necolas/issue-guidelines))
* Suggesting new features
* Writing or refactoring code
* Fixing [issues](https://github.com/roots/roots/issues)
* Replying to questions on the [forum](http://discourse.roots.io/)

## Support

Use the [Roots Discourse](http://discourse.roots.io/) to ask questions and get support.
