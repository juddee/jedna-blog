<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Jedna_Blog
 */

get_header();
?>

    <!-- main.content -->
    <main class=" py-4 container">
        <div class="wrapper-404 text-center">
            <img src="<?= get_template_directory_uri().'/public/images/404.png'; ?>" alt="404" class="image-404 image-fluid w-100">
            <div class="pt-1" >
                <a href="<?= home_url(''); ?>" class="">
                    <i class="fa-solid fa-arrow-rotate-left"></i>
                    <span>Go Home</span>
                </a>
            </div>
        </div>

    </main>
    <!-- main.content end -->

<?php
get_footer();
