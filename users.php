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
        session_start();
        include 'settings.php';

        $conn = @new mysqli($dbHost, $dbUser, $dbPass, $dbName);
        if($conn -> connect_errno) die ('brak polaczenia');

        if(isset($_POST['delUser'])) {
            $delUser = $_POST['delUser'];
            $conn -> query("DELETE FROM users WHERE name = '$delUser' ");
        }



        $rs = $conn -> query("SELECT *, good/(good+bad) as wynik FROM `users` ORDER BY name ASC");
        
        echo '
        <table>
                <tr>
                    <th>name</th>
                    <th>good</th>
                    <th>bad</th>
                    <th>wynik</th>
                    <th></th>
                </tr>
        ';

        while ($rec = $rs -> fetch_array()) {

            if($rec['name'] !== 'admin') {
                echo '
                <tr>
                    <td>'.$rec['name'].'</td>
                    <td>'.$rec['good'].'</td>
                    <td>'.$rec['bad'].'</td>
                    <td>'.($rec['wynik']*100).' %</td>
                    <td>'.'
                        <form action="users.php" method="post">
                            <input type="hidden" name="delUser" value="'.$rec['name'].'">
                            <input type="submit" name="usun" value="USUŃ" />
                        </form>
                    '.'</td>
                </tr>
                ';
            }
        }

        echo '
        </table>
        ';

    ?>
</body>
</html>