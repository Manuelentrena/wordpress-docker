<?php

/* Agrega css y js al frontview */
function quizbook_frontedview_styles() {
    /* Lo carga en todas las paginas del frontview */
    wp_enqueue_style( 'quizbook_view_css', plugins_url( '../../assets/css/quizbook.css', __FILE__ ) );

    wp_enqueue_script( 'quizbook_view_js', plugins_url( '../../assets/js/quizbook.js', __FILE__ ), null, 1.0, true );
    /* Le enviamos a  quizbook_view_js el dato de admin_url */
    wp_localize_script('quizbook_view_js', 'admin_url', array(
        'ajax_url' => admin_url('admin-ajax.php')
    ));
}

add_action( 'wp_enqueue_scripts', 'quizbook_frontedview_styles' );

/* Agrega css y js al fronpanel */
function quizbook_frontedpanel_styles($hook) {
    /* Lo carga en todas las paginas del frontpanel, filtramos */
    global $post;
    if($hook == 'post-new.php' || $hook == 'post.php'){
        if($post->post_type === 'quizes'){
            wp_enqueue_style( 'quizbook_panel_css', plugins_url( '../../assets/css/quizbookPanel.css', __FILE__ ) );
        }
    }
}

add_action('admin_enqueue_scripts','quizbook_frontedpanel_styles');
?>