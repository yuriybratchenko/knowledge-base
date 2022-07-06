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
?>

<li <?php if ( $order !== '' ) {
    printf('style="order:%s;"', $order);
}?>>
    <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
</li>