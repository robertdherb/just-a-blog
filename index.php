<?php
	/*
	 *
	 * Just a Blog
	 * http://qualityretro.net
	 *
	 * A simple blogging software that leaves presentation up to the user.
	 *
	 * (c) 2016 Robert D Herb
	 * All rights reserved.
	 *
	 * For more information see LICENSE
	 *
	 */

$documentRoot = $_SERVER["DOCUMENT_ROOT"];
require_once( "functions.php" );
require_once( "lib/parsedown/Parsedown.php" );

	/* This should probably be an ini file */
$url = "http://localhost/";
if( file_exists( "./blogdir.txt" ) ) {
	$blogDir = file_get_contents( "blogdir.txt" );
}

else {
	trigger_error( "Could not find blogdir.txt, make sure it is in the same
	directory as index.php. Assuming blog is at \"/\"", E_USER_NOTICE );
	
	$blogDir = "";
}

//$blogDir = $documentRoot . "/" . 
	preg_match( "([0-9A-Za-z_\-]+)", $blogDir ) . "/";

$pages = scandir( "pages/" );
$pages = array_diff( $pages, array( "..", "." ) );
$posts = scandir( "posts/" );
$posts = array_diff( $posts, array( "..", "." ) );

	/* Make sure a home page exists. One should be supplied for you. */
if( !file_exists( "pages/home.md" ) ) {
	trigger_error( "No home page. Make sure there is a file named home.md in 
		the pages directory.", E_USER_ERROR );
}

$postDates = array();
foreach( $posts as $thisPost ) {
//	$postDates[filectime( "posts/" . $thisPost)] = $thisPost;
	$postDates[] = filectime( "posts/" . $thisPost);
}

$posts = array_combine( $postDates, $posts );

sort( $pages );
krsort( $posts );

$headerHtml = "templates/header.html";
include( "header.php" );
$parsedown = new Parsedown();

if( isset( $_GET['page'] ) ) {
	$content = file_get_contents( "pages/" . $_GET['page'] . ".md" );
}
else if( isset( $_GET['post'] ) ) {
	$content = file_get_contents( "posts/" . $_GET['post'] . ".md" );

}
else {
	print( "
	<ul id=\"posts\">" );
	foreach( $posts as $thisPost ) {
		print( "
		<li><a href=\"" . $url . $blogDir . "pages/" . $thisPost . "\">" . date( "Y-m-d", key( $posts ) ) . " - " . format_name( $thisPost ) . "</a></li>" );
	}
	print( "
	</ul>" );

write_html( file_get_contents( "html/footer.html" ) );
}

?>
