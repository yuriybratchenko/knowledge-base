<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Kava
 */
?>
</div>
<?php
$cp = is_singular('jetplugins');
if ( ! is_single() || $cp ) {
    include get_theme_file_path('tmp/need-help.php');
}
?>

<?php if ( class_exists( '\\Croco_Site_Menu\\Menu' ) ) {
    \Croco_Site_Menu\Menu::instance()->cs_footer_render();
} ?>

</div>
<?php if ( is_single() && ! $cp ) { echo '</div>'; } ?>
<?php wp_footer(); ?>
</body>

</html>