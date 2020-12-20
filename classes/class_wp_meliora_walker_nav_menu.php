<?php


class Wp_meliora_walker_nav_menu extends Walker_Nav_Menu {
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$object      = $item->object;
		$type        = $item->type;
		$title       = $item->title;
		$description = $item->description;
		$permalink   = $item->url;


		$output .= "<li class='" . implode( " ", $item->classes ) . "'>";

		//Add SPAN if no Permalink
		if ( $permalink ) {
			$output .= '<a href="' . $permalink . '">';
		}

		$output .= $title;

		if ( $permalink ) {
			$output .= '</a>';
		}

		if ( $args->walker->has_children ) {
			$output .= '<span aria-label="Toggle sub menu" role="button" class="dashicons dashicons-arrow-down-alt2 js-toggle-submenu"></span>';
		}
	}
}
