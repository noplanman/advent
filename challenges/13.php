<?php
/**
 * Challenge for day 13 of Advent of Code.
 * http://adventofcode.com/day/13
 *
 * @package AOC_Solutions
 */

/**
 * Challenge for day 13.
 */
class Challenge13 extends Challenge {

	/**
	 * The current challenge day.
	 *
	 * @var integer
	 */
	protected static $_day = 13;

	/**
	 * All the people that need to be seated.
	 *
	 * @var array
	 */
	private $_people = [];

	/**
	 * Seating arrangement which provides the biggest happiness.
	 *
	 * @var array
	 */
	private $_biggest_happiness = [];

	/**
	 * Calculate happiness of all permutations. (http://stackoverflow.com/a/10223120/3757422)
	 *
	 * @param array $items List of all the people to calculate the happiness for.
	 * @param array $perms The current sitting arrangement.
	 */
	private function _calculate_happiness( $items, $perms = [] ) {
		if ( empty( $items ) ) {
			$happiness = $this->_get_happiness( $perms );

			if ( empty( $this->_biggest_happiness ) || $happiness > max( $this->_biggest_happiness ) ) {
				$this->_biggest_happiness = [ implode( ' -> ', $perms ) => $happiness ];
			} elseif ( max( $this->_biggest_happiness ) === $happiness  ) {
				// Save all sitting arrangements that have the same biggest happiness.
				$this->_biggest_happiness[ implode( ' -> ', $perms ) ] = $happiness;
			}
		} else {
			for ( $i = count( $items ) - 1; $i >= 0; --$i ) {
				$newitems = $items;
				$newperms = $perms;
				list( $foo ) = array_splice( $newitems, $i, 1 );
				array_unshift( $newperms, $foo );
				$this->_calculate_happiness( $newitems, $newperms );
			}
		}
	}

	/**
	 * Get the happiness for the passed sitting arrangement.
	 *
	 * @param array $people People for this sitting arrangement.
	 * @return integer happiness for this sitting arrangement.
	 */
	private function _get_happiness( $people ) {
		$happiness = 0;
		$first = $left = array_shift( $people );

		while ( $people ) {
			$right = $left;
			$left = array_shift( $people );
			$happiness += $this->_people[ $right ][ $left ];
		}

		// Remember to close the circle!
		$happiness += $this->_people[ $left ][ $first ];

		return $happiness;
	}

	/**
	 * The main method where the challenge gets solved.
	 */
	public function solve() {
		foreach ( explode( "\n", $this->_input ) as $happiness_info ) {
			$info_clean = str_replace( [ 'would ', 'gain ', 'lose ', 'happiness units by sitting next to ', '.' ], [ '', '', '-', '', '' ], $happiness_info );

			list( $left, $points, $right ) = explode( ' ', $info_clean );

			if ( isset( $this->_people[ $left ][ $right ] ) ) {
				$this->_people[ $left ][ $right ] += intval( $points );
				$this->_people[ $right ][ $left ] += intval( $points );
			} else {
				$this->_people[ $left ][ $right ] = $this->_people[ $right ][ $left ] = intval( $points );
			}
		}

		$this->_calculate_happiness( array_keys( $this->_people ) );

		// Sort the keys to make the output prettier.
		ksort( $this->_biggest_happiness );
	}

	/**
	 * Output the solution for part 1.
	 */
	public function output_part_1() {
		echo 'Sitting arrangement with most happiness points: ' . max( $this->_biggest_happiness ) . "\n";
		foreach ( array_keys( $this->_biggest_happiness ) as $arrangement ) {
			echo $arrangement . "\n";
		}
		echo "\n";
	}

	/**
	 * Output the solution for part 2.
	 */
	public function output_part_2() {
		echo '';
	}
}
