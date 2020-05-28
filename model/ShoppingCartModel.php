<?php

class ShoppingCartModel
{
    //private $shoppingCartArray;
    private $productName;

//    public function getShoppingCart()
//    {
//        $_SESSION['shoppingCart'] = $this->shoppingCartArray;
//        return $this->shoppingCartArray;
//    }


    public function getProductName($id)
    {
        $statement = "SELECT name FROM products WHERE id = $id";
        $db = new DatabaseService();
        $db->connect();

        return $this->productName = $db->queryData($statement);

        //$this->productName = $db->queryData($statement)[0]['name'];
    }

    public function addToCart($id)
    {
        $currentCart = $_SESSION['shoppingCart'];

        if ($this->isInCart($id)){
            foreach ($_SESSION['shoppingCart'] as $item) {
                if($item->id == $id){

                    $item->amount++;
                }

            }
        }
        else {

            $statement = "SELECT name, id, price_of_sale as price FROM products WHERE id=" . $id;
            $db = new DatabaseService();
            $db->connect();
            $data = $db->queryData($statement);
            //print_r($data);
            //$temp = $this->getProductName($id)[0]['name'];

            $article = new stdClass();

            $article->productName = $data[0]['name'];
            $article->id = $data[0]['id'];
            $article->price = $data[0]['price'];

            $article->amount = 1;

            print_r($article);

            $_SESSION['shoppingCart'][] = $article;

            //$_SESSION['shoppingCart'][] = ['articleName' => $temp, 'amount' => 1];


        }


        //$_SESSION['shoppingCart'][] = $data;



        //$_SESSION['shoppingCart'][] = ['articleName' => $this->productName[0]["name"]];





//        if($_SESSION['shoppingCart'] == ''){
//
//        }
//        foreach ($_SESSION['shoppingCart'] as $key => $value) {
//
//
//
//             if($value["articleName"] == $temp && $value['amount'] == 1){
//                $amountPlus = $value["amount"] + 1;
//                $_SESSION['shoppingCart'][$key]["amount"] = $amountPlus;
//            }
//
//
//
//        }


        //array_push($_SESSION['shoppingCart'], ["articleName" => $this->productName[0]['name']]);
        //$shoppingCartArray = ['shoppingCart' => $_SESSION['shoppingCart']];

        //$_SESSION['shoppingCart'][] = $this->shoppingCartArray;
    }


    public function isInCart($id)
    {
        $currentCart = $_SESSION['shoppingCart'];
        foreach ($currentCart as $item) {

            if($item->id == $id){
                return true;
            }

        }

        return false;

    }


    public function removeFromCart($id)
    {
        $currentCart = $_SESSION['shoppingCart'];

     if($this->isInCart($id)){
        foreach ($currentCart as $item) {
          if($item->id == $id){
              $item->amount--;

          }

        }
     }

     $currentCart = $this->removeEmptyArticles($id, $currentCart);
     $_SESSION['shoppingCart'] = $currentCart;

    }

    public function removeEmptyArticles($id, $currentCart){
        //$currentCart = $_SESSION['shoppingCart'];

        foreach ($currentCart as $item => $object) {
            if($object->amount == 0){
                unset($currentCart[$item]);

            }

        }

        return $currentCart;

    }







    public function listCart()
    {

    }

    public function testProduct()
    {

    }

    public function fetchProductData($data)
    {
        $product = [];
    }


}