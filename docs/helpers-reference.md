Gesso for WordPress includes a set of pre-defined functions that you might find useful to speed up your development experience. These functions are designed to help you follow [DRY principles](https://en.wikipedia.org/wiki/Don't_repeat_yourself) while they also cover many common scenarios.

Source code is located in [inc/helpers.php](https://github.com/forumone/gesso-wp/blob/master/inc/helpers.php)

## Functions

### `gesso_get_posts()`

Retrieves a list of posts from given ID's. *Useful when working with [ACF Relationship](https://www.advancedcustomfields.com/resources/relationship/) field*.

**Parameters:**

* (array) `$post_IDs`: a list of Post ID's.

**Returns:** an array of `Timber\Post` objects | `null`

**Example:**

```php
// single.php
<?php

$context = Timber::get_context();
$post = Timber::query_post();
$context['post'] = $post;

// ...

// If ACF relationship field has posts selected, let's pull their contents.
if ( $post->featured_content ) {
	$context['featured_content'] = gesso_get_posts( $post->featured_content );
}
```


### `gesso_get_posts_by_tax()`



### `gesso_get_posts_with_pagination()`



### `gesso_get_image()`



### `gesso_get_posts_block()`



### `gesso_get_sidebar()`



### `gesso_get_post_type_label()`



### `gesso_add_post_type_labels()`



### `gesso_get_menu()`


## Twig filters

### `post_type_label`
