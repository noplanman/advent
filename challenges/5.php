<?php
/**
 * Challenge for day 5 of Advent of Code.
 * http://adventofcode.com/day/5
 *
 * @package AOC_Solutions
 */

/**
 * Challenge for day 5.
 */
class Challenge5 extends Challenge {

	/**
	 * The current challenge day.
	 *
	 * @var integer
	 */
	protected static $_day = 5;

	/**
	 * The number of nice strings.
	 *
	 * @var integer
	 */
	private $_nice_strings = 0;

	/**
	 * Check if the string has any illegal letter combinations.
	 *
	 * @param string  $string The string to check.
	 * @return boolean If this check passes.
	 */
	private function _has_no_illegals( $string ) {
		$illegals = [ 'ab', 'cd', 'pq', 'xy' ];
		foreach ( $illegals as $illegal ) {
			if ( false !== strpos( $string, $illegal ) ) {
				return false;
			}
		}
		return true;
	}

	/**
	 * Check if the string has at least 3 vowels.
	 *
	 * @param string  $string The string to check.
	 * @return boolean If this check passes.
	 */
	private function _has_three_vowels( $string ) {
		$vowels = 0;
		for ( $pos = 0; $pos < strlen( $string ); $pos++  ) {
			$char = $string[ $pos ];
			$vowels += ( false !== strpos( 'aeiou', $char ) ) ? 1 : 0;
		}
		return ( $vowels >= 3 );
	}

	/**
	 * Check if the string has a double letter.
	 *
	 * @param string  $string The string to check.
	 * @return boolean If this check passes.
	 */
	private function _has_double_letter( $string ) {
		for ( $pos = 0; $pos < strlen( $string ) - 1; $pos++ ) {
			if ( $string[ $pos ] === $string[ $pos + 1 ] ) {
				return true;
			}
		}
		return false;
	}

	/**
	 * The main method where the challenge gets solved.
	 */
	public function solve() {
		$all_strings = explode( "\n", $this->_input );

		$checks = [ '_has_no_illegals', '_has_three_vowels', '_has_double_letter' ];

		foreach ( $all_strings as $string ) {
			// Only increment nice string counter if all checks pass.
			foreach ( $checks as $check ) {
				if ( ! call_user_func( [ $this, $check ], $string ) ) {
					continue 2;
				}
			}
			$this->_nice_strings++;
		}
	}

	/**
	 * Output the solution for part 1.
	 */
	public function output_part_1() {
		echo 'Nice strings: ' . $this->_nice_strings;
	}

	/**
	 * Output the solution for part 2.
	 */
	public function output_part_2() {
		echo '';
	}
}
