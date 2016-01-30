<?php

$ls = scandir( "./" );

echo "<pre>", print_r( $ls ), "</pre>";

echo $_SERVER['DOCUMENT_ROOT'];
?>
