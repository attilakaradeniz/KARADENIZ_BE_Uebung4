<?php

class StoreProductsModel
{

    //private $modelProductsArray = [];

    public function fetchProductsData($data)
    {
        // print_r($data);
        $products = [];

        foreach ($data as $item) {
            $products[] = array("name" => $item['productName']);
        }

        $result = new stdClass();

        if ($data != null) {
            $productType = $data[0]['productTypeName'];
            $result->productType = $productType;
        } else {
            $result->productType = "No products in this category";
        }

        $result->products = $products;
        $result->url = $this->getUrl();
        return $result;
    }

    private function getUrl()
    {
        return "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'] . "?action=listTypes";
    }

}
