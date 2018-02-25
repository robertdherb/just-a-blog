<?php

function write_html() {

	$argc = func_num_args();
	$argv = func_get_args();

	$output = $argv[0];

	if( $argc > 0 ) {
		for( $i = 1; $i < $argc; $i++ ) {
			$searchThisPunk = "(\{" . ($i - 1) . "\})";
			if( is_array( $argv[$i] ) ) {
				foreach( $argv[$i] as $thisArg ) {
					$output = preg_replace( $searchThisPunk, $thisArg, $output );
				}
			}

			else {
				$output = preg_replace( $searchThisPunk, $argv[$i], $output );
			}
		}
	}

// This is ripe for breaking stuff. Move this into a different function please.
	$output = str_replace( "{allposts}", build_blog(), $output );

	print( $output );

}

function build_blog() {
	
	$posts = get_posts();
	$returnThisPunk = "<ul id=\"listOfPosts\">";

	foreach( $posts as $date => $thisPost ) {
		$returnThisPunk .= "<li class=\"postSnippet\">\n\t
<span class=\"listTitle\"><a href=\"" . URL . BLOGDIR . "/" . $thisPost . "\">" .
format_name( $thisPost ) . " - <span style=\"postListDate\">" .
date( "Y-m-d", $date ) . "</span></a></span><br />" .
get_post_snippet( $thisPost );
	}

	$returnThisPunk .= "</ul>";

	return $returnThisPunk;

}

function format_name( $name ) {

	$returnThisName = preg_replace( "(-)", " ", $name );
	$returnThisName = substr( $returnThisName, 0, strpos( $returnThisName, ".md" ) );
	$returnThisName = ucwords( $returnThisName );

	return $returnThisName;

}

function get_posts() {
	
	$argc = func_num_args();
	$argv = func_get_args();
	
	$posts = array_diff( scandir( "posts/" ), array( "..", "." ) );
	$postDates = array();
	foreach( $posts as $thisPost ) {
		$postDates[] = filectime( "posts/" . $thisPost);
	}
	
	$posts = array_combine( $postDates, $posts );
	krsort( $posts );

	if( $argc && $argv[0] > 1 ) {
		$posts = array_slice( $posts, 0, $argv[0] );
	}

	return $posts;

}

function get_post_snippet( $post ) {

	$content = file_get_contents( "posts/" . $post );

	if( strlen( $content ) > 500 ) {
		$shortText = substr($content, 0, strpos( $content, '.', 500) ); // Short text to first period after 500 characters
	}
	else {
		$shorText = $content;
	}

	$parsedown = new Parsedown();

	return strip_tags( $parsedown->text( $content ) );

}

function link_name( $name ) {
	return str_replace( ".md", "", $name );
}

function list_all_posts() {
	
	$posts = get_posts();

	$output = "\n\t<ul id=\"posts\">";
	
	foreach( $posts as $thisPost ) {
		# $output .= "\n\t\t<li><a href=\"" . URL . BLOG_DIR . "/post/" . link_name( $thisPost ) . "\">" . date( "Y-m-d", key( $posts ) ) . " - " . format_name( $thisPost ) . "</a></li>";
		$output .= "\n\t\t<li><a href=\"" . URL . BLOG_DIR . "/index.php?post=" . link_name( $thisPost ) . "\">" . date( "Y-m-d", key( $posts ) ) . " - " . format_name( $thisPost ) . "</a></li>";
	}

	$output .= "\n\t</ul>";

	return $output;

}

function set_title() {

	$title = TITLE;

	if( isset( $_GET['page'] ) ) {
		$thisPage = $_GET['page'];
		$title .= " - " . format_name( $thisPage );
	}

	return $title;

}

function build_nav( $arrayOfPages ) {

	$nav = "<ul class=\"nav\">\n";
	foreach( $arrayOfPages as $thisPage ) {
		#$nav .= "\t\t\t<li id=\"" . $thisPage . "\">\n\t\t\t\t<a href=\"" . URL . BLOG_DIR . "/page/" . link_name( $thisPage ) . "\">" . format_name( $thisPage ) . "</a></li>\n";
		$nav .= "\t\t\t<li id=\"" . $thisPage . "\">\n\t\t\t\t<a href=\"" . URL . BLOG_DIR . "index.php?page=" . link_name( $thisPage ) . "\">" . format_name( $thisPage ) . "</a></li>\n";
	}
	$nav .= "</ul>";

	return $nav;
}

?>
