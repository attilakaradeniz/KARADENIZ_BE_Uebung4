<?php

class StoreTypesModel
{

    //private $modelTypesArray = [];

   public function fetchTypesData($data){
        $tableData = [];
        foreach($data as $item){
             $tableData[] = array("productType"=>$item['name'],"url"=>$this->getUrl().$item['id']);

        }
        return $tableData;
    }
    private function getUrl(){
        return "http://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']."?action=listProductsByTypeId&typeId=";
    }

}