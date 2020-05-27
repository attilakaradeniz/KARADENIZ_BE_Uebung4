<?php
class JsonView{

    public function __construct()
    {
        header('Content-Type: application/json');
    }

    public function output($result){
        $jsonResult = json_encode($result);
        echo $jsonResult;
    }
}