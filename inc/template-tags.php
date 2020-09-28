<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package wp_meliora
 */

if ( ! function_exists( 'wp_meliora_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function wp_meliora_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
		/* translators: %s: post date. */
			esc_html_x( '%s', 'post date', 'wp_meliora' ),
			$time_string
		);

		echo '<span class="c-post__meta__date posted-on">' . $posted_on . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
endif;

if ( ! function_exists( 'wp_meliora_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function wp_meliora_posted_by() {
		$byline = sprintf(
		/* translators: %s: post author. */
			esc_html_x( '%s', 'post author', 'wp_meliora' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="byline"> ' . $byline . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
endif;

if ( ! function_exists( 'wp_meliora_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function wp_meliora_entry_footer() {
		if ( is_singular() ) {
			// Hide category and tag text for pages.
			if ( 'post' === get_post_type() ) {
				/* translators: used between list items, there is a space after the comma */
				$categories_list = get_the_category_list( esc_html__( ', ', 'wp_meliora' ) );
				if ( $categories_list ) {
					/* translators: 1: list of categories. */
					printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'wp_meliora' ) . '</span>', $categories_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				}

				/* translators: used between list items, there is a space after the comma */
				$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'wp_meliora' ) );
				if ( $tags_list ) {
					/* translators: 1: list of tags. */
					printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'wp_meliora' ) . '</span>', $tags_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				}
			}

			if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
				echo '<span class="comments-link">';
				comments_popup_link(
					sprintf(
						wp_kses(
						/* translators: %s: post title */
							__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'wp_meliora' ),
							array(
								'span' => array(
									'class' => array(),
								),
							)
						),
						wp_kses_post( get_the_title() )
					)
				);
				echo '</span>';
			}

			edit_post_link(
				sprintf(
					wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Edit <span class="screen-reader-text">%s</span>', 'wp_meliora' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					wp_kses_post( get_the_title() )
				),
				'<span class="edit-link">',
				'</span>'
			);
		}
	}
endif;

if ( ! function_exists( 'wp_meliora_entry_category' ) ) :
	/**
	 * Prints HTML with meta information for the categories.
	 */
	function wp_meliora_entry_category() {
		if ( is_singular() ) {
			// Hide category and tag text for pages.
			if ( 'post' === get_post_type() ) {
				/* translators: used between list items, there is a space after the comma */
				$categories_list = get_the_category_list( esc_html__( ', ', 'wp_meliora' ) );
				if ( $categories_list ) {
					/* translators: 1: list of categories. */
					printf( '<span class="c-post_cats s-post-meta cat-links">' . esc_html__( '%1$s', 'wp_meliora' ) . '</span>', $categories_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				}
			}
		}
	}
endif;

function wp_meliora_post_tags_archive() {
	$tags = get_the_tags();
	if ( $tags ) {
		echo '<div class="c-post__tags">';
		$i = 0;
		foreach ( $tags as $tag ) {
			$i ++;
			if ( $i <= 3 ) { ?>
            <a aria-label="<?php echo $tag->name; ?>" class="c-post__tags__tag" href="<?php echo get_tag_link( $tag->term_id ); ?>">#<?php echo $tag->name; ?></a><?php
			} else {
				$tags_count = count( $tags ) - 3; ?>
                <span class="c-post__tags__tag c-post__tags__tag--more"><?php echo "+" . $tags_count; ?></span>
				<?php
                break;
			}
		}
		echo '</div>';
	}
}

function wp_meliora_post_tags_single() {
	$tags = get_the_tags();
	if ( $tags ) {
		echo '<div class="c-post__tags">';
		foreach ( $tags as $tag ) { ?>
            <a aria-label="<?php echo $tag->name; ?>" class="c-post__tags__tag" href="<?php echo get_tag_link( $tag->term_id ); ?>">#<?php echo $tag->name; ?></a>
			<?php
		}
		echo '</div>';
	}
}

function wp_meliora_categories_list() { ?>
    <li class="<?php if ( is_home() ) {
		echo "current-cat";
	} ?>"><a href="<?php echo wp_meliora_get_blog_posts_page_url(); ?>">All</a></li>
	<?php
	wp_list_categories( array( 'title_li' => '', 'depth' => 1 ) );
}

function wp_meliora_get_blog_posts_page_url() {

	// If front page is set to display a static page, get the URL of the posts page.
	if ( 'page' === get_option( 'show_on_front' ) ) {
		return get_permalink( get_option( 'page_for_posts' ) );
	}

	// The front page is the posts page. Get its URL.
	return get_home_url();
}

if ( ! function_exists( 'wp_meliora_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function wp_meliora_post_thumbnail() {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) :
			?>

            <div class="post-thumbnail">
				<?php the_post_thumbnail( 'large' ); ?>
            </div><!-- .post-thumbnail -->
		<?php
		endif; // End is_singular().
	}
endif;

function wp_meliora_post_content() {
	the_content(
		sprintf(
			wp_kses(
			/* translators: %s: Name of current post. Only visible to screen readers */
				__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'wp_meliora' ),
				array(
					'span' => array(
						'class' => array(),
					),
				)
			),
			wp_kses_post( get_the_title() )
		)
	);
}

if ( ! function_exists( 'wp_body_open' ) ) :
	/**
	 * Shim for sites older than 5.2.
	 *
	 * @link https://core.trac.wordpress.org/ticket/12563
	 */
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
endif;


if ( ! function_exists( 'wp_meliora_socials_links' ) ) :
	/**
	 * Display Social Networks
	 */
	function wp_meliora_socials_links() {
		$wp_meliora_facebook = get_theme_mod('facebook', "");
		$wp_meliora_twitter = get_theme_mod('twitter', "");
		$wp_meliora_instagram = get_theme_mod('instagram', "");
		$wp_meliora_linkedin = get_theme_mod('linkedin', "");

		if ($wp_meliora_facebook) {
		    echo sprintf('<a href="%s" class="social-link" target="_blank"><span class="dashicons dashicons-facebook-alt"></span></a>', esc_url($wp_meliora_facebook));
        }

		if ($wp_meliora_twitter) {
			echo sprintf('<a href="%s" class="social-link" target="_blank"><span class="dashicons dashicons-twitter"></span></a>', esc_url($wp_meliora_twitter));
		}

		if ($wp_meliora_instagram) {
			echo sprintf('<a href="%s" class="social-link" target="_blank"><span class="dashicons dashicons-instagram"></span></a>', esc_url($wp_meliora_instagram));
		}

		if ($wp_meliora_linkedin) {
			echo sprintf('<a href="%s" class="social-link" target="_blank"><span class="dashicons dashicons-linkedin"></span></a>', esc_url($wp_meliora_linkedin));
		}
	}
endif;
