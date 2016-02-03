<?php
$nav = "<ul class=\"nav\">\n";
foreach( $pages as $thisPage ) {
	$nav .= "\t\t\t<li id=\"" . $thisPage . "\">\n\t\t\t\t<a href=\"/" . $url . $blogDir . "/pages/" . $thisPage . "\">" . format_name( $thisPage ) . "</a></li>\n";
}
$nav .= "</ul>";
$title = "Just a Blog";

if( isset( $_GET['page'] ) ) {
	$thisPage = $_GET['page'];
	$title .= " - " . format_name( $thisPage );
}

write_html( file_get_contents( "html/header.html" ), $title, $nav );
?>
