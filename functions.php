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

	print( $output );

}

function format_name( $name ) {

	$returnThisName = preg_replace( "(_)", " ", $name );
	$returnThisName = substr( $returnThisName, 0, strpos( $returnThisName, ".md" ) );
	$returnThisName = ucwords( $returnThisName );

	return $returnThisName;

}

?>
