<?php get_header(); ?>



    <?php 
        $featured_post_id = get_theme_mod('featured_post',0);

        $featured_recent_posts_ids =  get_theme_mod('recent_posts','');

        $featured_category_id = get_theme_mod('specific_category',0);

        // print_r($featured_recent_posts_ids); 
    ?>
    <!-- hero section -->
    <section class="hero my-3 bg-pry">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-12 mb-3">
                <!--cc  -->
                    <?php 
                    if(!empty($featured_post_id)): 
                        $featured_post = get_post($featured_post_id);
                        $featured_post_url = get_permalink($featured_post_id);
                        $featured_post_author = get_author_name($featured_post->post_author);

                        $original_image_src = wp_get_attachment_image_src(get_post_thumbnail_id($featured_post_id), 'full');
                        // $cat_post_thumbnail_url = $original_image_src[0];

                        // Check if the featured post has a thumbnail
                         $featured_post_thumbnail_img_src = !empty($original_image_src) ? $original_image_src[0] : get_template_directory_uri().'/public/images/no-thumbnail.png';
                         
                    ?>

                            <a href="<?= $featured_post_url; ?>" class="latest-post" style="background-image: url('<?= $featured_post_thumbnail_img_src ?>'); background-repeat: no-repeat; background-size: cover; background-position: center; ">
                                <div class="write-up p-4" style='backdrop-filter: brightness(50%); width:100%;'>
                                    <div class="post-author py-3 o-7">By <?= $featured_post_author; ?></div>
                                    <div class="post-title "><?= $featured_post->post_title; ?></div>
                                </div>
                            </a>
                    <?php 
                        
                    endif; 
                    ?>

                <?php if(empty($featured_post_id)): ?>
                    <?php 
                    if(have_posts()) { 
                        $default_featured_post = get_post();
                        $default_featured_post_author = get_author_name($default_featured_post->post_author);
                        $default_featured_post_url = get_permalink($default_featured_post->ID);
                        $default_original_image_src = wp_get_attachment_image_src(get_post_thumbnail_id($default_featured_post->ID), 'full');

                        // Check if the default featured post has a thumbnail
                        $default_featured_post_thumbnail_url  = !empty($default_original_image_src) ?  $default_original_image_src[0] : get_template_directory_uri().'/public/images/no-thumbnail.png';
                            
                    ?>
                            <a href="<?= $default_featured_post_url; ?>" class="latest-post" style="background-image: url('<?= $default_featured_post_thumbnail_url ?>'); background-repeat: no-repeat; background-size: cover; background-position: center; ">
                                <div class="write-up p-4" style="backdrop-filter: brightness(50%); width:100%;">
                                    <div class="post-author py-3 o-7">By <?= $default_featured_post_author; ?> </div>
                                    <div class="post-title "><?= $default_featured_post->post_title; ?></div>
                                </div>
                            </a>
                    <?php    
                        
                    }
                    ?>
                <?php endif; ?>

                <!-- cc -->
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="sidebar">
                        
                            <div class="title w-100 d-flex justify-content-between align-items-end pb-4 border-bottom">
                                <strong>Reading List</strong>
                                <!-- <a href="" class="">View all new</a> -->
                            </div>
                            <div class="sidebar-post-items">
                                <?php 
                                    if($featured_recent_posts_ids): 
                                        $featured_recent_post_count = 1;
                                        $featured_recent_post_count_limit = 4;
                                        foreach(explode(',',$featured_recent_posts_ids) as $recent_featured_post_id):
                                            if($featured_recent_post_count <= $featured_recent_post_count_limit):
                                                $recent_featured_post = get_post($recent_featured_post_id);
                                                $recent_featured_post_url = get_permalink($recent_featured_post_id);
                                                $formatted_publiched_date = date('F m y', strtotime($recent_featured_post->post_date));

                                                // print_r($formatted_publiched_date);

                                ?>
                                            <div class="sidebar-post-item py-3">
                                                <div class="sidebar-post-date 0-7"><?= $formatted_publiched_date; ?></div>
                                                <a href="<?= $recent_featured_post_url; ?>" class="sidebar-post-title"> 
                                                    <strong><?= $recent_featured_post->post_title; ?></strong>
                                                </a>
                                            </div>
                                <?php 
                                        endif;
                                        $featured_recent_post_count++;
                                        endforeach;
                                    endif; 
                                ?>
                            </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- hero section end -->

    
    <!-- post-category-1 -->
    <?php if(get_theme_mod('show_specific_category')): ?>

    <div class=" post-category-1 bg-pry">
        <div class="container">
            <?php 
                $featured_category_id = get_theme_mod('specific_category');
                // print_r($featured_category_id);
                if($featured_category_id):
                    $featured_category = get_category($featured_category_id);

                    // prepare query args
                    $args = array(
                        'category' => $featured_category_id,
                        'posts_per_page' => 3,
                    );
                    
                    $featured_category_posts = get_posts($args);
                    if(!empty($featured_category_posts)):
            ?>
                    <!--  -->
                    <div class="section-title d-flex justify-content-between align-items-end py-3">
                        <h3><?php echo  $featured_category->name; ?></h3>
                        <a href="<?php echo  home_url().'/category/'.$featured_category->slug.'/'; ?>" class="o-7">View all</a>
                    </div>
                    <!--  -->
                    <div class="row">
                <!-- ccc  -->
                    <?php 
                    foreach($featured_category_posts as $cat_post): 
                        $post_author = get_author_name($cat_post->post_author);
                        // Check if the post has a featured image
                        if(has_post_thumbnail($cat_post->ID)) {
                            $cat_post_original_image_src = wp_get_attachment_image_src(get_post_thumbnail_id($cat_post->ID), 'full');
                            
                            $cat_post_thumbnail_url = $cat_post_original_image_src[0];
                        } else {
                            // If no featured image is set, provide a default image URL
                            $cat_post_thumbnail_url = get_template_directory_uri() . '/public/images/no-thumbnail.png';
                        }
                        $cat_post_url = get_permalink($cat_post->ID);
                    ?>
                        <div class="col-lg-4 col-md-4 col-sm-6 my-2">
                            <a href="<?= $cat_post_url; ?>" class="post-wrapper d-flex justify-content-center align-items-center" style="background-image: url('<?= $cat_post_thumbnail_url; ?>'); background-repeat: no-repeat; background-size: cover; background-position: center;">
                                <div class="write-up p-3" style='backdrop-filter: brightness(50%); width:100%; height:100%;'>
                                    <div class="post-author py-2 o-7"><?= $post_author; ?></div>
                                    <div class="post-title "><?= $cat_post->post_title; ?></div>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; wp_reset_postdata(); ?>

                <!--ccc  -->
                    </div>
            <?php
                    
                    endif;
                endif;
            ?>
        </div>
    </div>
    <?php endif; ?>
    <!-- post-category-1 end -->

    <!-- post-category-2 -->
    <div class="post-category-2 my-5">
        <div class="container">
            <!--  -->
            <div class="section-title d-flex justify-content-between align-items-end py-3">
                <h3>Latest Post</h3>
                <a href="<?= home_url('').'/blog/'; ?>" class="o-7">View all</a>
            </div>
            <!--  -->
            <div class="row">
                <?php 
                    $latest_posts_args = array(
                        'posts_per_page'=> 20,
                        'orderby' =>'date',
                        'order' => 'DESC',
                        'post_type' => 'post',
                    );

                    $latest_posts = get_posts($latest_posts_args);
                    if(!empty($latest_posts)):
                        foreach($latest_posts as $latest_post):
                            setup_postdata($latest_post);
                            // print_r($latest_post);
                            $latest_post_url = get_permalink($latest_post->ID);
                            $latest_post_author = get_author_name($latest_post->post_author);
                            $latest_post_thumbnail_url = get_the_post_thumbnail_url($latest_post->ID,'full');

                            $latest_post_category = get_the_category($latest_post->ID);
                            // if no thumbnail in post use default no-thumbnail img
                            $latest_post_thumbnail_url=  empty($latest_post_thumbnail_url) ? get_template_directory_uri().'/public/images/no-thumbnail.png' : $latest_post_thumbnail_url;
                ?>
                    <div class="col-lg-6 col-md-6 col-sm-12 my-3">
                        <div class="card">
                            <img src="<?= $latest_post_thumbnail_url; ?>" class="card-img-top" alt="...">
                            <div class="card-body">
                                <div class="post-author o-7 py-2">
                                    <a href="<?php echo home_url('').'/author/'.get_the_author_meta('nicename', $latest_post->post_author); ?>">By <?= $latest_post_author; ?></a>
                                    <a href="<?= home_url('').'/category/'.$latest_post_category[0]->slug.'/'; ?>" class="category-card btn"><?= $latest_post_category[0]->name; ?></a>
                                </div>
                                <a href="<?= $latest_post_url; ?> " class="card-title">
                                    <h5 ><?= $latest_post->post_title; ?></h5>
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php else : ?>
                    <div class="col-lg-6 col-md-6 col-sm-12 my-3">
                        <div class="text-center card">
                            No post yet!!
                        </div>
                    </div>
                <?php endif; ?>
                
            </div>
        </div>
    </div>
    <!-- post-category-2 end -->


<?php
get_footer();