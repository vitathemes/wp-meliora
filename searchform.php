<form role="search" method="get" class="c-search-form search-form" action="<?php echo esc_url(home_url( '/' )); ?>">
	<label class="c-search-form__label">
		<span class="c-search-form__label__text screen-reader-text"><?php echo esc_html_x( 'Search for:', 'label', 'wp-meliora' ) ?></span>
		<input type="search" class="c-search-form__input search-field"
			placeholder="<?php echo esc_attr_x( 'Search', 'placeholder' , 'wp-meliora' ) ?>"
			value="<?php echo get_search_query() ?>" name="s"
			title="<?php echo esc_attr_x( 'Search for:', 'label' , 'wp-meliora'  ) ?>" />
	</label>
    <button aria-label="<?php esc_attr_e('Search', 'wp-meliora'); ?>" type="submit" class="c-search-form__submit search-submit">
        <span class="dashicons dashicons-search"></span>
    </button>
</form>
