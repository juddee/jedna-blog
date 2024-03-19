<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Jedna_Blog
 */

?>
   
   <!-- footer -->
    <footer class="w-100">
        <div class="container pt-3">
            <div class="row text-center">
                <div class="col-lg-4 col-md-12 py-2">
                    <?php
                        // $custom_logo_id = get_theme_mod('custom_logo');
                        // $logo = wp_get_attachment_image_src($custom_logo_id, 'full');
                        // if ($logo):
                    ?>
                        <!-- <img src="<?php //echo esc_url($logo[0]); ?>" alt="<?php //echo bloginfo('name'); ?>"> -->
                    <?php //else: ?>
                        <span><?php echo bloginfo('name'); ?></span>
                    <?php //endif; ?>
                </div>
                <div class="col-lg-4 col-md-12 py-2">
                    <div class="d-flex justify-content-center  footer-social-icons">
                        <?php
                            // Get social media links from Customizer
                            $footer_social_media_links = get_theme_mod('footer_social_media_links', '[]');
                            // Parse social media links
                            $social_media_links = json_decode($footer_social_media_links, true);
                            // Output social media links
                            if (!empty($social_media_links)) 
                            {
                                foreach ($social_media_links as $link) {
                                    echo '<a href="' . esc_url($link['url']) . '"><i class="' . esc_attr($link['icon-class']) . '"></i></a>';
                                }
                            }
                        ?>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 py-2">
                    <p>All Rights Reserved  
                        <?php
                            echo date('Y').' ';
                            echo get_bloginfo('name');  
                        ?>
                    </p>

                </div>
            </div>
            <div class="text-center" style="opacity:0.5; font-size;11px;">
                <small>Theme by <a href="#">Juddee</a>  </small>
            </div>
        </div>
    </footer>
    <!-- footer end -->

	<?php wp_footer(); ?>

</body>
</html>