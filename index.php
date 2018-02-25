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
require_once( "config.php" );

$title = TITLE; // Change the defined title to a var to let me change it later.

//BLOGDIR = $documentRoot . "/" . 
	preg_match( "([0-9A-Za-z_\-]+)", BLOGDIR ) . "/";

	define( "BLOG_DIR", BLOGDIR );

$pages = preg_grep( '~\.md$~', scandir( "pages/" ) );

	/* Make sure a home page exists. One should be supplied for you. */
if( !file_exists( "pages/home.md" ) ) {
	trigger_error( "No home page. Make sure there is a file named home.md in 
		the pages directory.", E_USER_ERROR );
}

sort( $pages );

// Build the header
write_html( file_get_contents( "html/header.html" ), set_title(), BLOGDIR, build_nav( $pages ) );
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
