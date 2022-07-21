<?php

class DBUpdater
{
    private $jsonArray;
    private string $fileName;

    public function __constructor(string $inFileName)
    {
        $this->fileName = $inFileName;
        $this->readFile();
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

    public function checkIsRecordExist(string $login, string $email)
    {
        $isFound = false;
        if (!empty($this->jsonArray)) {
            if (strval($email) != strval(BLANK)) {
                foreach ($this->jsonArray as $key) {
                    if ((strval($key->login) == strval($login)) && (strval($key->email) == strval($email)))
                        $isFound = true;
                }
            } else {
                foreach ($this->jsonArray as $key) {
                    if (strval($key->login) == strval($login))
                        $isFound = true;
                }
            }
        }
        return $isFound;
    }

    private function checkMode(string $iMode)
    {
        if (strval($iMode) != strval(ADD_RECORD) || strval($iMode) != strval(MODIFY_RECORD) || strval($iMode) != strval(DELETE_RECORD)) {
            return array("Неверный режим работы с данными");
        } else {
            return array("");
        }
    }


}