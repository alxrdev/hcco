
<?php get_header(); ?>

<div class="site-page">
	<!-- Content -->
    <div class="site-page-header" style="background-image: url(<?= get_the_post_thumbnail_url(); ?>);">
        <div class="container">
            <div class="page-header-content">
                <h1 class="text-center"><?php echo get_the_title(); ?></h1>
            </div>
        </div>
    </div>