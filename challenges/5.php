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
	 * The number of nice strings for each part.
	 *
	 * @var array
	 */
	private $_nice_strings = [ 1 => 0, 2 => 0 ];

	/**
	 * Check if the string has any illegal letter combinations. (For part 1)
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
	 * Check if the string has at least 3 vowels. (For part 1)
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
	 * Check if the string has a double letter. (For part 1)
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
	 * Check if the string has at least two letter pairs. (For part 1)
	 *
	 * @param string  $string The string to check.
	 * @return boolean If this check passes.
	 */
	private function _has_two_pairs( $string ) {
		for ( $pos = 0; $pos < strlen( $string ) -1; $pos++ ) {
			// Get each pair and explode the string with it.
			$pair = substr( $string, $pos, 2 );
			// If we have more than 2 entries, we have two valid pairs.
			if ( count( explode( $pair, $string ) ) > 2 ) {
				return true;
			}
		}
		return false;
	}

	/**
	 * Check if the string has a letter sandwich. (For part 2)
	 *
	 * @param string  $string The string to check.
	 * @return boolean If this check passes.
	 */
	private function _has_letter_sandwich( $string ) {
		for ( $pos = 0; $pos < strlen( $string ) - 2; $pos++ ) {
			if ( $string[ $pos ] === $string[ $pos + 2 ] ) {
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

		$checks_part_1 = [ '_has_no_illegals', '_has_three_vowels', '_has_double_letter' ];
		$checks_part_2 = [ '_has_two_pairs', '_has_letter_sandwich' ];

		foreach ( $all_strings as $string ) {
			// Only increment nice string counters if all checks pass.
			// Part 1.
			$valid = true;
			foreach ( $checks_part_1 as $check ) {
				if ( ! call_user_func( [ $this, $check ], $string ) ) {
					$valid = false;
					break;
				}
			}
			$valid && $this->_nice_strings[1]++;

			// Part 2.
			$valid = true;
			foreach ( $checks_part_2 as $check ) {
				if ( ! call_user_func( [ $this, $check ], $string ) ) {
					$valid = false;
					break;
				}
			}
			$valid && $this->_nice_strings[2]++;
		}
	}

	/**
	 * Output the solution for part 1.
	 */
	public function output_part_1() {
		echo 'Nice strings for part 1: ' . $this->_nice_strings[1];
	}

	/**
	 * Output the solution for part 2.
	 */
	public function output_part_2() {
		echo 'Nice strings for part 2: ' . $this->_nice_strings[2];
	}
}
