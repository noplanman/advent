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
	 * The sums of all numbers that should be counted for both part 1 and 2.
	 *
	 * @var array
	 */
	private $_sums = [];

	/**
	 * The main method where the challenge gets solved.
	 */
	public function solve() {
		$json = $this->_input;

		// For part 1, count ALL numbers.
		preg_match_all( '/-?\d+/', $json, $m );
		$this->_sums[1] = array_sum( $m[0] );

		// For part 2, only the ones that aren't in a "red" object.
		// Regex from: https://github.com/ChrisPenner/Advent-Of-Code-Polyglot/blob/master/erlang/12/part2.erl
		$json = preg_replace( '/{(\[(\[(?2)*]|{(?2)*}|[^][}{])*]|{(?2)*}|[^][}{])*red(?1)*}/', '', $json );
		preg_match_all( '/-?\d+/', $json, $m );
		$this->_sums[2] = array_sum( $m[0] );
	}

	/**
	 * Output the solution for part 1.
	 */
	public function output_part_1() {
		echo 'Sum of all numbers: ' . $this->_sums[1];
	}

	/**
	 * Output the solution for part 2.
	 */
	public function output_part_2() {
		echo 'Sum of all non red numbers: ' . $this->_sums[2];
	}
}
