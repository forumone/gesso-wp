# Gesso for Wordpress (w/ Timber)

### Gesso
Gesso is a [Sass](http://sass-lang.com/)-based starter theme that outputs
accessible HTML5 markup. It uses a mobile-first responsive approach and
leverages [SMACSS](https://smacss.com/) for style organization. This
encourages a component-based approach to theming through the creation of
discrete, reusable UI elements.

### Timber
[Timber](https://upstatement.com/timber/) helps you create fully-customized WordPress themes faster with more sustainable code. With Timber, you write your HTML using the [Twig Template Engine](http://twig.sensiolabs.org/doc/templates.html) separate from your PHP files. This cleans-up your theme code so your PHP file can focus on supplying the data and logic, while your twig file can focus 100% on the display and HTML.

# Getting Started

### Timber Installation
In order to use this theme you must download and activate the [Timber Library](http://wordpress.org/plugins/timber-library/) plugin from Wordpress.org.

Additional information about installing and configuring the Timber Library can be found in the [Timber Documentation](http://timber.github.io/timber/#installation)

### Pattern Lab installation

The included Grunt tasks look for an instance of the Drupal standard edition of
Pattern Lab and [the Gesso Twig starter kit](https://github.com/forumone/starterkit-twig-drupal-gesso)
in a subdirectory of the theme called 'pattern-lab'.  The Grunt build task will
skip building Pattern Lab if this directory is not found.

To install Pattern Lab, run the following Composer command in
the theme directory.

```
$ composer create-project pattern-lab/edition-drupal-standard pattern-lab
```

When prompted, select /forumone/starterkit-twig-drupal-gesso as the starterkit.

If prompted, select 'r' to overwrite existing /source/ files.


### Compiling Sass

[LibSass](http://sass-lang.com/libsass) is required to compile the Sass into
CSS. Gesso includes Grunt tasks to compile the CSS/Pattern Lab files and to
watch them for changes.  To use these tasks, run the following NPM command in
the theme folder (Windows users may need to include the `--no-bin-links` flag at
the end of the command).

```
npm install
```

To run the Grunt build task, run

```
grunt
```


### Build Artifacts

By default, the compiled Pattern Lab and Sass files (e.g., /pattern-lab/public/
and /css/) are ignored by Git as these files are built during deployment.
To change this, edit the included .gitignore file.


### Sass/Grunt dependencies

* [Breakpoint](http://breakpoint-sass.com): Easy to write media queries.

* [Sass](http://sass-lang.com): CSS on steroids. Adds nested rules, variables,
mixins, selector inheritance, and more.

* [Sass Globbing](https://github.com/DennisBecker/grunt-sass-globbing): Adds glob-
based imports to Sass.

* [SVG2PNG](https://github.com/dbushell/grunt-svg2png): Rasterizes SVG to PNG images using PhantomJS.

* [Autoprefixer](https://github.com/postcss/autoprefixer): Adds necessary browser CSS property prefixes during Sass compilation.


## Maintainers

The Gesso theme is maintained by Dan Mouyard, Corey Lafferty, Lindsey DiNapoli, Derek Moon, Karen Kitchens and Elvis Morales.

Please use the Github issue queue: https://github.com/forumone/gesso-wp/issues
