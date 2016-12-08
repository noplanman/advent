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
    private $part_1 = 0;

    /**
     * @var int Solution for part 2.
     */
    private $part_2 = -1;

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
     * Get the list of valid rooms in a nicely formatted array.
     *
     * @param array $rooms
     * @return array
     */
    private function get_valid_rooms(array $rooms)
    {
        $valid_rooms = [];

        /** @var array $room_names */
        foreach ($rooms as $room_names) {
            preg_match('/(\d*)\[(.*)\]/', array_pop($room_names), $id_checksum);
            list(, $sector_id, $checksum) = $id_checksum;

            $letters = [];

            /** @var string $code */
            foreach ($room_names as $room_name) {
                foreach (str_split($room_name) as $letter) {
                    if (isset($letters[$letter])) {
                        $letters[$letter]++;
                    } else {
                        $letters[$letter] = 1;
                    }
                }
            }

            if ($this->is_valid_room($letters, $checksum)) {
                $valid_rooms[] = compact('sector_id', 'checksum', 'room_names');
            }
        }

        return $valid_rooms;
    }

    /**
     * Caesar cipher for the passed string.
     *
     * @param string $string
     * @param int $rotation
     * @return string
     */
    private function caesar($string, $rotation)
    {
        $new_string = '';
        $rotation %= 26;

        foreach (str_split($string) as $char) {
            $ascii = ord($char);
            for ($j = 0; $j < $rotation; $j++) {
                122 === $ascii++ && $ascii = 97;
            }
            $new_string .= chr($ascii);
        }

        return $new_string;
    }

    /**
     * Solve part 1 and save the answer to $this->part_1.
     *
     * @param array $rooms
     */
    private function solve_1(array $rooms)
    {
        foreach ($rooms as $room) {
            $this->part_1 += $room['sector_id'];
        }
    }

    /**
     * Solve part 2 and save the answer to $this->part_2.
     *
     * @param array $rooms
     */
    private function solve_2(array $rooms)
    {
        foreach ($rooms as $room) {
            $room_name_deciphered = '';

            /** @var array $room_names */
            $room_names = $room['room_names'];
            foreach ($room_names as $room_name) {
                $room_name_deciphered .= $this->caesar($room_name, $room['sector_id']);
            }

            if ('northpoleobjectstorage' === $room_name_deciphered) {
                $this->part_2 = $room['sector_id'];
                return;
            }
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

        $valid_rooms = $this->get_valid_rooms($rooms);

        $this->solve_1($valid_rooms);
        $this->solve_2($valid_rooms);
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
        echo 'Northpole object storage has sector ID: ' . $this->part_2;
    }
}
