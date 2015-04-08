<form class="search" method="get" action="<?php echo home_url(); ?>" role="search">
	<label for="s" class="element-hidden">Search</label>
	<input class="search__input" type="search" name="s" placeholder="<?php _e( 'To search, type and hit enter.', 'gesso' ); ?>">
	<button class="button search__submit" type="submit" role="button"><?php _e( 'Search', 'gesso' ); ?></button>
</form>
