<?php
$secret = file_get_contents( 'input' );
$i = -1;
do {
  $md5 = md5( $secret . ++$i );
} while ( '000000' !== substr( $md5, 0, 6 ) );
echo $i;
