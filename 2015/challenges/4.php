<?php
/**
 * Challenge for day 4 of Advent of Code.
 * http://adventofcode.com/day/4
 *
 * @package AOC_Solutions
 */

/**
 * Challenge for day 4.
 */
class Challenge4 extends Challenge {

	/**
	 * The current challenge day.
	 *
	 * @var integer
	 */
	protected static $_day = 4;

	/**
	 * The value manager.
	 *
	 * @var array
	 */
	private $_values = [
		1 => [
			'found'    => false,
			'prefix'   => '00000',
			'number'   => 1,
			'md5_hash' => '',
		],
		2 => [
			'found'    => false,
			'prefix'   => '000000',
			'number'   => 1,
			'md5_hash' => '',
		],
	];

	/**
	 * The main method where the challenge gets solved.
	 */
	public function solve() {
		$all_found = false;
		$number = 0;
		$md5_hash = '';

		while ( ! $all_found ) {
			$all_found = true;
			$md5_hash = md5( $this->_input . ++$number );

			foreach ( $this->_values as $key => &$value ) {
				if ( $value['found'] ) {
					continue;
				}

				if ( 0 === strpos( $md5_hash, $value['prefix'] ) ) {
					$value['found'] = true;
					$value['number'] = $number;
					$value['md5_hash'] = $md5_hash;
				}

				$all_found = false;
			}
		}
	}

	/**
	 * Output the solution for part 1.
	 */
	public function output_part_1() {
		echo 'AdventCoin number 1: ' . $this->_values[1]['number'] . ' - MD5 hash: ' . $this->_values[1]['md5_hash'];
	}

	/**
	 * Output the solution for part 2.
	 */
	public function output_part_2() {
		echo 'AdventCoin number 2: ' . $this->_values[2]['number'] . ' - MD5 hash: ' . $this->_values[2]['md5_hash'];
	}
}
