<?php
require '../classes/Handler.php';
require '../classes/FormValidator.php';
require '../classes/LoginValidator.php';
require '../classes/DBUpdater.php';
require '../settings/constants.php';

$data = $_POST;

if (isset($data['do_login'])) {

    $Validator = new LoginValidator($data['login'], $data['password']);
    $error = $Validator->validateLogin();
    if (!empty($error))
        Handler::printError($error);
    $error = $Validator->validatePassword();
    if (!empty($error))
        Handler::printError($error);

    $fileName = "LoginUsers.json";
    if (empty($error)) {
        $db = new DBUpdater($fileName);
        if (!$db->checkIfRecordExist($data['login'], BLANK)) {
            $error = 'Пользователь с таким логином не найден!';
            Handler::printError($error);
        }
    }
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
        <button type="submit" name="do_login">Войти</button>
    </p>
</form>