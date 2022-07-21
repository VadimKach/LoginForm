<?php

class DBUpdater
{
    // key fields for DB file
    private $login;
    private $password;
    //
    // data by input key
    private $data;


    public function __construct(string $iLogin, string $iPassword)
    {
        $this->login = $iLogin;
        $this->password = $iPassword;
    }

    public function isRecordExist() {

    }

    private function checkMode(String $iMode) {
        if ($iMode != ADD_RECORD || $iMode != MODIFY_RECORD || $iMode != DELETE_RECORD) {
            return array("Неверный режим работы с данными");
        } else {
            return array("");
        }
    }

}