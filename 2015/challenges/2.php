<?php
/**
 * Challenge for day 2 of Advent of Code.
 * http://adventofcode.com/day/2
 *
 * @package AOC_Solutions
 */

/**
 * Challenge for day 2.
 */
class Challenge2 extends Challenge {

	/**
	 * The current challenge day.
	 *
	 * @var integer
	 */
	protected static $_day = 2;

	/**
	 * The total amounts of paper and ribbon needed.
	 *
	 * @var array
	 */
	private $_totals = array(
		'paper'  => 0,
		'ribbon' => 0,
	);

	/**
	 * The main method where the challenge gets solved.
	 */
	public function solve() {
		$presents_sizes = $this->_input;
		$presents_sizes = explode( "\n", $presents_sizes );

		foreach ( $presents_sizes as $present_sizes ) {
			// Get the present dimentions and sort them by size.
			$present_sizes = explode( 'x', $present_sizes );
			sort( $present_sizes );
			list( $s, $m, $l ) = $present_sizes;

			// Part 1, total paper needed.
			$side1 = $s * $m;
			$side2 = $s * $l;
			$side3 = $m * $l;

			$total_paper = 2 * ( $side1 + $side2 + $side3 ) + min( $side1, $side2, $side3 );
			$this->_totals['paper'] += $total_paper;

			// Part 2, total ribbon needed.
			$total_ribbon = 2 * ( $s + $m ) + array_product( $present_sizes );
			$this->_totals['ribbon'] += $total_ribbon;
		}
	}

	/**
	 * Output the solution for part 1.
	 */
	public function output_part_1() {
		echo 'Total paper: ' . $this->_totals['paper'];
	}

	/**
	 * Output the solution for part 2.
	 */
	public function output_part_2() {
		echo 'Total ribbon: ' . $this->_totals['ribbon'];
	}
}
