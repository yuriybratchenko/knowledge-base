<div>
    <?php if ( is_single() && ! $cp ) { kb_share_buttons(); }?>
    <div id="content" <?php echo kava_get_container_classes( 'container d-flex flex-column flex-md-row-reverse pb-60 px-0' ); ?>>
        <aside id="main-sidebar" <?php kava_secondary_content_class( array( 'widget-area col-sm-10 col-md-5 col-lg-4' ) ); ?>>
            <?php if ( is_singular('troubleshooting') || is_singular('tips-and-tricks') ) {
                dynamic_sidebar( 'sidebar-troubleshoot-tips' );
            } else {
                dynamic_sidebar( 'sidebar' );
            }?>
        </aside>