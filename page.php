<?php get_header(); ?>

<main class="container" role="main">
  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <article id="page-<?php the_ID(); ?>">
      <h1><?php the_title(); ?></h1>
      <div><?php the_content(); ?></div>
    </article>
  <?php endwhile; endif; ?>
</main>

<?php get_footer(); ?>
