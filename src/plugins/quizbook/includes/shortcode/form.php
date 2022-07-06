<form name="quizbook_form" id="quizbook_form">
    <div id="quizbook_container" class="quizbook_container">
        <ul>
            <?php while($quizbook->have_posts()): $quizbook->the_post(); ?>
                <li>
                    <?php the_title('<h2>','</h2>'); ?>
                    <p><?php the_content(); ?></p>
                    <?php $opciones = get_post_meta(get_the_ID()); ?>
                        
                    <?php foreach($opciones as $key => $opcion){ ?>
                            <?php $opcionWithPre = quizbook_filter_questions($key); ?>
                            <?php if($opcionWithPre === 0) { ?>
                                <?php $numero = explode('_', $key); ?>
                                <div id="<?php echo(get_the_ID() . ':' . $numero[2]); ?>" class="quizbook_respuesta" data-selected="false">
                                    <?php echo($opcion[0]); ?>
                                </div>
                            <?php } ?>
                    <?php } ?>
                </li>
            <?php endwhile; wp_reset_postdata(); ?>
        </ul>
    </div>
    <input type="submit" value="Enviar" id="quizbook_btnSubmit">
    <div id="quizbook_resultado"></div>
</form>
