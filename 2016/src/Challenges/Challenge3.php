<?php declare(strict_types = 1);
/**
 * Challenge for day 3 of Advent of Code.
 * http://adventofcode.com/2016/day/3
 *
 * @package AOC_Solutions
 */

namespace AOC\Challenges;

/**
 * Challenge for day 3.
 */
class Challenge3 extends ChallengeBase
{
    /**
     * @var integer The current challenge day.
     */
    protected static $day = 3;

    /**
     * @var int Solution for part 1.
     */
    private $part_1;

    /**
     * @var int Solution for part 2.
     */
    private $part_2;

    /**
     * Calculate if triangle is possible.
     *
     * @param $sides
     * @return bool
     */
    private function is_triangle(array $sides)
    {
        natsort($sides);
        $sides = array_values($sides);

        return $sides[0] + $sides[1] > $sides[2];
    }

    /**
     * The main method where the challenge gets solved.
     */
    public function solve()
    {
        $triangles = array_chunk(array_filter(explode(' ', str_replace(PHP_EOL, ' ', $this->input))), 3);

        $this->part_1 = count(array_filter($triangles, function($triangle) {
            return $this->is_triangle($triangle);
        }));
    }

    /**
     * Output the solution for part 1.
     */
    public function output_part_1()
    {
        echo 'Number of valid triangles: ' . $this->part_1;
    }

    /**
     * Output the solution for part 2.
     */
    public function output_part_2()
    {
        echo '';
    }
}
