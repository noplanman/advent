<?php
$paper = 0;
foreach ( explode( PHP_EOL, file_get_contents( 'input' ) ) as $presi ) {
  list( $l, $w, $h ) = explode( 'x', $presi );
  $paper += ( 2 * ( $l * $w + $l * $h + $w * $h ) );
  $paper += ( $l * $w * $h / max( $l, $w, $h ) );
}
echo $paper;
