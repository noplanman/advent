<?php declare(strict_types = 1);
/**
 * Challenge for day 4 of Advent of Code.
 * http://adventofcode.com/2016/day/4
 *
 * @package AOC_Solutions
 */

namespace AOC\Challenges;

/**
 * Challenge for day 4.
 */
class Challenge4 extends ChallengeBase
{
    /**
     * @var integer The current challenge day.
     */
    protected static $day = 4;

    /**
     * @var int Solution for part 1.
     */
    private $part_1;
    
    /**
     * Check if the passed letters and checksum are a valid room.
     *
     * @param array $letters
     * @param string $checksum
     * @return bool
     */
    private function is_valid_room(array $letters, $checksum)
    {
        $letters_arr = [];
        foreach ($letters as $letter => $letter_cnt) {
            if (isset($letters_arr[$letter_cnt])) {
                $letters_arr[$letter_cnt][] = $letter;
            } else {
                $letters_arr[$letter_cnt] = [$letter];
            }
        }
        krsort($letters_arr);

        $check = '';
        foreach ($letters_arr as $letter_arr) {
            asort($letter_arr);
            if ($letters = array_intersect($letter_arr, str_split($checksum))) {
                $check .= implode($letters);
            }
            if (strlen($check) > 5) {
                $check = substr($check, 0, 5);
                break;
            }
        }

        return $check === $checksum;
    }

    /**
     * Solve part 1 and save the answer to $this->part_1.
     *
     * @param array $rooms
     */
    private function solve_1($rooms)
    {
        $this->part_1 = 0;
        
        /** @var array $room */
        foreach ($rooms as $room) {
            preg_match('/(\d*)\[(.*)\]/', array_pop($room), $id_checksum);
            list(, $sector_id, $checksum) = $id_checksum;

            $letters = [];

            /** @var string $code */
            foreach ($room as $code) {
                foreach (str_split($code) as $char) {
                    if (isset($letters[$char])) {
                        $letters[$char]++;
                    } else {
                        $letters[$char] = 1;
                    }
                }
            }

            $this->is_valid_room($letters, $checksum) && $this->part_1 += $sector_id;
        }
    }

    /**
     * The main method where the challenge gets solved.
     */
    public function solve()
    {
        $rooms = array_filter(explode(PHP_EOL, $this->input));

        // Turn each row into an array.
        array_walk($rooms, function (&$room) {
            $room = explode('-', $room);
        });

        $this->solve_1($rooms);
    }

    /**
     * Output the solution for part 1.
     */
    public function output_part_1()
    {
        echo 'Sum of valid room sector IDs: ' . $this->part_1;
    }

    /**
     * Output the solution for part 2.
     */
    public function output_part_2()
    {
        echo '';
    }
}
