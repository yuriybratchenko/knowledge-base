<?php do_action( 'kb-theme/site/need-help-start' ); ?>
<section class="p-32 py-60 bg-100 rounded">
    <div class="container px-0">
        <h2 class="text-center m-0">Need help?</h2>
        <div class="row row-40 justify-content-center justify-content-lg-start mt-40">
            <div class="col-sm-10 col-lg-6">
                <?php include get_theme_file_path('tmp/need-help/fb.php'); ?>
            </div>
            <div class="col-sm-10 col-lg-6 d-none d-lg-inline-flex">
                <?php include get_theme_file_path('tmp/need-help/chat.php'); ?>
            </div>
        </div>
    </div>
</section>