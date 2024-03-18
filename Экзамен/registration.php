<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Registration</title>
    <link rel="stylesheet" href="style.css"/>
</head>
<body>
<?php
    
    require('db.php');
    // When form submitted, insert values into the database.
    if (isset($_REQUEST['username'])) {
        // removes backslashes
        $username = stripslashes($_REQUEST['username']);
        //escapes special characters in a string
        $username = mysqli_real_escape_string($con, $username);
        $email    = stripslashes($_REQUEST['email']);
        $email    = mysqli_real_escape_string($con, $email);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($con, $password);
        $create_datetime = date("Y-m-d H:i:s");
        $query    = "INSERT into `users` (username, password, email, create_datetime)
                     VALUES ('$username', '" . md5($password) . "', '$email', '$create_datetime')";
        $result   = mysqli_query($con, $query);
        if ($result) {
            echo "<div class='form'>
                  <h3>Вы успешно зарегистрировались.</h3><br/>
                  <p class='link'>Нажмите здесь для<a href='index.php'> авторизации</a></p>
                  </div>";
        } else {
            echo "<div class='form'>
                  <h3>Обязательные поля отсутствуют.</h3><br/>
                  <p class='link'>Нажмите здесь для<a href='registration.php'> регистрации</a> снова.</p>
                  </div>";
        }
    } else {
?>
    <form class="form" action="" method="post">
        <h1 class="login-title">Регистрация</h1>
        <input type="text" class="login-input" name="username" placeholder="Фамилия" required />
        <input type="text" class="login-input" name="email" placeholder="E-mail">
        <input type="password" class="login-input" name="password" placeholder="Пароль">
        <input type="submit" name="submit" value="Регистрация" class="login-button">
        <p class="link"><a href="index.php">Нажмите для авторизации.</a></p>
    </form>
<?php
    }
?>
</body>
</html>