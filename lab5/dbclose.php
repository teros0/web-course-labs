<?php

// --------------------------------
// -- Closing the Connection to a Database
// --------------------------------

/*

New:
    method - $connection->close();

*/


$dbPassword = "";
$dbUserName = "root";
$dbServer = "localhost";
$dbName = "students";

$connection = new mysqli($dbServer, $dbUserName, $dbPassword, $dbName);

if($connection->connect_errno)
{
     exit("Database Connection Failed. Reason: ".$connection->connect_error);
}

$connection->close();
