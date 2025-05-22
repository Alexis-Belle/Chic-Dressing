<?php 

// Charger les styles du parent et du thème enfant
add_action( 'wp_enqueue_scripts', 'chicdressing_enqueue_styles' );
function chicdressing_enqueue_styles() {
    // Charger le style du thème parent
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    
    // Charger le style du thème enfant
    wp_enqueue_style( 'chicdressing-theme', get_stylesheet_directory_uri() . '/css/theme.css', array('parent-style') );
}

// Désactiver le redimensionnement des grandes images
add_filter( 'big_image_size_threshold', '__return_false' );

/**
 * Wrapper optimisé pour wp_get_attachment_image_src()
 * Remplace automatiquement 'full' par 'medium' pour éviter de charger pleinement l’image originale.
 */
function get_smart_image( $attachment_id, $size = 'full', $icon = false ) {
    if ( $size === 'full' ) {
        $size = 'medium';
    }
    return wp_get_attachment_image_src( $attachment_id, $size, $icon );
}


// Applique un filtre pour modifier les balises des titres de widgets
add_filter( 'dynamic_sidebar_params', 'chicdressing_widget_titles_h4' );
function chicdressing_widget_titles_h4( $params ) {
    // Remplace les balises de titre par <h4>
    $params[0]['before_title'] = '<h4 class="widget-title">';
    $params[0]['after_title']  = '</h4>';
    return $params;
}

