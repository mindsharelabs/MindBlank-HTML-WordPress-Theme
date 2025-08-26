<?php
/**
 * Gutenberg → Bootstrap 5 class mapper (text blocks)
 * -------------------------------------------------
 * Adds appropriate Bootstrap classes to core text blocks while preserving
 * existing Gutenberg classes and user-specified classes.
 *
 * Scope: paragraph, heading, list, quote, pullquote, code, preformatted, verse
 * Extendable: add other core/blocks as needed.
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }
$MIND_BLANK_CAN_USE_TAGPROC = class_exists( '\\WP_HTML_Tag_Processor' );

/**
 * Helper: inject one or more classes into the first HTML tag of $html.
 * - Preserves existing class attribute if present.
 * - Skips when $html is empty or doesn't start with an element.
 */
function mindblank_add_class_to_first_tag( string $html, $classes ) : string {
	if ( trim( $html ) === '' ) { return $html; }
	$classes = is_array( $classes ) ? $classes : preg_split( '/\s+/', (string) $classes, -1, PREG_SPLIT_NO_EMPTY );
	if ( empty( $classes ) ) { return $html; }

	if ( class_exists( '\\WP_HTML_Tag_Processor' ) ) {
		$tp = new \WP_HTML_Tag_Processor( $html );
		if ( ! $tp->next_tag() ) { return $html; }
		$existing = $tp->get_attribute( 'class' );
		$merged = array_values( array_unique( array_filter( array_merge( preg_split( '/\s+/', (string) $existing, -1, PREG_SPLIT_NO_EMPTY ), $classes ) ) ) );
		$tp->set_attribute( 'class', implode( ' ', $merged ) );
		return $tp->get_updated_html();
	}

	// Fallback: previous regex implementation
	$classes = is_array( $classes ) ? $classes : preg_split( '/\s+/', (string) $classes, -1, PREG_SPLIT_NO_EMPTY );
	if ( empty( $classes ) ) { return $html; }
	if ( ! preg_match( '/^<([a-zA-Z0-9\-]+)([^>]*)>/', $html, $m, PREG_OFFSET_CAPTURE ) ) {
		return $html; // not an element
	}
	$full   = $m[0][0];
	$tag    = $m[1][0];
	$attrs  = $m[2][0];
	if ( preg_match( '/\sclass\s*=\s*"([^"]*)"/i', $attrs, $cm ) ) {
		$existing = preg_split( '/\s+/', trim( $cm[1] ) );
		$merged   = array_values( array_unique( array_filter( array_merge( $existing, $classes ) ) ) );
		$attrs    = preg_replace( '/\sclass\s*=\s*"([^"]*)"/i', ' class="' . esc_attr( implode( ' ', $merged ) ) . '"', $attrs );
	} else {
		$attrs .= ' class="' . esc_attr( implode( ' ', $classes ) ) . '"';
	}
	$replacement = '<' . $tag . $attrs . '>';
	return $replacement . substr( $html, strlen( $full ) );
}

/**
 * Helper: add classes to all occurrences of a given tag selector in HTML.
 * (Very lightweight and regex-based; acceptable for WP block output.)
 */
function mindblank_add_class_to_tag( string $html, string $tag, $classes ) : string {
	$classes = is_array( $classes ) ? $classes : preg_split( '/\s+/', (string) $classes, -1, PREG_SPLIT_NO_EMPTY );
	if ( empty( $classes ) || trim( $html ) === '' ) { return $html; }

	if ( class_exists( '\\WP_HTML_Tag_Processor' ) ) {
		$tp = new \WP_HTML_Tag_Processor( $html );
		while ( $tp->next_tag( [ 'tag_name' => strtoupper( $tag ) ] ) ) {
			$existing = $tp->get_attribute( 'class' );
			$merged = array_values( array_unique( array_filter( array_merge( preg_split( '/\s+/', (string) $existing, -1, PREG_SPLIT_NO_EMPTY ), $classes ) ) ) );
			$tp->set_attribute( 'class', implode( ' ', $merged ) );
		}
		return $tp->get_updated_html();
	}

	// Fallback: regex implementation
	$pattern = '/<(' . preg_quote($tag,'/') . ')(\s+[^>]*)?>/i';
	return preg_replace_callback( $pattern, function( $m ) use ( $classes ) {
		$attrs = isset($m[2]) ? $m[2] : '';
		if ( preg_match( '/\sclass\s*=\s*"([^"]*)"/i', $attrs, $cm ) ) {
			$existing = preg_split( '/\s+/', trim( $cm[1] ) );
			$merged   = array_values( array_unique( array_filter( array_merge( $existing, $classes ) ) ) );
			$attrs    = preg_replace( '/\sclass\s*=\s*"([^"]*)"/i', ' class="' . esc_attr( implode( ' ', $merged ) ) . '"', $attrs );
		} else {
			$attrs .= ' class="' . esc_attr( implode( ' ', $classes ) ) . '"';
		}
		return '<' . $m[1] . $attrs . '>';
	}, $html );
}

/**
 * Helper: add classes to elements that match a simple class selector.
 * Example: mindblank_add_class_to_selector($html, 'figcaption', ['figure-caption'])
 */
function mindblank_add_class_to_selector( string $html, string $selector, $classes ) : string {
	list($tag, $required_class) = array_pad( explode('.', $selector, 2 ), 2, '' );
	$classes = is_array( $classes ) ? $classes : preg_split( '/\s+/', (string) $classes, -1, PREG_SPLIT_NO_EMPTY );

	if ( class_exists( '\\WP_HTML_Tag_Processor' ) ) {
		$tp = new \WP_HTML_Tag_Processor( $html );
		while ( $tp->next_tag( [ 'tag_name' => strtoupper( $tag ) ] ) ) {
			$existing = (string) $tp->get_attribute( 'class' );
			if ( $required_class && strpos( $existing, $required_class ) === false ) {
				continue;
			}
			$merged = array_values( array_unique( array_filter( array_merge( preg_split( '/\s+/', $existing, -1, PREG_SPLIT_NO_EMPTY ), $classes ) ) ) );
			$tp->set_attribute( 'class', implode( ' ', $merged ) );
		}
		return $tp->get_updated_html();
	}

	// Fallback: previous regex implementation
	$pattern = '/<(' . preg_quote($tag,'/') . ')([^>]*)>/i';
	return preg_replace_callback( $pattern, function( $m ) use ( $required_class, $classes ) {
		$attrs = $m[2];
		if ( $required_class && strpos( $attrs, $required_class ) === false ) {
			return $m[0];
		}
		if ( preg_match( '/\sclass\s*=\s*"([^"]*)"/i', $attrs, $cm ) ) {
			$existing = preg_split( '/\s+/', trim( $cm[1] ) );
			$merged   = array_values( array_unique( array_filter( array_merge( $existing, $classes ) ) ) );
			$attrs    = preg_replace( '/\sclass\s*=\s*"([^"]*)"/i', ' class="' . esc_attr( implode( ' ', $merged ) ) . '"', $attrs );
		} else {
			$attrs .= ' class="' . esc_attr( implode( ' ', $classes ) ) . '"';
		}
		return '<' . $m[1] . $attrs . '>';
	}, $html );
}

/**
 * Map Gutenberg block render output to include Bootstrap classes.
 */
add_filter( 'render_block', function( $block_content, $block ) {
	$block_name = isset( $block['blockName'] ) ? $block['blockName'] : '';
	$attrs      = isset( $block['attrs'] ) ? (array) $block['attrs'] : [];

	if ( ! $block_name || ! is_string( $block_content ) || $block_content === '' ) {
		return $block_content;
	}

	// Helper to map text alignment if Gutenberg didn't already provide .has-text-align-*
	$align_class = '';
	if ( ! empty( $attrs['textAlign'] ) ) {
		$map = [ 'left' => 'text-start', 'center' => 'text-center', 'right' => 'text-end' ];
		if ( isset( $map[ $attrs['textAlign'] ] ) ) { $align_class = $map[ $attrs['textAlign'] ]; }
	}

	switch ( $block_name ) {
		case 'core/paragraph': {
			$classes = ['mb-3'];
			// Drop cap ⇒ treat like Bootstrap lead text
			if ( ! empty( $attrs['dropCap'] ) ) { $classes[] = 'lead'; }
			if ( $align_class ) { $classes[] = $align_class; }
			$block_content = mindblank_add_class_to_first_tag( $block_content, $classes );
			break;
		}

		case 'core/heading': {
			$classes = ['mb-3'];
			// Optional: map font size presets to display-* if large
			$font = isset( $attrs['fontSize'] ) ? (string) $attrs['fontSize'] : '';
			$display_map = [ 'xxl' => 'display-2', 'xl' => 'display-3', 'lg' => 'display-5' ];
			if ( isset( $display_map[ $font ] ) ) { $classes[] = $display_map[ $font ]; }
			if ( $align_class ) { $classes[] = $align_class; }
			$block_content = mindblank_add_class_to_first_tag( $block_content, $classes );
			break;
		}

		case 'core/list': {
			$classes = ['mb-3'];
			// If the block style is "list-style: none" in editor, approximate with list-unstyled
			if ( ! empty( $attrs['className'] ) && strpos( $attrs['className'], 'is-style-unstyled' ) !== false ) {
				$classes[] = 'list-unstyled';
			}
			// Support inline lists if author chooses a custom class `is-style-inline`
			if ( ! empty( $attrs['className'] ) && strpos( $attrs['className'], 'is-style-inline' ) !== false ) {
				$classes[] = 'list-inline';
				// Add list-inline-item to children list items
				$block_content = preg_replace( '/<li(\s+[^>]*)?>/i', '<li$1 class="list-inline-item">', $block_content );
			}
			$block_content = mindblank_add_class_to_first_tag( $block_content, $classes );
			break;
		}

		case 'core/quote': {
			// Add Bootstrap blockquote + footer class for citations
			$block_content = mindblank_add_class_to_first_tag( $block_content, ['blockquote', 'mb-4'] );
			$block_content = preg_replace( '/<cite(\s+[^>]*)?>/i', '<footer$1 class="blockquote-footer">', $block_content );
			$block_content = str_replace( '</cite>', '</footer>', $block_content );
			break;
		}

		case 'core/pullquote': {
			// Treat pullquote similarly but emphasize with border-start
			$block_content = mindblank_add_class_to_first_tag( $block_content, ['blockquote', 'mb-4', 'border-start', 'ps-3'] );
			$block_content = preg_replace( '/<cite(\s+[^>]*)?>/i', '<footer$1 class="blockquote-footer">', $block_content );
			$block_content = str_replace( '</cite>', '</footer>', $block_content );
			break;
		}

		case 'core/code': {
			// Ensure code samples look like Bootstrap code blocks
			$block_content = mindblank_add_class_to_first_tag( $block_content, ['code', 'mb-3'] );
			break;
		}

		case 'core/preformatted': {
			$block_content = mindblank_add_class_to_first_tag( $block_content, ['mb-3', 'p-3', 'bg-light', 'border', 'rounded'] );
			break;
		}

		case 'core/verse': {
			$block_content = mindblank_add_class_to_first_tag( $block_content, ['fst-italic', 'mb-3'] );
			break;
		}

		case 'core/image': {
			// Typically <figure class="wp-block-image"> <img ...> <figcaption>...
			$block_content = mindblank_add_class_to_first_tag( $block_content, ['figure','mb-3'] );
			$block_content = mindblank_add_class_to_tag( $block_content, 'img', ['img-fluid'] );
			$block_content = mindblank_add_class_to_tag( $block_content, 'figcaption', ['figure-caption','text-muted','mt-2'] );
			break;
		}

		case 'core/gallery': {
			// Map gallery grid to Bootstrap row/cols using block attr `columns`
			$block_content = mindblank_add_class_to_first_tag( $block_content, ['mb-4'] );

			// Determine desired row-cols based on Gutenberg `columns` (limit 1–6 for sanity)
			$cols = 0;
			if ( isset( $attrs['columns'] ) && is_numeric( $attrs['columns'] ) ) {
				$cols = max( 1, min( 6, (int) $attrs['columns'] ) );
			}
			$row_cols_classes = array_filter( [ 'row', 'g-3', 'row-cols-2', $cols ? 'row-cols-md-' . $cols : '' ] );

			if ( class_exists( '\\WP_HTML_Tag_Processor' ) ) {
				$tp = new \WP_HTML_Tag_Processor( $block_content );
				// Add row classes to the first UL in the gallery
				if ( $tp->next_tag( [ 'tag_name' => 'UL' ] ) ) {
					$existing = $tp->get_attribute( 'class' );
					$merged = array_values( array_unique( array_filter( array_merge( preg_split( '/\s+/', (string) $existing, -1, PREG_SPLIT_NO_EMPTY ), $row_cols_classes ) ) ) );
					$tp->set_attribute( 'class', implode( ' ', $merged ) );
				}
				// Add col to each LI
				while ( $tp->next_tag( [ 'tag_name' => 'LI' ] ) ) {
					$existing = $tp->get_attribute( 'class' );
					$merged = array_values( array_unique( array_filter( array_merge( preg_split( '/\s+/', (string) $existing, -1, PREG_SPLIT_NO_EMPTY ), [ 'col' ] ) ) ) );
					$tp->set_attribute( 'class', implode( ' ', $merged ) );
				}
				$block_content = $tp->get_updated_html();
			} else {
				// Fallback: previous regex approach
				$block_content = preg_replace( '/<ul(\s+[^>]*)class="([^"]*)"/i', '<ul$1 class="$2 row g-3' . ( $cols ? ' row-cols-2 row-cols-md-' . esc_attr( $cols ) : ' row-cols-2' ) . '"', $block_content );
				$block_content = preg_replace( '/<li(\s+[^>]*)?>/i', '<li$1 class="col">', $block_content );
			}

			// Make inner images fluid
			$block_content = mindblank_add_class_to_tag( $block_content, 'img', [ 'img-fluid' ] );
			// Caption styling
			$block_content = mindblank_add_class_to_tag( $block_content, 'figcaption', [ 'figure-caption', 'text-muted', 'mt-1' ] );

			break;
		}

		case 'core/media-text': {
			// Parent container behaves like a row; children map to cols
			$block_content = mindblank_add_class_to_first_tag( $block_content, ['row','g-4','align-items-center','mb-4'] );
			// Media column size from mediaWidth (percentage)
			$media_col = 'col-md-6';
			if ( isset( $attrs['mediaWidth'] ) && is_numeric( $attrs['mediaWidth'] ) ) {
				$w = (int) $attrs['mediaWidth'];
				if ( $w <= 25 ) $media_col = 'col-md-3';
				elseif ( $w <= 33 ) $media_col = 'col-md-4';
				elseif ( $w <= 50 ) $media_col = 'col-md-6';
				elseif ( $w <= 66 ) $media_col = 'col-md-8';
				else $media_col = 'col-md-9';
			}
			$txt_col = 'col-md'; // fill remaining space
			// Media position (left/right)
			$reverse = ( isset($attrs['mediaPosition']) && $attrs['mediaPosition'] === 'right' );
			if ( class_exists( '\\WP_HTML_Tag_Processor' ) ) {
				$tp = new \WP_HTML_Tag_Processor( $block_content );
				while ( $tp->next_tag() ) {
					$tag_name = $tp->get_tag();
					$cls = (string) $tp->get_attribute( 'class' );
					if ( $tag_name === 'FIGURE' && strpos( $cls, 'wp-block-media-text__media' ) !== false ) {
						$add = [ $media_col ];
						if ( $reverse ) { $add[] = 'order-md-2'; }
						$merged = array_values( array_unique( array_filter( array_merge( preg_split( '/\s+/', $cls, -1, PREG_SPLIT_NO_EMPTY ), $add ) ) ) );
						$tp->set_attribute( 'class', implode( ' ', $merged ) );
					}
					if ( $tag_name === 'DIV' && strpos( $cls, 'wp-block-media-text__content' ) !== false ) {
						$add = [ $txt_col ];
						if ( $reverse ) { $add[] = 'order-md-1'; }
						$merged = array_values( array_unique( array_filter( array_merge( preg_split( '/\s+/', $cls, -1, PREG_SPLIT_NO_EMPTY ), $add ) ) ) );
						$tp->set_attribute( 'class', implode( ' ', $merged ) );
					}
				}
				$block_content = $tp->get_updated_html();
			} else {
				$block_content = preg_replace( '/<figure([^>]*)class="([^"]*wp-block-media-text__media[^"]*)"/i', '<figure$1 class="$2 ' . esc_attr($media_col) . ( $reverse ? ' order-md-2' : '' ) . '"', $block_content );
				$block_content = preg_replace( '/<div([^>]*)class="([^"]*wp-block-media-text__content[^"]*)"/i', '<div$1 class="$2 ' . esc_attr($txt_col) . ( $reverse ? ' order-md-1' : '' ) . '"', $block_content );
			}
			// Make inner media responsive
			$block_content = mindblank_add_class_to_tag( $block_content, 'img', ['img-fluid'] );
			$block_content = mindblank_add_class_to_selector( $block_content, 'video', ['w-100'] );
			break;
		}

		case 'core/video': {
			// Make videos scale to container width; rely on connector for aspect ratio
			$block_content = mindblank_add_class_to_first_tag( $block_content, ['mb-4'] );
			$block_content = mindblank_add_class_to_tag( $block_content, 'video', ['w-100'] );
			break;
		}

		case 'core/embed': {
			// Ensure wrapper behaves like responsive ratio (connector sets aspect-ratio)
			$block_content = mindblank_add_class_to_first_tag( $block_content, ['mb-4'] );
			$block_content = mindblank_add_class_to_selector( $block_content, 'iframe', ['w-100'] );
			break;
		}

		case 'core/button': {
			$block_content = mindblank_add_class_to_first_tag( $block_content, ['mb-2'] );

			$size = '';
			if ( ! empty( $attrs['className'] ) ) {
				if ( strpos( $attrs['className'], 'is-style-large' ) !== false ) { $size = ' btn-lg'; }
				if ( strpos( $attrs['className'], 'is-style-small' ) !== false ) { $size = ' btn-sm'; }
			}
			$variant = ' btn-primary';
			if ( ! empty( $attrs['className'] ) && strpos( $attrs['className'], 'is-style-outline' ) !== false ) {
				$variant = ' btn-outline-primary';
			}

			if ( class_exists( '\\WP_HTML_Tag_Processor' ) ) {
				$tp = new \WP_HTML_Tag_Processor( $block_content );
				while ( $tp->next_tag( [ 'tag_name' => 'A' ] ) ) {
					$cls = (string) $tp->get_attribute( 'class' );
					if ( strpos( $cls, 'wp-block-button__link' ) === false ) { continue; }
					$add = preg_split( '/\s+/', trim( 'btn' . $variant . $size ) );
					$merged = array_values( array_unique( array_filter( array_merge( preg_split( '/\s+/', $cls, -1, PREG_SPLIT_NO_EMPTY ), $add ) ) ) );
					$tp->set_attribute( 'class', implode( ' ', $merged ) );
				}
				$block_content = $tp->get_updated_html();
			} else {
				$block_content = preg_replace(
					'/<a([^>]*)class="([^"]*wp-block-button__link[^"]*)"/i',
					'<a$1 class="$2 btn' . $variant . $size . '"',
					$block_content
				);
			}

			break;
		}

		case 'core/buttons': {
			// Button group container: flex with gap; map justify content if provided
			$block_content = mindblank_add_class_to_first_tag( $block_content, ['d-flex','flex-wrap','gap-2','mb-3'] );
			// Map layout justification (if present)
			if ( isset( $attrs['layout'] ) && is_array( $attrs['layout'] ) && ! empty( $attrs['layout']['justifyContent'] ) ) {
				$jc = $attrs['layout']['justifyContent'];
				$jc_map = [ 'left' => 'justify-content-start', 'center' => 'justify-content-center', 'right' => 'justify-content-end', 'space-between' => 'justify-content-between' ];
				if ( isset( $jc_map[ $jc ] ) ) {
					$block_content = mindblank_add_class_to_first_tag( $block_content, [ $jc_map[ $jc ] ] );
				}
			}
			break;
		}

		case 'core/file': {
			$block_content = mindblank_add_class_to_first_tag( $block_content, ['mb-3'] );
			if ( class_exists( '\\WP_HTML_Tag_Processor' ) ) {
				$tp = new \WP_HTML_Tag_Processor( $block_content );
				while ( $tp->next_tag( [ 'tag_name' => 'A' ] ) ) {
					$cls = (string) $tp->get_attribute( 'class' );
					if ( strpos( $cls, 'wp-block-file__button' ) === false ) { continue; }
					$add = [ 'btn', 'btn-primary' ];
					$merged = array_values( array_unique( array_filter( array_merge( preg_split( '/\s+/', $cls, -1, PREG_SPLIT_NO_EMPTY ), $add ) ) ) );
					$tp->set_attribute( 'class', implode( ' ', $merged ) );
				}
				$block_content = $tp->get_updated_html();
			} else {
				$block_content = preg_replace( '/<a([^>]*)class="([^"]*wp-block-file__button[^"]*)"/i', '<a$1 class="$2 btn btn-primary"', $block_content );
			}

			break;
		}

		case 'core/audio': {
			$block_content = mindblank_add_class_to_first_tag( $block_content, ['mb-4'] );
			$block_content = mindblank_add_class_to_tag( $block_content, 'audio', ['w-100'] );
			break;
		}

		case 'core/table': {
			$block_content = mindblank_add_class_to_first_tag( $block_content, [ 'table-responsive', 'mb-4' ] );
			if ( class_exists( '\\WP_HTML_Tag_Processor' ) ) {
				$tp = new \WP_HTML_Tag_Processor( $block_content );
				if ( $tp->next_tag( [ 'tag_name' => 'TABLE' ] ) ) {
					$cls = (string) $tp->get_attribute( 'class' );
					$merged = array_values( array_unique( array_filter( array_merge( preg_split( '/\s+/', $cls, -1, PREG_SPLIT_NO_EMPTY ), [ 'table', 'table-striped' ] ) ) ) );
					$tp->set_attribute( 'class', implode( ' ', $merged ) );
				}
				$block_content = $tp->get_updated_html();
			} else {
				$block_content = preg_replace( '/<table(\s+[^>]*)?>/i', '<table$1 class="table table-striped">', $block_content, 1 );
			}
			$block_content = mindblank_add_class_to_tag( $block_content, 'figcaption', [ 'figure-caption', 'text-muted', 'mt-2' ] );

			break;
		}

		case 'core/cover': {
			// Keep minimal: make inner content readable, let theme handle overlays.
			$block_content = mindblank_add_class_to_first_tag( $block_content, ['mb-4','position-relative','overflow-hidden','rounded'] );
			break;
		}
	}

	return $block_content;
}, 10, 2 );
