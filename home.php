<!DOCTYPE html>
<html>
<head>

	<?= get_header('common') ?>

	<?php

		$dotted_line_image_id = 172;
		$dotted_line_image_url = wp_get_attachment_image_src($dotted_line_image_id, 'full')[0];

	?>

	<style>
		.page-container {
			padding-top: 48px !important;
		}
		.page-inner {
			background-color: white;
			padding: 0 30px;
		}
		.post-summary {
			padding: 2rem 0 0;
		}
		.dotted-line{
			background-image: url("<?= $dotted_line_image_url ?>");
			border: 0;
			height: 10px;
			background-size: contain;
		}
		a, a:hover {
			color: #bf5246;
		}
		h1>a, h1>a:hover {
			color: #3f616c;
		}
		.post-excerpt {
			margin-bottom: 1rem;
		}
		.post-date {
			text-transform: uppercase;
			font-weight: bold;
			color: #b8b8b7;
		}
	</style>
</head>
<body>
	<?php get_template_part('navbar');?>
	<div class="page-container">
		<div class="page-inner">
			<?php query_posts('post_type=post&cat=4&post_status=publish&posts_per_page=10&paged='. get_query_var('paged')); ?>
			<?php if( have_posts() ): ?>
			<?php while( have_posts() ): the_post(); ?>
				<div class="post-summary" id="post-<?php get_the_ID(); ?>">
					<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( array(200,220) ); ?></a>
					<h1><a href="<?php echo get_permalink(); ?>"><?= the_title(); ?></a></h1>
					<div class="post-date"><?=the_date(); ?></div>
					<div class="post-excerpt">
						<?= the_excerpt() ?>
						<a href="<?php echo get_permalink(); ?>"> Read More...</a>
					</div>
					<hr class="dotted-line">
				</div>
			<?php endwhile; ?>
				<div class="navigation">
					<span class="newer"><?php previous_posts_link(__('« Newer','example')) ?></span> <span class="older"><?php next_posts_link(__('Older »','example')) ?></span>
				</div><!-- /.navigation -->
			<?php else: ?>
				<div id="post-404" class="noposts">
				    <p><?php _e('None found.','example'); ?></p>
			    </div><!-- /#post-404 -->
			<?php endif; wp_reset_query(); ?>
		</div>
	</div>

<?php
	get_template_part('footer');
?>

</body>
</html>
