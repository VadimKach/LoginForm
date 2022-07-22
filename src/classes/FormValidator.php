<?php

abstract class FormValidator
{
    private string $login, $password;

    public function __construct(string $iLogin, string $iPassword)
    {
        $this->login = $iLogin;
        $this->password = $iPassword;
    }

    public function validateLogin()
    {
        $error = $this->isEmpty($this->login);
        if (!empty($error)) {
            $error .= ' Логин';
        } else {
            $loginLen = strlen($this->login);
            if ($loginLen < 6)
                $error = 'Логин должен быть не менее 6-ти симвлов';
        }
        return $error;
    }

    public function validatePassword()
    {
        $error = $this->isEmpty($this->password);
        if (!empty($error)) {
            $error .= ' Пароль';
        } else {
            $error = $this->validatePaswordLen();
            if (!empty($error))
                return $error;
            $error = $this->validatePaswordChars();
            if (!empty($error))
                return $error;
        }
        return $error;
    }

    protected function isEmpty(string $field)
    {
        if (empty(trim($field)))
            return 'Введите';

    }

    protected function validatePaswordLen()
    {
        if (strlen($this->password) < 6)
            return 'Пароль должен быть не менее 6-ти симвлов';
    }

    protected function validatePaswordChars()
    {
        if (preg_match("/^(([a-zA-Z' -])|([а-яА-ЯЁёІіЇїҐґЄє' -])| [0-9])$/u", ($this->password)))
            return 'Пароль должен состоять только из букв и цифр';
    }
}