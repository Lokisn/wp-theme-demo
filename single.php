<?php get_header()?>

<?php 

if (in_category('reporters')) {

    // Catégorie reporters
    get_template_part('templates/parts/single', 'reporters');

} else if(in_category('reportages')){
    // Catégorie reportages
    get_template_part('templates/parts/single', 'reportages');

} else {

    // Tout autres articles
    get_template_part('templates/parts/single', 'news');

}


?>
    
<?php get_footer( ) ?>