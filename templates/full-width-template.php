<?php 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly\
global $post;
$umdc_options = get_option('umdc_setting_option');
// WP_Query arguments
  $args = array (
    'post_type'              => $attributes['type'],
    'post_status'            => array('publish'),
    'cat'                    => $attributes['cat_id'],
    'posts_per_page'         => 10,
    'order'                  => 'DESC',
    'orderby'                => 'date',
  );

  if($attributes['type'] == 'umdc-slider') {
		$args2 = array(
      	'post_type'   => 'umdc-slider',
      	'posts_per_page' => 10
    );
    query_posts($args2);
		?>
		<div class="clearfix single-slide">
   	<ul id="umdc-gallery" class="gallery list-unstyled cS-hidden one-slide">
		<?php while ( have_posts() ) : the_post();
			global $post;
	        	$full_img_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
	        	$full_img = '';
		          if( empty($full_img_url[0]) ){
		            $full_img = UMDC_URL.'img/no_image.png';
		          }else{
		            $full_img = $full_img_url[0];
		          }
	         ?>
	         <?php $videos_url2 = get_post_meta( get_the_ID(), 'slider_url', TRUE ); 
			 $videos_title2 = get_post_meta( get_the_ID(), 'slider_title', TRUE );
			 ?>
			<li>
				<div class="post_title_get"><a href="<?php echo get_permalink();?>"><?php if($videos_title2 == '') the_title(); else echo $videos_title2; ?></a></div>
		         <?php if($videos_url2 == ''){  ?>
	                <a href="<?php echo get_permalink();?>">
						<div class="overlap"> </div>
			            <img src="<?php echo $full_img; ?>" alt="image" />
		            </a>    
		         <?php	} else { ?>
				<a href="<?php echo get_permalink();?>">
					<div class="overlap"><img width="50" height="35" src="<?php echo UMDC_URL.'img/youtube-icon.png' ?>"  /></div>
					<img src="https://i.ytimg.com/vi/<?php echo $videos_url2; ?>/maxresdefault.jpg"  />
	            </a>
	            <?php } ?>
			</li> 
		<?php endwhile;  ?>
		<?php wp_reset_query(); ?>
		</ul>
	</div>
	<?php
		wp_reset_query(); 
  }

  else{

   // The Query
   $mdps_query = new WP_Query( $args );
   if ( $mdps_query->have_posts() ) { 
    ?>
   <div class="clearfix single-slide">
   	<ul id="umdc-gallery" class="gallery list-unstyled cS-hidden one-slide">
	      <?php
	    	while ( $mdps_query->have_posts() ) : $mdps_query->the_post();
	       	global $post;
	        	$full_img_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
	        	$full_img = '';
		          if( empty($full_img_url[0]) ){
		            $full_img = UMDC_URL.'img/no_image.png';
		          }else{
		            $full_img = $full_img_url[0];
		          }
	         ?>
	        <li>
	        	<div class="post_title_get"><a href="<?php echo get_permalink();?>"><?php the_title(); ?></a></div>
	        	<a href="<?php echo get_permalink();?>">
				<div class="overlap"></div>
	            <img height="400" src="<?php echo $full_img; ?>" alt="image" />
	            </a>
	        </li>
	      <?php  endwhile; ?>
	      <?php wp_reset_query(); ?>
	   </ul>
	</div>
	<?php
  	}
}
	echo "<script>
	            jQuery(document).ready(function() {
	                    jQuery('.one-slide').umdclightSlider({
	                   	adaptiveHeight: true,
	                    item:1,
	                    slideMargin: 0,
	                    thumbItem: -1,
	                    pause:".$umdc_options['umdc_pause'].",
			            auto:".$umdc_options['umdc_auto_start'].",
			            loop:".$umdc_options['umdc_enable_loop'].",
			            keyPress: ".$umdc_options['umdc_enable_keypress'].",
		                controls: ".$umdc_options['umdc_next_previous_controls'].",
		                enableTouch:".$umdc_options['umdc_enable_touch'].",
		                enableDrag:".$umdc_options['umdc_enable_drag'].",
		                pauseOnHover:".$umdc_options['umdc_pause_on_hover'].",
                        onSliderLoad: function() {
                            jQuery('.one-slide').removeClass('cS-hidden');
                        }  
                    });
            });
            </script>";

?>