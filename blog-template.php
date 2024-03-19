<?php
/* Template Name: Blog Template */

get_header();
?>

<!-- post-category-2 -->
<div class="post-category-2 my-3">
    <div class="container">

        <div class="row">
            <?php 
            // Set up the main query to retrieve all posts
            $args = array(
                'post_type' => 'post',
                // 'posts_per_page' => 16, // Number of posts per page
                'paged' => get_query_var('paged') ? get_query_var('paged') : 1 // Get current page number
            );
            $query = new WP_Query($args);

            if ($query->have_posts()) : 
                /* Start the Loop */
                while ($query->have_posts()) :
                    $query->the_post();    
                    $post_category = get_the_category();
                    $post_author_name = get_the_author();
                    $post_author_url = get_author_posts_url(get_the_author_meta('ID'));
                    $post_thumbnail_url = get_the_post_thumbnail_url();
                    $post_thumbnail_url = empty($post_thumbnail_url) ? get_template_directory_uri().'/public/images/no-thumbnail.png' : $post_thumbnail_url;
            ?>
                    <div class="col-lg-6 col-md-6 col-sm-12 my-3">
                        <div class="card">
                            <img src="<?php echo $post_thumbnail_url; ?>" class="card-img-top" alt="...">
                            <div class="card-body">
                                <div class="post-author o-7 py-2">
                                    <a href="<?php echo $post_author_url; ?>">By <?php echo ' '.$post_author_name; ?></a>
                                    <a href="<?php echo get_category_link($post_category[0]->term_id); ?>" class="category-card btn"><?php echo $post_category[0]->name; ?></a>
                                </div>
                                <a href="<?php echo get_permalink(); ?>" class="card-title">
                                    <h5><?php the_title(); ?></h5>
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
            <?php wp_reset_postdata(); // Reset post data after custom query ?>

        </div>

        <!-- pagination -->
        <?php 
        // Pagination
        if ($query->max_num_pages > 1) : 
            $prev_page_url = get_previous_posts_page_link();
            $next_page_url = get_next_posts_page_link();
            $total_pages = $query->max_num_pages;
            $current_page = max(1, get_query_var('paged'));
        ?>
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item">
                        <a class="page-link" href="<?php echo $prev_page_url; ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <?php 
                        for ($i=1; $i <= $total_pages; $i++) 
                        { 
                            $active_page = ($current_page == $i) ? 'active bg-pry': '';
                            echo '<li class="page-item">
                                        <a href="'.home_url('').'/blog/page/'.$i.'" class="page-link '.$active_page.' ">'.$i.'</a>
                                  </li>';
                        }
                    ?>
                    
                    <li class="page-item">
                        <a class="page-link" href="<?php echo $next_page_url; ?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>    
                    </li>
                </ul>
            </nav>
        <?php endif; ?>
        <!-- pagination end -->
    </div>
</div>
<!-- post-category-2 end -->


<?php
get_footer();
