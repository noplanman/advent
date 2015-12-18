<?php
/**
 * Challenge for day 17 of Advent of Code.
 * http://adventofcode.com/day/17
 *
 * @package AOC_Solutions
 */

/**
 * Challenge for day 17.
 */
class Challenge17 extends Challenge {

	/**
	 * The current challenge day.
	 *
	 * @var integer
	 */
	protected static $_day = 17;

	/**
	 * All combinations of container sizes.
	 *
	 * @var array
	 */
	private $_150l_combinations = [];

	/**
	 * Get container size combinations. (http://docstore.mik.ua/orelly/webprog/pcook/ch04_25.htm)
	 *
	 * @param array $container_sizes All available container sizes.
	 * @return array All combinations of the container sizes.
	 */
	private function _container_combinations( $container_sizes ) {
		$results = [ [] ];

		foreach ( $container_sizes as $element ) {
			foreach ( $results as $combination ) {
				array_push( $results, array_merge( [ $element ], $combination ) );
			}
		}
		return $results;
	}

	/**
	 * The main method where the challenge gets solved.
	 */
	public function solve() {
		// Because this is a monster array operation, we need more resources...
		ini_set( 'memory_limit', '1024M' );

		$container_sizes = explode( "\n", $this->_input );

		$this->_150l_combinations = array_filter( $this->_container_combinations( $container_sizes ), function( $combination ) {
			return ( 150 === array_sum( $combination ) );
		} );
	}

	/**
	 * Output the solution for part 1.
	 */
	public function output_part_1() {
		printf( 'Possible combinations to store 150L of eggnog: %d', count( $this->_150l_combinations ) );
	}

	/**
	 * Output the solution for part 2.
	 */
	public function output_part_2() {
		// Sort them by container count.
		usort( $this->_150l_combinations, function( $a, $b ) {
			return count( $a ) <=> count( $b );
		} );

		$min_combinations = 0;

		$min = $current = count( reset( $this->_150l_combinations ) );
		while ( $min === $current ) {
			$min_combinations++;
			$current = count( next( $this->_150l_combinations ) );
		}
		printf( '150L requires a minimum of %d containers. There are a total of %d combinations.', $min, $min_combinations );
	}
}
