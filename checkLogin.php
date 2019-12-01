<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="author" content="Dawid Wajda">
    <meta name="description" content="3ic2">

    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="style.css">


    <title>Strona</title>
</head>

<?php
session_start();

if (!empty($_POST)) {
    if (isset($_POST['name']) && isset($_POST['pass'])) {
        include 'settings.php';

        $name = $_POST['name'];
        $pass = $_POST['pass'];

        $conn = @new mysqli($dbHost, $dbUser, $dbPass, $dbName);
        if($conn -> connect_errno) die ('brak polaczenia');
        // $rs = $conn -> query("SELECT * FROM users WHERE name = $name");
        $rs = $conn -> query("SELECT * FROM users WHERE name = '$name' AND pass = '$pass'");

        // print_r($rs);

        if($rs -> num_rows > 0 ) {
            echo 'zalogowano';
            $_SESSION['name'] = $name;
            header("Location: http://localhost/projektTester/index.php");
        } else {
            $rs = $conn -> query("SELECT * FROM users WHERE name = '$name'");
            if ($rs -> num_rows > 0) {
                echo '
                    <div class="cont">
                        <p class="wrongPass">Błędne Hasło</p>
                        <a href="./login.php">Spróbuj jeszcze raz</a>
                    </div>
                ';

            } else {
                echo 'tworze konto';
                $rs = $conn -> query("INSERT INTO `users` (`name`, `pass`, `good`, `bad`) VALUES ('$name', '$pass', '0', '0');");
                if ($rs == 1) {
                    $_SESSION['name'] = $name;
                    header("Location: http://localhost/projektTester/index.php");
                }
                
            }

        }

    }
}

?>

<body>
</body>
</html>




