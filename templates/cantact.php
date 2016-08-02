<?php
/*
	Template Name: Contact
*/
	?>
	<?php get_header(); ?>
<div class="content">
	<section id="main-content">
		<div class="contact-info">
		        <h4>Địa chỉ liên lạc</h4>
		        <p>Ghi địa chỉ vào đây</p>
		        <p>090 456 765</p>
		</div>
		<div class="contact-form">
		        <?php echo do_shortcode('[CONTACT FORM]'); ?>
		</div>
	</section>
	<section id="sidebar">
		<?php get_sidebar() ?>
	</section>
</div>
<?php get_footer(); ?>