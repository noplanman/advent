<?php
/**
 * Challenge for day 18 of Advent of Code.
 * http://adventofcode.com/day/18
 *
 * @package AOC_Solutions
 */

/**
 * Challenge for day 18.
 */
class Challenge18 extends Challenge {

	/**
	 * The current challenge day.
	 *
	 * @var integer
	 */
	protected static $_day = 18;

	/**
	 * The currently active lighting configuration.
	 *
	 * @var array
	 */
	private $_current_configuration = [];

	/**
	 * Get the number of burning lights surrounding the passed light.
	 *
	 * @param integer $x X coordinate of the light.
	 * @param integer $y Y coordinate of the light.
	 * @return integer Number of burning lights surrounding this light.
	 */
	private function _get_neighbouring_lights_count( $x, $y ) {
		$neighbouring_lights_on = 0;
		for ( $_x = max( 0, $x - 1 ); $_x <= min( 99, $x + 1 ); $_x++ ) {
			for ( $_y = max( 0, $y - 1 ); $_y <= min( 99, $y + 1 ); $_y++ ) {
				// Don't count the light we're on, just the neighbours.
				if ( $x === $_x && $y === $_y ) {
					continue;
				}
				( $this->_current_configuration[ $_x ][ $_y ] ) && $neighbouring_lights_on++;
			}
		}

		return $neighbouring_lights_on;
	}

	/**
	 * Set the next lighting configuration.
	 */
	private function _set_next_configuration() {
		// Start off with a copy of the current configuration.
		$next_configuration = $this->_current_configuration;

		for ( $x = 0; $x < 100; $x++ ) {
			for ( $y = 0; $y < 100; $y++ ) {
				$neighbouring_lights_count = $this->_get_neighbouring_lights_count( $x, $y );
				$current_light = $this->_current_configuration[ $x ][ $y ];

				$next_configuration[ $x ][ $y ] = ( $current_light )
					? ( 3 === $neighbouring_lights_count || 2 === $neighbouring_lights_count )
					: ( 3 === $neighbouring_lights_count );
			}
		}

		$this->_current_configuration = $next_configuration;
	}

	/**
	 * The main method where the challenge gets solved.
	 */
	public function solve() {
		$x = 0;
		foreach ( explode( "\n", $this->_input ) as $lights ) {
			$y = 0;
			foreach ( str_split( $lights ) as $light ) {
				$this->_current_configuration[ $x ][ $y++ ] = ( '#' === $light );
			}
			$x++;
		}

		// Now, let's get the next configuration 100 times.
		for ( $i = 0; $i < 100; $i++ ) {
			$this->_set_next_configuration();
		}
	}

	/**
	 * Output the solution for part 1.
	 */
	public function output_part_1() {
		$lights_on = 0;
		foreach ( $this->_current_configuration as $row ) {
			$lights_on += count( array_filter( $row ) );
		}

		printf( 'There are %d lights on.', $lights_on );
	}

	/**
	 * Output the solution for part 2.
	 */
	public function output_part_2() {
		echo '';
	}
}
