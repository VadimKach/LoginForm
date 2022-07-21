<?php

abstract class FormValidator
{
    private string $login, $password;

    public abstract function isEmpty();
    public abstract function validateLogin();
    public abstract function validatePassword();
}