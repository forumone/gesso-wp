# Gesso for WordPress (w/ Timber)

Gesso is a [Sass](http://sass-lang.com/)-based starter theme that outputs
accessible HTML5 markup. It uses a mobile-first responsive approach and
leverages [SMACSS](https://smacss.com/) for style organization. This
encourages a component-based approach to theming through the creation of
discrete, reusable UI elements. Gesso is heavily integrated with
[Pattern Lab](http://patternlab.io/), allowing WordPress and Pattern Lab
to share the same markup.

For more information, view the
[Gesso WordPress GitHub repo](https://github.com/forumone/gesso-wp).
To submit bug reports or feature requests, visit the
[Gesso WordPress issue queue](https://github.com/forumone/gesso-wp/issues).

### Global Prerequisites
The following packages need to be installed on your system in order to use
Gesso WordPress.

- [composer](https://getcomposer.org)
- [npm](https://www.npmjs.com/get-npm)
- [grunt](https://gruntjs.com/getting-started)

### Timber
[Timber](https://upstatement.com/timber/) helps you create fully-customized
WordPress themes faster with more sustainable code. With Timber, you write
your HTML using the
[Twig Template Engine](http://twig.sensiolabs.org/doc/templates.html) separate
from your PHP files. This cleans-up your theme code so your PHP file can focus
on supplying the data and logic, while your twig file can focus 100% on the
display and HTML.

# Getting Started

### Timber Installation
In order to use this theme you must download and activate the
[Timber Library](http://wordpress.org/plugins/timber-library/) plugin from
Wordpress.org.

Additional information about installing and configuring the Timber Library can
be found in the
[Timber Documentation](http://timber.github.io/timber/#installation)

### Compiling Pattern Lab and Sass

[LibSass](http://sass-lang.com/libsass) is required to compile the Sass into
CSS. Gesso includes Grunt tasks to compile the CSS and generate the compiled
Pattern Lab files and to watch both for changes. To use these tasks, first run
the following NPM command in the theme folder (Windows users may need to
include the `--no-bin-links` flag at the end of the command).

```
npm install
```

Once the above command is run, the _starter-kit folder that comes with Gesso
will be renamed to pattern-lab/source. This directory contains all of the
Pattern Lab Twig templates and Sass files.

To initiate the Grunt build tasks that compile the Sass and Pattern Lab files,
run the following command in the theme directory:

```
grunt
```


### Creating New Components

Gesso includes a script to generate new component files. To use, run
the following command in the theme folder.

```
node component
```


### Build Artifacts

By default, the compiled Pattern Lab and Sass files (e.g., /pattern-lab/public/
and /css/) are ignored by Git as these files are built during deployment.
To change this, edit the included .gitignore file.


### Sass/Grunt dependencies

* [Breakpoint](http://breakpoint-sass.com): Easy to write media queries.

* [Sass](http://sass-lang.com): CSS on steroids. Adds nested rules, variables,
mixins, selector inheritance, and more.

* [Sass Globbing](https://github.com/DennisBecker/grunt-sass-globbing): Adds
glob-based imports to Sass.

* [Autoprefixer](https://github.com/postcss/autoprefixer): Adds necessary
browser CSS property prefixes during Sass compilation.


## Maintainers

The Gesso theme for WordPress is maintained by [Corey Lafferty](https://github.com/coreylafferty), [Lindsey DiNapoli](https://github.com/cssgirl), [Karen Kitchens](https://github.com/karenkitchens) and [Elvis Morales](https://github.com/elvismdev).

Please use the Github issue queue: https://github.com/forumone/gesso-wp/issues
