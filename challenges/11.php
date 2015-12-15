<?php
/**
 * Challenge for day 11 of Advent of Code.
 * http://adventofcode.com/day/11
 *
 * @package AOC_Solutions
 */

/**
 * Challenge for day 11.
 */
class Challenge11 extends Challenge {

	/**
	 * The current challenge day.
	 *
	 * @var integer
	 */
	protected static $_day = 11;

	/**
	 * The next valid passwords for part 1 and 2.
	 *
	 * @var array
	 */
	private $_next_pw = [];

	/**
	 * Check if the password has a 3 letter straight.
	 *
	 * @param string $pw The current password to check.
	 * @return boolean If this check passes.
	 */
	private function _has_straight( $pw ) {
		$straight_length = 1;
		for ( $i = 1; $i < strlen( $pw ); $i++ ) {
			if ( ord( $pw[ $i - 1 ] ) + 1 === ord( $pw[ $i ] ) ) {
				$straight_length++;
			} else {
				$straight_length = 1;
			}
			if ( $straight_length >= 3 ) {
				return true;
			}
		}
		return false;
	}

	/**
	 * Check if the password has two letter pairs.
	 *
	 * @param string $pw The current password to check.
	 * @return boolean If this check passes.
	 */
	private function _has_two_letter_pairs( $pw ) {
		preg_match_all( '/(\w)\1+/', $pw, $m );
		return ( count( $m[0] ) >= 2 );
	}

	/**
	 * Get the next password. This method already prevents illegal characters.
	 *
	 * @param string $pw Current password.
	 * @return string Next password.
	 */
	private function _get_next_pw( $pw ) {
		$pw_len = strlen( $pw );
		for ( $i = $pw_len - 1; $i >= 0; $i-- ) {
			$ord = ord( $pw[ $i ] );
			if ( ( ord( 'z' ) - $ord ) > 0 ) {
				$pw[ $i ] = chr( $ord + 1 );
				break;
			} else {
				$pw[ $i ] = 'a';
			}
		}

		// Check for illegal characters.
		$illegals = preg_split( '/(i|o|l)/', $pw );
		if ( count( $illegals ) > 1 ) {
			// If an illegal is found, increment it and fill the rest of the password with 'a's.
			$pw = str_pad( $illegals[0] . chr( ord( $pw[ strlen( $illegals[0] ) ] ) + 1 ), 8, 'a' );
		}

		return $pw;
	}

	/**
	 * Get the next VALID password.
	 *
	 * @param string $pw Current password.
	 * @return string Next VALID password.
	 */
	private function _get_next_valid_pw( $pw ) {
		$pw_found = false;

		while ( ! $pw_found ) {
			$pw = $this->_get_next_pw( $pw );

			$pw_found = true;
			foreach ( [ '_has_two_letter_pairs' => true, '_has_straight' => true ] as $func => $ret ) {
				// Does our check pass back what we need for a valid password?
				if ( call_user_func( [ $this, $func ], $pw ) !== $ret ) {
					$pw_found = false;
					break;
				}
			}
		}
		return $pw;
	}

	/**
	 * The main method where the challenge gets solved.
	 */
	public function solve() {
		// Get the next valid password for part 1.
		$this->_next_pw[1] = $this->_get_next_valid_pw( $this->_input );

		// And the next valid password for part 2.
		$this->_next_pw[2] = $this->_get_next_valid_pw( $this->_next_pw[1] );
	}

	/**
	 * Output the solution for part 1.
	 */
	public function output_part_1() {
		echo 'Next valid pasword: ' . $this->_next_pw[1];
	}

	/**
	 * Output the solution for part 2.
	 */
	public function output_part_2() {
		echo 'Next valid pasword: ' . $this->_next_pw[2];
	}
}
