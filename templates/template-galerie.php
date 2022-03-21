<?php 
/*
Template Name: Gabarit galerie
*/
?>

<?php get_header( ) ?>

    <h2><?php echo get_the_title(); ?></h2>

<div class="galerie">

    <?php 

        $images = get_field('champ_galerie');

        if( $images ): ?>

                <?php foreach( $images as $image ): ?>
                    <a href="<?php echo $image['full_image_url']; ?>" title="<?php echo $image['caption']; ?>"><img src="<?php echo $image['thumbnail_image_url'];?>"/></a>   
                <?php endforeach; ?>
    <?php 
        endif;
        wp_reset_postdata();
    ?>
</div>

<?php get_footer( ) ?>