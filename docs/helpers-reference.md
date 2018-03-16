Gesso for WordPress includes a set of pre-defined functions and filters that you might find useful to speed up your development experience. These are designed to help you follow [DRY principles](https://en.wikipedia.org/wiki/Don't_repeat_yourself) while they also cover many common scenarios.

Source code is located in [inc/helpers.php](https://github.com/forumone/gesso-wp/blob/master/inc/helpers.php)

## Functions

### `gesso_get_posts()`

Retrieves a list of posts from given ID's. *Useful when working with [ACF Relationship](https://www.advancedcustomfields.com/resources/relationship/) field*.

**Parameters:**

* (array) `$post_IDs`: a list of Post ID's.

**Returns:** An array of `Timber\Post` objects | `null`

**Example:**

```php
// single.php
<?php

// ...

// If ACF relationship field has posts selected, let's pull their contents.
if ( $post->featured_content ) {
	$context['featured_content'] = gesso_get_posts( $post->featured_content );
}
```

***

### `gesso_get_posts_by_tax()`

Retrieves a list of posts from given taxonomy terms. *Useful to populate a component of related contents by taxonomy under a single post detail page*.

**Parameters:**

* (string | array) `$post_type`: single or multiple post type slugs. 

* (string) `$taxonomy`: taxonomy name.

* (array) `$terms`: array of `Timber\Term` objects.

* (int) `$qty`[optional]: quantity of posts results to return (default: `posts_per_page` WordPress global setting).

* (int) `$excl`[optional]: ID of post to exclude (default: `null`).

**Returns:** An array of `Timber\Post` objects | `null`

**Example:**

```php
// single.php
<?php

// ...

// Set post types to query.
$post_types = ['post', 'project', 'event'];
// Get current post topics.
$topics = $post->get_terms( 'topic' );
// Get other related contents by topics.
$context['related_content'] = gesso_get_posts_by_tax( 
	$post_types, 	// Query for Blog Posts, Projects and Events.
	'topic', 		// Having under the Topic taxonomy.
	$topics, 		// This topic terms.
	3, 				// Return only 3 post results.
	$post->ID 		// Exclude the current post.
	);
```

***


### `gesso_get_posts_with_pagination()`

Retrieves a list of posts with pagination included. *Good for providing a paginated list of content items on any page.*

**Parameters:**

* (string | array) `$post_type`: single or multiple post type slugs.

**Returns:** An array of `Timber\Post` objects and a `Timber\Pagination` object to construct the pager.

### `gesso_get_image()`



### `gesso_get_posts_block()`



### `gesso_get_sidebar()`



### `gesso_get_post_type_label()`



### `gesso_add_post_type_labels()`



### `gesso_get_menu()`


## Twig filters

### `post_type_label`

## WordPress filters

### `gesso/get_post_type_label`


