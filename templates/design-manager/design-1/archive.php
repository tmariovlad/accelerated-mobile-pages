<?php global $redux_builder_amp;  ?>
<!doctype html>
<html amp <?php echo AMP_HTML_Utils::build_attributes_string( $this->get( 'html_tag_attributes' ) ); ?>>
<head>
	<meta charset="utf-8">
    <link rel="dns-prefetch" href="https://cdn.ampproject.org">
	<?php
	global $redux_builder_amp;
	if ( is_home() || is_front_page() || is_archive() ){
		global $wp;
		$current_archive_url 	= home_url( $wp->request );
		$amp_url 				= trailingslashit($current_archive_url);
		$remove 				= '/'. AMP_QUERY_VAR;
		$amp_url 				= str_replace($remove, '', $amp_url) ;
	} ?>
	<link rel="canonical" href="<?php echo $amp_url ?>">
	<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no">
	<?php do_action( 'amp_post_template_head', $this ); ?>
	<style amp-custom>
		<?php $this->load_parts( array( 'style' ) ); ?>
		<?php do_action( 'amp_post_template_css', $this ); ?>
	</style>
</head>

<body class="<?php echo esc_attr( $this->get( 'body_class' ) ); ?>">

<?php $this->load_parts( array( 'header-bar' ) ); ?>

<article class="amp-wp-article ampforwp-custom-index amp-wp-home">

	<?php do_action('ampforwp_post_before_design_elements') ?>

  <?php if ( is_archive() ) {
    the_archive_title( '<h3 class="page-title">', '</h3>' );
    the_archive_description( '<div class="taxonomy-description">', '</div>' );
  } ?>

		<?php  if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	        <div class="amp-wp-content amp-wp-article-header amp-loop-list">

		        <h1 class="amp-wp-title">
		            <?php  $ampforwp_post_url = get_permalink(); ?>
		            <a href="<?php  echo trailingslashit($ampforwp_post_url) . AMP_QUERY_VAR ;?>"><?php the_title() ?></a>
		        </h1>

				<div class="amp-wp-content-loop">

          <div class="amp-wp-meta">
              <time> <?php
                    printf( _x( '%1$s '. $redux_builder_amp['amp-translator-ago-date-text'], '%2$s = human-readable time difference', 'wpdocs_textdomain' ),
                          human_time_diff( get_the_time( 'U' ),
                          current_time( 'timestamp' ) ) ); ?>
              </time>
          </div>

					<?php if ( has_post_thumbnail() ) { ?>
						<?php
						$thumb_id = get_post_thumbnail_id();
						$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'thumbnail', true);
						$thumb_url = $thumb_url_array[0];
						?>
						<div class="home-post-image">
							<a href="<?php  echo trailingslashit($ampforwp_post_url) . AMP_QUERY_VAR ;?>">
								<amp-img src=<?php echo $thumb_url ?> width=100 height=75></amp-img>
							</a>
						</div>
					<?php }
						if( has_excerpt() ){
							$content = get_the_excerpt();
						}else{
							$content = get_the_content();
						} ?>
					<p><?php echo wp_trim_words( $content , '20'); ?></p>
				</div>
	        </div>
	    <?php endwhile;  ?>
		    <div class="amp-wp-content pagination-holder">

		        <div id="pagination">
		            <div class="next"><?php next_posts_link( $redux_builder_amp['amp-translator-next-text']. ' &raquo;', 0 ) ?></div>
		            <div class="prev"><?php previous_posts_link( '&laquo; '. $redux_builder_amp['amp-translator-previous-text'] ); ?></div>
		            <div class="clearfix"></div>
		        </div>

		    </div>
		<?php endif; ?>

	<?php do_action('ampforwp_post_after_design_elements') ?>

</article>

<?php $this->load_parts( array( 'footer' ) ); ?>

<?php do_action( 'amp_post_template_footer', $this ); ?>

</body>
</html>