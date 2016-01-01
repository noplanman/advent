<?php
$ribbon = 0;
foreach ( explode( PHP_EOL, file_get_contents( 'input' ) ) as $presi ) {
  list( $l, $w, $h ) = explode( 'x', $presi );
  $ribbon += ( 2 * ( $l + $w + $h - max( $l, $w, $h ) ) );
  $ribbon += ( $l * $w * $h );
}
echo $ribbon;
