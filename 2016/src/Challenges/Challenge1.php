<?php declare(strict_types = 1);
/**
 * Challenge for day 1 of Advent of Code.
 * http://adventofcode.com/day/1
 *
 * @package AOC_Solutions
 */

namespace AOC\Challenges;

/**
 * Challenge for day 1.
 */
class Challenge1 extends ChallengeBase
{
    /**
     * The current challenge day.
     *
     * @var integer
     */
    protected static $day = 1;

    private $part_1;

    /**
     * The main method where the challenge gets solved.
     */
    public function solve()
    {
        $directions = explode(',', str_replace(' ', '', $this->input));
        $moves = array_fill(0, 4, 0);
        $cur_dir = 0;
        foreach ($directions as $direction) {
            $cur_dir += $direction[0] === 'R' ? 1 : -1;
            ($cur_dir < 0) && $cur_dir += 4;
            $cur_dir %= 4;
            $moves[$cur_dir] += (int)substr($direction, 1);
        }

        $this->part_1 = abs($moves[0] - $moves[2]) + abs($moves[1] - $moves[3]);
    }

    /**
     * Output the solution for part 1.
     */
    public function output_part_1()
    {
        echo 'Easter Bunny HQ is ' . $this->part_1 . ' blocks away.';
    }

    /**
     * Output the solution for part 2.
     */
    public function output_part_2()
    {
        echo '';
    }
}
