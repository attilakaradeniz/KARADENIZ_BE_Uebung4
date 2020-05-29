<?php

class ShoppingCartModel
{
    //private $shoppingCartArray;
    private $articleName;
    private $currentCart; // 29

    public function getArticleName($id)
    {
        $statement = "SELECT name FROM products WHERE id = $id";
        $db = new DatabaseService();
        $db->connect();

        return $this->articleName = $db->queryData($statement);
    }

    public function addToCart($id)
    {

        if ($this->isInCart($id)) {
            foreach ($_SESSION['cart'] as $item) {
                if ($item->id == $id) {
                    $item->amount++;
                }
            }
        } else {

            $statement = "SELECT name, id, price_of_sale as price FROM products WHERE id=" . $id;
            $db = new DatabaseService();
            $db->connect();
            $data = $db->queryData($statement);
            //print_r($data);
            //$temp = $this->getProductName($id)[0]['name'];

            $article = new stdClass();

            $article->articleName = $data[0]['name'];
            $article->id = $data[0]['id'];
            //$article->price = $data[0]['price'];
            $article->amount = 1;
            $article->state = "OK";

            //print_r($article);

            $_SESSION['cart'][] = $article;
            //$_SESSION['cart'] = array_values($this->currentCart);



        }
    }

    public function isInCart($id)
    {
        $this->currentCart = $_SESSION['cart']; // +29
        //foreach ($currentCart as $item) { // -29
            foreach ($this->currentCart as $item) { // +29

            if ($item->id == $id) {
                return true;
            }
        }
        return false;
    }

    public function removeFromCart($id)
    {
        $this->currentCart = $_SESSION['cart']; // +29

        if ($this->isInCart($id)) {
                foreach ($this->currentCart as $item) { // +29
                if ($item->id == $id) {
                    $item->amount--;
                }
            }
        }

        $this->currentCart = $this->removeEmptyArticles($id, $this->currentCart); // +29
        $_SESSION['cart'] = array_values($this->currentCart);
    }

    public function removeEmptyArticles($id, $currentCart) // +29
    {
            foreach ($this->currentCart as $item => $object) { // +29
            if ($object->amount == 0) {
                unset($this->currentCart[$item]); // +29
            }
        }
        return $this->currentCart; // +29
    }

    public function listCart()
    {
        $currentCart = $_SESSION['cart'];
        //$currentCart = $_SESSION;

        $arrayToShow = array();

        foreach ($currentCart as $item) {

            $showCart = new stdClass();
            $showCart->articleName = $item->articleName;
            $showCart->amount = $item->amount;
            //$showCart->state = "OK";

            $arrayToShow[] = $showCart;

        }
        return $arrayToShow;


    }

    public function testProduct()
    {

    }

    public function fetchProductData($data)
    {
        $product = [];
    }

}