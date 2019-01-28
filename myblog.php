<?php 
/**
 * 
 * template name: MyBlog
 * 
 */

get_header(); ?>
<?php query_posts('post_type=post&post_status=publish&posts_per_page=10&paged='. get_query_var('paged')); ?>

<!-- Blog Posts start -->
<section id="post-<?php the_ID(); ?>" <?php post_class('blog-posts'); ?> >
  <div class="container blog-width" >
    <div class="row">
      <div class="col-md-12">
        <div class="blog-post blog-card single-post">
<?php 
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args['paged'] = $paged;
query_posts($args);
 ?>
          <?php if ( have_posts() ) : ?>
          <?php while( have_posts() ) : the_post(); ?>
          <div class="col-md-4 col-sm-2 col-xs-12">
            <?php if ( has_post_thumbnail() ) {
the_post_thumbnail();
} else { ?>
            <img src="<?php site_url(); ?>/wp-content/uploads/2017/03/lucere-fallback-1.png" alt="<?php the_title(); ?>" />
            <?php } ?>
          </div>
          <div class="col-md-8 col-sm-10 col-xs-12"> <span class="entry-date" style="text-transform:uppercase; font-size:12px;"><?php echo get_the_date(); ?></span> . <span style="text-transform:uppercase; font-size:12px;" class="text-color">
            <?php $categories = get_the_category();
if ( ! empty( $categories ) ) {
    echo '<a href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '">' . esc_html( $categories[0]->name ) . '</a>';
} ?>
            </span>
            <h4 style="text-transform:uppercase;" class="text-color"><a href="<?php the_permalink(); ?>">
              <?php the_title(); ?>
              </a></h4>
            <?php the_excerpt(__('Continue reading »','example')); ?>
              <a href="<?php echo get_permalink(); ?>"> Read More...</a>
          </div>
          <div style="clear:both;"></div>
          <div style="border-bottom:1px solid #CCC; margin:75px 0px;"></div>
          <?php endwhile; ?>
               <?php apicona_paging_nav(); ?>
          <?php endif; ?>
        </div>
      </div>
      <!-- <div class="col-md-4">
                <?php // get_sidebar(); ?>
            </div> --> 
    </div>
  </div>
</section>
<!-- Blog Posts end -->

<?php get_footer(); ?>