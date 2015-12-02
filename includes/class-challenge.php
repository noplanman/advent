<?php
/**
 * Base challenge class.
 *
 * @package AOC_Solutions
 */

/**
 * This class contains all necessary functionality for a challenge.
 */
abstract class Challenge {

	/**
	 * The day of this challenge.
	 *
	 * @var integer
	 */
	protected static $_day = null;

	/**
	 * The input for this day.
	 *
	 * @var string
	 */
	protected $_input = null;

	/**
	 * Constructor.
	 *
	 * @throws Exception An exception if an invalid day is provided.
	 */
	public function __construct() {
		// Day must be an integer between 1 and 25.
		if ( ! is_int( static::$_day ) || static::$_day < 1 || static::$_day > 25 ) {
			throw new Exception( 'Please provide a valid day for this challenge (' . get_called_class() . ')' );
		}
	}

	/**
	 * Get the challenge input of a given day.
	 *
	 * @throws Exception An exception if an invalid day is provided.
	 */
	final public function load_input() {
		// Make sure the input file for this day exists.
		$input_file = sprintf( '%s/../input/%d', __DIR__, static::$_day );
		if ( ! file_exists( $input_file ) ) {
			throw new Exception( 'Input file seems to be AWOL.' );
		}

		$this->_input = file_get_contents( $input_file );
	}

	/**
	 * Output the header for this challenge.
	 */
	public static function output_header() {
		echo '*********************************' . "\n";
		echo 'Challenge of day ' . static::$_day . "\n";
		echo '*********************************' . "\n";
	}

	/**
	 * This is where the challenge gets solved.
	 */
	abstract public function solve();

	/**
	 * The output for part 1 of this challenge.
	 */
	abstract public function output_part_1();

	/**
	 * The output for part 2 of this challenge.
	 */
	abstract public function output_part_2();
}
