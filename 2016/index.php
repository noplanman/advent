<?php declare(strict_types=1);
/**
 * Challenge solutions for Advent of Code 2016.
 * http://adventofcode.com/
 *
 * @package AOC_Solutions
 */

require_once __DIR__ . '/vendor/autoload.php';

$input_dir = __DIR__ . '/Input';

for ($day = 1; $day < 25; ++$day) {
    $challenge_class = 'AOC\\Challenges\\Challenge' . $day;
    
    /** @var Challenge $challenge */
    try {
        $mem = memory_get_usage();
        $time = microtime(true);

        $challenge = new $challenge_class($input_dir . '/' . $day);
        $challenge::output_header();
        $challenge->solve();
        printf(
            'Memory used: %dB, Time used: %fs' . "\n",
            memory_get_usage() - $mem,
            microtime(true) - $time
        );
        $challenge->output_part_1();
        echo "\n";
        $challenge->output_part_2();
        echo "\n\n";
    } catch (\Throwable $e) {
        // Silencio...
        // printf("!!! %s !!!\n\n", $e->getMessage());
    }
}
