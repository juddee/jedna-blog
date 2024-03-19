<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Jedna_Blog
 */

get_header();
?>

    <!-- post-category-2 -->
    <div class="post-category-2 my-3">
        <div class="container">
            <!--  -->
            <div class="section-title py-3">
                <h4 class=" search-query w-100">
                    <span>Search Result for : </span>
                    <form action="<?php echo home_url('/'); ?>" method="get">
                        <input type="hidden" name="post_type" value="post">
                        <input type="text"  placeholder=" Search .." class="form-control mt-2" value="<?php echo the_search_query(); ?>" name="s" id="s"> 
                    </form>
                </h4>
            </div>
            <!--  -->
            <div class="row">
                <?php 
                    if( have_posts() ) : 
                        /* Start the Loop */
			            while ( have_posts() ) :
				        the_post();    
                        $post_category = get_the_category();
                        $post_author_name = get_author_name();
                        $post_author_url = get_the_author_meta('nicename');
                        $post_thumbnail_url = get_the_post_thumbnail_url();
                        $post_thumbnail_url = empty($post_thumbnail_url) ? get_template_directory_uri().'/public/images/no-thumbnail.png' : $post_thumbnail_url;

                        
                ?>
                        <div class="col-lg-6 col-md-6 col-sm-12 my-3">
                            <div class="card">
                                <img src="<?php echo $post_thumbnail_url; ?>" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <div class="post-author o-7 py-2">
                                        <a href="<?php echo home_url('').'/author/'.$post_author_url; ?>">By <?php echo ' '.$post_author_name; ?></a>
                                        <a href="<?php echo home_url('').'/category/'.$post_category[0]->slug; ?>" class="category-card btn"><?php echo $post_category[0]->name; ?></a>
                                    </div>
                                    <a href="<?php echo get_permalink(); ?>" class="card-title">
                                        <h5 ><?= the_title(); ?></h5>
                                    </a>
                                </div>
                            </div>
                        </div>
                <?php endwhile; ?>
                <?php else: ?>
                    <div class="col-lg-6 col-md-6 col-sm-12 my-3 p-3">
                        <h3 class="card" style="min-height: 60vh;">No result found!</h3>
                    </div>
                <?php endif; ?>

            </div>

            <!-- pagination -->
            <?php 
            // Pagination
            global $wp_query;

            $prev_page_url = get_previous_posts_page_link();
            $next_page_url = get_next_posts_page_link();
            $total_pages = $wp_query->max_num_pages;
            $current_page = max(1, get_query_var('paged'));
            if($total_pages > 1):
            ?>
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item">
                            <a class="page-link" href="<?php echo esc_url($prev_page_url); ?>" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <?php 
                        for ($i = 1; $i <= $total_pages; $i++) { 
                            $active_page = ($current_page == $i) ? 'active bg-pry' : '';
                            echo '<li class="page-item ' . $active_page . '">
                                    <a href="' . get_pagenum_link($i) . '" class="page-link">' . $i . '</a>
                                </li>';
                        }
                        ?>
                        <li class="page-item">
                            <a class="page-link" href="<?php echo esc_url($next_page_url); ?>" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            <?php endif?>
        <!-- pagination end -->
        </div>
    </div>
    <!-- post-category-2 end -->

<?php
get_footer();
