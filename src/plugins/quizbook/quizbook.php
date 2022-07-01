<?php

/*
Plugin Name: Quizbook
Plugin URI: Plugin de cuestionario con wordpress
Version: 1.0.0
Author: Manuel Entrena
Author URI: 
License: GPLv2 or later
Text Domain: quizbook
*/

/* AGREGAR CUSTOM POST TYPE */
require_once plugin_dir_path(__FILE__) . 'includes/post-types/quiz.php';
/* AGREGAR METABOX AL POST */
require_once plugin_dir_path(__FILE__) . 'includes/metaboxes/metaboxes.php';


/* refrescar urls del plugin al activarlo */
register_activation_hook(__FILE__, 'quizbook_rewrite_flush');

?>