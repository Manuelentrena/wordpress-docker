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
/* AGREGAR ROLES Y CAPABILITY */
require_once plugin_dir_path(__FILE__) . 'includes/roles/roles.php';


/* refrescar urls del plugin al activarlo */
register_activation_hook(__FILE__, 'quizbook_rewrite_flush');
/* Crear rol al activar plugin */
register_activation_hook(__FILE__, 'quizbook_create_rol');
/* Borrar rol al desactivar el plugin */
register_deactivation_hook(__FILE__, 'quizbook_remove_rol');
/* Añadir permisos de roles al activar el plugin */
register_activation_hook( __FILE__, 'quizbook_add_capabilities' );
/* Borrar permisos de roles al desactivar el plugin */
register_deactivation_hook( __FILE__, 'quizbook_remove_capabilities' );

?>