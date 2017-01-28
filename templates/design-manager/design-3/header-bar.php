<amp-sidebar id='sidebar'
    layout="nodisplay"
    side="left">
  <div class="toggle-navigationv2">
      <div role="button" tabindex="0" on='tap:sidebar.close' class="close-nav">X</div>
      <?php wp_nav_menu( array( 'theme_location' => 'amp-menu' ) ); ?>
  </div>
</amp-sidebar>

<div id="designthree" class="designthree main_container">
<header class="container">
  <div id="headerwrap">
      <div id="header">
        <div class="hamburgermenu">
            <button class="toast pull-left" on='tap:sidebar.toggle'><span></span></button>
        </div>
        <div class="headerlogo">
        <?php global $redux_builder_amp;
          if ($redux_builder_amp['amp-on-off-support-for-non-amp-home-page']) {
            $ampforwp_home_url = trailingslashit( get_bloginfo('url') );
          }else{
            $ampforwp_home_url = trailingslashit( get_bloginfo('url') ) . '?' . AMP_QUERY_VAR;
          }
        ?>
        <?php if ( true == ($redux_builder_amp['opt-media']['url']) ) {  ?>
          <a href="<?php echo esc_url( $ampforwp_home_url ); ?>">
              <amp-img src="<?php echo $redux_builder_amp['opt-media']['url']; ?>" width="190" height="36" alt="logo" class="amp-logo"></amp-img>
          </a>
        <?php } else { ?>
          <h1><a href="<?php echo esc_url( $ampforwp_home_url ); ?>"><?php bloginfo('name'); ?></a></h1>
        <?php } ?>
        </div>
        <div class="searchmenu"><button on="tap:search-icon"><i class="icono-search"></i></button>          </div>
      </div>
  </div>
</header>