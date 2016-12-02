<?php
$nice = 0;
foreach ( explode( PHP_EOL, file_get_contents( 'input' ) ) as $string ) {
  if ( ! preg_match_all( '/(\w{2}).*\1/i', $string ) ) continue;
  if ( ! preg_match( '/(\w)\w\1/i', $string ) ) continue;
  $nice++;
}
echo $nice;
