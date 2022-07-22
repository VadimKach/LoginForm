<?php
require '../classes/Handler.php';
require '../classes/FormValidator.php';
require '../classes/SignupValidator.php';
require '../classes/DBUpdater.php';
require '../settings/constants.php';

$data = $_POST;
if (isset($data['do_signup'])) {

    $Validator = new SignupValidator($data['login'], $data['password'], $data['email'], $data['name']);

    $error = $Validator->validateName();
    if (!empty($error))
        Handler::printError($error);
    $error = $Validator->validateLogin();
    if (!empty($error))
        Handler::printError($error);
    $error = $Validator->validateEmail();
    if (!empty($error))
        Handler::printError($error);

    if (($data['password_2']) != $data['password'])
        $error = "Повторный пароль введен неверно";
    else
        $error = $Validator->validatePassword();

    if (!empty($error))
        Handler::printError($error);

    $fileName = "LoginUsers.json";
    if (empty($error)) {
        $db = new DBUpdater($fileName);
        if (!$db->checkIfRecordExist($data['login'], $data['email'])) {
            $db->workWithData($data,ADD_RECORD);
        } else {
            $db->workWithData($data,MODIFY_RECORD);
        }
    }
}
?>

<form action="signup.php" method="POST">
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