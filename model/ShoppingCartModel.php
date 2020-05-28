<?php

class ShoppingCartModel
{
    private $shoppingCart;
    private $productsArray;
    private $productsDB;
    private $amount;
    private $statementProducts;
    private $articleId;

    public  function __construct()
    {

        $this->productsDB = new DatabaseService();
        $this->productsDB->connect();
        $this->statementProducts =
        $this->productsDB->queryData();



    }


    /**
 * @return mixed
 */
    public function getShoppingCart()
    {
        $_SESSION['shoppingCart'] = $this->shoppingCart;
        return $this->shoppingCart;
    }



    public function addToCart(){

        // Session
        if (!isset($_SESSION['shoppingCart'])) {
            $_SESSION['shoppingCart'] = array();
        }
//        $shoppingCart = ['shoppingCart' =>  $_SESSION['shoppingCart']];

        $_SESSION['shoppingCart'][] = $this->shoppingCart;
    }



    public function removeFromCart(){

    }


    public function listCart(){

    }

    public function testProduct(){

    }

    public function fetchProductData($data){
        $product = [];
    }


}