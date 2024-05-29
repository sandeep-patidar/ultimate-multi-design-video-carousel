<?php
/**
 * The Template for displaying all single posts.
 *
 * @package Shape
 * @since Shape 1.0
 */
 if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
get_header();
	 while ( have_posts() ) : the_post(); 
			$video_id = get_post_meta( get_the_ID(), 'slider_url', TRUE ); 
			?>	
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header class="entry-header">
					<h1 class="entry-title"><?php the_title(); ?></h1>
				</header>
				<div class="entry-content">
					<div class="umdc-video-conatiner">
						<?php if($video_id){ 
						// Echo the embed code via oEmbed
						echo wp_oembed_get( 'http://www.youtube.com/watch?v=' . $video_id ); 
					} else { ?>
							<?php if ( ! post_password_required() && ! is_attachment() ) :
								the_post_thumbnail();
							endif; ?>
						<?php } ?>
						
					</div>
					<?php the_content(); ?>	
				</div><!-- .entry-content -->
			</article>
<?php endwhile; // end of the loop. ?>
<?php get_footer(); ?>