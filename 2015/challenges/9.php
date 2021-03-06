<?php
/**
 * Challenge for day 9 of Advent of Code.
 * http://adventofcode.com/day/9
 *
 * @package AOC_Solutions
 */

/**
 * Challenge for day 9.
 */
class Challenge9 extends Challenge {

	/**
	 * The current challenge day.
	 *
	 * @var integer
	 */
	protected static $_day = 9;

	/**
	 * All destinations that need to be visited.
	 *
	 * @var array
	 */
	private $_destinations = [];

	/**
	 * Save the shortest distance, including the route(s) used. (For part 1)
	 *
	 * @var array
	 */
	private $_shortest_distance = [];

	/**
	 * Save the furthest distance, including the route(s) used. (For part 2)
	 *
	 * @var array
	 */
	private $_furthest_distance = [];

	/**
	 * Calculate distances of all permutations. (http://stackoverflow.com/a/10223120/3757422)
	 *
	 * @param array $arg What to find permutations for.
	 */
	private function _calculate_distances( $items, $perms = [] ) {
		if ( empty( $items ) ) {
			$distance = $this->_get_distance( $perms );

			// Part 1, shortest distance.
			if ( empty( $this->_shortest_distance ) || $distance < min( $this->_shortest_distance ) ) {
				$this->_shortest_distance = [ implode( ' -> ', $perms ) => $distance ];
			} elseif ( $distance === min( $this->_shortest_distance ) ) {
				// Save all routes that have the same shortest distance.
				$this->_shortest_distance[ implode( ' -> ', $perms ) ] = $distance;
			}

			// Part 2, furthest distance.
			if ( empty( $this->_furthest_distance ) || $distance > max( $this->_furthest_distance ) ) {
				$this->_furthest_distance = [ implode( ' -> ', $perms ) => $distance ];
			} elseif ( $distance === max( $this->_furthest_distance ) ) {
				// Save all routes that have the same furthest distance.
				$this->_furthest_distance[ implode( ' -> ', $perms ) ] = $distance;
			}
		} else {
			for ( $i = count( $items ) - 1; $i >= 0; --$i ) {
				$newitems = $items;
				$newperms = $perms;
				list( $foo ) = array_splice( $newitems, $i, 1 );
				array_unshift( $newperms, $foo );
				$this->_calculate_distances( $newitems, $newperms );
			}
		}
	}

	/**
	 * Get the distance for the passed route.
	 *
	 * @param array $destinations Destinations for this route.
	 * @return integer Distance for this route.
	 */
	private function _get_distance( $destinations ) {
		$distance = 0;
		$to = array_shift( $destinations );

		while ( $destinations ) {
			$from = $to;
			$to = array_shift( $destinations );
			$distance += $this->_destinations[ $from ][ $to ];
		}
		return $distance;
	}

	/**
	 * The main method where the challenge gets solved.
	 */
	public function solve() {
		$routes = explode( "\n", $this->_input );
		foreach ( $routes as $route ) {
			list( $from, $to, $distance ) = preg_split( '/( to | = )/', $route );
			$this->_destinations[ $from ][ $to ] = $distance;
			$this->_destinations[ $to ][ $from ] = $distance;
		}

		$this->_calculate_distances( array_keys( $this->_destinations ) );
	}

	/**
	 * Output the solution for part 1.
	 */
	public function output_part_1() {
		echo 'Shortest route is ' . min( $this->_shortest_distance ) . "\n";
		foreach ( array_keys( $this->_shortest_distance ) as $shortest_route ) {
			echo $shortest_route . "\n";
		}
		echo "\n";
	}

	/**
	 * Output the solution for part 2.
	 */
	public function output_part_2() {
		echo 'Furthest route is ' . min( $this->_furthest_distance ) . "\n";
		foreach ( array_keys( $this->_furthest_distance ) as $furthest_route ) {
			echo $furthest_route . "\n";
		}
		echo "\n";
	}
}
