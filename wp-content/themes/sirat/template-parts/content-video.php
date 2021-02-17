<?php
/**
 * The template part for displaying post
 *
 * @package Sirat 
 * @subpackage sirat
 * @since Sirat 1.0
 */
?>
<?php 
  $sirat_archive_year  = get_the_time('Y'); 
  $sirat_archive_month = get_the_time('m'); 
  $sirat_archive_day   = get_the_time('d'); 
?>
<?php
  $content = apply_filters( 'the_content', get_the_content() );
  $video = false;

  // Only get video from the content if a playlist isn't present.
  if ( false === strpos( $content, 'wp-playlist-script' ) ) {
    $video = get_media_embedded_in_content( $content, array( 'video', 'object', 'embed', 'iframe' ) );
  }
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('inner-service'); ?>>
  <div class="post-main-box ">
    <?php
      if ( ! is_single() ) {
        // If not a single post, highlight the video file.
        if ( ! empty( $video ) ) {
          foreach ( $video as $video_html ) {
            echo '<div class="entry-video">';
              echo $video_html;
            echo '</div>';
          }
        };
      };
    ?>
    <div class="new-text">
      <h2 class="section-title"><a href="<?php echo esc_url(get_permalink()); ?>"><?php the_title();?><span class="screen-reader-text"><?php the_title(); ?></span></a></h2>
      <?php if( get_theme_mod( 'sirat_toggle_postdate',true) != '' || get_theme_mod( 'sirat_toggle_author',true) != '' || get_theme_mod( 'sirat_toggle_comments',true) != '') { ?>
        <div class="post-info">
          <?php if(get_theme_mod('sirat_toggle_postdate',true)==1){ ?>
            <span class="entry-date"><i class="<?php echo esc_attr(get_theme_mod('sirat_toggle_postdate_icon','fas fa-calendar-alt')); ?>"></i><a href="<?php echo esc_url( get_day_link( $sirat_archive_year, $sirat_archive_month, $sirat_archive_day)); ?>"><?php echo esc_html( get_the_date() ); ?><span class="screen-reader-text"><?php echo esc_html( get_the_date() ); ?></span></a></span><span><?php echo esc_html(get_theme_mod('sirat_meta_field_separator','|'));?></span>
          <?php } ?>

          <?php if(get_theme_mod('sirat_toggle_author',true)==1){ ?>
            <span class="entry-author"><i class="<?php echo esc_attr(get_theme_mod('sirat_toggle_author_icon','far fa-user')); ?>"></i><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' )) ); ?>"><?php the_author(); ?><span class="screen-reader-text"><?php the_author(); ?></span></a></span><span><?php echo esc_html(get_theme_mod('sirat_meta_field_separator','|'));?></span>
          <?php } ?>

          <?php if(get_theme_mod('sirat_toggle_comments',true)==1){ ?>
            <span class="entry-comments"><i class="<?php echo esc_attr(get_theme_mod('sirat_toggle_comments_icon','fas fa-comments')); ?>"></i><?php comments_number( __('0 Comment', 'sirat'), __('0 Comments', 'sirat'), __('% Comments', 'sirat') ); ?> </span><span><?php echo esc_html(get_theme_mod('sirat_meta_field_separator','|'));?></span>
          <?php } ?>
          <?php if( get_theme_mod( 'sirat_toggle_time',true) != '') { ?>
            <span class="entry-time"><i class="<?php echo esc_attr(get_theme_mod('sirat_toggle_time_icon','far fa-clock')); ?>"></i><?php echo esc_html( get_the_time() ); ?></span>
          <?php }?>
        </div>
      <?php } ?>
      <div class="entry-content">
        <?php $sirat_theme_lay = get_theme_mod( 'sirat_excerpt_settings','Excerpt');
          if($sirat_theme_lay == 'Content'){ ?>
            <?php the_content(); ?>
          <?php }
          if($sirat_theme_lay == 'Excerpt'){ ?>
            <?php if(get_the_excerpt()) { ?>
              <p><?php $excerpt = get_the_excerpt(); echo esc_html( sirat_string_limit_words( $excerpt, esc_attr(get_theme_mod('sirat_excerpt_number','30')))); ?> <?php echo esc_html(get_theme_mod('sirat_excerpt_suffix',''));?></p>
            <?php }?>
          <?php }?>
      </div>
      <?php if( get_theme_mod('sirat_button_text','READ MORE') != ''){ ?>
        <div class="more-btn">
          <a href="<?php echo esc_url(get_permalink()); ?>"><?php echo esc_html(get_theme_mod('sirat_button_text',__('READ MORE','sirat')));?><span class="screen-reader-text"><?php echo esc_html(get_theme_mod('sirat_button_text',__('READ MORE','sirat')));?></span></a>
        </div>
      <?php } ?>
    </div>
  </div>
</article>