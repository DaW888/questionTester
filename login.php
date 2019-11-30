<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="author" content="Dawid Wajda">
    <meta name="description" content="3ic2">
    <title>Strona Głowna</title>
</head>

<body>
    <form action="./checkLogin.php" method="post">
        <input type="text" name="name" placeholder="Podaj nazwe użytkownika" minlength="3" required>
        <input type="password" name="pass" placeholder="Podaj hasło" minlength="6" required>
        <input type="submit" value="Submit">
    </form>
</body>

</html>