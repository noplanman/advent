<?php declare(strict_types=1);
/**
 * Base challenge class.
 *
 * @package AOC_Solutions
 */

namespace AOC\Challenges;

use InvalidArgumentException;

/**
 * This class contains all necessary functionality for a challenge.
 */
abstract class ChallengeBase
{
    /**
     * The day of this challenge.
     *
     * @var integer
     */
    protected static $day;

    /**
     * The input for this day.
     *
     * @var string
     */
    protected $input;

    /**
     * Constructor.
     *
     * @param $input_file
     * @throws \InvalidArgumentException
     */
    public function __construct($input_file)
    {
        // Day must be an integer between 1 and 25.
        if (!is_int(static::$day) || static::$day < 1 || static::$day > 25) {
            throw new InvalidArgumentException('Please provide a valid day for this challenge (' . get_called_class() . ')');
        }
        $this->load_input($input_file);
    }

    /**
     * Return the day number of this challenge.
     *
     * @return integer The day number.
     */
    final static public function day()
    {
        return static::$day;
    }

    /**
     * Get the challenge input of a given day.
     *
     * @param $input_file
     * @throws \InvalidArgumentException
     */
    final private function load_input($input_file)
    {
        // Make sure the input file for this day exists.
        if (!file_exists($input_file)) {
            throw new InvalidArgumentException('Input file seems to be AWOL.');
        }

        $this->input = file_get_contents($input_file);
    }

    /**
     * Output the header for this challenge.
     */
    public static function output_header()
    {
        echo '*********************************' . "\n";
        echo 'Challenge of day ' . static::$day . "\n";
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
