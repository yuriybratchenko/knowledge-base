
<div id="content" <?php echo kava_get_container_classes( 'container d-flex' ); ?>>
<nav class="sidebar mr-40">
    <p>Browse knowledge base</p>
    <ul class="bg-100 list border border-200 rounded m-0">
        <li class="d-flex justify-content-between" data-collapse-target="collapse-item-01">
            <span>Plugin Usage</span>
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M7.41 15.41L12 10.83L16.59 15.41L18 14L12 8L6 14L7.41 15.41Z" fill="#0F172A"/>
            </svg>
        </li>
        <ul class="flex-column bg-white list m-0 pl-16" id="collapse-item-01">
        <?php $query_args = array(
            'post_type' => 'jetplugins',
        );
        $the_query = new WP_Query( $query_args );
        if ( $the_query->have_posts() ) {
            while ( $the_query->have_posts() ) {
                $the_query->the_post();
                include get_theme_file_path('tmp/list-item.php');
            }
            wp_reset_postdata();
        } else {
            return;
        } ?></ul>
        <li><a href="#">Account Overview</a></li>
        <li><a href="#">Quick Start</a></li>
        <li><a href="#">Tips & Tricks</a></li>
        <li><a href="#">Guides</a></li>
        <li><a href="#">Glossary</a></li>
    </ul>
</nav>