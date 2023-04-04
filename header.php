<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Kava
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php kava_body_open(); ?>
<?php do_action( 'kava-theme/site/page-start' ); ?>
<?php kava_get_page_preloader(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'knowledge-base' ); ?></a>


	<header id="masthead" <?php echo kava_get_container_classes( 'site-header site-header-transparent site-header-inverse' ); ?>>
        <?php if ( wp_is_mobile() ) {
            get_template_part( 'header-mobile' );
        } else {
            get_template_part( 'header-desktop' );
        } ?>
	</header>
    <?php include get_theme_file_path('tmp/header.php'); ?>
    <?php do_action( 'kava-theme/site/breadcrumbs-area' ); ?>

    <?php
        $cp = is_singular('jetplugins');

        if ( $cp ) {
            if ( ! wp_is_mobile() ) {
                include get_theme_file_path('tmp/sidebar-plugin.php');
            }
        } elseif ( is_single() && ! $cp ) {
            include get_theme_file_path('tmp/sidebar.php');
        } else {
            echo '<div id="content" class="site-content">';
        }
    ?>
