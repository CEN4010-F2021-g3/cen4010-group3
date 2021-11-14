<?php
//always use db so that variable names don't match with other scripts
//$dbHostname = 'localhost';
//$dbUsername = 'root';
//$dbPassword = ''; //don't need this anymore for my local DB
//$dbName = 'proj_database';

// Mauricio's PC
$dbHostname = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'proj_database';

// Namecheap/Cpanel database user
//$dbHostname = 'localhost';
//$dbUsername = 'peaczntv';
//$dbPassword = 'Gp03@2021';
//$dbName = 'peaczntv_proj_database';

// Ryan's PC
// $dbHostname = 'localhost';
// $dbUsername = 'root';
// $dbPassword = 'Acerace80';
// $dbName = 'proj_database_updated';

$conn = mysqli_connect($dbHostname, $dbUsername, $dbPassword, $dbName); //connect to database
if (!$conn) { //if connection fails
    die('Connection failed: ' . mysqli_connect_error());
}
