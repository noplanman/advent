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
	 * Number of lights burning in the last configuration, for both part 1 and 2.
	 *
	 * @var array
	 */
	private $_lights_on = [ 1 => 0, 2 => 0 ];

	/**
	 * Get the number of burning lights surrounding the passed light.
	 *
	 * @param integer $x    X coordinate of the light.
	 * @param integer $y    Y coordinate of the light.
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
	 *
	 * @param integer $part The part we're getting the next configuration for.
	 */
	private function _set_next_configuration( $part ) {
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

		// For part 2, keep the corners lit.
		( 2 === $part ) && $this->_set_stuck_corner_lights();
	}

	/**
	 * Set the 4 stuck corner lights to on.
	 */
	private function _set_stuck_corner_lights() {
		$this->_current_configuration[0][0] = true;
		$this->_current_configuration[0][99] = true;
		$this->_current_configuration[99][0] = true;
		$this->_current_configuration[99][99] = true;
	}

	/**
	 * Run through all configurations.
	 *
	 * @param integer $part The part we're processing.
	 */
	private function _process_all_configurations( $part ) {
		for ( $i = 0; $i < 100; $i++ ) {
			$this->_set_next_configuration( $part );
		}
		// Save the number of burning lights at the end.
		foreach ( $this->_current_configuration as $row ) {
			$this->_lights_on[ $part ] += count( array_filter( $row ) );
		}
	}

	/**
	 * The main method where the challenge gets solved.
	 */
	public function solve() {
		$base_configuration = [];
		$x = 0;
		foreach ( explode( "\n", $this->_input ) as $lights ) {
			$y = 0;
			foreach ( str_split( $lights ) as $light ) {
				$base_configuration[ $x ][ $y++ ] = ( '#' === $light );
			}
			$x++;
		}

		// Part 1.
		$this->_current_configuration = $base_configuration;
		$this->_process_all_configurations( 1 );

		// Part 2.
		$this->_current_configuration = $base_configuration;
		// Set the stuck lights.
		$this->_set_stuck_corner_lights();
		$this->_process_all_configurations( 2 );
	}

	/**
	 * Output the solution for part 1.
	 */
	public function output_part_1() {
		printf( 'There are %d lights on.', $this->_lights_on[1] );
	}

	/**
	 * Output the solution for part 2.
	 */
	public function output_part_2() {
		printf( 'With the stuck corner lights, there are now %d lights on.', $this->_lights_on[2] );
	}
}
