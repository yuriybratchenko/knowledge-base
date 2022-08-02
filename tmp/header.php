<?php
/**
 * Template part for displaying header parts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package knowledge-base
 */
?>

<section class="bg-900 bg-rg-jetpopup-jetengine context-dark pt-120">
    <div class="container">
        <h1>Help Center</h1>
        <div class="d-flex align-items-center justify-content-between">
            <ul class="list d-flex flex-wrap m-0 custom-navigation">
                <li><a class="d-block text-font-sec font-weight-bold py-12 py-md-24 px-12 px-md-16 custom-navigation-link active" href="#">Knowledge Base</a></li>
                <li><a class="d-block text-font-sec font-weight-bold py-12 py-md-24 px-12 px-md-16 custom-navigation-link" href="#">Troubleshoot</a></li>
                <li><a class="d-block text-font-sec font-weight-bold py-12 py-md-24 px-12 px-md-16 custom-navigation-link" href="https://crocoblock.com/?page_id=71433&preview=true">Support</a></li>
                <li><a class="d-block text-font-sec font-weight-bold py-12 py-md-24 px-12 px-md-16 custom-navigation-link" href="#">Guides</a></li>
                <li><a class="d-block text-font-sec font-weight-bold py-12 py-md-24 px-12 px-md-16 custom-navigation-link" href="https://crocoblock.com/blog/">Blog</a></li>
            </ul>
            <?php reblex_display_block(26750) ?>
        </div>
    </div>
</section>
<?php if ( ! is_front_page() ) {
    ?><section class="p-32">
        <div class="container">
            <?php echo do_shortcode('[breadcrumbs]'); ?>
        </div>
    </section>
    <?php
} ?>