<?php
session_start();

$admin = false;

if (isset($_SESSION['name'])) {
    if ($_SESSION['name'] == 'admin') {
        $admin = true;
    }
} else {
    header("Location: http://localhost/projektTester/login.php");
}

if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: http://localhost/projektTester/index.php");
}

?>


<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="author" content="Dawid Wajda">
    <meta name="description" content="3ic2">
    <title>Strona</title>

    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="table.css">
</head>
<body>

<a href="./index.php" id="mainSite">Strona Główna</a>

    <?php
        include 'settings.php';

        $name = $_SESSION['name'];
        $conn = @new mysqli($dbHost, $dbUser, $dbPass, $dbName);
        if($conn -> connect_errno) die ('brak polaczenia');

        $rs = $conn -> query("SELECT *, good/(good+bad) as wynik FROM `users` ORDER BY wynik DESC LIMIT 10");
        
        $inTop = false;
        echo '
        <table>
                <tr>
                    <th>name</th>
                    <th>good</th>
                    <th>bad</th>
                    <th>wynik</th>
                </tr>
        ';

        while ($rec = $rs -> fetch_array()) {
            
            if ($rec['name'] !== 'admin') {

                if ($rec['name'] == $name) {
                    $inTop = true;
                    echo '<tr class="my">';
                } else {
                    echo '<tr>';
                }
                echo '
                    <td>'.$rec['name'].'</td>
                    <td>'.$rec['good'].'</td>
                    <td>'.$rec['bad'].'</td>
                    <td>'.($rec['wynik']*100).' %</td>
                </tr>
                ';
            }

        }

        echo '
        </table>
        ';

        if (!$inTop && $name != 'admin') {
            $rs = $conn -> query("SELECT *, good/(good+bad) as wynik FROM `users` WHERE name = '$name'");
            $ar = $rs -> fetch_array();

            echo '
            <h2>Twoj Wynik</h2>
            <table>
                <tr>
                    <td>'.$ar['name'].'</td>
                    <td>'.$ar['good'].'</td>
                    <td>'.$ar['bad'].'</td>
                    <td>'.($ar['wynik']*100).'% </td>
                </tr>
            </table>
            ';
        }


    ?>
</body>
</html>