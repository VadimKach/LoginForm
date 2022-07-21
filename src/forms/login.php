<?php
require '../classes/Validator.php';
require '../settings/constants.php';
    $data = $_POST;
    if( isset($data['do_login'])) {

        $loginValidator = new Validator($data['login'], $data['password']);
        $error = $loginValidator->validateLogin();
        if (!empty($error)) {
            echo '<div style="color: red;">' . array_shift($error) . '</div><hr>';
        }
        $error = $loginValidator->validatePassword();
        if (!empty($error)) {
            echo '<div style="color: red;">' . array_shift($error) . '</div><hr>';
        }

        $dbUpdater = new DBUpdater($data['login'], $data['password']);
    }
?>

<form action="login.php" method="POST">
    <p>
        <p><strong>Логин</strong>:</p>
        <input type="text" name="login" value="<?php echo @$data['login']; ?>">
    </p> 
    
    <p>
        <p><strong>Пароль</strong>:</p>
        <input type="password" name="password" value="<?php echo @$data['password']; ?>">
    </p> 
    
    <p>
        <button type="submit" name= "do_login">Войти</button>
    </p>    

</form>