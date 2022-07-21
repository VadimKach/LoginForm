<?php

abstract class FormValidator
{
    private string $login, $password;

    protected abstract function isEmpty(string $field);
    public abstract function validateLogin();
    public abstract function validatePassword();
}