Gesso for WordPress includes a set of pre-defined functions and filters that you might find useful to speed up your development experience. These are designed to help you follow [DRY principles](https://en.wikipedia.org/wiki/Don't_repeat_yourself) while they also cover many common scenarios.

Source code is located in [inc/helpers.php](https://github.com/forumone/gesso-wp/blob/master/inc/helpers.php)

## Functions

### `gesso_get_posts_by_id()`

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
	$context['featured_content'] = gesso_get_posts_by_id( $post->featured_content );
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

### `gesso_get_paged_posts()`

Retrieves a list of posts with pagination included. *Good for providing a paginated list of content items on any page.*

**Parameters:**

* (string | array) `$post_type`: single or multiple post type slugs.

**Returns:** An array of `Timber\Post` objects with `Timber\Pagination` to construct the pager.

**Example:**

```php
// single.php
<?php

// ...

// Get collection of paged posts.
$context['paged_posts'] = gesso_get_paged_posts( 'post' );
```

**FED:**

```twig
{# ... #}

{# pattern-lab/source/_patterns/03-components/pager/pager.twig #}
{% include '@components/pager/pager.twig' with
{
  pagination: paged_posts.pagination
}
%}
```

***

### `gesso_get_image()`

Retrieves an image object from a given WordPress media ID. *Good for [ACF Image](https://www.advancedcustomfields.com/resources/image/) fields and other special situations where we have only the image ID*.

**Parameters:**

* (int) `$id`: a WordPress media ID.

**Returns:** a `Timber\Image` object.

**Example:**

```php
// single.php
<?php

$context = Timber::get_context();
$post = Timber::query_post();
$context['post'] = $post;

// ...

// If the ACF hero_image field had an image selected, 
// replace the media ID value for a Timber\Image object.
if ( $post->hero_image ) {
	$context['post']->hero_image = gesso_get_image( $post->hero_image );
}
```

**FED:**

```html
<div class="hero-bg-image" style="background-image: url( {{ post.hero_image.src }} );">
  ...
</div>
```

!!! tip
    You can also do `{{ TimberImage( post.hero_image ).src }}` directly from Twig and get the same results.

***

### `gesso_get_post_type_label()`

Get the singular name of a post type.

**Parameters:**

* (string) `$post_type`: a WordPress post type slug.

**Returns:** the singular name of the post type.

**Example:**

```php
// single.php
<?php

$context = Timber::get_context();
$post = Timber::query_post();
$context['post'] = $post;

// Add a post_type_label property to this single Post.
$context['post']->post_type_label = gesso_get_post_type_label( $post->post_type );

// ...
```

!!! info
    This function applies [`gesso/get_post_type_label`](#gessoget_post_type_label) filter before `return`.

***

### `gesso_add_post_type_labels()`

Adds a `$post_type_label` property to each post.

**Parameters:**

* (array) `$posts`: array of `Timber\Post` objects.

**Returns:** An array of `Timber\Post` objects with `$post_type_label`.

**Example:**

```php
// single.php
<?php

// ...

// Get collection of paged posts. Add a post type label to each post.
$context['paged_posts'] = gesso_add_post_type_labels( 
	gesso_get_paged_posts( 
		['post', 'event', 'campaign', 'report', 'press_release'] 
	) 
);
```

!!! info
    This function uses [`gesso_get_post_type_label()`](#gesso_get_post_type_label) and applies [`gesso/get_post_type_label`](#gessoget_post_type_label) filter to each post before `return`.

***

### `gesso_get_menu()`

Returns a WordPress menu.

**Parameters:**

* (int | string) `$menu`: The WordPress menu `ID` or `slug`.

**Returns:** a `Timber\Menu` object.

**Example:**

```php
// page.php
<?php

// ...

if ( is_page( 'about' ) ) {
	$context['about_submenu'] = gesso_get_menu( 'about-menu' );
}
```

***

## Twig filters

### `post_type_label`

Returns the post type label.

**Example:**

```html
<!-- ... -->
<div class="card__label">{{ post.post_type | post_type_label }}</div>
<!-- ... -->
```

!!! info
    This Twig filter is affected by [`gesso/get_post_type_label`](#gessoget_post_type_label) filter before `return`.

## WordPress filters

### `gesso/get_post_type_label`


