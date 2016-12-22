<!DOCTYPE html>
<?php 
    $site_title="ТвійРозклад";
?>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title><?php echo "$site_title"; ?></title>
    <link rel="stylesheet" type="text/css" href="assets\style.css">
</head>

<?php
function checke($row)
{ 
    if (substr_count($row, "/") != 2)
        return "secrets";
    $chrow = array_map('trim', explode("/", $row));
    $date = explode(".", $chrow[0]);
    $time = explode(":", $chrow[1]);
    $descr = (array_key_exists(2, $chrow)) ? $chrow[2] : '';

    #getting date apart
    $day = $date[0];
    $month = (array_key_exists(1, $date)) ? $date[1] : '';
    $year = (array_key_exists(2, $date)) ? $date[2] : '';
    if ($day > 31 || $day < 1)
        $chrow[0] = "Day error,<br> enter day in range [1;31]";
    if ($month > 12 || $month < 1)
        $chrow[0] = "Month error,<br> enter month in range [1;12]";
    if ($year > 99 || $year < 0)
        $chrow[0] = "Year error,<br> enter year in range [0;99]";
    if (count($date) != 3 or empty($day) or empty($month) or empty($year))
        $chrow[0] = "Incorrect date format,<br> enter 'dd.mm.yy'";

    #getting time apart   
    $hours = $time[0];
    $minutes = (array_key_exists(1, $time)) ? $time[1] : '';

    if ($hours > 23 || $hours < 0)
        $chrow[1] = "Hours error,<br> enter hours in range [0;23]";
    if ($minutes > 59 || $minutes < 0)
        $chrow[1] = "Minutes error, <br> enter minutes in range [0;59]";
    if (count($time) != 2 or empty($hours) or empty($minutes))
        $chrow[1] = "Incorrect time format,<br> enter 'hh:mm'";

    if (empty($descr))
        $chrow[2] = "Опис відсутній.";
    return $chrow;
}


$myfile = file("assets\data.txt") or die("Unable to open file!");
$array = array();
foreach($myfile as $entry)
{
    if (empty(trim($entry))){
        #echo "Line is empty, skipping", "<br>";
        continue;
    }
    array_push($array, checke($entry));
}
?>

<body>
    <table align="center">
        <caption>Розклад</caption>
        <col width="400">
        <col width="400">
        <col width="400">
        <thead>
            <tr height="60">
                <th>Дата</th>
                <th>Час</th>
                <th>Опис</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach ($array as $row) {
                    echo "<tr height='60'>";
                    if ($row == "secrets"){
                        echo "<td id='error' colspan='3'>", "Некоректний ввід, дозволено лише 2 слеші.", "</td>";
                        echo "</tr>";
                        continue;
                    }
                    if (is_array($row)) {
                        foreach ($row as $point) {
                            echo "<td> ", $point, " </td>";
                        }
                    }
                    echo "</tr>";
                }
            ?>
        </tbody>
    </table>
</body>