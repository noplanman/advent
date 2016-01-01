<?php
$nice = 0;
foreach ( explode( PHP_EOL, file_get_contents( 'input' ) ) as $string ) {
  if ( preg_match_all( '/[aeiou]/i', $string ) < 3 ) continue;
  if ( ! preg_match( '/(\w)\1+/i', $string ) ) continue;
  if ( preg_match( '/(ab|cd|pq|xy)/i', $string ) ) continue;
  $nice++;
}
echo $nice;
