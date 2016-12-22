<?php
    require 'dbopen.php';
    $table = $_GET['table'];
    $operation = $_GET['operation'];
    switch ($operation) {
        case 'INSERT':
            $operands = $_GET['operands'];
            $query = "INSERT INTO $table VALUES ('$operands[0]', '$operands[1]', '$operands[2]')";
            break;
        case 'DELETE':
            $operand = $_GET['delid'];
            $query = "DELETE FROM $table where prod_id='$operand'";
            break;
        case 'UPDATE':
            $operands = $_GET['operands'];
            $query = "UPDATE $table SET prod_name='$operands[1]', prod_price='$operands[2]' WHERE prod_id='$operands[0]'";
            break;
    }
    $connection->query($query);
    $query = "SELECT * FROM $table";
    $resultObj = $connection->query($query);
    $newURL = "http://localhost:8081/lab5/index.php";
    header('Location: '.$newURL);
?>