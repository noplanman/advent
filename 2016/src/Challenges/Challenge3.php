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
     * Solve part 1 and save the answer to $this->part_1.
     *
     * @param array $triangles
     */
    private function solve_1(array $triangles)
    {
        $this->part_1 = count(array_filter($triangles, function ($triangle) {
            return $this->is_triangle($triangle);
        }));
    }

    /**
     * Solve part 2 and save the answer to $this->part_2.
     *
     * @param array $triangles
     */
    private function solve_2(array $triangles)
    {
        $this->part_2 = 0;
        for ($i = 0; $i < 3; ++$i) {
            // Get each column and divide into chunks of 3, each representing a triangle.
            $this->part_2 += count(array_filter(array_chunk(array_column($triangles, $i), 3), function ($triangle) {
                return $this->is_triangle($triangle);
            }));
        }
    }

    /**
     * The main method where the challenge gets solved.
     */
    public function solve()
    {
        $triangles = array_filter(explode(PHP_EOL, $this->input));
        
        // Turn each row into an array.
        array_walk($triangles, function (&$triangle) {
            $triangle = array_values(array_filter(explode(' ', $triangle)));
        });

        $this->solve_1($triangles);
        $this->solve_2($triangles);
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
        echo 'Number of valid triangles (vertically): ' . $this->part_2;
    }
}
