<?php

# Script til database forbindelse 

// Server variabler
$serverName = "142.93.238.170"; 
$connectionInfo = array( "Database"=>"fdfDB", "UID"=>"jwh", "PWD"=>"jSdp2408");
$conn = sqlsrv_connect($serverName, $connectionInfo);

// Hvis forbindelsen mislykkes udskrives en fejl
if(!$conn) {
  echo "Connection could not be established.<br />";
  die(print_r( sqlsrv_errors(), true));
}
