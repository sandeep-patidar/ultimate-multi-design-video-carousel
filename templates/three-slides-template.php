<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
$umdc_options = get_option('umdc_setting_option');
if($attributes['type'] == 'umdc-slider' ) { ?>

  <?php
    $args2 = array(
      'post_type'   => 'umdc-slider',
      'posts_per_page' => 10
    );
    query_posts($args2);
    ?>
       
<div class="clearfix three-slide">
    <ul id="umdc-gallery" class="umdc-gallery gallery list-unstyled cS-hidden three-slides" style="height:315px;">
    <?php $i = 0; ?>
    <?php while ( have_posts() ) : the_post(); ?>
    <?php $videos_url2 = get_post_meta( get_the_ID(), 'slider_url', TRUE ); 
	   $videos_title2 = get_post_meta( get_the_ID(), 'slider_title', TRUE );

    global $post;
    $full_img_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
    $full_img = '';
          if( empty($full_img_url[0]) ){
            $full_img = UMDC_URL.'img/no_image.png';
          }else{
            $full_img = $full_img_url[0];
          }
    ?>
    <?php if($i == 0): ?>
        <li style="margin-left:0px;">
          <div class="scol-1">
            <div class="post-item">
            <div class="post_title_get"><a href="<?php echo get_permalink();?>"><?php if($videos_title2 == '') the_title(); else echo $videos_title2;?></a></div>
            <?php if($videos_url2 == ''){ ?>
              <a href="<?php echo get_permalink();?>">
			  <div class="overlap"></div>
				<img src="<?php echo $full_img; ?>" />
              </a>
            <?php } else{?>
                 
			   <?php if(has_post_thumbnail()){ ?>
			   		<a href="<?php echo get_permalink();?>">
			   			<div class="overlap">
							<img width="50" height="35" src="<?php echo UMDC_URL.'img/youtube-icon.png' ?>"  />
						</div>
						<img src="<?php echo $full_img; ?>" />
              		</a>
			  <?php } else { ?>
			  		<a href="<?php echo get_permalink();?>">
			  			<div class="overlap">
							<img width="50" height="35" src="<?php echo UMDC_URL.'img/youtube-icon.png' ?>"  />
						</div>
						<img src="https://i.ytimg.com/vi/<?php echo $videos_url2; ?>/maxresdefault.jpg"  />
              		</a>
			    
            	<?php } ?>
			<?php } ?>
            </div>
          </div>
    <?php endif; ?>
    <?php if($i == 1): ?>
      <div class="scol-2">
        <?php endif; ?>
        <?php if( ($i == 1) || ($i == 2) ): ?>
        <div class="width-100">
          <div class="post-item">
		  <div class="post_title_get"><a href="<?php echo get_permalink();?>"><?php if($videos_title2 == '') the_title(); else echo $videos_title2;	 ?></a></div>
          <?php if($videos_url2 == ''){ ?>
            <a href="<?php echo get_permalink();?>">
			<div class="overlap"></div>
              <img src="<?php echo $full_img; ?>" />
            </a>
          <?php } else { ?>
              
			  <a href="<?php echo get_permalink();?>">
			  <div class="overlap">
					<img width="50" height="35" src="<?php echo UMDC_URL.'img/youtube-icon.png' ?>"  />
				</div>
				<img src="https://i.ytimg.com/vi/<?php echo $videos_url2; ?>/maxresdefault.jpg"  />
              </a>
			    
            	<?php } ?>
			
          </div>
        </div>
        <?php endif; ?>
        <?php if($i == 2 ): ?>
      </div>
    </li>
    <?php endif; ?>
    <?php
    $i++;
    if($i == 3 ){
    $i = 0;
    }
    ?>
    <?php  endwhile; ?>
    <?php wp_reset_query(); ?>
  </ul>
</div>
<?php  }  else{
$args = array (
'post_type'              => array( 'post' ),
'post_status'            => array( 'publish' ),
'cat'                    => $attributes['cat_id'],
'posts_per_page'         => 10,
'order'                  => 'DESC',
'orderby'                => 'date',
);
$mdps_query = new WP_Query($args);
?>
<div class="clearfix three-slide">
  <?php if($mdps_query->have_posts()): ?>
  <ul id="umdc-gallery" class="umdc-gallery gallery list-unstyled cS-hidden three-slides">
    <?php $i = 0; ?>
    <?php while ( $mdps_query->have_posts() ) : $mdps_query->the_post();
          global $post;
            $full_img_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
            $full_img = '';
              if( empty($full_img_url[0]) ){
                $full_img = UMDC_URL.'img/no_image.png';
              }else{
                $full_img = $full_img_url[0];
              }
    ?>
    <?php if($i == 0): ?>
        <li style="margin-left:0px;">
          <div class="scol-1">
            <div class="post-item">
              <div class="post_title_get"><a href="<?php echo get_permalink();?>"><?php the_title(); ?></a></div>
              <a href="<?php echo get_permalink();?>">
			  <div class="overlap"></div>
                <img src="<?php echo $full_img; ?>" />
              </a>
            </div>
          </div>
    <?php endif; ?>
    <?php if($i == 1): ?>
      <div class="scol-2">
        <?php endif; ?>
        <?php if( ($i == 1) || ($i == 2) ): ?>
        <div class="width-100">
          <div class="post-item">
            <div class="post_title_get"><a href="<?php echo get_permalink();?>"><?php the_title(); ?></a></div>
            <a href="<?php echo get_permalink();?>">
			<div class="overlap"></div>
              <img src="<?php echo $full_img; ?>" />
            </a>
          </div>
        </div>
        <?php endif; ?>
        <?php if($i == 2 ): ?>
      </div>
    </li>
    <?php endif; ?>
    <?php
    $i++;
    if($i == 3 ){
    $i = 0;
    }
    ?>
    <?php  endwhile; ?>
    <?php wp_reset_query(); ?>
  </ul>
  <?php endif; ?>
</div>
<?php } ?>
<?php
echo "<script>
jQuery(document).ready(function() {
    jQuery('.three-slides').umdclightSlider({
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
    jQuery('.three-slides').removeClass('cS-hidden');
    }
    });
});
</script>";
?>
