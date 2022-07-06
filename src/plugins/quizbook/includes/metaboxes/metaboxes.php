<?php

if(!defined('ABSPATH')) exit;

function quizbook_agregar_metaboxes() {
    /* id, name, callback($post), slug-post, position, priority, num_arg */
    add_meta_box( 'quizbook_meta_box', 'Respuestas', 'quizbook_metabosex', 'quizes', 'normal', 'high', null);
}

/* Añade metabox al post */
add_action( 'add_meta_boxes', 'quizbook_agregar_metaboxes' );

function quizbook_metabosex($post){
    /* Vamos a usar una clases de CSS internos para tener los mismos estilos de WP */
    /* Vamos tambien a crear un nonce, token de 24 horas que se verifica para saber que la fuente de envio de datos es segura */
    /* Se crea un input invisible con el codigo en el value */
    /* (donde va a crear el token de seguridad,nombre del nonce) */
    wp_nonce_field(basename(__FILE__), 'quizbook_nonce' );
    ?>
    <table class="form-table">
        <tr>
            <th class="row-title" style="width: 10px !important;">
                <h2>Añade las respuestas aquí</h2>
            </th>
        </tr>
        <tr>
            <th class="row-title">
                <label for="respuesta_a">A)</label>
                
            </th>
            <td>
                <!-- https://codex.wordpress.org/Validating_Sanitizing_and_Escaping_User_Data -->
                <!-- esc_attr(), para asegurar que lo que hay en la BD es lo que se ve en el input "escapar datos" -->
                <!-- get_post_meta( id del post, nombre del campo "meta_key" de la tabla postmeta, false -> como array true -> valor directo) -->
                <input value="<?php echo esc_attr(get_post_meta( $post->ID, 'qb_respuesta_a', true )); ?>" type="text" id="respuesta_a" name="qb_respuesta_a" class="regular-text"></input>
            </td>
        </tr>
        <tr>
            <th class="row-title">
                <label for="respuesta_b">B)</label>
            </th>
            <td>
                <input value="<?php echo esc_attr(get_post_meta( $post->ID, 'qb_respuesta_b', true )); ?>" type="text" id="respuesta_b" name="qb_respuesta_b" class="regular-text"></input>
            </td>
        </tr>
        <tr>
            <th class="row-title">
                <label for="respuesta_c">C)</label>
            </th>
            <td>
                <input value="<?php echo esc_attr(get_post_meta( $post->ID, 'qb_respuesta_c', true )); ?>" type="text" id="respuesta_c" name="qb_respuesta_c" class="regular-text"></input>
            </td>
        </tr>
        <tr>
            <th class="row-title">
                <label for="respuesta_d">D)</label>
            </th>
            <td>
                <input value="<?php echo esc_attr(get_post_meta( $post->ID, 'qb_respuesta_d', true )); ?>" type="text" id="respuesta_d" name="qb_respuesta_d" class="regular-text"></input>
            </td>
        </tr>
        <tr>
            <th class="row-title">
                <label for="respuesta_e">E)</label>
            </th>
            <td>
                <input value="<?php echo esc_attr(get_post_meta( $post->ID, 'qb_respuesta_e', true )); ?>" type="text" id="respuesta_e" name="qb_respuesta_e" class="regular-text"></input>
            </td>
        </tr>
        <tr>
            <th class="row-title">
                <label for="respuesta_correcta">Respuesta Correcta</label>
            </th>
            <td>
                <?php $respuesta = esc_html(get_post_meta( $post->ID, 'quizbook_correcta', true )); ?>
                <select name="quizbook_correcta" id="respuesta_correcta" class="postbox">
                    <option value="">Elige la respuesta Correcta</option>
                    <!-- selected, te la selecciona si coinciden ambos arg -->
                    <option <?php selected($respuesta,'qb_correcta:a'); ?> value="qb_correcta:a">A</option>
                    <option <?php selected($respuesta,'qb_correcta:b'); ?> value="qb_correcta:b">B</option>
                    <option <?php selected($respuesta,'qb_correcta:c'); ?> value="qb_correcta:c">C</option>
                    <option <?php selected($respuesta,'qb_correcta:d'); ?> value="qb_correcta:d">D</option>
                    <option <?php selected($respuesta,'qb_correcta:e'); ?> value="qb_correcta:e">E</option>
                </select>
            </td>
        </tr>

    </table>

    <?php
}

function quizbook_guardar_metaboxes($post_id, $post, $update){
    /* Verificamos en nonce antes de guardar, que se envie y esté verificado en este archivo */
    if(!isset($_POST['quizbook_nonce']) || !wp_verify_nonce($_POST['quizbook_nonce'], basename(__FILE__))){
        return $post_id;
    }
    /* Si no tiene permisos de edicion el rol de usuario */
    if(!current_user_can( 'edit_post', $post_id )){
        return $post_id;
    }

    if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE){
        return $post_id;
    }

    $respuesta_1 = $respuesta_2 = $respuesta_3 = $respuesta_4 = $respuesta_5 =  $correcta = '';

    if(isset($_POST['qb_respuesta_a'])){
        $respuesta_1 = sanitize_text_field( $_POST['qb_respuesta_a'] );
    }
    update_post_meta( $post_id, 'qb_respuesta_a', $respuesta_1 );

    if(isset($_POST['qb_respuesta_b'])){
        $respuesta_2 = sanitize_text_field( $_POST['qb_respuesta_b'] );

    }
    update_post_meta( $post_id, 'qb_respuesta_b', $respuesta_2 );

    if(isset($_POST['qb_respuesta_c'])){
        $respuesta_3 = sanitize_text_field( $_POST['qb_respuesta_c'] );
    }
    update_post_meta( $post_id, 'qb_respuesta_c', $respuesta_3 );

    if(isset($_POST['qb_respuesta_d'])){
        $respuesta_4 = sanitize_text_field( $_POST['qb_respuesta_d'] );
    }
    update_post_meta( $post_id, 'qb_respuesta_d', $respuesta_4 );

    if(isset($_POST['qb_respuesta_e'])){
        $respuesta_5 = sanitize_text_field( $_POST['qb_respuesta_e'] );
    }
    update_post_meta( $post_id, 'qb_respuesta_e', $respuesta_5 );

    if(isset($_POST['quizbook_correcta'])){
        $correcta = sanitize_text_field( $_POST['quizbook_correcta'] );
    }
    update_post_meta( $post_id, 'quizbook_correcta', $correcta );
}

/* Al actualizar el post, , envia 3 parametros al callback */
/* hook, callback, priority, num_arg */
add_action( 'save_post', 'quizbook_guardar_metaboxes', 10, 3);

/* Add custom field to api rest */
function add_custom_field_rest($post){
    register_rest_field( 'quizes', 'respuestas', array(
        'get_callback' => function($post) {
            $listMetabox = [];
            $metaboxes = get_post_meta($post['id']);
            foreach($metaboxes as $key => $metabox){
                $metaboxWithPre = quizbook_filter_questions($key);
                if($metaboxWithPre === 0) {
                    $listMetabox[$key] = $metabox[0];
                }
                
            }
            return $listMetabox;
        }
    ));
    register_rest_field( 'quizes', 'correcta', array(
        'get_callback' => function($post) {
            $metaboxes = get_post_meta($post['id']);
            return $metaboxes['quizbook_correcta'][0];
        }
    ));
}

add_action('rest_api_init', 'add_custom_field_rest');
