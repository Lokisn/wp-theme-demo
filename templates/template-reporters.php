<?php 
/*
Template Name: Gabarit reporter
*/
?>

<?php get_header( ) ?>

<h2><?php echo get_the_title(); ?></h2>
<p><?php echo get_the_content(); ?></p>
<div class="flex">
    <?php 
        $args = array(
            'category_name' => 'reporters',
            'order' => 'title',
            'order_by' => 'ASC'
        );

        $query = new WP_Query($args);

        if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post();
    ?>
        <article>

            <h3><?php echo get_field('prenom')?>&nbsp;<?php echo get_field('nom') ?></h3>

            <?php if(get_field('photo')): ?>

                <img src="<?php echo get_field('photo')['sizes']['thumbnail']?>" alt="Photo du journaliste">

            <?php else: ?>

                <img src="<?php echo get_template_directory_uri()?>/images/portrait.png" alt="Photo par défaut du journaliste" width="150" height="150">

            <?php endif ?>

                <p>Années d'expériences : <?php echo get_field('annees_dexperiences')?></p>

        </article>

    <?php 
        endwhile;
        endif;
        wp_reset_postdata();
    ?>
</div>

<?php get_footer( ) ?>