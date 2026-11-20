<?php
if (!defined('ABSPATH')) exit;
get_header();
?>
<main id="main-content">

<?php get_template_part('template-parts/hero'); ?>

<div class="row" id="latest-posts">
  <div class="col-lg-8">
    <?php get_template_part('template-parts/post-list'); ?>
  </div>

  <?php get_sidebar(); ?>
</div>

</main>

<?php get_footer(); ?>
