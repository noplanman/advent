<?php
/**
 * Challenge solutions for Advent of Code 2015.
 * http://adventofcode.com/
 *
 * @package AOC_Solutions
 */

// We'll be outputting plain text.
header('Content-Type: text/plain');

require_once __DIR__ . '/includes/class-challenge.php';
$challenge_files = glob(__DIR__ . '/challenges/*.php');
natsort($challenge_files);
foreach ($challenge_files as $challenge_file) {
    require_once $challenge_file;
}

// Get a list of all challenge classes.
$challenge_classes = array_filter(get_declared_classes(), function ($class) {
    return is_subclass_of($class, 'Challenge');
});

/** @var Challenge $challenge */
foreach ($challenge_classes as $challenge_class) {
    try {
        $mem = memory_get_usage();
        $time = microtime(true);

        call_user_func([$challenge_class, 'output_header']);
        $challenge = new $challenge_class();
        if (isset($_GET['day']) && (int)$_GET['day'] !== $challenge::day()) {
            echo "Skipped\n\n";
            continue;
        }
        $challenge->load_input();
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
    } catch (Exception $e) {
        printf("!!! %s !!!\n\n", $e->getMessage());
    }
}
