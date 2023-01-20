<?php
/**
 * Title: Article
 * Slug: gesso/article
 * Categories: gesso
 * Description: A starting pattern for article content
 * Block Types: core/post-title, core/group, core/post-date, core/post-author, core/post-content
 */
?>

<!-- wp:group {"tagName":"article","className":"article","layout":{"inherit":true}} -->
<article class="wp-block-group article"><!-- wp:post-title {"level":1,"className":"article__title"} /-->

<!-- wp:group {"tagName":"footer","className":"article__footer","layout":{"type":"flex","allowOrientation":false,"flexWrap":"nowrap"}} -->
<footer class="wp-block-group article__footer"><!-- wp:post-date /-->

<!-- wp:post-author {"showAvatar":false,"showBio":false} /--></footer>
<!-- /wp:group -->

<!-- wp:post-content {"className":"article__content"} /--></article>
<!-- /wp:group -->