## Global Prerequisites

The following packages needs to be installed on your system in order to use Gesso for WordPress.

* [composer](https://getcomposer.org/)
* [npm](https://www.npmjs.com/get-npm)
* [grunt](https://gruntjs.com/getting-started)


## Timber Installation
In order to develop using this starter theme you must download and activate the [Timber Library](http://wordpress.org/plugins/timber-library/) plugin from WordPress.org.

Additional information about installing and configuring the Timber Library can be found in the [Timber Documentation](https://timber.github.io/docs/getting-started/setup)

## Pattern Lab installation 

The included Grunt tasks look for an instance of the Drupal standard edition of
Pattern Lab and [the Gesso Twig starter kit](https://github.com/forumone/starterkit-twig-drupal-gesso)
in a subdirectory of the theme called `pattern-lab`.  The Grunt build task will
skip building Pattern Lab if this directory is not found.

To install Pattern Lab, run the following Composer command in
the theme directory.

```
$ composer create-project pattern-lab/edition-drupal-standard pattern-lab
```

When prompted, select `/forumone/starterkit-twig-drupal-gesso as the starterkit`.

If prompted, select '`r`' to overwrite existing `/source/` files.


## Compiling Pattern Lab and Sass

[LibSass](http://sass-lang.com/libsass) is required to compile the Sass into
CSS. Gesso includes Grunt tasks to compile the CSS and generate the compiled Pattern Lab files (if included) and to watch both for changes.  To use these tasks, first run the following NPM command in the theme folder (Windows users may need to include the --no-bin-links flag at the end of the command).

```
npm install
```

Once the above command is run, the `_starter-kit` folder that comes with Gesso will be renamed to `pattern-lab/source`. This directory contains all of the Pattern Lab Twig templates and Sass files.

To initiate the Grunt build tasks that compile the Sass and Pattern Lab files, run the following command in the theme directory:

```
grunt
```

## Creating New Components

Gesso includes a script to generate new component files. To use, run the following command in the theme folder.

```
node component
```

## Build Artifacts

By default, the compiled Pattern Lab and Sass files (e.g., `/pattern-lab/public/`
and `/css/`) are ignored by Git as these files are built during deployment.
To change this, edit the included `.gitignore` file.


## Sass/Grunt dependencies

* [Breakpoint](http://breakpoint-sass.com): Easy to write media queries.

* [Sass](http://sass-lang.com): CSS on steroids. Adds nested rules, variables,
mixins, selector inheritance, and more.

* [Sass Globbing](https://github.com/DennisBecker/grunt-sass-globbing): Adds glob-
based imports to Sass.

* [SVG2PNG](https://github.com/dbushell/grunt-svg2png): Rasterizes SVG to PNG images using PhantomJS.

* [Autoprefixer](https://github.com/postcss/autoprefixer): Adds necessary browser CSS property prefixes during Sass compilation.
