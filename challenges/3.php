<?php
/**
 * Challenge for day 3 of Advent of Code.
 * http://adventofcode.com/day/3
 *
 * For part 2, it would be easier to have only 1 array of all visited positions
 * instead of individual ones for santa and robot, but this way we can keep track of both.
 *
 * @package AOC_Solutions
 */

/**
 * Challenge for day 3.
 */
class Challenge3 extends Challenge {

	/**
	 * The current challenge day.
	 *
	 * @var integer
	 */
	protected static $_day = 3;

	/**
	 * Management of all positions visited in part 1.
	 *
	 * @var array
	 */
	private $_positions_part_1 = [
		'x'   => 0,
		'y'   => 0,
		'pos' => [ '0 0' => 1 ],
	];

	/**
	 * Management of all positions visited in part 2.
	 *
	 * @var array
	 */
	private $_positions_part_2 = [
		'santa' => [
			'x'   => 0,
			'y'   => 0,
			'pos' => [ '0 0' => 1 ],
		],
		'robot' => [
			'x'   => 0,
			'y'   => 0,
			'pos' => [ '0 0' => 1 ],
		],
	];

	/**
	 * Increment visit to the passed position.
	 *
	 * @param array   $positions The array of positions to update.
	 * @param integer $x         X position.
	 * @param integer $y         Y position.
	 * @return integer The current value at the X Y position.
	 */
	private function _update_position( &$positions, $x, $y ) {
		$pos = "$x $y";
		if ( ! isset( $positions[ $pos ] ) ) {
			$positions[ $pos ] = 0;
		}
		return ++$positions[ $pos ];
	}

	/**
	 * The main method where the challenge gets solved.
	 */
	public function solve() {
		$directions = $this->_input;
		$directions_count = strlen( $directions );

		// X and Y for part 1.
		$x1 = &$this->_positions_part_1['x'];
		$y1 = &$this->_positions_part_1['y'];

		for ( $direction = 0; $direction < $directions_count; $direction++ ) {
			$who = ( 0 === $direction % 2 ) ? 'santa' : 'robot';
			// X and Y for part 2.
			$x2 = &$this->_positions_part_2[ $who ]['x'];
			$y2 = &$this->_positions_part_2[ $who ]['y'];

			switch ( $directions[ $direction ] ) {
				case '^': $y1++; $y2++; break;
				case '>': $x1++; $x2++; break;
				case 'v': $y1--; $y2--; break;
				case '<': $x1--; $x2--; break;
				default : continue; // Shouldn't ever happen.
			}
			$this->_update_position( $this->_positions_part_1['pos'], $x1, $y1 );
			$this->_update_position( $this->_positions_part_2[ $who ]['pos'], $x2, $y2 );
		}
	}

	/**
	 * Output the solution for part 1.
	 */
	public function output_part_1() {
		echo 'Houses with at least 1 present: ' . count( $this->_positions_part_1['pos'] );
	}

	/**
	 * Output the solution for part 2.
	 */
	public function output_part_2() {
		// We need to merge all positions together.
		$all_positions = array();
		foreach ( array( $this->_positions_part_2['santa']['pos'], $this->_positions_part_2['robot']['pos'] ) as $positions ) {
			foreach ( $positions as $position => $count ) {
				if ( ! isset( $all_positions[ $position ] ) ) {
					$all_positions[ $position ] = 0;
				}
				$all_positions[ $position ] += $count;
			}
		}
		echo 'Houses with at least 1 present: ' . ( count( $all_positions ) );
	}
}
