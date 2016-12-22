<?php
    require 'dbopen.php';
    $table = $_GET['table'];
    $operation = $_GET['operation'];
    switch ($operation) {
        case 'INSERT':
            $operands = $_GET['operands'];
            $query ="INSERT INTO $table VALUES ('$operands[0]', '$operands[1]', '$operands[2]', '$operands[3]')";
            break;
        case 'DELETE':
            $operand = $_GET['delid'];
            $query = "DELETE FROM $table where order_id='$operand'";
            break;
        case 'UPDATE':
            $operands = $_GET['operands'];
            $query = "UPDATE $table SET cust_id='$operands[1]', prod_id='$operands[2]', price='$operands[3]' WHERE order_id='$operands[0]'";
            break;
    }
    $connection->query($query);
    $query = "SELECT * FROM $table";
    $resultObj = $connection->query($query);
    $newURL = "./index.php";
    header('Location: '.$newURL);
?>