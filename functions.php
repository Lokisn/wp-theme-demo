<?php

// Lier la feuille de style et les fonts au projet 

function simplenews_enqueue_styles(){
    // Ajout des fonts à l'aide d'une variable
    wp_enqueue_style( 'latofont', 'https://fonts.googleapis.com/css2?family=Lato&display=swap' );
    wp_enqueue_style( 'merrifont', 'https://fonts.googleapis.com/css2?family=Merriweather+Sans&display=swap' );

    wp_enqueue_style( 'maincss', get_template_directory_uri() . '/styles/main.css', array('latofont', 'merrifont')  );
}

add_action( 'wp_enqueue_scripts', 'simplenews_enqueue_styles' );

// Supports de thème :
function simplenews_add_theme_support(){
    add_theme_support( 'post-thumbnails' );

    // Adapter le title de la page en fonction du contenu affiché 
    add_theme_support('title-tag');
}

add_action( 'after_setup_theme', 'simplenews_add_theme_support' );

// Déclarer les menus 
function simplenews_register_menus(){
   
    register_nav_menus( array(
        'main-menu' => __('Menu principal')
    ));
}

add_action( 'after_setup_theme', 'simplenews_register_menus');

?>