<?php
/**
 * Challenge solutions for Advent of Code.
 * http://adventofcode.com/
 *
 * @package AOC_Solutions
 */

/**
 * Get the challenge input of a given day.
 *
 * @throws Exception An exception if an invalid day is provided.
 * @param  int $day The day number, a positive integer.
 * @return string The input string of the given day.
 */
function get_input( $day ) {
	// Must be an integer between 1 and 25.
	if ( ! is_int( $day ) || $day < 1 || $day > 25 ) {
		throw new Exception( 'Please provide a valid day (1-25)' );
	}
	// Make sure the input file for this day exists.
	$input_file = sprintf( '%s/input/%d', __DIR__, $day );
	if ( ! file_exists( $input_file ) ) {
		throw new Exception( 'Input file seems to be AWOL.' );
	}

	return file_get_contents( $input_file );
}

/**
 * Challenge for day 1.
 */
function day1() {
	try {
		$directions = get_input( 1 );
	} catch ( Exception $e ) {
		return $e->getMessage();
	}
	$directions_count = strlen( $directions );

	$floor = 0;
	$floors = array(
		'down' => 0,
		'up'   => 0,
	);
	$floors_down = 0;

	// This is used for part 2.
	$first_basement = false;

	for ( $direction = 0; $direction < $directions_count; $direction++ ) {
		// '(' is up, ')' is down.
		$up = ( '(' === $directions[ $direction ] );
		$floor += $up ? 1 : -1;
		$floors[ $up ? 'up' : 'down' ]++;

		// Part 2, remember when Santa first steps into the basement.
		if ( false === $first_basement && -1 === $floor ) {
			$first_basement = $direction + 1;
		}
	}

	// Part 1.
	echo 'Current floor: ' . ( $floors['up'] - $floors['down'] ) . '<br>';

	// Part 2.
	echo 'First time in basement: ' . $first_basement;
}
day1();

/**
 * Challenge for day 2.
 */
function day2() {

	try {
		$presents_sizes = get_input( 2 );
	} catch ( Exception $e ) {
		return $e->getMessage();
	}

	$presents_sizes = explode( "\n", $presents_sizes );

	$total_paper = 0;
	$total_ribbon = 0;

	foreach ( $presents_sizes as $present_sizes ) {
		// Get the present dimentions and sort them by size.
		$present_sizes = explode( 'x', $present_sizes );
		sort( $present_sizes );
		list( $s, $m, $l ) = $present_sizes;

		// Part 1, total paper needed.
		$side1 = $s * $m;
		$side2 = $s * $l;
		$side3 = $m * $l;

		$sum_paper = 2 * ( $side1 + $side2 + $side3 ) + min( $side1, $side2, $side3 );
		$total_paper += $sum_paper;

		// Part 2, total ribbon needed.
		$sum_ribbon = 2 * ( $s + $m ) + array_product( $present_sizes );
		$total_ribbon += $sum_ribbon;
	}

	// Part 1.
	echo 'Total paper: ' . $total_paper . '<br>';

	// Part 2.
	echo 'Total ribbon: ' . $total_ribbon;
}
day2();

?>