        <!--// END PAGE //-->

        <!--// BEGIN FOOTER //-->

        </div><!--/content-->

    </div><!--/container-->

    <footer id="footer" class="clearfix">

        <div class="container">

            <div id="footer-logo" class="footer-block">
                <a href="/"><img src="<?php bloginfo( 'stylesheet_directory' );?>/library/images/ucla-logo.png" alt="UCLA" /></a>
            </div>

            <?php if ( is_active_sidebar( 'sidebar-footer-first' ) ) : ?>
                <div id="sidebar-footer-first" class="footer-block widget-area" role="complementary">
                    <?php dynamic_sidebar( 'sidebar-footer-first' ); ?>
                </div>
            <?php endif; ?>

            <?php if ( is_active_sidebar( 'sidebar-footer-second' ) ) : ?>
                <div id="sidebar-footer-second" class="footer-block widget-area" role="complementary">
                    <?php dynamic_sidebar( 'sidebar-footer-second' ); ?>
                </div>
            <?php endif; ?>

            <?php if ( is_active_sidebar( 'sidebar-footer-third' ) ) : ?>
                <div id="sidebar-footer-third" class="footer-block widget-area" role="complementary">
                    <?php dynamic_sidebar( 'sidebar-footer-third' ); ?>
                </div>
            <?php endif; ?>

            <?php if ( is_active_sidebar( 'sidebar-footer-forth' ) ) : ?>
                <div id="sidebar-footer-forth" class="footer-block widget-area" role="complementary">
                    <?php dynamic_sidebar( 'sidebar-footer-forth' ); ?>
                </div>
            <?php endif; ?>

        </div>

        <div class="container sub-footer">

            <?php if ( is_active_sidebar( 'sidebar-sub-footer' ) ) : ?>
                <div id="sidebar-sub-footer" class="container clearfix hospitality-group widget-area" role="complementary">
                    <?php dynamic_sidebar( 'sidebar-sub-footer' ); ?>
                </div>
                
            <?php endif; ?>

        </div>

    </footer>

    <?php wp_footer(); ?>

    <?php the_field( 'third_party_snippets', 'option' ); ?>

</body>
</html>
