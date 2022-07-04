<?php

if(!defined('ABSPATH')) exit;

/* [quizbook preguntas=num orden=num] */

function quizbook_shorcode( $atts ){
   
    $args = array(
        'post_type' => 'quizes',
        'posts_per_page' => $atts['preguntas'],
        'orderby' => $atts['orden'],
    ); 

    $quizbook = new WP_Query($args); ?>
    
    <?php ob_start(); ?>
    <!-- Dibujamos un Form -->
    <?php include_once plugin_dir_path(__FILE__) . './form.php'; ?>
    <!-- FIN Dibujamos un Form -->
    <?php $output = ob_get_clean(); ?>
    <?php return $output; ?>
<?php
}

add_shortcode( 'quizbook', 'quizbook_shorcode' );

?>