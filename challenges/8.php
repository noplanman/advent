<?php
/**
 * Challenge for day 8 of Advent of Code.
 * http://adventofcode.com/day/8
 *
 * @package AOC_Solutions
 */

/**
 * Challenge for day 8.
 */
class Challenge8 extends Challenge {

	/**
	 * The current challenge day.
	 *
	 * @var integer
	 */
	protected static $_day = 8;

	/**
	 * Counter for code and memory character numbers.
	 *
	 * @var array
	 */
	private $_chars_num = [ 'code' => 0, 'memory' => 0 ];

	/**
	 * The main method where the challenge gets solved.
	 */
	public function solve() {
		$lines = explode( "\n", $this->_input );
		foreach ( $lines as $line ) {
			$this->_chars_num['code'] += strlen( $line );
			$memory_line = preg_replace( '/(\\\\\"|\\\\\\\\|\\\\x[0-9a-f]{2})/', ' ', $line );
			$this->_chars_num['memory'] += strlen( $memory_line ) - 2;
		}
	}

	/**
	 * Output the solution for part 1.
	 */
	public function output_part_1() {
		extract( $this->_chars_num );
		printf( 'Characters in code (%d) - characters in memory (%d) = %d', $code, $memory, $code - $memory );
	}

	/**
	 * Output the solution for part 2.
	 */
	public function output_part_2() {
		echo '';
	}
}
