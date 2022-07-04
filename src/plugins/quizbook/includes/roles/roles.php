<?php

/* https://developer.wordpress.org/plugins/users/roles-and-capabilities/ */

function quizbook_create_rol(){
    /* Add rol in WP user panel (slug_role, name_role,) */
    add_role( 'quizbook', 'Quiz' );
}

function quizbook_remove_rol(){
    remove_role( 'quizbook', 'Quiz' );
}

function quizbook_add_capabilities() {

	$roles = array( 'administrator', 'editor', 'quizbook' );

	foreach( $roles as $the_role ) {
		$role = get_role( $the_role );
		$role->add_cap( 'read' );
		$role->add_cap( 'edit_quizes' ); // editar desde cero
		$role->add_cap( 'publish_quizes' ); // publicar
		$role->add_cap( 'edit_published_quizes' ); // Editar los tuyos ya creados
		$role->add_cap( 'edit_others_quizes' ); // Editar los de otros usuarios
        $role->add_cap( 'delete_quizes' ); // Borrar mis propios quiz
        $role->add_cap( 'delete_others_quizes' ); // Borrar quiz de otros no publicados
        $role->add_cap( 'delete_published_quizes' ); // Borrar quiz ya publicados de otros
	}

	$manager_roles = array( 'administrator', 'editor' );

	foreach( $manager_roles as $the_role ) {
		$role = get_role( $the_role );
		$role->add_cap( 'read_private_quizes' );
		$role->add_cap( 'edit_private_quizes' );
		$role->add_cap( 'delete_private_quizes' );
	}

}

function quizbook_remove_capabilities() {

	$manager_roles = array( 'administrator', 'editor' );

	foreach( $manager_roles as $the_role ) {
		$role = get_role( $the_role );
		$role->remove_cap( 'read' );
		$role->remove_cap( 'edit_quizes' );
		$role->remove_cap( 'publish_quizes' );
		$role->remove_cap( 'edit_published_quizes' );
		$role->remove_cap( 'read_private_quizes' );
		$role->remove_cap( 'edit_others_quizes' );
		$role->remove_cap( 'edit_private_quizes' );
		$role->remove_cap( 'delete_quizes' );
		$role->remove_cap( 'delete_published_quizes' );
		$role->remove_cap( 'delete_private_quizes' );
		$role->remove_cap( 'delete_others_quizes' );
	}

}

?>