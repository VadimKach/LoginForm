<?php

class Validator
{
    private $login;
    private $password;


    public function __construct(String $iLogin, String $iPassword)
    {
        $this->login = $iLogin;
        $this->password = $iPassword;
    }

    public function validateLogin()
    {
        $loginLen = strlen($this->login);
        if ( $loginLen < 6) {
            $error = array("Логин должен быть не менее 6-ти симвлов");
        }else {
            $error = array();
        }
        return $error;
    }

    public function validatePassword()
    {
        $error = $this->validatePaswordLen();
        if (!empty($error)) {
            return $error;
        }
        $error = $this->validatePaswordChars();
        if (!empty($error)) {
            return $error;
        }
    }

    private function validatePaswordLen() {
        if (strlen($this->password) < 6) {
            $error = array("Пароль должен быть не менее 6-ти симвлов");
        } else {
            $error = array();
        }
        return $error;
    }

    private function validatePaswordChars() {
//        return $error;
    }

}