<?php
/**
 * Template part for displaying header parts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package knowledge-base
 */

$ts_class = '';
$class = '';
$bg = '';

if ( is_post_type_archive('troubleshooting') || is_singular('troubleshooting') ) {
    $ts_class = 'active-ts';
    $bg = 'jetappointment';
} else {
    $class = 'active';
    $bg = 'jetpopup';
}

?>

    <section class="bg-900 bg-gradient-section-<?php echo $bg;?> context-dark pt-120 pb-20 pb-md-0">
        <div class="container">
            <h1 class="m-0 text-center text-md-left">Help Center</h1>
            <div class="d-flex flex-column flex-xl-row-reverse align-items-center justify-content-between mt-40 mt-xl-20">
                <?php reblex_display_block(26750) ?>
                <ul class="list d-flex flex-wrap justify-content-center justify-content-md-start m-0 custom-navigation custom-navigation-jetpopup mt-32 mt-md-20 mt-xl-0">
                    <li><a class="d-block text-font-sec font-weight-bold py-12 py-md-24 px-12 px-md-16 custom-navigation-link <?php echo $class;?>" href="<?php echo home_url( '/' )?>">Knowledge Base</a></li>
                    <li><a class="d-block text-font-sec font-weight-bold py-12 py-md-24 px-12 px-md-16 custom-navigation-link ts <?php echo $ts_class;?>" href="<?php echo home_url( '/troubleshooting/' )?>">Troubleshooting</a></li>
                    <li><a class="d-block text-font-sec font-weight-bold py-12 py-md-24 px-12 px-md-16 custom-navigation-link support" href="https://crocoblock.com/?page_id=71433&preview=true">Support</a></li>
                    <li><a class="d-block text-font-sec font-weight-bold py-12 py-md-24 px-12 px-md-16 custom-navigation-link blog" href="https://crocoblock.com/blog/">Blog</a></li>
                </ul>
            </div>
        </div>
    </section>
<?php if ( ! is_front_page() ) {
    ?><section class="pt-20 pb-40">
    <div class="container">
        <?php echo do_shortcode('[breadcrumbs]'); ?>
    </div>
    </section>
    <?php
} ?>