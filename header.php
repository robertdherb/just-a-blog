<?php
build_nav();
$title = set_title();
write_html( file_get_contents( "html/header.html" ), $title, $blogDir, $nav );
?>
