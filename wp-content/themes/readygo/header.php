<!DOCTYPE html>
<html lang="en-us">
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php bloginfo('name'); ?> - <?php is_front_page() ? the_title() : wp_title(''); ?></title>
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <link href="https://fonts.googleapis.com/css?family=Raleway:400,700,400italic,700italic,800,800italic" rel="stylesheet" type="text/css">
    <link href="<?php echo get_stylesheet_directory_uri(); ?>/style.css" rel="stylesheet" type="text/css">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <header class="header" role="banner">
        <div class="header-brand">
            <a href="/"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/logo-white@2x.png" width="94" height="50" alt="" /></a>
        </div>
        <div class="header-ss-right">
            <a href="#" id="mobile-menu-btn" class="menu-btn">
                <div class="menu-btn-line"></div>
                <div class="menu-btn-line"></div>
                <div class="menu-btn-line"></div>
            </a>
        </div>
        <nav class="nav" role="navigation"><?php wp_nav_menu( array( 'theme_location' => 'nav-menu' ) ); ?></nav>
    </header>
    <nav class="mobile-menu" id="mobile-menu" role="navigation">
        <ul>
            <li><a href="/tools/">Browse Tools</a></li>
            <li><a href="/collections/">Collections</a></li>
            <li><a href="/how-it-works/">How It Works</a></li>
            <li><a href="/in-the-community/">In The Community</a></li>
        </ul>
    </nav>