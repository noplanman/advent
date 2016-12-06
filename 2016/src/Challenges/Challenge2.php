<?php declare(strict_types = 1);
/**
 * Challenge for day 2 of Advent of Code.
 * http://adventofcode.com/2016/day/2
 *
 * @package AOC_Solutions
 */

namespace AOC\Challenges;

/**
 * Challenge for day 2.
 */
class Challenge2 extends ChallengeBase
{
    /**
     * @var integer The current challenge day.
     */
    protected static $day = 2;

    /**
     * @var int Solution for part 1.
     */
    private $part_1;

    /**
     * @var int Solution for part 2.
     */
    private $part_2;

    /**
     * The main method where the challenge gets solved.
     */
    public function solve()
    {
        $moves = explode(PHP_EOL, trim($this->input));

        $pad = [
            [1, 2, 3],
            [4, 5, 6],
            [7, 8, 9]
        ];

        $x = 1;
        $y = 1;

        foreach ($moves as $move) {
            $steps = str_split($move);
            foreach ($steps as $step) {
                ('U' === $step) && $y--;
                ('R' === $step) && $x++;
                ('D' === $step) && $y++;
                ('L' === $step) && $x--;

                $x = max(0, min(2, $x));
                $y = max(0, min(2, $y));
            }
            $this->part_1 .= $pad[$y][$x];
        }
    }

    /**
     * Output the solution for part 1.
     */
    public function output_part_1()
    {
        echo 'Bathroom code is: ' . $this->part_1;
    }

    /**
     * Output the solution for part 2.
     */
    public function output_part_2()
    {
        echo '';
    }
}
