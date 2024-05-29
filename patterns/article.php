<?php
/**
 * Title: Article
 * Slug: gesso/article
 * Categories: gesso, templates_only, theme
 * Description: A starting pattern for article content
 * Block Types: core/post-title, core/group, core/post-date, core/post-author
 *
 * @package gesso
 */

?>

<!-- wp:group {"className":"article"} -->
<div class="wp-block-group article"><!-- wp:post-title {"level":1,"className":"article__title"} /-->

<!-- wp:group {"tagName":"footer","className":"article__footer","layout":{"type":"flex","allowOrientation":false,"flexWrap":"nowrap"}} -->
<footer class="wp-block-group article__footer"><!-- wp:post-date /-->

<!-- wp:post-author {"showAvatar":false,"showBio":false} /--></footer>
<!-- /wp:group -->

<!-- wp:post-content {"className":"article__content"} /--></div>
<!-- /wp:group -->
