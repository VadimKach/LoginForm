 <?php if( isset($_SESSION['logged_user'])) : ?>
    Авторизован!<br>
    Привет, <?php echo $_SESSION['logged_user']->login; ?>
    <hr>
    <a href="/logout.php">Выйти</a>
<?php else : ?>        
    <a href="forms/login.php">Авторизация</a><br>
    <a href="forms/signup.php">Регистрация</a>
<?php endif; ?>