<!DOCTYPE html>
<html <?php language_attributes(); ?>> <!-- Set language attributes dynamically -->
<head>
    <meta charset="<?php bloginfo('charset'); ?>"> <!-- Use WordPress site charset -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Mobile responsive -->
    <?php wp_head(); ?> <!-- Required: Enqueues styles, scripts, and plugin code into the head -->
</head>
<body <?php body_class(); ?>> <!-- Add dynamic body classes for styling -->
<header>
    <div class="nav-container">
        <?php
        // Display the navigation menu assigned to "main-menu"
        wp_nav_menu(array(
            'theme_location' => 'main-menu', // Menu location registered in functions.php
            'container' => false, // No extra container element
            'menu_class' => 'menu' // CSS class for the <ul>
        ));
        ?>
    </div>
</header>
