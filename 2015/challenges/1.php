<?php
/**
 * Challenge for day 1 of Advent of Code.
 * http://adventofcode.com/day/1
 *
 * @package AOC_Solutions
 */

/**
 * Challenge for day 1.
 */
class Challenge1 extends Challenge {

	/**
	 * The current challenge day.
	 *
	 * @var integer
	 */
	protected static $_day = 1;

	/**
	 * The current floor that Santa is on.
	 *
	 * @var integer
	 */
	private $_floor = 0;

	/**
	 * The number of floors Santa has gone up and down.
	 *
	 * @var array
	 */
	private $_floors = array(
		'down' => 0,
		'up'   => 0,
	);

	/**
	 * First step into the basement, used for part 2.
	 *
	 * @var integer
	 */
	private $_first_basement_step = null;

	/**
	 * The main method where the challenge gets solved.
	 */
	public function solve() {
		$directions = $this->_input;
		$directions_count = strlen( $directions );

		for ( $direction = 0; $direction < $directions_count; $direction++ ) {
			// '(' is up, ')' is down.
			$up = ( '(' === $directions[ $direction ] );
			$this->_floor += $up ? 1 : -1;
			$this->_floors[ $up ? 'up' : 'down' ]++;

			// Part 2, remember when Santa first steps into the basement.
			if ( is_null( $this->_first_basement_step ) && -1 === $this->_floor ) {
				$this->_first_basement_step = $direction + 1;
			}
		}
	}

	/**
	 * Output the solution for part 1.
	 */
	public function output_part_1() {
		echo 'Current floor: ' . ( $this->_floors['up'] - $this->_floors['down'] );
	}

	/**
	 * Output the solution for part 2.
	 */
	public function output_part_2() {
		echo 'First step in basement: ' . $this->_first_basement_step;
	}
}
