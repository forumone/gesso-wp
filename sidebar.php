<?php
/**
 * Sidebar template containing the primary and secondary widget areas.
 *
 * @package Gesso
 */

?>
<aside class="sidebar" role="complementary">
	<div class="sidebar__widgets">
<?php
if ( ! function_exists( 'dynamic_sidebar' ) || ! dynamic_sidebar( 'widget-area-1' ) ) {
	echo '';
}
?>
	</div>
</aside>
