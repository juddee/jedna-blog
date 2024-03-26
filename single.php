<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Jedna_Blog
 */

get_header();
?>

    <!-- header ends -->
    <main class="container content py-3">
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-12">
                <!-- post-metadata -->
                <?php 
                    while ( have_posts() ) :
                        the_post();
                        $post_category = get_the_category();
                        $post_thumbnail_url = get_the_post_thumbnail_url();
                        $formatted_publiched_date = date('F m y', strtotime(get_the_date()));
                        
                ?>
                    <div class="post-metadata my-3">
                        <h1><?php echo the_title(); ?></h1>
                        <h6 class=""><?php ?></h6>
                        <h6>
                            <?php echo $formatted_publiched_date; ?>
                            <a href="#" class="post-author" style=""> <?php jedna_blog_posted_by();?></a> in
                            | <a href="<?php echo home_url().'/category/'.$post_category[0]->slug ?>" class="post-category"> <?php echo $post_category[0]->name; ?></a>
                        </h6>
                    </div>
                    <!-- post-metadata end -->
                    <!--  -->
                    <div class="details pb-4 pt-1">
                        <?php
                                        the_content(
                                            sprintf(
                                                wp_kses(
                                                    /* translators: %s: Name of current post. Only visible to screen readers */
                                                    __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'jedna-blog' ),
                                                    array(
                                                        'span' => array(
                                                            'class' => array(),
                                                        ),
                                                    )
                                                ),
                                                wp_kses_post( get_the_title() )
                                            )
                                        );
                        ?>
                    </div>
                    <!--  -->
                <?php the_post_navigation( array(
                    'prev_text'  => __( '<i class="fa-solid fa-arrow-left"></i> %title' ),
                    'next_text'  => __( '%title <i class="fa-solid fa-arrow-right"></i>' ),
                    ) );
                ?>
                <?php

                    // If comments are open or we have at least one comment, load up the comment template.
                    if ( comments_open() || get_comments_number() ) :
                        comments_template();
                    endif;
                ?>
                <?php endwhile; ?>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
                <?php dynamic_sidebar('sidebar-1') ?>
            </div>
        </div>

    </main>

<?php
    get_footer();