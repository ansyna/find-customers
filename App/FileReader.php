<?php

namespace App;


class FileReader
{
    /**
     * @string
     */
    private $filePath;

    /**
     * @param $filePath
     */
    function __construct($filePath)
    {
        $this->filePath = $filePath;
    }

    /**
     * @return array
     */
    public function loadDataFromFile()
    {
        $data = [];

        if (!empty($this->filePath)) {
            $record = file($this->filePath);

            foreach ($record as $key => $value) {
                $data[] = json_decode($value, true);
            }
        } else {
            trigger_error("File is empty", E_USER_ERROR);
        }

        return $data;
    }
}