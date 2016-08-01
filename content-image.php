<article id='post-<?php the_ID();?>' <?php post_class(); ?>>
	<div class="entry-thumbnail">
		
	</div>
	<?php cmg_thumbnails('large'); ?>
	<header class="entry-header">
		<?php cmg_entry_header(); ?>
		<?php
		/*
		* Đếm số lượng attachment có trong post
		*/
		   $attachments = get_children( array( 'post_parent'=>$post->ID ) );
		   $attachment_number = count($attachments);
		   printf( __('This image post contains %1$s photos', 'thachpham'), $attachment_number );
		?>
	</header>
	<div class="entry-content">
		<?php cmg_entry_content(); ?>
        <?php ( is_single() ? cmg_entry_tag() : '' ); ?>
	</div>
</article>