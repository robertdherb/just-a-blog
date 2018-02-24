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

	$output = str_replace( "{allposts}", post_list(), $output );

	print( $output );

}

function format_name( $name ) {

	$returnThisName = preg_replace( "(-)", " ", $name );
	$returnThisName = substr( $returnThisName, 0, strpos( $returnThisName, ".md" ) );
	$returnThisName = ucwords( $returnThisName );

	return $returnThisName;

}

function link_name( $name ) {
	return str_replace( ".md", "", $name );
}

function post_list() {
	
	$posts = scandir( "posts/" );
	$posts = array_diff( $posts, array( "..", "." ) );
	$postDates = array();
	foreach( $posts as $thisPost ) {
		$postDates[] = filectime( "posts/" . $thisPost);
	}
	
	$posts = array_combine( $postDates, $posts );
	krsort( $posts );


	$output = "\n\t<ul id=\"posts\">";
	
	foreach( $posts as $thisPost ) {
		# $output .= "\n\t\t<li><a href=\"" . URL . BLOG_DIR . "/post/" . link_name( $thisPost ) . "\">" . date( "Y-m-d", key( $posts ) ) . " - " . format_name( $thisPost ) . "</a></li>";
		$output .= "\n\t\t<li><a href=\"" . URL . BLOG_DIR . "/index.php?post=" . link_name( $thisPost ) . "\">" . date( "Y-m-d", key( $posts ) ) . " - " . format_name( $thisPost ) . "</a></li>";
	}

	$output .= "\n\t</ul>";

	return $output;

}

?>
