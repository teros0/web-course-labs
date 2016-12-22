<?php
    require 'dbopen.php';    
    $query = "SELECT * FROM products pr JOIN orders o ON pr.prod_id = o.prod_id join customers c on o.cust_id=c.cust_id";
    $resultObj = $connection->query($query);
    $ng=mysqli_num_rows($resultObj);
    mysqli_close($connection);
 ?>
<!DOCTYPE html>
<html>
<head>
    <title>lab5 ТвоїЗапити</title>    
    <link rel="stylesheet" type="text/css" href="assets\style.css">
    <link rel="stylesheet" type="text/css" href="assets\pure\buttons.css">
    <link rel="stylesheet" type="text/css" href="assets\zavoloklom.css">
</head>
<body>
<div id="main">
<div class="main-table">
    <table align="center">
        <caption>Об'єднанні <?=$ng?></caption>
        <thead>
            <tr>
                <th>prod_id</th>
                <th>prod_name</th>
                <th>prod_price</th>
                <th>order_id</th>
                <th>cust_id</th>
                <th>price</th>
                <th>cust_name</th>
                <th>cust_mail</th>
            </tr>
        </thead>
        <tbody>                
            <?php while($row = $resultObj->fetch_assoc()) : ?> 
                    <tr>
                    <td><?=$row['prod_id']?></td>
                    <td><?=$row['prod_name']?></td>
                    <td><?=$row['prod_price']?></td>
                    <td><?=$row['order_id']?></td>
                    <td><?=$row['cust_id']?></td>
                    <td><?=$row['price']?></td>
                    <td><?=$row['cust_name']?></td>
                    <td><?=$row['cust_mail']?></td>
                    </tr>
                <?php endwhile; ?>
        </tbody>
        </table>
</div>

<?php 
    require 'dbopen.php';
    $querycust = "SELECT * FROM customers";
    $resultCust = $connection->query($querycust);
    $nc=mysqli_num_rows($resultCust); 
    $queryprod = "SELECT * FROM products";
    $resultProd = $connection->query($queryprod);
    $np=mysqli_num_rows($resultProd); 
    $queryord = "SELECT * FROM orders";
    $resultOrd = $connection->query($queryord);
    $no=mysqli_num_rows($resultOrd); 
    mysqli_close($connection);
 ?>


<div class="megaflex">
<div class="second-table megaitem">    

    <table class="item">
        <caption>customers <?=$nc?></caption>
        <thead>
            <tr>
                <th>cust_id</th>
                <th>cust_name</th>
                <th>cust_mail</th>
            </tr>
        </thead>
        <tbody>                
            <?php while($row = $resultCust->fetch_assoc()) : ?> 
                    <tr>
                    <td><?=$row["cust_id"]?></td>
                    <td><?=$row["cust_name"]?></td>
                    <td><?=$row["cust_mail"]?></td>
                    </tr>
                <?php endwhile; ?>
        </tbody>
        </table>        
        <div class="item-form">
        <form  action="customers.php" method="get" accept-charset="utf-8">
            <span>cust_id: </span>
            <input type="text" name="operands[]"><br>
            <span>cust_name: </span>
            <input type="text" name="operands[]"><br>
            <span>cust_mail: </span>
            <input type="text" name="operands[]"><br>
            <button class="button-small pure-button" type="submit" name="operation" value="INSERT">INSERT</button>
            <button class="button-small pure-button" type="submit" name="operation" value="UPDATE">UPDATE</button> <br>
            <span>cust_id: </span>
            <input type="text" name="delid"><br>
            <button class="button-small pure-button" type="submit" name="operation" value="DELETE">DELETE</button> <br>
            <input type="hidden" name="table" value="customers">
        </form>
        </div>
</div>

<div class="second-table megaitem">    

    <table class="item">
        <caption>products <?=$np?></caption>
        <thead>
            <tr>
                <th>prod_id</th>
                <th>prod_name</th>
                <th>prod_price</th>
            </tr>
        </thead>
        <tbody>                
            <?php while($row = $resultProd->fetch_assoc()) : ?> 
                    <tr>
                    <td><?=$row["prod_id"]?></td>
                    <td><?=$row["prod_name"]?></td>
                    <td><?=$row["prod_price"]?></td>
                    </tr>
                <?php endwhile; ?>
        </tbody>
        </table>        

        <form class="item-form" action="products.php" method="get" accept-charset="utf-8">
            <span>prod_id: </span>
            <input type="text" name="operands[]"><br>
            <span>prod_name: </span>
            <input type="text" name="operands[]"><br>
            <span>prod_price: </span>
            <input type="text" name="operands[]"><br>
            <button class="button-small pure-button" type="submit" name="operation" value="INSERT">INSERT</button>
            <button class="button-small pure-button" type="submit" name="operation" value="UPDATE">UPDATE</button> <br>
            <span>prod_id: </span>
            <input type="text" name="delid"><br>
            <button class="button-small pure-button" type="submit" name="operation" value="DELETE">DELETE</button> <br>
            <input type="hidden" name="table" value="products">
        </form>
</div>

<div class="second-table megaitem">    

    <table class="item">
        <caption>orders <?=$no?></caption>
        <thead>
            <tr>
                <th>order_id</th>
                <th>cust_id</th>
                <th>prod_id</th>
                <th>price</th>
            </tr>
        </thead>
        <tbody>                
            <?php while($row = $resultOrd->fetch_assoc()) : ?> 
                    <tr>
                    <td><?=$row["order_id"]?></td>
                    <td><?=$row["cust_id"]?></td>                    
                    <td><?=$row["prod_id"]?></td>
                    <td><?=$row["price"]?></td>
                    </tr>
                <?php endwhile; ?>
        </tbody>
        </table>        

        <form class="item-form" action="orders.php" method="get" accept-charset="utf-8">
            <span>order_id: </span>
            <input type="text" name="operands[]"><br>
            <span>cust_id: </span>
            <input type="text" name="operands[]"><br>
            <span>prod_id: </span>
            <input type="text" name="operands[]"><br>
            <span>price: </span>
            <input type="text" name="operands[]"><br>
            <button class="button-small pure-button" type="submit" name="operation" value="INSERT">INSERT</button>
            <button class="button-small pure-button" type="submit" name="operation" value="UPDATE">UPDATE</button> <br>
            <span>order_id: </span>
            <input type="text" name="delid"><br>
            <button class="button-small pure-button" type="submit" name="operation" value="DELETE">DELETE</button> <br>
            <input type="hidden" name="table" value="orders">
        </form>
</div>

</div>
</body>
</html>