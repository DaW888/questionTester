<?php
session_start();

$admin = false;

if (isset($_SESSION['name'])) {
    if ($_SESSION['name'] == 'admin') {
        $admin = true;
    } else {
        header("Location: http://localhost/projektTester");
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

    <script>
        function dodajPytanie() {
            console.log('asd');
            const bt = document.getElementById('btAdd');
            bt.parentNode.removeChild(bt);

            const form = document.createElement('form');
            form.action = "./questions.php";
            form.method = "POST";
            form.className = "box";
            const box = `
                <form action="./questions.php" method="POST" class="box">
                    <div class="quest">
                        <textarea name="question" cols="30" rows="4" required></textarea>
                    </div>
                    <div class="answers">
                        <label><input type="radio" name="good" value="a" required /> <input type="text" name="a"  required></label>
                        <label><input type="radio" name="good" value="b" /> <input type="text" name="b"  required></label>
                        <label><input type="radio" name="good" value="c" /> <input type="text" name="c"  required></label>
                        <label><input type="radio" name="good" value="d" /> <input type="text" name="d"  required></label>
                    </div>
                    <div class="bt">
                        <input type="submit" value="Dodaj" name="update">
                    </div>
                </form> `;
            
            form.innerHTML = box;
            const cont = document.querySelector('.cont');
            cont.appendChild(form);
            cont.appendChild(bt);
            console.log(form);

       


        }
    </script>

    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="style.css">
</head>

<body>
<a href="./index.php" id="mainSite" >Strona Główna</a>
    <?php
    include 'settings.php';

    $conn = @new mysqli($dbHost, $dbUser, $dbPass, $dbName);
    if ($conn->connect_errno) die('brak polaczenia');



    if (isset($_POST['update'])) {
        $question = $_POST['question'];
        $good = $_POST['good'];
        $a = $_POST['a'];
        $b = $_POST['b'];
        $c = $_POST['c'];
        $d = $_POST['d'];

        if ($_POST['update'] == 'Dodaj') {
            $conn -> query("INSERT INTO `questions` (`id`, `question`, `answer`, `a`, `b`, `c`, `d`, `good`, `bad`) 
            VALUES (NULL, '$question', '$good', '$a', '$b', '$c', '$d', '0', '0')");

        } else {
            $id = $_POST['id'];
    
            $conn->query("UPDATE questions SET question = '$question', a = '$a', b = '$b', c = '$c', d = '$d', answer = '$good' WHERE id = '$id' ");
        }

    }





    $rs = $conn->query("SELECT * FROM questions");

    if ($rs->num_rows > 0) {
        echo '<div class="cont">';

        $ans = array('a', 'b', 'c', 'd');

        while ($rec = $rs->fetch_array()) {

            echo '
                    <form action="./questions.php" method="POST" class="box">
                        <div class="quest">
                            <textarea name="question" cols="30" rows="4">' . $rec['question'] . '</textarea>
                        </div>
                        <div class="answers">';

                        foreach ($ans as $let) {
                            if ($let == $rec['answer'])
                                echo '<label><input type="radio" name="good" value="'.$let.'" checked /> <input type="text" name="'.$let.'" value="' . $rec[$let] . '"></label>';
                            else 
                                echo '<label><input type="radio" name="good" value="'.$let.'" /> <input type="text" name="'.$let.'" value="' . $rec[$let] . '"></label>';
                        }
                        echo '</div>
                        <div class="bt">
                            <input type="hidden" name="id" value="' . $rec['id'] . '">
                            <input type="submit" value="Aktualizuj" name="update">
                        </div>
                    </form>
                ';
        }
        
        echo '<button onclick="dodajPytanie()" id="btAdd" >Dodaj Pytanie</button>';

        echo '</div>';
    }
    ?>

</body>

</html>
<!-- 
<div>
    <form action="./questions.php" method="POST" class="box">
        <div class="quest">
            ' . $rec['question'] . '
        </div>

        <div class="answers">
            <label><input type="radio" name="' . $rec['id'] . '" value="a" hidden checked /> <span>' . $rec['a'] . '</span></label>
            <label><input type="radio" name="' . $rec['id'] . '" value="b" hidden /> <span>' . $rec['b'] . '</span></label>
            <label><input type="radio" name="' . $rec['id'] . '" value="c" hidden /> <span>' . $rec['c'] . '</span></label>
            <label><input type="radio" name="' . $rec['id'] . '" value="d" hidden /> <span>' . $rec['d'] . '</span></label>
        </div>
    </form>
</div>
 -->


<!-- 
<form action="./questions.php" method="POST" class="box">
    <div class="quest">
        <textarea name="pyt" cols="30" rows="4"></textarea>
    </div>
    <div class="answers">
        <label><input type="radio" name="czesc3" checked /> <input type="text" name="a"></label>
        <label><input type="radio" name="czesc3" /> <input type="text" name="b"></label>
        <label><input type="radio" name="czesc3" /> <input type="text" name="c"></label>
        <label><input type="radio" name="czesc3" /> <input type="text" name="d"></label>
    </div>
    <div class="bt">
        <input type="submit" value="Aktualizuj" name="update">
    </div>
</form> 
-->