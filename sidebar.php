<article>
    <h3>Compléments</h3>

    <div class="widget-container">
        <?php if(is_active_sidebar('widget-1')) : ?>

                <?php dynamic_sidebar('widget-1');?>

        <?php endif;?>
    </div>

    <div class="widget-container">
        <?php if(is_active_sidebar('widget-2')) : ?>

            <?php dynamic_sidebar('widget-2');?>

        <?php endif;?>
    </div>

</article>