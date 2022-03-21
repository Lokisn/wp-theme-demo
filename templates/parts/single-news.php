<?php if(have_posts( )) : ?>
    <?php while(have_posts( )) : the_post(  ); ?>


        <article class="flex">

            <!-- L'image de l'article -->
            <div class="image-article quart">

                <?php if(has_post_thumbnail( )) : ?>

                <?php the_post_thumbnail('small', ['class' => 'fluide']); ?>

                <?php endif; ?>

            </div>

            <!-- Le contenu de l'article -->
            <div class="texte-article trois-quart">
                <p><?php the_content( );?></p>
                <p>Consultez d'autres articles dans la catégorie : <?php the_category( ',' );?>.</p>
            </div>

        </article>

    <?php endwhile;?>
<?php endif; ?>