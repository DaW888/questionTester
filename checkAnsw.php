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
    <a href="index.php?logout=true">LOGOUT</a>
    <a href="./usersRanking.php">Ranking Userow</a>

    <?php
    include 'settings.php';
    session_start();

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
    echo '</div>';

    ?>
</body>

</html>