<?php

class DBUpdater
{
    // key fields for DB file
    private $login;
    private $password;
    // DB file name;
    private $fileName;
    private $jsonArray;


    public function __construct(string $iLogin, string $iPassword, string $inFileName)
    {
        $this->login = $iLogin;
        $this->password = $iPassword;
        $this->fileName = $inFileName;
        $this->readFile();
    }

    public function checkIsRecordExist()
    {
        foreach ($this->jsonArray as $key) {
            if ((strval($key->login) == strval($this->login)) && (strval($key->password) == strval($this->password)))
                return true;
            else
                return false;
        }
    }

    private function checkMode(string $iMode)
    {
        if ($iMode != ADD_RECORD || $iMode != MODIFY_RECORD || $iMode != DELETE_RECORD) {
            return array("Неверный режим работы с данными");
        } else {
            return array("");
        }
    }

    private function readFile()
    {
        if (file_exists($this->fileName)) {
            $json = file_get_contents($this->fileName);
            $this->jsonArray = json_decode($json, true);
        } else {
            $this->jsonArray = [];
        }
    }

}