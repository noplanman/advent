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
     * Calculate the next valid step.
     * 
     * @param $pad
     * @param $x
     * @param $y
     * @param $dir
     * @return array
     */
    private function next_step($pad, $x, $y, $dir)
    {
        $x2 = $x;
        $y2 = $y;
        
        ('U' === $dir) && $y2--;
        ('R' === $dir) && $x2++;
        ('D' === $dir) && $y2++;
        ('L' === $dir) && $x2--;

        $x = max(0, min(count($pad) - 1, $x));
        $y = max(0, min(count($pad) - 1, $y));

        return (empty($pad[$y2][$x2]) || ' ' === $pad[$y2][$x2]) ? [$x, $y] : [$x2, $y2];
    }

    /**
     * Solve part 1 and save the answer to $this->part_1.
     *
     * @param array $moves
     */
    private function solve_1(array $moves)
    {
        $pad = [
            ['1', '2', '3'],
            ['4', '5', '6'],
            ['7', '8', '9']
        ];

        $x = 1;
        $y = 1;

        foreach ($moves as $move) {
            $steps = str_split($move);
            foreach ($steps as $step) {
                list($x, $y) = $this->next_step($pad, $x, $y, $step);
            }
            $this->part_1 .= $pad[$y][$x];
        }
    }
    
    /**
     * Solve part 2 and save the answer to $this->part_2.
     *
     * @param array $moves
     */
    private function solve_2(array $moves)
    {
        $pad = [
            [' ', ' ', '1', ' ', ' '],
            [' ', '2', '3', '4', ' '],
            ['5', '6', '7', '8', '9'],
            [' ', 'A', 'B', 'C', ' '],
            [' ', ' ', 'D', ' ', ' ']
        ];

        $x = 0;
        $y = 2;

        foreach ($moves as $move) {
            $steps = str_split($move);
            foreach ($steps as $step) {
                list($x, $y) = $this->next_step($pad, $x, $y, $step);
            }
            $this->part_2 .= $pad[$y][$x];
        }
    }

    /**
     * The main method where the challenge gets solved.
     */
    public function solve()
    {
        $moves = explode(PHP_EOL, trim($this->input));

        $this->solve_1($moves);
        $this->solve_2($moves);
    }

    /**
     * Output the solution for part 1.
     */
    public function output_part_1()
    {
        echo 'Part 1 bathroom code is: ' . $this->part_1;
    }

    /**
     * Output the solution for part 2.
     */
    public function output_part_2()
    {
        echo 'Part 2 bathroom code is: ' . $this->part_2;
    }
}
