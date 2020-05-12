<?php get_header(); ?>

<div class="holos-page-header" style="background-image: url(<?= get_the_post_thumbnail_url(); ?>);">
    <div class="container">
        <div class="holos-page-header-content">
            <h1><?php echo get_the_title(); ?></h1>
        </div>
    </div>
</div>
