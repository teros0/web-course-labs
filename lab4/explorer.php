<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>ТвоїФайли</title>
    <link rel="stylesheet" type="text/css" href="assets\style.css">        
</head>

<?php
    function entries_array($path){
        $handle = (is_dir($path)) ? opendir($path) : die("WHAT A MESS");
        $entries = array();
        $files = array();

        while(false !== ($entry = readdir($handle))){
            if ($entry != "."){
                if(is_dir($entry))
                    array_push($entries, realpath($entry));
                else
                    array_push($files, realpath($entry));
            }
        }
        closedir($handle);
        foreach ($files as $file) {
            array_push($entries, $file);
        }
        return $entries;
    }
?>

<body>

    <form action="explorer.php" method="get" accept-charset="utf-8">
    <label>
        <span>Введіть шлях до папки: </span>
        <input type="text" name="path" required>
    </label>
    <input type="submit" name="submit">
</form>

    <?php 
        $curr = $_GET['path'];

        (is_dir($curr)) ? chdir($curr) : die("No such directory");            
        $entries = entries_array($curr);
    ?>
    <form action="explorer.php" method="get" accept-charset="utf-8">
        <label>
            <span>Введіть шлях до папки: </span>
            <input type="text" name="path" required>
        </label>
        <input type="submit" name="submit">
    </form><br>

        <table align="left">
        <caption><?=$curr?></caption>
        <thead>
            <tr>
                <th>Назва</th>
                <th>Розмір</th>
            </tr>
        </thead>
        <tbody>                
            <?php foreach ($entries as $entr): ?>                     
                <?php if(is_dir($entr)): ?>
                    <tr>
                    <td><form action="explorer.php" method="get" accept-charset="utf-8">
                    <button type="submit" name="path" style="color:#4343a7" value="<?=($entr==dirname($curr) ? dirname($curr) : $entr)?>">
                    <img src="<?=($entr==dirname($curr)) ? $_='assets\ret.png' : $_='assets\fold.png' ?>" alt='icon'>
                            <?=($entr==dirname($curr)) ? $_='Go Back' : basename($entr) ?>
                    </button>
                    </form></td>
                    <td class='second'> </td>
                    
                <?php else: ?>
                    <tr>
                        <td>
                            <span>
                                <img src='assets\file.png' alt='return icon'> <?=basename($entr)?>
                            </span>
                        </td>
                        <td class='second'> <?=filesize(basename($entr))?> B</td>
                <?php endif; ?>
                        </tr>
                <?php endforeach; ?>
        </tbody>
        </table>
</body>
</html>