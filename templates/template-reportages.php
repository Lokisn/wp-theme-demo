<?php 
/*
Template Name: Gabarit reportages
*/
?>

<?php get_header( ) ?>

<h2><?php echo get_the_title(); ?></h2>

<div class="flex">
    <?php 
        $args = array(
            'category_name' => 'reportages',
            'order' => 'title',
            'order_by' => 'ASC'
        );

        $query = new WP_Query($args);

        if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post();
    ?>
        <article>

            <!--Titre du reportage-->
            <h3> <a href="<?=the_permalink();?>"><?php echo get_field('titre_du_reportage')?></a></h3>

            <!--Image du reportage / Par défaut si aucune-->
            <?php if(get_field('image')): ?>
                <img src="<?php echo get_field('image')['sizes']['thumbnail']?>" alt="Photo du reportage">
            <?php else: ?>
                <img src="<?php echo get_template_directory_uri()?>/images/placeholder.png" alt="Photo par défaut du reportage" width="150" height="150">
            <?php endif ?>
            <div>
                <p><b><?php echo get_field('date')?></b></p>
                <p><?php echo get_field('lieu_tournage')?></p>     
            </div>
            <p><i><?php echo get_field('reportages')?></i></p>



        </article>

    <?php 
        endwhile;
        endif;
        wp_reset_postdata();
    ?>
</div>


<?php get_footer( ) ?>