<?php
require '../classes/LoginValidator.php';
require '../classes/DBUpdater.php';
require '../settings/constants.php';

$fileName = "LoginUsers.json";
$data = $_POST;

if (isset($data['do_login'])) {

    $Validator = new LoginValidator($data['login'], $data['password']);
    $error = $Validator->validateLogin();
    $error = $Validator->validatePassword();

    $dbData = new DBUpdater($fileName);
    if (!$dbData->checkIsRecordExist($data['login'], BLANK))
        $error = array("Пользователь с таким логином не найден!");

    if (!empty($error)) {
        echo '<div style="color: red;">' . array_shift($error) . '</div><hr>';
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