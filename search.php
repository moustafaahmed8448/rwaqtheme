<?php get_header(); ?>

<main class="container" role="main">
  <h1>Search Results for: <?php echo esc_html(get_search_query()); ?></h1>
  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <article>
      <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
      <div><?php the_excerpt(); ?></div>
    </article>
  <?php endwhile; else : ?>
    <p>No results found.</p>
  <?php endif; ?>
</main>

<?php get_footer(); ?>
