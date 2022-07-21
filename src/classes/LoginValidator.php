<?php

class LoginValidator extends FormValidator
{
    private string $login;
    private string $password;


    public function __construct(string $iLogin, string $iPassword)
    {
        $this->login = $iLogin;
        $this->password = $iPassword;
    }

    public function validateLogin()
    {
        $error = $this->isEmpty($this->login);
        if (!empty($error)) {
            $loginLen = strlen($this->login);
            if ($loginLen < 6)
                $error = array("Логин должен быть не менее 6-ти симвлов");
            else
                $error = array();
        }
        return $error;
    }

    public function validatePassword()
    {
        $error = $this->isEmpty($this->password);
        if (!empty($error)) {
            $error = $this->validatePaswordLen();
            if (!empty($error))
                return $error;
            $error = $this->validatePaswordChars();
            if (!empty($error))
                return $error;
        }
        return $error;
    }

    private function validatePaswordLen()
    {
        if (strlen($this->password) < 6)
            $error = array("Пароль должен быть не менее 6-ти симвлов");
        else
            $error = array();
        return $error;
    }

    protected function isEmpty(string $field)
    {
        if (empty(trim($field)))
            return array("Введите");

    }

    private function validatePaswordChars()
    {
        if (preg_match("/^(([a-zA-Z' -])|([а-яА-ЯЁёІіЇїҐґЄє' -])| [0-9])$/u"($this->password)))
             $error = array("Пароль должен состоять только из букв и цифр");
        else
             $error = array();
        return $error;
//        return $error;
    }

}