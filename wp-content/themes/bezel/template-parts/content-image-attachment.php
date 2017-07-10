<?php
/**
 * Template part for displaying single image attachment.
 *
 * @package Bezel
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="post-content-wrapper post-content-wrapper-single">
		<div class="entry-data-wrapper entry-data-wrapper-single">

			<?php
			// Retrieve attachment metadata.
			$metadata = wp_get_attachment_metadata();
			?>

			<div class="entry-header-wrapper">
				<header class="entry-header">
					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
				</header><!-- .entry-header -->

				<div class="entry-meta entry-meta-header-after">
					<ul>
						<li>
							<span class="posted-on">
								<time class="entry-date" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>">
									<?php echo esc_html( get_the_date() ); ?>
								</time>
							</span>
						</li>
						<?php if ( $post->post_parent ) : ?>
						<li>
							<span class="parent-post-link">
								<a href="<?php echo esc_url( get_permalink( $post->post_parent ) ); ?>" rel="gallery">
									<?php echo esc_html( get_the_title( $post->post_parent ) ); ?>
								</a>
							</span>
						</li>
						<?php endif; ?>
						<li>
							<span class="full-size-link">
								<a href="<?php echo esc_url( wp_get_attachment_url() ); ?>">
									<?php echo esc_html( $metadata['width'] ); ?> &times; <?php echo esc_html( $metadata['height'] ); ?>
								</a>
							</span>
						</li>
					</ul>
				</div><!-- .entry-meta -->
			</div><!-- .entry-header-wrapper -->

			<div class="entry-content">
				<div class="entry-attachment">
					<div class="attachment">
						<?php bezel_the_attached_image(); ?>
					</div><!-- .attachment -->

					<?php if ( has_excerpt() ) : ?>
					<div class="entry-caption">
						<?php the_excerpt(); ?>
					</div><!-- .entry-caption -->
					<?php endif; ?>
				</div><!-- .entry-attachment -->

				<?php the_content(); ?>

				<?php
					wp_link_pages( array(
						'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'bezel' ) . '</span>',
						'after'       => '</div>',
						'link_before' => '<span>',
						'link_after'  => '</span>',
					) );
				?>
			</div><!-- .entry-content -->

			<?php if ( '' != get_edit_post_link() ) : ?>
			<footer class="entry-meta entry-meta-footer">
				<?php edit_post_link( esc_html__( 'Edit', 'bezel' ), '<span class="edit-link">', '</span>' ); ?>
			</footer><!-- .entry-meta -->
			<?php endif; ?>

		</div><!-- .entry-data-wrapper -->
	</div><!-- .post-content-wrapper -->
</article><!-- #post-## -->
