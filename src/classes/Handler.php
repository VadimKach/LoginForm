<?php

class Handler
{
    public static function printError(string $error)
    {
        $arrError = array($error);
        echo '<div style="color: red;">' . array_shift($arrError) . '</div><hr>';
    }
}