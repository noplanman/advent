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
	private $_biggest_happiness = [ 1 => [], 2 => [] ];

	/**
	 * Calculate happiness of all permutations. (http://stackoverflow.com/a/10223120/3757422)
	 *
	 * @param integer $part  The current challenge part, 1 or 2.
	 * @param array   $items List of all the people to calculate the happiness for.
	 * @param array   $perms The current sitting arrangement.
	 */
	private function _calculate_happiness( $part, $items, $perms = [] ) {
		if ( empty( $items ) ) {
			$happiness = $this->_get_happiness( $perms );

			if ( empty( $this->_biggest_happiness[ $part ] ) || $happiness > max( $this->_biggest_happiness[ $part ] ) ) {
				$this->_biggest_happiness[ $part ] = [ implode( ' -> ', $perms ) => $happiness ];
			} elseif ( max( $this->_biggest_happiness[ $part ] ) === $happiness  ) {
				// Save all sitting arrangements that have the same biggest happiness.
				$this->_biggest_happiness[ $part ][ implode( ' -> ', $perms ) ] = $happiness;
			}
		} else {
			for ( $i = count( $items ) - 1; $i >= 0; --$i ) {
				$newitems = $items;
				$newperms = $perms;
				list( $foo ) = array_splice( $newitems, $i, 1 );
				array_unshift( $newperms, $foo );
				$this->_calculate_happiness( $part, $newitems, $newperms );
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

		// Calculate happiness points for part 1.
		$this->_calculate_happiness( 1, array_keys( $this->_people ) );

		// Add myself for part 2.
		$me = 'Le Moi';
		foreach ( array_keys( $this->_people ) as $person ) {
			$this->_people[ $me ][ $person ] = $this->_people[ $person ][ $me ] = 0;
		}

		// Calculate happiness points for part 2.
		$this->_calculate_happiness( 2, array_keys( $this->_people ) );

		// Sort the keys to make the output prettier.
		array_walk( $this->_biggest_happiness, function( &$item ) {
			ksort( $item );
		} );
	}

	/**
	 * Output the solution for part 1.
	 */
	public function output_part_1() {
		echo 'Sitting arrangement with most happiness points: ' . max( $this->_biggest_happiness[1] ) . "\n";
		foreach ( array_keys( $this->_biggest_happiness[1] ) as $arrangement ) {
			echo $arrangement . "\n";
		}
		echo "\n";
	}

	/**
	 * Output the solution for part 2.
	 */
	public function output_part_2() {
		echo 'Sitting arrangement including myself with most happiness points: ' . max( $this->_biggest_happiness[2] ) . "\n";
		foreach ( array_keys( $this->_biggest_happiness[2] ) as $arrangement ) {
			echo $arrangement . "\n";
		}
		echo "\n";
	}
}
