<?php
/**
 * Template part for displaying addons
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package knowledge-base
 */

$post_id = get_the_ID();
$order = get_post_meta( $post_id, 'order', true );
$term_slug=$post->post_name;

if ( $slug === $term_slug ) {
    $class = 'active';
} else {
    $class = '';
}

?>

<li <?php if ( $order !== '' ) {
    printf('style="order:%s;"', $order);
}?>>
    <a class="d-block small py-4 px-20 <?php echo $class;?>" href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
</li>