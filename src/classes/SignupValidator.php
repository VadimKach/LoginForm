<?php

class SignupValidator extends FromValidator
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
            if (!preg_match("/^(([a-zA-Z' -]{2,30})|([а-яА-ЯЁёІіЇїҐґЄє' -]{2,30}))$/u", $this->email))
                return array("Неверный email");
        }
        return $error;
    }

    public function validateName()
    {
        $error = $this->isEmpty($this->name);
        if (!empty($error)) {
            $error = $this->validateNameLen();
            if (!empty($error))
                return $error;
            $error = $this->validateNameChars();
            if (!empty($error))
                return $error;
        }
        return $error;
    }

    private function validateNameLen()
    {
        if (strlen($this->name) != 2)
            $error = array("Имя должено быть 2 симвлов");
        else
            $error = array();
        return $error;
    }

    private function validateNameChars()
    {
        if (preg_match("/^(([a-zA-Z' -])|([а-яА-ЯЁёІіЇїҐґЄє' -]))$/u", $this->name)))
             $error = array("Имя должно состоять только из букв");
        else
             $error = array();
        return $error;
    }
}