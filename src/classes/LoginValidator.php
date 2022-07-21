<?php

class LoginValidator extends FormValidator
{
    public function __construct(string $iLogin, string $iPassword)
    {
        parent::__construct($iLogin, $iPassword);
    }
}