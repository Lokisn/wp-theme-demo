<?php 
/*
Template Name: Gabarit accueil
*/
?>

<?php get_header(); ?>

<?php 

    /*$args = array(
        'category_name' => 'Techno', 
        'post_type' => 'post'
    );*/

    $args = array(
        'category__not_in' => 1
    );

    $query = new WP_Query($args);

?>

<div class="flex">
            <section class="trois-quart">

            <?php if($query->have_posts( )) : ?>
            <?php while($query->have_posts( )) : $query->the_post(  ); ?>

                <article class="flex">

                    <!-- L'image de l'article -->
                    <div class="image-article quart">

                        <?php if(has_post_thumbnail(  )) : ?>
                            
                            <?php the_post_thumbnail('small', ['class' => 'fluide']); ?>

                        <?php endif; ?>

                    </div>

                    <div class="texte-article trois-quart">
                        <!-- Récupération des articles (titre, contenu)-->
                        <h3><?php the_title(); ?></h3>
                        <p><?php the_excerpt(); ?> <a href="<?=the_permalink();?>"> En savoir plus... </a> </p>
                        <p><?php the_tags()?></p>
                    </div>

                </article>

            <?php endwhile;?>
            <?php endif; ?>

            </section>
            <section class="quart sidebar">
                <article>
                    <h3>Sidebar</h3>
                    <div class="widget-container">
                        <!-- widget -->
                    </div>
                    <div class="widget-container">
                        <!-- widget -->
                    </div>
                </article>
            </section>
        </div>

<?php get_footer(); ?>