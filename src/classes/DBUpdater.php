<?php

class DBUpdater
{
    private string $fileName;

    public function __constructor(string $inFileName)
    {
        $this->fileName = $inFileName;
    }


    public function checkIfRecordExist(string $login, string $email)
    {
        $isFound = false;
        $jsonArray = $this->readFile();
        if (!empty($jsonArray)) {
            if (strval($email) != strval(BLANK)) {
                foreach ($jsonArray as $key) {
                    if ((strval($key->login) == strval($login)) && (strval($key->email) == strval($email)))
                        $isFound = true;
                }
            } else {
                foreach ($jsonArray as $key) {
                    if (strval($key->login) == strval($login))
                        $isFound = true;
                }
            }
        }
        return $isFound;
    }

    public function workWithData(array $data, string $mode)
    {
        switch ($mode) {
            case ADD_RECORD;
                $error = $this->addRecord($data);
                break;

            case MODIFY_RECORD;
                $error = $this->modifyRecord($data);
                break;

            case DELETE_RECORD;
                $error = $this->deleteRecord($data['login'], $data['email']);
                break;

            default:
                $error = "Неверный режим работы с файлом";
        }
        return $error;

    }

    private function addRecord(array $data)
    {
        $jsonArray = json_encode($data);
        file_put_contents($this->fileName, $jsonArray, JSON_FORCE_OBJECT);
    }

    private function modifyRecord(array $data)
    {
        $jsonArray = json_encode($data);
        file_put_contents($this->fileName, $jsonArray, JSON_FORCE_OBJECT);
    }

    private function deleteRecord(string $login, string $email)
    {

//        file_put_contents($this->fileName, $jsonArray, JSON_FORCE_OBJECT);
    }

    private function readFile()
    {
        if (file_exists($this->fileName)) {
            $json = file_get_contents($this->fileName);
            return json_decode($json, true);
        }
    }
}