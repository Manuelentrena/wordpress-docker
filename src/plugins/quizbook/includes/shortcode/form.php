<form name="quizbook_form" id="quizbook_form">
    <div id="quizbook_container" class="quizbook_container">
        <ul>
            <?php while($quizbook->have_posts()): $quizbook->the_post(); ?>
                <li>
                    <?php the_title('<h2>','</h2>'); ?>
                    <?php the_content(); ?>
                    <?php $opciones = get_post_meta(get_the_ID()); ?>
                        
                    <?php foreach($opciones as $key => $opcion){ ?>
                            <?php $opcionWithPre = quizbook_filter_questions($key); ?>
                            <?php if($opcionWithPre === 0) { ?>
                                <?php $numero = explode('_', $key); ?>
                                <div id="<?php echo(get_the_ID() . ':' . $numero[2]); ?>">
                                    <?php echo($opcion[0]); ?>
                                </div>
                            <?php } ?>
                    <?php } ?>
                </li>
            <?php endwhile; wp_reset_postdata(); ?>
        </ul>
    </div>
</form>