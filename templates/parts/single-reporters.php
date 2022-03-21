<?php if(have_posts( )) : ?>
    <?php while(have_posts( )) : the_post(  ); ?>


        <article class="flex">

            <!-- L'image de l'article -->
            <div class="image-article quart">

                <?php if(get_field('photo')) : ?>

                    <img src="<?php echo get_field('photo')['sizes']['large'] ?>" alt="photo du reporter">

                <?php endif; ?>

            </div>

            <!-- Le contenu de l'article -->
            <div class="texte-article trois-quart">

                <h3> <?php echo get_field('prenom')?>&nbsp;<?php echo get_field('nom')?></h3>

                <p><?php echo get_field('description')?></p>

                <p> Expériences : <?php echo get_field('annees_dexperiences')?></p>
                
            </div>

        </article>

    <?php endwhile;?>
<?php endif; ?>