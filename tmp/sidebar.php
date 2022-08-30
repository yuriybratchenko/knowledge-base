<div>
    <?php if ( is_single() && ! $cp ) { kb_share_buttons(); }?>
    <div id="content" <?php echo kava_get_container_classes( 'container d-flex flex-row-reverse pb-60' ); ?>>
        <aside id="main-sidebar" <?php kava_secondary_content_class( array( 'widget-area col-lg-3' ) ); ?>>
            <?php dynamic_sidebar( 'sidebar' ); ?>
        </aside>