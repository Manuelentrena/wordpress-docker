<?php

if(!defined('ABSPATH')) exit;

function quizbook_agregar_metaboxes() {
    /* id, name, callback, slug-post, position, priority, num_arg */
    add_meta_box( 'quizbook_meta_box', 'Respuestas', 'quizbook_metabosex', 'quizes', 'normal', 'high', null);
}

/* Añade metabox al post */
add_action( 'add_meta_boxes', 'quizbook_agregar_metaboxes' );

function quizbook_metabosex(){
    /* Vamos a usar una clases de CSS internos para tener los mismos estilos de WP */
    ?>
    <table class="form-table">
        <tr>
            <th class="row-title" style="width: 10px !important;">
                <h2>Añade las respuestas aquí</h2>
            </th>
        </tr>
        <tr>
            <th class="row-title">
                <label for="respuesta_1">A)</label>
                
            </th>
            <td>
                <input type="text" id="respuesta_1" name="qb_respuesta_1" class="regular-text"></input>
            </td>
        </tr>
        <tr>
            <th class="row-title">
                <label for="respuesta_2">B)</label>
            </th>
            <td>
                <input type="text" id="respuesta_2" name="qb_respuesta_2" class="regular-text"></input>
            </td>
        </tr>
        <tr>
            <th class="row-title">
                <label for="respuesta_3">C)</label>
            </th>
            <td>
                <input type="text" id="respuesta_3" name="qb_respuesta_3" class="regular-text"></input>
            </td>
        </tr>
        <tr>
            <th class="row-title">
                <label for="respuesta_4">D)</label>
            </th>
            <td>
                <input type="text" id="respuesta_4" name="qb_respuesta_4" class="regular-text"></input>
            </td>
        </tr>
        <tr>
            <th class="row-title">
                <label for="respuesta_5">E)</label>
            </th>
            <td>
                <input type="text" id="respuesta_5" name="qb_respuesta_5" class="regular-text"></input>
            </td>
        </tr>
        <tr>
            <th class="row-title">
                <label for="respuesta_correcta">Respuesta Correcta</label>
            </th>
            <td>
                <select name="quizbook_correcta" id="respuesta_correcta" class="postbox">
                    <option value="">Elige la respuesta Correcta</option>
                    <option value="qb_correcta:a">A</option>
                    <option value="qb_correcta:b">B</option>
                    <option value="qb_correcta:c">C</option>
                    <option value="qb_correcta:d">D</option>
                    <option value="qb_correcta:e">E</option>
                </select>
            </td>
        </tr>

    </table>

    <?php
}

function quizbook_guardar_metaboxes($post_id, $post, $update){
    $respuesta_1 = $respuesta_2 = $respuesta_3 = $respuesta_4 = $respuesta_5 =  $correcta = '';

    if(isset($_POST['qb_respuesta_1'])){
        $respuesta_1 = sanitize_text_field( $_POST['qb_respuesta_1'] );
    }
    update_post_meta( $post_id, 'qb_respuesta_1', $respuesta_1 );

    if(isset($_POST['qb_respuesta_2'])){
        $respuesta_2 = sanitize_text_field( $_POST['qb_respuesta_2'] );
    }

    update_post_meta( $post_id, 'qb_respuesta_2', $respuesta_2 );
    if(isset($_POST['qb_respuesta_3'])){
        $respuesta_3 = sanitize_text_field( $_POST['qb_respuesta_3'] );
    }

    update_post_meta( $post_id, 'qb_respuesta_3', $respuesta_3 );
    if(isset($_POST['qb_respuesta_4'])){
        $respuesta_4 = sanitize_text_field( $_POST['qb_respuesta_4'] );
    }

    update_post_meta( $post_id, 'qb_respuesta_4', $respuesta_4 );
    if(isset($_POST['qb_respuesta_5'])){
        $respuesta_5 = sanitize_text_field( $_POST['qb_respuesta_5'] );
    }
    update_post_meta( $post_id, 'qb_respuesta_5', $respuesta_5 );

    if(isset($_POST['quizbook_correcta'])){
        $correcta = sanitize_text_field( $_POST['quizbook_correcta'] );
    }
    update_post_meta( $post_id, 'quizbook_correcta', $correcta );
}

/* Al actualizar el post, , envia 3 parametros al callback */
/* hook, callback, priority, num_arg */
add_action( 'save_post', 'quizbook_guardar_metaboxes', 10, 3);
