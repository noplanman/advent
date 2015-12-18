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
	private $_combinations = [];

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

		$this->_combinations = $this->_container_combinations( $container_sizes );
	}

	/**
	 * Output the solution for part 1.
	 */
	public function output_part_1() {
		$combinations = 0;
		foreach ( $this->_combinations as $combination ) {
			( 150 === array_sum( $combination ) ) && $combinations++;
		}
		echo 'Possible combinations to store 150L of eggnog: ' . $combinations;
	}

	/**
	 * Output the solution for part 2.
	 */
	public function output_part_2() {
		echo '';
	}
}
