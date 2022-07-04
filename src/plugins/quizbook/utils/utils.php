<?php

function consoleLog($data) {
    echo "<pre>";
    var_dump($data);
    echo "</pre>";
}

function quizbook_filter_questions( $key ){
    return strpos($key, 'qb_');
}

?>