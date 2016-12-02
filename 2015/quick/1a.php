<?php
$floor = 0;
foreach ( str_split( file_get_contents( 'input' ) ) as $step ) {
  $floor += ( '(' === $step ) ? 1 : -1;
}
echo $floor;
