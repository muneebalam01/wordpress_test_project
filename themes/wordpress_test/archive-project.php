<?php get_header();?>

 <div class = "all_projects">
 <?php $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;

 $product_args = array(
     'post_type' => 'project',
     'posts_per_page' => 3,
     'paged' => $paged,
     'page' => $paged
   );

 $product_query = new WP_Query( $product_args ); ?>
 <?php if ( $product_query->have_posts() ) : ?>
  <div class = "all_new_projects_row">
   <?php while ( $product_query->have_posts() ) : $product_query->the_post(); ?>
   <div class = "inner_prjoect">
     <article class="loop">
       <h3><a href = "<?php the_permalink();?>"><?php the_title(); ?></a></h3>
         <h1><a href ="<?php the_permalink(); ?>"> <?php the_title();?> </a></h1>
         <?php
        $terms = get_the_terms( $post->ID, 'projecttype' );
        if ($terms) {
            foreach($terms as $term) {
            echo $term->name;
            } 
                    }
        ?>
        <p><a href = " <?php the_permalink();?> "> <?php the_post_thumbnail('medium'); ?></a> </p>
       <div class="content">
         <?php the_excerpt(); ?>
       </div>
     </article>
    </div>
   <?php endwhile; ?>
   </div>
   <?php
      if (function_exists( 'custom_pagination' )) :
         custom_pagination( $product_query->max_num_pages,"",$paged );
     endif;
    ?>
 <?php wp_reset_postdata(); ?>
 <?php else:  ?>
   <p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
 <?php endif; ?>
  </div>
<?php get_footer();?>