<?php
$presis = [ '0-0' => 1 ];
$v = $h = 0;
foreach ( str_split( file_get_contents( 'input' ) ) as $move ) {
  switch ( $move ) {
    case '^': $v++; break;
    case 'v': $v--; break;
    case '>': $h++; break;
    case '<': $h--; break;
  }
  ( ! isset( $presis["$h-$v"] ) ) && $presis["$h-$v"] = 0;
  $presis["$h-$v"]++;
}
echo count( array_filter( $presis, function( $_presis ) {
  return ( count( $_presis ) >= 1 );
} ) );
