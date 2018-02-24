<?php
build_nav();
$title = "Just a Blog!";

if( isset( $_GET['page'] ) ) {
	$thisPage = $_GET['page'];
	$title .= " - " . format_name( $thisPage );
}

write_html( file_get_contents( "html/header.html" ), $title, $blogDir, $nav );
?>
