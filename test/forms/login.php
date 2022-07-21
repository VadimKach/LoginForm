<?php
    require "db.php";
    $data = $_POST;
    if( isset($data['do_login']))
    {
        $errors = array();
        $user = R::findOne('users2', 'login = ?', array($data['login']));

        if($user)
        {
           

           
            if( password_verify($data['password'], $user->password)) 
            {
                $_SESSION['logged_user'] = $user;
                echo '<div style="color: green;">Вы успешно авторизованы!<br/>Можете перейти на <a href="/">главную</a> страницу</div><hr>';
            }
            else
            {               
               $errors[] = 'Пароль неверно введен!';
            }
        }
        else
        {
            $errors[] = 'Пользователь с таким логин не найден!';
        }

        if( ! empty($errors))
        {
            echo '<div style="color: red;">'.array_shift($errors).'</div><hr>';
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
        <button type="submit" name= "do_login">Войти</button>

    </p>    

</form>