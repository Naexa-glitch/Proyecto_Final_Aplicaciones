<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Astra
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header(); ?>

<?php if ( astra_page_layout() == 'left-sidebar' ) : ?>

	<?php get_sidebar(); ?>

<?php endif ?>

	<div id="primary" <?php astra_primary_class(); ?>>
		
	<?php 
		astra_primary_content_top();

		$paged = get_query_var('pg');

	$args = [
		'post_type' => 'proyecto',
		'post_per_page' => 10,
		'paged' => $paged,
		
	];

	$query = new WP_Query($args);
	?>
	<div>
		<h1 class="mt-3">Mis proyectos</h1>
		<ul>
			<?php
			 	while ( $query-> have_posts() ){
						$query->the_post();
						global $post;
						?>

						<li class="card">
							<a class="img-blog" href="<?php echo get_the_permalink(); ?>">
							<?php
								echo get_the_post_thumbnail( $post->ID );
							?>
								<div class="mt-3">
									<?php $foto = get_field('imagen'); ?>
									<img class="foto-proyecto" src="<?php echo $foto['url'] ?>" alt="<?php echo $foto['alt'] ?>">
									<h2 class="mt-3"><?php echo get_the_title(); ?></h2>
								</div>
							</a>
							<?php 
								// Añadir permalink del campo personalizado
								$url_proyecto = get_field('url_proyecto');
								if( $url_proyecto ):
							?>
								<a href="<?php echo esc_url( $url_proyecto ); ?>" class="btn btn-primary">Ver Proyecto</a>
							<?php endif; ?>
						</li>
						<?php
				}
				?>
				<div>
					<ul>
						<?php 
						echo paginate_links(
							array(
								'total' => $query->max_num_pages,
								'current' => $paged,
								'format' => '?pg=%#%',
								'prev_text' => __('&laquo; Anterior'),
								'next_text' => __('Siguinte &raquo;'),
							)
						)
						?>
					</ul>
				</div>
				<?php
				wp_reset_postdata()
			?>
		</ul>


		<?php astra_primary_content_bottom(); ?>

	</div><!-- #primary -->

<?php if ( astra_page_layout() == 'right-sidebar' ) : ?>

	<?php get_sidebar(); ?>

<?php endif ?>

<?php get_footer(); ?>
