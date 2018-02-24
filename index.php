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
define( "TITLE", "Just-A-Blog" );
define( "URL", "http://robertdherb.com/" );
if( file_exists( "./blogdir.txt" ) ) {
	$blogDir = file_get_contents( "blogdir.txt" );
}

else {
	trigger_error( "Could not find blogdir.txt, make sure it is in the same
	directory as index.php. Assuming blog is at \"/\"", E_USER_NOTICE );
	
	$blogDir = "";
}
$title = TITLE; // Change the defined title to a var to let me change it later.

//$blogDir = $documentRoot . "/" . 
	preg_match( "([0-9A-Za-z_\-]+)", $blogDir ) . "/";

	define( "BLOG_DIR", $blogDir );

$pages = scandir( "pages/" );
$pages = array_diff( $pages, array( "..", "." ) );

	/* Make sure a home page exists. One should be supplied for you. */
if( !file_exists( "pages/home.md" ) ) {
	trigger_error( "No home page. Make sure there is a file named home.md in 
		the pages directory.", E_USER_ERROR );
}

sort( $pages );

// Build the header
$headerHtml = "templates/header.html";
write_html( file_get_contents( "html/header.html" ), set_title(), $blogDir, build_nav( $pages ) );
$parsedown = new Parsedown();

if( isset( $_GET['page'] ) ) {
	$content = file_get_contents( "pages/" . $_GET['page'] . ".md" );
}
else if( isset( $_GET['post'] ) ) {
	$content = file_get_contents( "posts/" . $_GET['post'] . ".md" );

}
else {
	$content = file_get_contents( "pages/home.md" );
}

print( write_html( $parsedown->text( $content ) ) );

write_html( file_get_contents( "html/footer.html" ) );


?>
