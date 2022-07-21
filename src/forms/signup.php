<?php
require '../classes/SignupValidator.php';
require '../classes/DBUpdater.php';
require '../settings/constants.php';

$data = $_POST;
if (isset($data['do_signup'])) {

    $Validator = new SignupValidator($data['login'], $data['password'], $data['email'], $data['name']);
    $error = $Validator->validateLogin();

    if (($data['password_2']) != $data['password'])
        $error = array("Повторый пароль введен неверно");
    else
        $error = $Validator->validatePassword();

    $error = $Validator->validateEmail();
    $error = $Validator->validateName();

    if (!empty($error)) {
        echo '<div style="color: red;">' . array_shift($error) . '</div><hr>';
    }
}
?>

<form action="/signup.php" method="POST">

    <p>
    <p><strong>Ваше имя</strong>:</p>
    <input type="text" name="name" value="<?php echo @$data['name']; ?>">
    </p>

    <p>
    <p><strong>Ваш логин</strong>:</p>
    <input type="text" name="login" value="<?php echo @$data['login']; ?>">
    </p>

    <p>
    <p><strong>Ваш Email</strong>:</p>
    <input type="email" name="email" value="<?php echo @$data['email']; ?>">
    </p>

    <p>
    <p><strong>Ваш пароль</strong>:</p>
    <input type="password" name="password" value="<?php echo @$data['password']; ?>">
    </p>

    <p>
    <p><strong>Введите ваш пароль еще раз</strong>:</p>
    <input type="password" name="password_2">
    </p>

    <p>
        <button type="submit" name="do_signup">Зарегистрироваться</button>

    </p>
</form>>