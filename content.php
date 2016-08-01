<article id='post-<?php the_ID();?>' <?php post_class(); ?>>
	<div class="entry-thumbnail">
		<?php cmg_thumbnails('thumbnail'); ?>
	</div>
	<header class="entry-header">
		<?php cmg_entry_header(); ?>
		<?php cmg_entry_meta(); ?>
	</header>
	<div class="entry-content">
		<?php
        //printf( '<a href="%1$s" target="blank">%2$s</a>', $link, $link_description);
			?>
        <?php ( is_single() ? cmg_entry_tag() : '' ); ?>
	</div>
</article>