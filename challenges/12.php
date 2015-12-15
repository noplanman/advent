<?php
/**
 * Challenge for day 12 of Advent of Code.
 * http://adventofcode.com/day/12
 *
 * @package AOC_Solutions
 */

/**
 * Challenge for day 12.
 */
class Challenge12 extends Challenge {

	/**
	 * The current challenge day.
	 *
	 * @var integer
	 */
	protected static $_day = 12;

	/**
	 * The sum of all numbers found in the input.
	 *
	 * @var integer
	 */
	private $_sum = 0;

	/**
	 * The main method where the challenge gets solved.
	 */
	public function solve() {
		$json = $this->_input;
		preg_match_all( '/\-?\d+/', $json, $m );
		$this->_sum = array_sum( $m[0] );
	}

	/**
	 * Output the solution for part 1.
	 */
	public function output_part_1() {
		echo 'Sum of all numbers: ' . $this->_sum;
	}

	/**
	 * Output the solution for part 2.
	 */
	public function output_part_2() {
		echo '';
	}
}
