<?php

class SignupValidator extends FormValidator
{
    private string $email;
    private string $name;

    public function __construct(string $iLogin, string $iPassword, string $iEmail, string $iName)
    {
        parent::__construct($iLogin, $iPassword);
        $this->email = $iEmail;
        $this->name = $iName;
    }

    public function validateEmail()
    {
        $error = $this->isEmpty($this->email);
        if (!empty($error)) {
            return $error . ' E-mail';
        } else {
//            if (!preg_match("/^(([a-zA-Z' -]{2,30})|([а-яА-ЯЁёІіЇїҐґЄє' -]{2,30}))$/u", $this->email))
//                $error = 'Неверный email';
        }
    }

    public function validateName()
    {
        $error = $this->isEmpty($this->name);
        if (!empty($error)) {
            return $error . ' Имя';
        } else {
            $error = $this->validateNameLen();
            if (!empty($error))
                return $error;
            $error = $this->validateNameChars();
            if (!empty($error))
                return $error;
        }
    }

    private function validateNameLen()
    {
        if (strlen($this->name) != 2)
            return 'Имя должено быть 2 симвлов';
    }

    private function validateNameChars()
    {
        if (!preg_match("/^(([a-zA-Z' -]{2,30})|([а-яА-ЯЁёІіЇїҐґЄє' -]{2,30}))$/u", $this->name))
             return 'Имя должно состоять только из букв';
    }
}