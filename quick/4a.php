<?php
$secret = file_get_contents( 'input' );
$i = -1;
do {
  $md5 = md5( $secret . ++$i );
} while ( '00000' !== substr( $md5, 0, 5 ) );
echo $i;
