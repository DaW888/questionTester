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
    <title>Strona Głowna</title>

    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <a href="index.php?logout=true">LOGOUT</a>
    <br>

    <?php
    if ($admin) {
        ?>
        <a href="./questions.php">Panel Pytań</a> <br>
        <a href="./users.php">Panel Użytkowników</a> <br>
        <a href="./questionsRanking.php">Ranking Pytań</a> <br>
        <a href="./usersRanking.php">Ranking Użytkowników</a> <br>

    <?php
    } else {
        include 'settings.php';

        $conn = @new mysqli($dbHost, $dbUser, $dbPass, $dbName);
        if($conn -> connect_errno) die ('brak polaczenia');
        $rs = $conn -> query("SELECT * FROM questions ORDER BY RAND() LIMIT 10");

        if($rs -> num_rows > 0 ) {
            echo '<form action="./checkAnsw.php" method="POST" class="cont">';

            while($rec = $rs -> fetch_array()){

                echo '
                    <div class="box">
                        <div class="quest">
                            '.$rec['question'].'
                        </div>
                        
                        <div class="answers">
                            <label><input type="radio" name="'.$rec['id'].'" value="a" hidden checked /> <span>'.$rec['a'].'</span></label>
                            <label><input type="radio" name="'.$rec['id'].'" value="b" hidden /> <span>'.$rec['b'].'</span></label>
                            <label><input type="radio" name="'.$rec['id'].'" value="c" hidden /> <span>'.$rec['c'].'</span></label>
                            <label><input type="radio" name="'.$rec['id'].'" value="d" hidden /> <span>'.$rec['d'].'</span></label>
                        </div>
                    </div>
                ';
            }

            echo '<input type="submit" value="Sprawdź">';
            echo '</form>';

        }
    }
    ?>


</body>

</html>