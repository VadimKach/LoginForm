<?php
    require "db.php";

    $data = $_POST;
    if(isset($data['do_signup']))
    {

        $errors = array();

        if( trim($data['name']) == '')
        {
            $errors[] = 'Введите имя';
        }

        if(!preg_match("/^(([a-zA-Z' -]{2,30})|([а-яА-ЯЁёІіЇїҐґЄє' -]{2,30}))$/u", $data['name']))
        {
            $errors[] = 'Имя должно быть не менее двух символов';
        }

        if( trim($data['login']) == '')
        {
            $errors[] = 'Введите логин';
        }

        if( trim($data['email']) == '')
        {
            $errors[] = 'Введите Email';
        }

        if( ($data['password']) == '')
        {
            $errors[] = 'Введите пароль';
        }

        if(!isset($data['password'][5]) or isset($data['password'][25]))
        {
            $errors[] = 'Ваш пароль должен состоять не менее чем из 6 символов';
         }
       
           

         

        if( ($data['password_2']) != $data['password'])
        {
            $errors[] = 'Повторый пароль введен неверно';
        }

        if ( R::count('users2', "login = ?", array($data['login'],)) > 0)
        {
            $errors[] = 'Пользователь с таким логином уже сущетвует';
        }

        if ( R::count('users2', "email = ?", array($data['email'])) > 0)
        {
            $errors[] = 'Пользователь с таким Email уже сущетвует';
        }

        

        if( empty($errors))
        {
            $user = R::dispense('users2');
            $user -> name = $data['name'];
            $user -> login = $data['login'];
            $user -> email = $data['email'];
          
            $user -> password = password_hash($data['password'], PASSWORD_DEFAULT);            
            R:: store($user);
            echo '<div style="color: green;">Вы успешно зарегестрированы</div><hr>';

        } else
        {
            echo'<div style="color: red;">'.array_shift($errors).'</div><hr>';
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
        <button type="submit" name= "do_signup">Зарегистрироваться</button>

    </p>    
