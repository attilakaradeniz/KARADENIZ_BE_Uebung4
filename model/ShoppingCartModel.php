<?php

class ShoppingCartModel
{
    private $shoppingCart;
    private $productsArray;


     /**
 * @return mixed
 */
    public function getShoppingCart()
    {
        $_SESSION['shoppingCart'] = $this->shoppingCart;
        return $this->shoppingCart;
    }



    public function addToCart(){

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