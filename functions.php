<?php

function simplenews_init() 
{
    simplenews_register_reportage_post_type();
    simplenews_register_reportage_taxonomies();
}
add_action( 'init', 'simplenews_init');

//----------------------------------------------------------------
// Ajout du Reportage post type
function simplenews_register_reportage_post_type()
{
	$labels = [
		'name'                     => __("Reportages", "simplenews"),
		'singular_name'            => __("Reportage", "simplenews"),
		'add_new'                  => _x("Ajouter", "simplenews"),
		'add_new_item'             => __("Ajouter un reportage", "simplenews"),
		'edit_item'                => __("Modifier le reportage", "simplenews"),
		'new_item'                 => __("Nouveau reportage", "simplenews"),
		'view_item'                => __("Afficher le reportage", "simplenews"),
		'view_items'               => __("Afficher les reportages", "simplenews"),
		'search_items'             => __("Rechercher les reportage", "simplenews"),
		'not_found'                => __("Aucun reportage n'a été trouvé", "simplenews"),
		'not_found_in_trash'       => __("Aucun reportage n'a été trouvé dans la corbeille", "simplenews"),
		'all_items'                => __("Tous les reportages", "simplenews"),
		'archives'                 => __("Archives des reportages", "simplenews"),
		'attributes'               => __("Attributs du reportage", "simplenews"),
		'insert_into_item'         => __("Insérer dans le reportage", "simplenews"),
		'uploaded_to_this_item'    => __("Téléverser dans le reportage", "simplenews"),
		'featured_image'           => __("Image du reportage", "simplenews"),
		'set_featured_image'       => __("Assigner l'image au reportage", "simplenews"),
		'remove_featured_image'    => __("Retirer l'image du reportage", "simplenews"),
		'use_featured_image'       => __("Utiliser l'image du reportage", "simplenews"),
		'filter_items_list'        => __("Filtrer la liste des reportages", "simplenews"),
		'items_list_navigation'    => __("Liste de navigation des reportages", "simplenews"),
		'items_list'               => __("Liste des reportages", "simplenews"),
		'item_published'           => __("Le reportage a été publié", "simplenews"),
		'item_published_privately' => __("Le reportage a été publié en privé", "simplenews"),
		'item_reverted_to_draft'   => __("Le reportage a été remis en brouillon", "simplenews"),
		'item_scheduled'           => __("Le reportage a été planifié", "simplenews"),
		'item_updated'             => __("Le reportage a été mis à jour", "simplenews")
	];
 
	$args = [
		'labels'              => $labels,
		'description'         => __("Contenu de type reportage", "simplenews"),
		'public'              => true,
		'menu_icon'           => 'dashicons-video-alt',
		'menu_position'       => 5,
		'supports'            => ['title', 'editor', 'thumbnail'],
		'rewrite'             => ['slug' => 'reportages']
	];
 
	register_post_type("reportages", $args);
}

//----------------------------------------------------------------
// Ajout du Reportage Taxonomies
function simplenews_register_reportage_taxonomies()
{
	$labels = [
		"name"          => _x("Types", "simplenews"),
		"singular_name" => _x('Type', 'simplenews'),
		"menu_name"     => __('Types', 'simplenews'),
		"all_items"     => __("Toutes les types", "simplenews"),
		"edit_item"     => __("Modifier le type", "simplenews"),
		"view_item"     => __("Afficher le type", "simplenews"),
		"update_item"   => __('Mettre à jour le type', "simplenews"),
		"add_new_item"  => __("Ajouter un type", "simplenews"),
		"new_item_name" => __("Nouveau nom du type", "simplenews"),
		"search_items"  => __("Rechercher des types", "simplenews"),
		"popular_items" => __("Types populaires", "simplenews"),
		"back_to_items" => __("Revenir aux types", "simplenews")
	];
 
	$args = [
		"hierarchical"      => true,
		"labels"            => $labels,
		"show_ui"           => true,
		"show_in_menu"      => true,
		"show_admin_column" => true,
		"query_var"         => true,
		"rewrite"           => [
			"slug" => "types"
		]
	];
 
	register_taxonomy("types_reportage", ["reportages"], $args);
}


//----------------------------------------------------------------
// Lier : Css + fonts + Libs + Javascript :
function simplenews_enqueue_styles(){
    // Ajout des fonts à l'aide d'une variable
    wp_enqueue_style( 'latofont', 'https://fonts.googleapis.com/css2?family=Lato&display=swap' );
    wp_enqueue_style( 'merrifont', 'https://fonts.googleapis.com/css2?family=Merriweather+Sans&display=swap' );
    wp_enqueue_style( 'maincss', get_template_directory_uri() . '/styles/main.css', array('latofont', 'merrifont')  );

    // Intégrer la librairie Splide [JS + CSS] (nom + lien)
    wp_enqueue_script( 'splidejs', 'https://cdn.jsdelivr.net/npm/@splidejs/splide@3.6.12/dist/js/splide.min.js');
    wp_enqueue_style( 'splidecss', 'https://cdn.jsdelivr.net/npm/@splidejs/splide@3.6.12/dist/css/splide.min.css');
    
    // Intégrer la librairie Lightbox [JS + CSS] (nom + lien)
    wp_enqueue_script( 'lightboxjs', get_template_directory_uri()."/js/simpleLightbox.min.js");
    wp_enqueue_style( 'lightboxcss', get_template_directory_uri()."/styles/simpleLightbox.min.css");
    
    // Intégration du main Javascript 
    wp_enqueue_script( 'mainjs', get_template_directory_uri()."/js/main.js", array('splidejs') );

    // Désactiver les styles globaux 
    wp_dequeue_style('global-styles');
    wp_dequeue_style('wp-block-library');
}
add_action( 'wp_enqueue_scripts', 'simplenews_enqueue_styles' );

//----------------------------------------------------------------
// Ajout de notre thème dans les choix admins :
function simplenews_add_theme_support(){
    add_theme_support( 'post-thumbnails' );
    // Adapter le title de la page en fonction du contenu affiché 
    add_theme_support('title-tag');
}
add_action( 'after_setup_theme', 'simplenews_add_theme_support' );

//----------------------------------------------------------------
// Déclaration des menus :
function simplenews_register_menus(){
    register_nav_menus( array(
        'main-menu' => __('Menu principal')
    ));
}
add_action( 'after_setup_theme', 'simplenews_register_menus');

//----------------------------------------------------------------
// Widgets :
function simplenews_widgets_init($id){
    register_sidebar( array(
        'name' => 'Widget 1', 
        'id' => 'widget-1',
        'description' => 'Widget affiché en haut du Sidebar',
        'before_widget' => '<div class="side-widget">',
        'after_widget' => '</div>'
    ));

    register_sidebar( array(
        'name' => 'Widget 2', 
        'id' => 'widget-2',
        'description' => 'Widget affiché en bas du Sidebar',
        'before_widget' => '<div class="side-widget">',
        'after_widget' => '</div>'
    ));
}
add_action( 'widgets_init', 'simplenews_widgets_init' );

//----------------------------------------------------------------
// Appel fonction nettoyage :
include('includes/clean.php');