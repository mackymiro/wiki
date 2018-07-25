<?php

/**
 * Plugin Name: Add IDs to Header Tags
 * Plugin URI: http://wordpress.org/plugins/add-ids-to-header-tags/
 * Description: Add an `id` attribute to header tags in your posts, to let users deep-link into your content.
 * Author: George Stephanis
 * Version: 1.0
 * Author URI: http://stephanis.info
 */

add_filter( 'the_content', 'add_ids_to_header_tags' );
function add_ids_to_header_tags( $content ) {

	if ( ! is_single() ) {
		return $content;
	}

	$pattern = '#(?P<full_tag><(?P<tag_name>h\d)(?P<tag_extra>[^>]*)>(?P<tag_contents>[^<]*)</h\d>)#i';
	if ( preg_match_all( $pattern, $content, $matches, PREG_SET_ORDER ) ) {
		$find = array();
		$replace = array();
		foreach( $matches as $match ) {
			if ( strlen( $match['tag_extra'] ) && false !== stripos( $match['tag_extra'], 'id=' ) ) {
				continue;
			}
			$find[]    = $match['full_tag'];
			$id        = sanitize_title( $match['tag_contents'] );
			$id_attr   = sprintf( ' id="%s"', $id );
			$extra     = sprintf( ' <a class="deep-link" href="#%s">#</a>', $id );
			$replace[] = sprintf( '<%1$s%2$s%3$s>%4$s%5$s</%1$s>', $match['tag_name'], $match['tag_extra'], $id_attr, $match['tag_contents'], $extra );
		}
		$content = str_replace( $find, $replace, $content );
	}

	return $content;
}
