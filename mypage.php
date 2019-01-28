<?php

get_header();

/* template name:sidebar-custom */

$is_page_builder_used = et_pb_is_pagebuilder_used( get_the_ID() );

?>
<?php 
$thumb_id = get_post_thumbnail_id();
$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'thumbnail-size', true);
$thumb_url = $thumb_url_array[0];
?>
<div id="main-content">
<div class="et_pb_section  et_pb_section_0 et_pb_with_background et_section_regular et_pb_section_first" data-fix-page-container="on" style="padding-top: 156px;
<?php if(has_post_thumbnail()): ?>
background-image: url(<?php echo $thumb_url; ?>) !important;">
<?php else :   ?>			
 background-image: url(http://dev-lucereskin.flywheelsites.com/wp-content/uploads/2017/08/homebanner.jpg) !important;">	
<?php endif;   ?>		
				
					<div class=" et_pb_row et_pb_row_0">
				
				
				<div class="et_pb_column et_pb_column_4_4  et_pb_column_0">
				
				
				<div class="et_pb_text et_pb_module et_pb_bg_layout_dark et_pb_text_align_center innerpage_head et_pb_text_0">
				
				
				<div class="et_pb_text_inner">
					
<h1><?php the_title(); ?></h1>

				</div>
			</div> <!-- .et_pb_text -->
			</div> <!-- .et_pb_column -->
			</div> <!-- .et_pb_row -->
				
			</div>

<?php if ( ! $is_page_builder_used ) : ?>

	<div class="container">
		<div id="content-area" class="clearfix">
			<div id="left-area">

<?php endif; ?>

			<?php while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

				<?php if ( ! $is_page_builder_used ) : ?>

					<h1 class="entry-title main_title"><?php the_title(); ?></h1>
				<?php
					$thumb = '';

					$width = (int) apply_filters( 'et_pb_index_blog_image_width', 1080 );

					$height = (int) apply_filters( 'et_pb_index_blog_image_height', 675 );
					$classtext = 'et_featured_image';
					$titletext = get_the_title();
					$thumbnail = get_thumbnail( $width, $height, $classtext, $titletext, $titletext, false, 'Blogimage' );
					$thumb = $thumbnail["thumb"];

					if ( 'on' === et_get_option( 'divi_page_thumbnails', 'false' ) && '' !== $thumb )
						print_thumbnail( $thumb, $thumbnail["use_timthumb"], $titletext, $width, $height );
				?>

				<?php endif; ?>

					<div class="entry-content">

					<?php
						the_content();

						if ( ! $is_page_builder_used )
							wp_link_pages( array( 'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'Divi' ), 'after' => '</div>' ) );
					?>
					<!-- Botox page Section -->
						 <div class="container-fluid">
							<!-- <div class="row">
									<?php if(is_page( 'botox' )){ ?>
										<div class="col-md-10 col-md-offset-1 col-sm-12 col-xs-12" style="margin-bottom:10px;">
											<div class="embed-responsive embed-responsive-16by9">
												<iframe width="727" height="409" src="https://www.youtube.com/embed/A1Y3Ic96n8w?feature=oembed" frameborder="0" allowfullscreen=""></iframe>
											</div>
										</div>
									<?php	}	?>
							</div> -->

						 </div>  <!-- .container-fluid -->


					</div> <!-- .entry-content -->

				<?php
					if ( ! $is_page_builder_used && comments_open() && 'on' === et_get_option( 'divi_show_pagescomments', 'false' ) ) comments_template( '', true );
				?>

				</article> <!-- .et_pb_post -->

			<?php endwhile; ?>

<?php if ( ! $is_page_builder_used ) : ?>

			</div> <!-- #left-area -->

			<?php /*get_sidebar(); */
					if ( is_active_sidebar( 'sidebar-lucere-11' ) ) : ?>
	               <div id="sidebar">
	                 	<?php dynamic_sidebar( 'sidebar-lucere-11' ); ?>
	               </div> <!-- end #sidebar -->
			<?php endif; ?>
		</div> <!-- #content-area -->
	</div> <!-- .container -->

<?php endif; ?>
                 <!-- Skin (Success) Story Section -->
						<div class="container-fluid">
								 <?php	if(!is_front_page()){ 
									  include_once('template-success-story.php');
								  }	?>
					     </div>
				 <!--  .Skin (Success) Story Section -->		

</div> <!-- #main-content -->

<?php get_footer(); ?>