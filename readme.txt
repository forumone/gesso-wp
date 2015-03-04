# What's Gesso?

Gesso (pronounced JEH-so) is a Sass-based starter theme that outputs accessible HTML5 markup. It uses a mobile-first responsive approach and leverages SMACSS to organize styles. This encourages a component-based approach to theming through the creation of discrete, reusable UI elements.

Gesso is an art term for the white paint mixture used to prepare a canvas or sculpture for painting. Likewise, the Gesso theme prepares WordPress' markup and styles for a clean starting point.

## What's in Gesso?
Gesso provides all necessary starting files for building your accessible custom theme. This theme was built with theme developers in mind and not meant to be used out of the box. 

---

# Getting Started

## Sass

[Sass](http://sass-lang.com/) is a scripting language that gets compiled into
CSS. This theme uses the SCSS syntax, so any valid CSS you write is also valid
SCSS. [Variables](http://sass-lang.com/documentation/file.SASS_REFERENCE.html#variables_),
[Nesting](http://sass-lang.com/documentation/file.SASS_REFERENCE.html#css_extensions),
and [Mixins](http://sass-lang.com/documentation/file.SASS_REFERENCE.html#mixins)
are just a few of Sass’s powerful features.


## Ruby

[Ruby](https://www.ruby-lang.org/en/) is required to compile Sass into CSS.
Check out the [installation instructions](https://www.ruby-lang.org/en/installation/)
for getting Ruby up and running on your system.


## Compass

This theme uses [Compass](http://compass-style.org/) for its powerful framework
features and for compiling Sass into CSS. Once you have Ruby installed, install
the required gems from the command line:

```
$ gem update --system
$ gem install compass
```

Additional libraries can be installed in the same way:

```
$ gem install breakpoint
$ gem install singularitygs
$ gem install sass-globbing
```

Executing the following command within your theme directory will constantly
watch for any change in your Sass files and re-compile them into CSS:

```
$ compass watch
```

You can also clear and recompile your CSS manually:

```
$ compass clean
$ compass compile
```

You can control various options for how Compass compiles Sass by editing
config.rb in your theme’s root directory.


## Bundler

If multiple people compile Sass into CSS on your project, then it’s a good idea
to use [Bundler](http://bundler.io) to make sure everybody uses the correct
versions of Compass and other Sass extensions, as well as any other required
Ruby gems in your project.

First, install Bundler:

```
$ gem install bundler
```

Managing dependencies is handled in the Gemfile, which is located in the root of
your theme directory. Once you’re done setting the dependencies, run the
following command within your theme directory to have Bundler install the
correct gem versions:

```
$ bundle install
```

Finally, you need to run all of your Compass commands using Bundler.

```
$ bundle exec compass clean
$ bundle exec compass compile
$ bundle exec compass watch
```


## File Structure

This Sass file structure uses many of the ideas discussed in Jonathan Snook’s
[SMACSS](http://smacss.com) and is intended to provide a starting point for
building modular, scalable CSS using Sass and WordPress.

### style.css
This file only contains the information needed by the WordPress Appearance -> Themes 
page to load the theme's information. No CSS should be placed here.

### css/
This is where all of the CSS files are compiled to. Don't edit these files. All the files you should edit are listed below:

### sass/styles.scss
This file shouldn’t contain any CSS code. It only serves to combine the CSS
contained in other Sass partials through @import directives. By default, the
compiled styles.css file is sent to all browsers except IE8 and below.

### sass/no-mq.scs
A duplicate of styles.scss, but includes legacy support for older browsers. By
default, the compiled no-mq.css file is only sent to IE8 and below.

### partials/_global.scss
Global extensions, variables, functions, and mixins that should be imported into
all scss files.

### partials/_base.scss
CSS reset based on [Normalize.css](http://necolas.github.io/normalize.css) and
default styles for HTML elements. Custom font declarations go here as well.

### partials/_helper-classes.scss
Helper classes that aren’t components themselves, such as clearfix.

### partials/_layout.scss
The layout of major regions that components will be placed into.

### partials/_components.scss
Discrete, reusable UI components. (Think SMACSS “modules”.) The majority of your
styles should be here.

### partials/_quick-fixes.scss
Deadlines happen, so put your quick fixes here. Hopefully there will be time
later to move/re-factor these styles into their proper place.


## SMACSS

You should try to abstract your components as much as possible to promote reuse
throughout the theme. Components should be flexible enough to respond to any
width and should never rely on context (e.g., .sidebar-first .component) for
styling. This allows components to be placed throughout the theme with no risk
of them breaking.

If you find you need to change the look of a component depending on its context,
you should avoid using context based classes at all costs. Instead, it is better
to add another modifier class to the component to alter the styling.

Sub-components are the individual parts that make up a component. As a general
rule, adding a class to target a sub-component is a much better option than
using descendant selectors or element selectors. In many cases sub-components
can be made more reusable by making them components in their own right, so they
can then be used within other components.