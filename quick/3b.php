<?php
$presis = [ '0-0' => 1 ];
$v1 = $v2 = $h1 = $h2 = 0;
$santa = true;
foreach ( str_split( file_get_contents( 'input' ) ) as $move ) {
  ( $santa )   && ( $v = &$v1 xor $h = &$h1 );
  ( ! $santa ) && ( $v = &$v2 xor $h = &$h2 );
  switch ( $move ) {
    case '^': $v++; break;
    case 'v': $v--; break;
    case '>': $h++; break;
    case '<': $h--; break;
  }
  ( ! isset( $presis["$h-$v"] ) ) && $presis["$h-$v"] = 0;
  $presis["$h-$v"]++;
  $santa = ! $santa;
}
echo count( array_filter( $presis, function( $_presis ) {
  return ( count( $_presis ) >= 1 );
} ) );
