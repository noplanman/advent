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
	 * The numbers of the auntie the present is from, for both part 1 and 2.
	 *
	 * @var array
	 */
	private $_present_auntie_nrs = [ 1 => 0, 2 => 0 ];

	/**
	 * The main method where the challenge gets solved.
	 */
	public function solve() {
		foreach ( explode( "\n", $this->_input ) as $auntie ) {
			$auntie_compounds = explode( ' ', str_replace( [ ':', ',' ], '', $auntie ) );
			// They're all called Sue...
			array_shift( $auntie_compounds );
			$auntie_nr = array_shift( $auntie_compounds );

			$finding_auntie_1 = ! (bool) $this->_present_auntie_nrs[1];
			$finding_auntie_2 = ! (bool) $this->_present_auntie_nrs[2];

			for ( $i = 0; $i < count( $auntie_compounds ); $i += 2 ) {
				$compound_name = $auntie_compounds[ $i ];
				$compound_value = (int) $auntie_compounds[ $i + 1 ];

				// Find auntie for part 1, where compounds must match perfectly.
				( $finding_auntie_1 && $compound_value !== $this->_present_data[ $compound_name ] ) && $finding_auntie_1 = false;

				// Find auntie for part 2, where compounds must match according to the correct MFCSAM instructions.
				if ( $finding_auntie_2 ) {
					if ( in_array( $compound_name, [ 'cats', 'trees' ] ) ) {
						( $compound_value <= $this->_present_data[ $compound_name ] ) && $finding_auntie_2 = false;
					} elseif ( in_array( $compound_name, [ 'pomeranians', 'goldfish' ] ) ) {
						( $compound_value >= $this->_present_data[ $compound_name ] ) && $finding_auntie_2 = false;
					} else {
						( $compound_value !== $this->_present_data[ $compound_name ] ) && $finding_auntie_2 = false;
					}
				}
			}
			( $finding_auntie_1 ) && $this->_present_auntie_nrs[1] = $auntie_nr;
			( $finding_auntie_2 ) && $this->_present_auntie_nrs[2] = $auntie_nr;
		}
	}

	/**
	 * Output the solution for part 1.
	 */
	public function output_part_1() {
		echo 'The present is from auntie Sue number ' . $this->_present_auntie_nrs[1];
	}

	/**
	 * Output the solution for part 2.
	 */
	public function output_part_2() {
		echo 'With correct usage, the present is from auntie Sue number ' . $this->_present_auntie_nrs[2];
	}
}
