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
		if ( get_theme_mod( 'show_post_date', true ) ) {
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
				esc_html( '%s' ),
				$time_string
			);
		}
		echo '<span class="c-post__meta__date posted-on">' . $posted_on . ' </span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		if ( get_theme_mod( 'show_post_author', true ) && get_theme_mod( 'show_post_date', true ) ) {
			echo esc_html( '|', 'wp-meliora' );
		}
	}
endif;
function wp_meliora_show_archive_post_meta() {
	wp_meliora_posted_on();
	wp_meliora_posted_by();
}

add_action( 'wp_meliora_post_meta_area', 'wp_meliora_show_archive_post_meta' );

if ( ! function_exists( 'wp_meliora_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function wp_meliora_posted_by() {
		if ( get_theme_mod( 'show_post_author', true ) ) {
			$byline = sprintf(
			/* translators: %s: post author. */
				esc_html( '%s' ),
				'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
			);

			echo '<span class="byline"> ' . $byline . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
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
				$categories_list = get_the_category_list( esc_html__( ', ', 'wp-meliora' ) );
				if ( $categories_list ) {
					/* translators: 1: list of categories. */
					printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'wp-meliora' ) . '</span>', $categories_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				}

				/* translators: used between list items, there is a space after the comma */
				$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'wp-meliora' ) );
				if ( $tags_list ) {
					/* translators: 1: list of tags. */
					printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'wp-meliora' ) . '</span>', $tags_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				}
			}

			if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
				echo '<span class="comments-link">';
				comments_popup_link(
					sprintf(
						wp_kses(
						/* translators: %s: post title */
							__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'wp-meliora' ),
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
						__( 'Edit <span class="screen-reader-text">%s</span>', 'wp-meliora' ),
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
				$categories_list = get_the_category_list( esc_html__( ', ', 'wp-meliora' ) );
				if ( $categories_list ) {
					/* translators: 1: list of categories. */
					echo wp_kses_post( sprintf( '<span class="c-post_cats s-post-meta cat-links">' . esc_html( '%1$s' ) . '</span>', $categories_list ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				}
			}
		}
	}
endif;

if ( ! function_exists( 'wp_meliora_post_tags_archive' ) ) :
	function wp_meliora_post_tags_archive() {
		if ( get_theme_mod( 'show_tags_archive', true ) ) {
			$tags = get_the_tags();
			if ( $tags ) {
				echo '<div class="c-post__tags">'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				$i = 0;
				foreach ( $tags as $tag ) {
					$i ++;
					if ( $i <= 3 ) { ?>
                    <a aria-label="<?php echo esc_attr( $tag->name ); ?>" class="c-post__tags__tag" href="<?php echo esc_attr( get_tag_link( $tag->term_id ) ); ?>">#<?php echo esc_html( $tag->name ); ?></a><?php
					} else {
						$tags_count = count( $tags ) - 3; ?>
                        <span class="c-post__tags__tag c-post__tags__tag--more"><?php echo "+" . esc_html( $tags_count ); ?></span>
						<?php
						break;
					}
				}
				echo '</div>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}
		}
	}
endif;
function wp_meliora_archive_post_tags() {
	wp_meliora_post_tags_archive();
}

add_action( 'wp_meliora_archive_post_tags_area', 'wp_meliora_archive_post_tags' );

if ( ! function_exists( 'wp_meliora_post_tags_single' ) ) :
	function wp_meliora_post_tags_single() {
		$tags = get_the_tags();
		if ( $tags ) {
			echo '<div class="c-post__tags">';
			foreach ( $tags as $tag ) { ?>
                <a aria-label="<?php echo esc_attr( $tag->name ); ?>" class="c-post__tags__tag" href="<?php echo esc_attr( get_tag_link( $tag->term_id ) ); ?>">#<?php echo esc_html( $tag->name ); ?></a>
				<?php
			}
			echo '</div>';
		}
	}
endif;

if ( ! function_exists( 'wp_meliora_slider_menu' ) ) {
	function wp_meliora_slider_menu_items() {
		$menu_name = 'menu-2';
		if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $menu_name ] ) ) :
			$menu             = wp_get_nav_menu_object( $locations[ $menu_name ] );
			$menu_items       = wp_get_nav_menu_items( $menu->term_id );
			$menu_items_count = count( (array) $menu_items );
			foreach ( (array) $menu_items as $key => $menu_item ) :
				$title = $menu_item->title;
				$url   = $menu_item->url;

				echo sprintf( '<div class="c-categories-list__slide %s">', wp_meliora_current_menu_item( esc_url( $url ) ) );
				echo sprintf( '<a href="%s">%s</a></div>', esc_url( $url ), esc_html( $title ) );

			endforeach;
		endif;
	}
}

if ( ! function_exists( 'wp_meliora_slider_menu' ) ) {
	function wp_meliora_slider_menu() {
		if ( has_nav_menu( 'menu-2' ) && get_theme_mod( 'show_slider_menu_index', true ) && is_home() || has_nav_menu( 'menu-2' ) && get_theme_mod( 'show_slider_menu_author', true ) && is_author() || has_nav_menu( 'menu-2' ) && get_theme_mod( 'show_slider_menu_tags', true ) && is_tag() || has_nav_menu( 'menu-2' ) && get_theme_mod( 'show_slider_menu_cats', true ) && is_category() ) {
			echo '<nav class="c-categories-list">';  // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			echo sprintf( '<div class="c-categories-list__list js-categories-list s-categories-list" data-rtl="%s">', esc_attr( wp_meliora_is_rtl() ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			wp_meliora_slider_menu_items();
			echo '</div>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			echo '</nav>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

		}
	}
}
function wp_meliora_show_slider_menu_in_code_area_name() {
	wp_meliora_slider_menu();
}

add_action( 'wp_meliora_slider_menu_area', 'wp_meliora_show_slider_menu_in_code_area_name' );


if ( ! function_exists( 'wp_meliora_get_blog_posts_page_url' ) ) :
	function wp_meliora_get_blog_posts_page_url() {

		// If front page is set to display a static page, get the URL of the posts page.
		if ( 'page' === get_option( 'show_on_front' ) ) {
			return get_permalink( get_option( 'page_for_posts' ) );
		}

		// The front page is the posts page. Get its URL.
		return get_home_url();
	}
endif;

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
            <div class="c-post__thumbnail">
				<?php the_post_thumbnail( 'full' ); ?>
            </div><!-- .post-thumbnail -->
		<?php
		else: ?>
            <div class="c-post__thumbnail">
				<?php the_post_thumbnail( 'full' ); ?>
            </div><!-- .post-thumbnail -->
		<?php
		endif; // End is_singular().
	}
endif;

if ( ! function_exists( 'wp_meliora_post_content' ) ) :
	function wp_meliora_post_content() {
		the_content(
			sprintf(
				wp_kses(
				/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'wp-meliora' ),
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
endif;

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
		$wp_meliora_facebook  = get_theme_mod( 'facebook', "" );
		$wp_meliora_twitter   = get_theme_mod( 'twitter', "" );
		$wp_meliora_instagram = get_theme_mod( 'instagram', "" );
		$wp_meliora_linkedin  = get_theme_mod( 'linkedin', "" );

		if ( $wp_meliora_facebook ) {
			echo sprintf( '<a href="%s" aria-label="%s" class="social-link" target="_blank"><span class="dashicons dashicons-facebook-alt"></span></a>', esc_url( $wp_meliora_facebook ), esc_html__( 'Facebook', 'wp-meliora' ) );
		}

		if ( $wp_meliora_twitter ) {
			echo sprintf( '<a href="%s" aria-label="%s" class="social-link" target="_blank"><span class="dashicons dashicons-twitter"></span></a>', esc_url( $wp_meliora_twitter ), esc_html__( 'Twitter', 'wp-meliora' ) );
		}

		if ( $wp_meliora_instagram ) {
			echo sprintf( '<a href="%s" aria-label="%s" class="social-link" target="_blank"><span class="dashicons dashicons-instagram"></span></a>', esc_url( $wp_meliora_instagram ), esc_html__( 'Instagram', 'wp-meliora' ) );
		}

		if ( $wp_meliora_linkedin ) {
			echo sprintf( '<a href="%s" aria-label="%s" class="social-link" target="_blank"><span class="dashicons dashicons-linkedin"></span></a>', esc_url( $wp_meliora_linkedin ), esc_html__( 'Linkedin', 'wp-meliora' ) );
		}
	}
endif;

if ( ! function_exists( 'wp_meliora_site_layout_class' ) ) :
	/**
	 * Generate Site Layout Class
	 */
	function wp_meliora_site_layout_class() {
		$wp_meliora_site_layout = get_theme_mod( 'site_layout', "left" );

		if ( $wp_meliora_site_layout == "left" ) {
			echo esc_html( 'is-sidebar-content' );
		}

		if ( $wp_meliora_site_layout == "center" ) {
			echo esc_html( 'no-sidebar' );
		}

		if ( $wp_meliora_site_layout == "right" ) {
			echo esc_html( 'is-content-sidebar' );
		}

	}
endif;

if ( ! function_exists( 'wp_meliora_posts_pagination' ) ) :
	/**
	 * Generate Posts Pagination
	 */
	function wp_meliora_posts_pagination() {
		the_posts_pagination( array(
			'screen_reader_text' => ' ',
			'mid_size'           => 2,
			'prev_text'          => '<span class="dashicons dashicons-arrow-left-alt2"></span>',
			'next_text'          => '<span class="dashicons dashicons-arrow-right-alt2"></span>',
		) );
	}
endif;

if ( ! function_exists( 'wp_meliora_current_menu_item' ) ) {
	function wp_meliora_current_menu_item( $url ) {
		global $wp;
		$current_url = home_url( $wp->request );
		if ( rtrim( $url, '/' ) === rtrim( $current_url, '/' ) ) {
			return esc_attr( "current-cat" );
		}
	}
}


if ( ! function_exists( 'wp_meliora_share_links' ) ) {
	function wp_meliora_share_links() {
		if ( get_theme_mod( 'show_share_icons', true ) ) {
			$wp_meliora_linkedin_url = "https://www.linkedin.com/shareArticle?mini=true&url=" . get_permalink() . "&title=" . get_the_title();
			$wp_meliora_twitter_url  = "https://twitter.com/intent/tweet?url=" . get_permalink() . "&title=" . get_the_title();
			$wp_meliora_facebook_url = "https://www.facebook.com/sharer.php?u=" . get_permalink();

			echo '<div class="c-social-share">';  // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			echo sprintf( '<span class="c-social-share__title">%s</span>', esc_html_e( 'Share', 'wp-meliora' ) );
			echo sprintf( '<a class="c-social-share__link" target="_blank" href="%s"><span class="dashicons dashicons-facebook-alt c-social-share__link__icon"></span></a>', esc_url( $wp_meliora_facebook_url ) );
			echo sprintf( '<a class="c-social-share__link" target="_blank" href="%s"><span class="dashicons dashicons-twitter c-social-share__link__icon"></span></a>', esc_url( $wp_meliora_twitter_url ) );
			echo sprintf( '<a class="c-social-share__link" target="_blank" href="%s"><span class="dashicons dashicons-linkedin c-social-share__link__icon"></span></a>', esc_url( $wp_meliora_linkedin_url ) );
			echo '</div>';  // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
	}
}
if ( ! function_exists( 'wp_meliora_show_socials_in_code_area_name' ) ) {
	function wp_meliora_show_socials_in_code_area_name() {
		wp_meliora_post_tags_single();
		wp_meliora_share_links();
	}
}
add_action( 'wp_meliora_post_footer', 'wp_meliora_show_socials_in_code_area_name' );

if ( ! function_exists( 'wp_meliora_is_rtl' ) ) {
	function wp_meliora_is_rtl() {
		if ( is_rtl() ) {
			return 1;
		} else {
			return 0;
		}
	}
}

if ( ! function_exists( 'wp_meliora_post_excerpt' ) ) {
	function wp_meliora_post_excerpt() {
		if ( get_theme_mod( 'show_post_excerpt', false ) ):
			echo '<main class="c-post__main s-post-archive">'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			the_excerpt();
			echo '</main>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		endif;
	}
}

if ( ! function_exists( 'wp_meliora_post_main' ) ) {
	function wp_meliora_post_main() {
		wp_meliora_post_excerpt();
	}
}

add_action( 'wp_meliora_archive_post_main', 'wp_meliora_post_main' );

if ( ! function_exists( 'wp_meliora_footer_socials' ) ) {
	function wp_meliora_footer_socials() {
		if ( get_theme_mod( 'facebook', "" ) || get_theme_mod( 'twitter', "" ) || get_theme_mod( 'linkedin', "" ) || get_theme_mod( 'instagram', "" ) ) {
			echo '<div class="c-footer__socials s-footer-socials">'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			wp_meliora_socials_links();
			echo '</div>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
	}
}
