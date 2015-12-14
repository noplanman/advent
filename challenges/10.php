<?php
/**
 * Challenge for day 10 of Advent of Code.
 * http://adventofcode.com/day/10
 *
 * @package AOC_Solutions
 */

/**
 * Challenge for day 10.
 */
class Challenge10 extends Challenge {

	/**
	 * The current challenge day.
	 *
	 * @var integer
	 */
	protected static $_day = 10;

	/**
	 * The currently processed number string.
	 *
	 * @var string
	 */
	private $_num = null;

	/**
	 * Make a number string from the passed numbers.
	 *
	 * @param string $nums Number string to process.
	 * @return string The processed number string.
	 */
	private function _num_string( $nums ) {
		$current_num = null;
		$current_num_count = 0;
		$current_string = '';
		foreach ( str_split( $nums ) as $num ) {
			if ( $num === $current_num ) {
				$current_num_count++;
			} else {
				isset( $current_num ) && $current_string .= $current_num_count . $current_num;
				$current_num = $num;
				$current_num_count = 1;
			}
		}
		// Remember to add the lastly processed numbers!
		return $current_string . $current_num_count . $current_num;
	}

	/**
	 * The main method where the challenge gets solved.
	 */
	public function solve() {
		$this->_num = $this->_input;
		for ( $i = 0; $i < 40; $i++ ) {
			$this->_num = $this->_num_string( $this->_num );
		}
	}

	/**
	 * Output the solution for part 1.
	 */
	public function output_part_1() {
		echo 'Length after 40 passes: ' . strlen( $this->_num );
	}

	/**
	 * Output the solution for part 2.
	 */
	public function output_part_2() {
		echo '';
	}
}
