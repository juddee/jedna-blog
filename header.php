
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<?php wp_head(); ?>
</head>
<body class="bg-pry">
<?php wp_body_open(); ?>

    <!-- header -->
    <header class="">
        <nav class="navbar navbar-expand-lg container py-3">
            <div class="container py-3 align-items-end">
                <a class="navbar-brand d-flex align-items-center " href="<?php echo esc_url(home_url('/')); ?>">
                    <?php
                        $custom_logo_id = get_theme_mod('custom_logo');
                        $logo = wp_get_attachment_image_src($custom_logo_id, 'full');
                        if ($logo):
                    ?>
                        <img src="<?php echo esc_url($logo[0]); ?>" alt="<?php echo bloginfo('name'); ?>">
                    <?php else: ?>
                        <span class="d-inline-block mt-2 pt-1"><?php echo bloginfo('name'); ?></span>
                    <?php endif; ?>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">


                    <?php
                        // Function to check if a menu item is active
                        function is_menu_item_active($menu_item_url)
                        {
                            // Get the current page URL
                            $current_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

                            // Compare the menu item URL with the current page URL
                            return ($menu_item_url === $current_url);
                        }

                        // Get the primary menu
                        $menu_items = wp_get_nav_menu_items('primary');

                        if ($menu_items) {
                            foreach ($menu_items as $menu_item) {
                                if ($menu_item->menu_item_parent == 0) {
                                    // Check if the menu item is active
                                    $is_active = is_menu_item_active($menu_item->url);
                                    $has_active_submenu = array_filter($menu_items, function ($item) use ($menu_item){
                                        if($item->menu_item_parent == $menu_item->ID && is_menu_item_active($item->url))
                                        {
                                            return true;
                                        }
                                    });
                                    $submenu_items = array_filter($menu_items, function ($item) use ($menu_item){
                                        if($item->menu_item_parent == $menu_item->ID)
                                        {
                                            return $item;
                                        }
                                    });
                                    if(!empty($submenu_items))
                                    {
                                        echo '<li class="nav-item dropdown">
                                                    <a href="#" class="nav-link dropdown-toggle ' . ($is_active || $has_active_submenu ? ' active' : '') . ' " href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        '.$menu_item->title.'
                                                    </a>
                                                    <ul class="dropdown-menu">';
                                        foreach($menu_items as $submenu)
                                        {
                                            if($submenu->menu_item_parent == $menu_item->ID)
                                            {
                                                echo '<li><a class="dropdown-item" href="'.$submenu->url.'">'.$submenu->title.'</a></li>';
                                            }
                                        }
                                        echo            '</ul>
                                                </li>';
                                    }else
                                    {
                                        echo '<li class="nav-item">
                                            <a class="nav-link ' . ($is_active ? ' active' : '') . '" aria-current="page" href="'.$menu_item->url.'">'.$menu_item->title.'</a>
                                        </li>';
                                    }
                                }
                            }
                        }
                    ?>

                    </ul>

                    <div class="search-sec d-lg-flex align-items-center">
                        <form method='GET' action="<?php echo esc_url(home_url('')); ?>" id="collapseExample" class="collapse">
                            <input type="text" placeholder=" Search website" class=" form-control" name="s">
                            <input type="hidden" name="post_type" value="post">
                        </form>
                        <i class="fa-solid fa-magnifying-glass header-search-btn"
                            type="button" 
                            data-bs-toggle="collapse" 
                            data-bs-target="#collapseExample" 
                            aria-expanded="false" 
                            aria-controls="collapseExample"
                            ></i>
                    </div>
                    <div class="sm-search d-sm-block d-lg-none d-md-none">
                        <input type="text" placeholder=" Search website" class=" form-control w-100">
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <!-- header ends -->
