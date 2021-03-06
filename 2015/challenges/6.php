<?php
/**
 * Challenge for day 6 of Advent of Code.
 * http://adventofcode.com/day/6
 *
 * @package AOC_Solutions
 */

/**
 * Challenge for day 6.
 */
class Challenge6 extends Challenge {

	/**
	 * The current challenge day.
	 *
	 * @var integer
	 */
	protected static $_day = 6;

	/**
	 * Array of light status data. (For part 1)
	 *
	 * @var array
	 */
	private $_lights = [];

	/**
	 * Array of light brightness data. (For part 2)
	 *
	 * @var array
	 */
	private $_lights_brightness = [];

	/**
	 * Toggle the lights that fit the passed parameters. (For part 1)
	 *
	 * @param string $toggle The toggle type: on, off, toggle.
	 * @param string $from   The X,Y coordinate to start from.
	 * @param string $to     The X,Y coordinate to end at.
	 */
	private function _toggle_lights( $toggle, $from, $to ) {
		list( $from_x, $from_y ) = explode( ',', $from );
		list( $to_x, $to_y ) = explode( ',', $to );
		for ( $x = $from_x; $x <= $to_x; $x++ ) {
			for ( $y = $from_y; $y <= $to_y; $y++ ) {
				$l = ( isset( $this->_lights[ $x ][ $y ] ) ) ? $this->_lights[ $x ][ $y ] : false;
				// Depending on the toggle passed, set the light accordingly.
				( 'on' === $toggle ) && $l = true;
				( 'off' === $toggle ) && $l = false;
				( 'toggle' === $toggle ) && $l = ! $l;
				$this->_lights[ $x ][ $y ] = $l;
			}
		}
	}

	/**
	 * Get the number of lights that are switched on. (For part 1)
	 *
	 * @return integer The number of lights that are switched on.
	 */
	private function _get_on_lights() {
		$on = 0;
		foreach ( $this->_lights as $x ) {
			foreach ( $x as $y ) {
				$y && $on++;
			}
		}
		return $on;
	}

	/**
	 * Toggle the brightness of the lights that fit the passed parameters. (For part 2)
	 *
	 * @param string $toggle The toggle type: on, off, toggle.
	 * @param string $from   The X,Y coordinate to start from.
	 * @param string $to     The X,Y coordinate to end at.
	 */
	private function _toggle_lights_brightness( $toggle, $from, $to ) {
		list( $from_x, $from_y ) = explode( ',', $from );
		list( $to_x, $to_y ) = explode( ',', $to );
		for ( $x = $from_x; $x <= $to_x; $x++ ) {
			for ( $y = $from_y; $y <= $to_y; $y++ ) {
				$lb = ( isset( $this->_lights_brightness[ $x ][ $y ] ) ) ? $this->_lights_brightness[ $x ][ $y ] : 0;
				// Depending on the toggle passed, set the brightness accordingly.
				( 'on' === $toggle ) && $lb++;
				( 'off' === $toggle ) && $lb--;
				( 'toggle' === $toggle ) && $lb += 2;
				$this->_lights_brightness[ $x ][ $y ] = max( 0, $lb );
			}
		}
	}

	/**
	 * Get the brightness of all the lights combined.
	 *
	 * @return integer The brightness of all lights combined.
	 */
	private function _get_lights_brightness() {
		$brightness = 0;
		foreach ( $this->_lights_brightness as $x ) {
			foreach ( $x as $y ) {
				$brightness += $y;
			}
		}
		return $brightness;
	}

	/**
	 * The main method where the challenge gets solved.
	 */
	public function solve() {
		// Because this is a monster array operation, we need more resources...
		ini_set( 'memory_limit', '384M' );
		ini_set( 'max_execution_time', 120 );

		// Remove "turn " and "through " from the strings to read the important infos better.
		$instructions = str_replace( [ 'turn ', 'through ' ], '', $this->_input );
		$instructions = explode( "\n", $instructions );
		foreach ( $instructions as $instruction ) {
			list( $toggle, $from, $to ) = explode( ' ', $instruction );
			$this->_toggle_lights( $toggle, $from, $to );
			$this->_toggle_lights_brightness( $toggle, $from, $to );
		}
	}

	/**
	 * Output the solution for part 1.
	 */
	public function output_part_1() {
		echo 'Lights on: ' . $this->_get_on_lights();
	}

	/**
	 * Output the solution for part 2.
	 */
	public function output_part_2() {
		echo 'Light brightness: ' . $this->_get_lights_brightness();
	}
}
