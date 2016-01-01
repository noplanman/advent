<?php
$floor = 0;
$step_nr = 0;
foreach ( str_split( file_get_contents( 'input' ) ) as $step ) {
  $step_nr++;
  $floor += ( '(' === $step ) ? 1 : -1;
  if ( -1 === $floor ) break;
}
echo $step_nr;
