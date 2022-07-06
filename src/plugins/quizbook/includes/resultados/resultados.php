<?php
    if(!defined('ABSPATH')) exit;

    function quizbook_resultados(){
        /* var_dump($_POST); */
        $resultado = 0;

        if(isset($_POST['resultados'])){
            $respuestas = $_POST['resultados'];
        }

        foreach($respuestas as $idQuiz => $respuesta){
            $correcta = get_post_meta($idQuiz, 'quizbook_correcta', true);
            $letraCorrecta = explode(':',$correcta);
            if($letraCorrecta[1] === $respuesta){
                $resultado += 10;
            }
        }

        $res = array(
            'total' => $resultado
        );

        header('Content-type: application/json');
        echo json_encode($res);
        die();
    }

    add_action('wp_ajax_nopriv_quizbook_resultados','quizbook_resultados'); // cuando estas logueado
    add_action('wp_ajax_quizbook_resultados', 'quizbook_resultados'); // cuando no estas logeado

?>