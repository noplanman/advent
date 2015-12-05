<?php
/**
 * Challenge solutions for Advent of Code.
 * http://adventofcode.com/
 *
 * @package AOC_Solutions
 */

// We'll be outputting plain text.
header( 'Content-Type: text/plain' );

require_once __DIR__ . '/includes/class-challenge.php';
$challenge_files = glob( __DIR__ . '/challenges/*.php' );
foreach ( $challenge_files as $challenge_file ) {
	require_once $challenge_file;
}

// Get a list of all challenge classes.
$challenges = array_filter( get_declared_classes(), function( $class ) {
	return is_subclass_of( $class, 'Challenge' );
} );

foreach ( $challenges as $challenge ) {
	try {
		call_user_func( array( $challenge, 'output_header' ) );
		$challenge = new $challenge();
		if ( isset( $_GET['day'] ) && intval( $_GET['day'] ) !== $challenge->day() ) {
			echo "Skipped\n\n";
			continue;
		}
		$challenge->load_input();
		$challenge->solve();
		$challenge->output_part_1();
		echo "\n";
		$challenge->output_part_2();
		echo "\n\n";
	} catch ( Exception $e ) {
		printf( "!!! %s !!!\n\n", $e->getMessage() );
	}
}
