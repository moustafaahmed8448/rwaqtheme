<?php get_header(); ?>

<main class="container" role="main">
  <h1>Welcome to <?php bloginfo('name'); ?></h1>
  <p>This is your front page template.</p>
  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <article>
      <h2><?php the_title(); ?></h2>
      <div><?php the_content(); ?></div>
    </article>
  <?php endwhile; endif; ?>
</main>

<?php get_footer(); ?>
