<?php declare(strict_types = 1);
/**
 * Challenge for day 1 of Advent of Code.
 * http://adventofcode.com/2016/day/1
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
     * @var integer The current challenge day.
     */
    protected static $day = 1;

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
        $directions = explode(',', str_replace(' ', '', $this->input));
        
        $x = 0;
        $y = 0;
        $cur_direction = 0;
        $distance = 0;

        $positions = [];
        foreach ($directions as $direction) {
            $cur_direction += $direction[0] === 'R' ? 1 : -1;
            ($cur_direction < 0) && $cur_direction += 4;
            $cur_direction %= 4;
            
            $cur_distance = (int)substr($direction, 1);
            // We need to remember every individual step.
            while ($cur_distance--) {
                (0 === $cur_direction) && $y++;
                (1 === $cur_direction) && $x++;
                (2 === $cur_direction) && $y--;
                (3 === $cur_direction) && $x--;

                $position = "$x:$y";
                $distance = abs($x) + abs($y);
                if (null === $this->part_2 && in_array($position, $positions, true)) {
                    $this->part_2 = $distance;
                }
                $positions[] = $position;
            }
        }

        $this->part_1 = $distance;
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
        echo 'First double-visit is ' . $this->part_2 . ' blocks away.';
    }
}
