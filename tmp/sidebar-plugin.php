
<div id="content" <?php echo kava_get_container_classes( 'container d-flex pb-60' ); ?>>
<nav class="sidebar mr-32">
    <ul class="bg-100 list border border-200 rounded m-0">
        <li class="d-flex justify-content-between py-12 px-20" data-collapse-target="collapse-item-01">
            <span class="text-font-sec font-weight-bold text-900">Plugin Usage</span>
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M7.41 15.41L12 10.83L16.59 15.41L18 14L12 8L6 14L7.41 15.41Z" fill="#0F172A"/>
            </svg>
        </li>
        <ul class="flex-column bg-white list m-0 list-collapse py-8" id="collapse-item-01">
        <?php global $post;
        $slug=$post->post_name;
        $query_args = array(
            'post_type' => 'jetplugins',
            'posts_per_page' => -1,
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


        <li class="d-flex justify-content-between py-12 px-20" data-collapse-target="collapse-item-04">
            <a href="https://devcroco.com/account-overview/">
                <span class="text-font-sec font-weight-bold text-900">Account Overview</span>
            </a>
        </li>
        <li class="d-flex justify-content-between py-12 px-20" data-collapse-target="collapse-item-04">
            <a href="https://devcroco.com/quick-start/">
                <span class="text-font-sec font-weight-bold text-900">Quick Start</span>
            </a>
        </li>
        <li class="d-flex justify-content-between py-12 px-20" data-collapse-target="collapse-item-04">
            <a href="https://devcroco.com/troubleshooting/">
                <span class="text-font-sec font-weight-bold text-900">Troubleshooting</span>
            </a>
        </li>
        <li class="d-flex justify-content-between py-12 px-20" data-collapse-target="collapse-item-05">
            <a href="https://devcroco.com/tips-and-tricks/">
                <span class="text-font-sec font-weight-bold text-900">Tips & Tricks</span>
            </a>
        </li>
    </ul>
</nav>