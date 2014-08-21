<?php

/* -=PHP FPING=- */

function fping($host, $timeout = 1) {
  $package = "\x08\x00\x7d\x4b\x00\x00\x00\x00PingHost";
  $socket  = socket_create(AF_INET, SOCK_RAW, 1);
  socket_set_option($socket, SOL_SOCKET, SO_RCVTIMEO, array('sec' => $timeout, 'usec' => 0));
  @socket_connect($socket, $host, null);
  @socket_send($socket, $package, strLen($package), 0);
  return socket_read($socket, 255) ? 'alive' : 'die';
  socket_close($socket);
}


// USE: 
//# fping(google.com, 5);
//# return -> alive | die 
