<?php
/**
 * The default template for displaying content
 *
 * @package Bezel
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="post-content-wrapper post-content-wrapper-archive">

		<?php bezel_post_thumbnail(); ?>

		<div class="entry-data-wrapper entry-data-wrapper-archive">
			<div class="entry-header-wrapper entry-header-wrapper-archive">
				<?php if ( 'post' == get_post_type() ) : // For Posts ?>
				<div class="entry-meta entry-meta-header-before">
					<ul>
						<li><?php bezel_post_first_category(); ?></li>
						<?php if ( is_sticky() && is_home() && ! is_paged() ) : ?>
						<li>
							<span class="post-label post-label-featured">
								<span class="screen-reader-text"><?php esc_html_e( 'Featured', 'bezel' ); ?></span>
							</span>
						</li>
						<?php endif; ?>
					</ul>
				</div><!-- .entry-meta -->
				<?php endif; ?>

				<header class="entry-header">
					<?php the_title( '<h1 class="entry-title"><a href="' . esc_url( apply_filters( 'bezel_the_permalink', get_permalink() ) ) . '" rel="bookmark">', '</a></h1>' ); ?>
				</header><!-- .entry-header -->

				<?php if ( 'post' == get_post_type() ) : // For Posts ?>
				<div class="entry-meta entry-meta-header-after">
					<ul>
						<li><?php bezel_posted_on(); ?></li>
						<li><?php bezel_posted_by(); ?></li>
					</ul>
				</div><!-- .entry-meta -->
				<?php endif; ?>
			</div><!-- .entry-header-wrapper -->

			<?php if ( bezel_has_excerpt() ) : ?>
			<div class="entry-summary">
				<?php the_excerpt(); ?>
			</div><!-- .entry-summary -->
			<?php endif; ?>

			<div class="more-link-wrapper">
				<a href="<?php echo esc_url( get_permalink() ); ?>" class="more-link"><?php esc_html_e( 'Read More', 'bezel' ); ?></a>
			</div><!-- .more-link-wrapper -->
		</div><!-- .entry-data-wrapper -->

	</div><!-- .post-content-wrapper -->
</article><!-- #post-## -->
