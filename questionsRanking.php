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

<a href="./index.php" id="mainSite" >Strona Główna</a>

    <?php
        session_start();
        include 'settings.php';

        $conn = @new mysqli($dbHost, $dbUser, $dbPass, $dbName);
        if($conn -> connect_errno) die ('brak polaczenia');

        $rs = $conn -> query("SELECT *, good/(good+bad) as wynik FROM `questions` ORDER BY wynik ASC LIMIT 10");
        
        echo '
        <table>
                <tr>
                    <th>id</th>
                    <th>pytanie</th>
                    <th>odpowiedz</th>
                    <th>dobrze</th>
                    <th>źle</th>
                    <th>wynik</th>
                </tr>
        ';

        while ($rec = $rs -> fetch_array()) {
                echo '
                <tr>
                    <td>'.$rec['id'].'</td>
                    <td>'.$rec['question'].'</td>
                    <td>'.$rec[$rec['answer']].'</td>
                    <td>'.$rec['good'].'</td>
                    <td>'.$rec['bad'].'</td>
                    <td>'.($rec['wynik']*100).' %</td>
                </tr>
                ';

        }

        echo '
        </table>
        ';

    ?>
</body>
</html>