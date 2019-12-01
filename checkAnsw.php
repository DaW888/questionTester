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
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <a href="index.php?logout=true" id="logout">LOGOUT</a>

    <?php
    include 'settings.php';

    $name = $_SESSION['name'];

    $conn = @new mysqli($dbHost, $dbUser, $dbPass, $dbName);
    if($conn -> connect_errno) die ('brak polaczenia');

    echo '<div class="cont">';

    foreach ($_POST as $k => $v) {
        $rs = $conn -> query("SELECT * FROM questions WHERE id='$k'");

        $ar = $rs -> fetch_array();
        $right = $ar['answer'];

        if ($right == $v) {
            $conn -> query("UPDATE questions SET good = good + 1 WHERE id = '$k' ");
            $conn -> query("UPDATE users SET good = good + 1 WHERE name = '$name' ");

            echo '
            <div class="box">
                <div class="quest">
                    '.$ar['question'].'
                </div>
                <div class="right">
                    <p class="good">'.$ar[$right].'</p>
                </div>
            </div>
        ';
        } else {
            $conn -> query("UPDATE questions SET bad = bad + 1 WHERE id = '$k' ");
            $conn -> query("UPDATE users SET bad = bad + 1 WHERE name = '$name' ");
            echo '
            <div class="box">
                <div class="quest">
                    '.$ar['question'].'
                </div>
                <div class="right">
                    <p class="good">'.$ar[$right].'</p>
                    <p class="your">'.$ar[$v].'</p>
                </div>
            </div>
        ';
        }
    }
    echo '<a href="./usersRanking.php">Ranking Userow</a>';
    echo '</div>';

    ?>
</body>

</html>