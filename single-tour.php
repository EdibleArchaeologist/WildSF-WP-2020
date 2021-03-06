<!DOCTYPE html>
<html>
<head>

	<?= get_header('common') ?>

	<?php
		global $post;
		$this_tour_id = $post->ID;
		$splash_video_url = get_field('splash_video', $this_tour_id);
		$splash_image_url = get_field('splash_image', $this_tour_id);

		$scroll_helper_image_id = 150;
		$scroll_helper_image_url = wp_get_attachment_image_src($scroll_helper_image_id, 'full')[0];

		$dotted_line_image_id = 172;
	  	$dotted_line_image_url = wp_get_attachment_image_src($dotted_line_image_id, 'full')[0];

		$lang = get_field('language');

		$en_cta_button = "Book Now";
		$es_cta_button = "Reservar Ahora";

		$en_book_title = "Book A Tour";
		$es_book_title = "Reservar Un Tour";
	?>
	<style type="text/css" class="wp-dynamic-css">
	  .dotted-line{
	    background-image: url("<?= $dotted_line_image_url ?>");
	    border: 0;
	    height: 10px;
	    background-size: contain;
	  }
	</style>

</head>

<body>
	<?php
		get_template_part('navbar');
	?>
	<div class="single-tour">
		<div class="single-tour-inner">

			<div class="splash-container">
				<?php
				if(!empty($splash_video_url)){
				?>
				<video class="splash-video" autoplay loop muted poster="<?= $splash_image_url ?>">
            		<source src="<?= $splash_video_url ?>" type="video/mp4">
        		</video>
        <?php
				} elseif(!empty($splash_image_url)) {
				?>
				<img class="splash-image" src="<?= $splash_image_url ?>">
				<?php
				}
	      ?>
        <div class="splash-title-container">
        	<h1 class="title">
        		<?= get_the_title($this_tour_id) ?>
        	</h1>
        	<h2 class="subtitle">
        		<?= get_field('subtitle', $this_tour_id) ?>
        	</h2>
        </div>
        <div class="scroll-helper-container">
        	<div class="scroll-helper">
        		<img src="<?= $scroll_helper_image_url ?>" />
        	</div>
        </div>
			</div>
			<hr class="dotted-line" />
			<div class="wysiwyg-container">
				<div class="wysiwyg-inner">
					<?= get_field('description', $this_tour_id) ?>
					<?= get_field('timing', $this_tour_id) ?>
					<?= get_field('pricing', $this_tour_id) ?>
					<a class="book-button" href="#calendar-nav-target">
						<?php if( $lang == 'spanish' ){?>
							<?= $es_cta_button ?>
						<?php
						} else {
						?>
							<?= $en_cta_button ?>
						<?php
						}
						?>
					</a>
				</div>
			</div>
			<?php
			$explainer_video = get_field('explainer_video', $this_tour_id);
			if(!empty($explainer_video)){
			?>
			<hr class="dotted-line" />
			<div class="explainer-video-container">
				<iframe src="<?= get_field('explainer_video', $this_tour_id) ?>" frameborder="0" allowfullscreen=""></iframe>
			</div>
			<?php
			}
			?>
			<hr class="dotted-line" />
			<div class="wysiwyg-container">
				<div class="wysiwyg-inner">
				<div class="wysiwyg-header"><?= get_the_title($this_tour_id) ?> Highlights</div>
				<div class="row">
					<?php
					$highlights = get_field('highlights', $this_tour_id);
					$extra_highlights = get_field('extra_highlights', $this_tour_id);
					if(!empty($extra_highlights)){
					?>
						<div class="col-md-6">
							<?= $highlights ?>
						</div>
						<div class="col-md-6">
							<?= $extra_highlights ?>
						</div>
					<?php
					} else {
					?>
						<div class="col-md-12">
							<?= $highlights ?>
						</div>
					<?php
					}
					?>
				</div>

				</div>
			</div>
			<hr class="dotted-line" />
			<div class="calendar-container">
				<div class="calendar-inner">
					<div class="calendar-header nav-target" id="calendar-nav-target">
						<?php if( $lang == 'spanish' ){?>
							<?= $es_book_title ?>
						<?php
						} else {
						?>
							<?= $en_book_title ?>
						<?php
						}
						?>
					</div>
					<div class="peek-container">
						<?php if( $lang == 'spanish' ) {?>
							<a href="https://book.peek.com/s/15a8284c-0990-4986-a5b4-1754b0c0b014/K1Ykr" data-embed="true">San Francisco Walking Tours</a>
						<?php
						} else {
						?>
							<a href="https://book.peek.com/s/15a8284c-0990-4986-a5b4-1754b0c0b014/3beY" data-embed="true">San Francisco Walking Tours</a>
						<?php
						}
						?>
	            	</div>
            	</div>
            </div>
            <hr class="dotted-line" />
            <div class="guides-container" id="guides">
            	<div class="guides-inner">
            		<div class="guides-header">Your Guides</div>
            		<div class="guides-list">

            				<?php
							while( have_rows('guides',$this_tour_id) ): the_row();
								$guide = get_sub_field('guide')
							?>
								<div class="guide-container">
		            				<div class="guide-headshot-container">
		            					<img src="<?= get_field('headshot_image', $guide->ID) ?>" />
		            				</div>
		            				<div class="guide-name">
		            					<?= $guide->post_title ?>
		            				</div>
		            				<div class="guide-description">
		            					<?= get_field('description', $guide->ID) ?>
		            				</div>
	            				</div>
							<?php
							endwhile;
							?>
            		</div>
            	</div>
            </div>
			<hr class="dotted-line" />
			<div class="other-tours-container">
				<div class="other-tours-inner">
					<div class="other-tours-header">Check out our other awesome tours!</div>
					<?php
					while( have_rows('other_tours',$this_tour_id) ): the_row();
						$tour = get_sub_field('tour')
					?>
						<a href="<?= get_permalink($tour->ID) ?>">
						<div class="tour-container">
            				<img class="tour-splash" src="<?= wp_get_attachment_image_url(get_field('frontpage_splash_image',$tour->ID),'full') ?>" />
            				<div class="tour-info">

	          					<div class="tour-header">
												<div class="tour-title"><?= $tour->post_title ?></div>
												<div class="tour-subtitle"><?= get_field('subtitle',$tour->ID) ?></div>
											</div>

											<div class="tour-summary"><?= get_field('frontpage_summary',$tour->ID) ?></div>

											<?php
											while( have_rows('frontpage_highlights',$tour->ID) ): the_row();
											$highlight_text = get_sub_field('highlight');
											?>
												<div class='tour-sight'>
													<span>★</span>
													<?= $highlight_text ?>
												</div>
											<?php
											endwhile;
											$post = $tour;
											?>
											<a href="<?= get_permalink() ?>" class="learn-more-button">Learn More</a>
            				</div>
        				</div>
        				</a>
					<?php
					endwhile;
					?>
				</div>
			</div>
		</div>
	</div>

	<?php
	get_template_part('footer');
	?>

</body>
</html>
