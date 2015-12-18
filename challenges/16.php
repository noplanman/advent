<?php
/**
 * Challenge for day 16 of Advent of Code.
 * http://adventofcode.com/day/16
 *
 * @package AOC_Solutions
 */

/**
 * Challenge for day 16.
 */
class Challenge16 extends Challenge {

	/**
	 * The current challenge day.
	 *
	 * @var integer
	 */
	protected static $_day = 16;

	/**
	 * The data analysis of the present paper.
	 *
	 * @var array
	 */
	private $_present_data = [
		'children'    => 3,
		'cats'        => 7,
		'samoyeds'    => 2,
		'pomeranians' => 3,
		'akitas'      => 0,
		'vizslas'     => 0,
		'goldfish'    => 5,
		'trees'       => 3,
		'cars'        => 2,
		'perfumes'    => 1,
	];

	/**
	 * List of all aunties.
	 *
	 * @var array
	 */
	private $_aunties = [];

	/**
	 * The number of the auntie the present is from.
	 *
	 * @var integer
	 */
	private $_present_auntie_nr = 0;

	/**
	 * The main method where the challenge gets solved.
	 */
	public function solve() {
		foreach ( explode( "\n", $this->_input ) as $auntie ) {
			$auntie_compounds = explode( ' ', str_replace( [ ':', ',' ], '', $auntie ) );
			// They're all called Sue...
			array_shift( $auntie_compounds );
			$auntie_nr = array_shift( $auntie_compounds );
			for ( $i = 0; $i < count( $auntie_compounds ); $i += 2 ) {
				$this->_aunties[ $auntie_nr ][ $auntie_compounds[ $i ] ] = (int) $auntie_compounds[ $i + 1 ];
			}
		}

		foreach ( $this->_aunties as $auntie_nr => $auntie_compounds ) {
			$perfect_fit = true;
			foreach ( $auntie_compounds as $compound_name => $compound_value ) {
				if ( $compound_value !== $this->_present_data[ $compound_name ] ) {
					$perfect_fit = false;
					break;
				}
			}
			if ( $perfect_fit ) {
				$this->_present_auntie_nr = $auntie_nr;
				break;
			}
		}
	}

	/**
	 * Output the solution for part 1.
	 */
	public function output_part_1() {
		echo 'The present is from auntie Sue number ' . $this->_present_auntie_nr;
	}

	/**
	 * Output the solution for part 2.
	 */
	public function output_part_2() {
		echo '';
	}
}
