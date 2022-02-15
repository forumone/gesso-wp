# Gesso for WordPress

A Sass-based starter [block theme](https://developer.wordpress.org/block-editor/how-to-guides/themes/block-theme-overview/) for
WordPress 5.9+.

## Requirements
* Node 14.x.x
* npm 7.x.x
* WordPress 5.9+
* [Forum One Block Library](https://github.com/forumone/f1-block-library)

## Getting Started
1. `npm ci`
2. `npm run dev`
3. Enable the Forum One Block Library plugin
4. Enable the theme

## Building the theme
To build the theme for production (or to get your local up and running if you
will not be working on the theme itself):
1. `npm ci`
2. `npm run build`

## Configuration
### Design tokens
Gesso uses a configuration file `source/00-config/config.design-tokens.yml`
to manage the theme’s design tokens and automatically generate both the global sass map for styling
and the theme.json file. The dev script will monitor changes in the config and
rebuild all necessary assets. To rebuild the theme assets a single time run `npm run build`.

### theme.json
Gesso's [theme.json](https://developer.wordpress.org/block-editor/how-to-guides/themes/theme-json/) file
is automatically generated. Colors, font families, font sizes, and layout
constrain widths are generated from the design tokens. Other theme.json customizations
can be added to `theme-settings.json`. The `theme.json` file should not be modified
directly as it'll be overwritten when `npm run build` runs. Instead, modify the design
tokens or place your changes in `theme-settings.json`. For more about what can be configured
with theme.json, see [the Block Editor Handbook](https://developer.wordpress.org/block-editor/how-to-guides/themes/theme-json/).

## Sass
Sass can be compiled as part of the global styles.css file or to individual
CSS files for use in a block style.

@use is used to import Sass variables, mixins, and/or functions into individual
SCSS files. @import is discouraged by the Sass team and will eventually be
phased out. This means that most files will start with @use '00-config' as *;.
This allows you to use the design token accessor functions without an
additional namespace. Other functions and mixins can be used similarly. Note
that to avoid namespace collisions, only theme-related variables, mixins, and
functions should be used with *.

All Sass files that are compiled to individual CSS files must have a unique filename, even if they are in different directories.

### Global styles
Prefix the name of your Sass file with _, e.g. _card.scss. Add it to
the appropriate aggregate file (i.e. _components.scss).

### Individual block styles
DO NOT prefix the name of your Sass file with _, e.g. menu.scss.
Import the config and global aggregate files. Add your CSS file to the
`wp_next_theme_block_assets` function inside functions.php:
```php
wp_enqueue_block_style('f1-block-library/standalone-link', [
  'handle' => 'wp-next-theme-standalone-link',
  'src' => get_theme_file_uri('dist/css/standalone-link.css'),
  'path' => get_theme_file_path('dist/css/standalone-link.css')
]);
```
Omit the `path` line if the WordPress should not be able to choose whether
to inject the styles via a `<style></style>` tag instead of loading an external
file. You may need to remove that line if you find that image paths break when the
CSS is injected. See [the WordPress dev note](https://make.wordpress.org/core/2021/12/15/using-multiple-stylesheets-per-block/)
for more on loading block styles.

## Block Styles
Block Styles can be registered or unregistered in the `source/editor-styles.js`. This script
is loaded whenever the Block Editor is loaded. For more about Block Styles, see [the Block Editor Handbook](https://developer.wordpress.org/block-editor/reference-guides/block-api/block-styles/).

## Linting
Linting is done with Prettier, ESLint, and Stylelint. Linting follows the WordPress standards,
with some rules disabled where needed to resolve conflicts between tools (mostly Prettier and Stylelint)
or between linting standards and the theme design tokens.

## Design Token Functions

The following Sass functions can be used to access the tokens defined in `config.design-tokens.yml`.

**`gesso-box-shadow($shadow)` Output a shadow value from the box-shadow token list**

example:

```
box-shadow: gesso-box-shadow(1);
```

**`gesso-brand($color, $variant)` Output a color value from the palette brand token list**

example:

```
color: gesso-brand(blue, light);
```

**`gesso-color($type, $subtype)` Output a color value from the colors token list**

example:

```
color: gesso-color(text, primary);
```

**`gesso-constrain($constrain)` Output a size value from the constrains token list**

example:

```
max-width: gesso-constrain(sm);
```

**`gesso-duration($duration)` Output a timing value from the transitions duration token list**

example:

```
transition-duration: gesso-duration(short);
```

**`gesso-easing($easing)` Output an easing value from the transitions ease token list**

example:

```
transition-timing-function: gesso-easing(ease-in-out);
```

**`gesso-font-family($family)` Output a stack value from the font-family token list**

example:

```
font-family: gesso-font-family(primary);
```

**`gesso-font-size($size)` Output a size value from the font-size token list**

example (combined with the rem() function to convert to rems):

```
font-size: rem(gesso-font-size(2));
```

**`gesso-font-weight($weight)` Output a weight value from the font-weight token list**

example:

```
font-weight: gesso-font-weight(semibold);
```

**`gesso-grayscale($color)` Output a color value from the palette grayscale token list**

example:

```
color: gesso-grayscale(gray-2);
```

**`gesso-line-height($height)` Output a height value from the line-height token list**

example:

```
line-height: gesso-line-height(tight);
```

**`gesso-spacing($spacing)` Output a size value from the spacing token list**

example (combined with the rem() function to convert to rems):

```
margin-bottom: rem(gesso-spacing(md));
```

**`gesso-z-index($index)` Output an index value from the z-index token list**

example:

```
z-index: gesso-z-index(modal);
```

### Design Tokens in JavaScript

The values in Gesso's configuration file are also exported to JavaScript objects
so that the same values can be used in CSS and JS. The JS objects can be found
in `js/src/constants/_GESSO.es6.js`. This file is also rebuilt whenever `gulp`
or `gulp build` is run.

For example, to use a breakpoint in a script:
```
import { BREAKPOINTS } from '../constants/_GESSO.es6';

if (window.matchMedia(`min-width: ${BREAKPOINTS.desktop}`).matches) {
  // Some script that should only run on larger screens.
}
```
This will use the same breakpoint as `breakpoint(gesso-breakpoint(desktop))` in
your Sass.

If your token value is a Sass function, the JavaScript will use the fallback
value, if available. If there is no fallback value, the token will be omitted
from the JavaScript objects. In general, if you want to share a value between
CSS and JavaScript, you should use simple strings or numbers.

### Width Based Media Queries

Gesso uses custom mixins to specify viewport width based media queries:
* `breakpoint`: min-width queries
* `breakpoint-max`: max-width queries
* `breakpoint-min-max`: queries with both a min and max width

Each mixin takes one or two
width parameters, which can be a straight value (e.g., 800px, 40em) or a design
token value called using the `gesso-breakpoint` function (e.g.,
`gesso-breakpoint(tablet-lg)`).  The `breakpoint-max` and `breakpoint-min-max`
mixins can also take an optional parameter to subtract one pixel from the
max-width value, which can be useful when you want your query to go up to the
value but not to include it, such as when using WordPress breakpoint variables.

You can also use the width-based breakpoint mixins defined in [@wordpress/base-styles](https://www.npmjs.com/package/@wordpress/base-styles),
alongside the breakpoint variables. We recommend using those instead of defining your
own for consistency between theme styling and plugin styling.
```scss
$break-huge: 1440px;
$break-wide: 1280px;
$break-xlarge: 1080px;
$break-large: 960px;	// admin sidebar auto folds
$break-medium: 782px;	// adminbar goes big
$break-small: 600px;
$break-mobile: 480px;
$break-zoomed-in: 280px;
```

**`@include breakpoint($width) { // styles }`
Output a min-width based media query.**

examples:

```
@include breakpoint(800px) {
  display: flex;
}

@include breakpoint($break-medium) {
  display: none;
}

@include break-small {
  display: grid;
}
```

**`@include breakpoint-max($width, $subtract_1_from_max) { // styles }`
Output a max-width based media query. The optional $subtract_1_from_max
parameter will subtract 1px from the width value if set to `true`
(default: `false`).**

examples:

```
@include breakpoint-max(900px) {
  display: block;
}

@include breakpoint-max($break-small, true) {
  display: none;
}
```

**`@include breakpoint-min-max($min-width, $max-width, $subtract_1_from_max)
{ // styles }`
Output a media query with both a min-width and max-width. The optional
$subtract_1_from_max parameter will subtract 1px from the max-width value if
set to `true` (default: `false`).**

examples:

```
@include breakpoint-min-max(400px, 700px) {
  display: flex;
}

@include breakpoint-min-max($break-small, $break-medium, true) {
  display: block;
}
```
