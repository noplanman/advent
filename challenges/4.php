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
	 * The current number.
	 *
	 * @var integer
	 */
	private $_number = 1;

	/**
	 * The current MD5 hash.
	 *
	 * @var string
	 */
	private $_md5_hash = null;

	/**
	 * The main method where the challenge gets solved.
	 */
	public function solve() {
		$prefix = '00000';

		while ( true ) {
			$this->_md5_hash = md5( $this->_input . $this->_number );
			if ( 0 === strpos( $this->_md5_hash, $prefix ) ) {
				break;
			} else {
				$this->_number++;
			}
		}
	}

	/**
	 * Output the solution for part 1.
	 */
	public function output_part_1() {
		echo 'AdventCoin number: ' . $this->_number . ' - MD5 hash: ' . $this->_md5_hash;
	}

	/**
	 * Output the solution for part 2.
	 */
	public function output_part_2() {
		echo '';
	}
}
