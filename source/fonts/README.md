Fonts used in a `@font-face` declaration will be inlined or copied to
a `build/fonts` directory by Webpack, depending on the size of the file.

Fonts used with services like typography.com, where the `@font-face` declaration
is **not** part of the theme SCSS should be placed in `build/fonts/` and excluded
from the `.gitignore`.
