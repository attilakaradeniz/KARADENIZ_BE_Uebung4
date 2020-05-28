<?php

class UserInputsController
{
    private $action;
    private $view;
    private $lisTypesData;
    private $productTypes;
    private $articleId;

    public function __construct()
    {
        $this->view = new JsonView();
    }

    public function route()
    {
        $db = new DatabaseService();
        $db->connect();

        // Session
        if (!isset($_SESSION['shoppingCart'])) {
            $_SESSION['shoppingCart'] = array();
        }

        $shoppingCart = new ShoppingCartModel();


        //$shoppingCart = ['shoppingCart' =>  $_SESSION['shoppingCart']];

        if (isset($_GET['action'])) {
            //$this->action = $_GET['action'];

            $this->action = filter_input(INPUT_GET, "action", FILTER_SANITIZE_STRING);

            switch ($this->action) {
                case 'listTypes' :
                    $modelTypes = new StoreTypesModel();
                    $this->lisTypesData = $db->queryData("SELECT id, name FROM  product_types ORDER BY name");
                    ///////////////////////
                    $data = $modelTypes->fetchTypesData($this->lisTypesData);
                    $this->view->output($data);

                    //print_r($modelTypes->fetchTypesData($this->lisTypesData)); // TEST

                    break;

                case 'listProductsByTypeId' :

                    $typeId = filter_input(INPUT_GET, "typeId", FILTER_SANITIZE_STRING);
                    $modelProducts = new StoreProductsModel();
                    $statement = "SELECT t.name AS productTypeName, p.name AS productName FROM product_types t JOIN products p ON t.id = p.id_product_types WHERE t.id =" . $typeId;
                    $data = $this->productTypes = $db->queryData($statement);
                    $resultData = $modelProducts->fetchProductsData($data);
                    $this->view->output($resultData);

                    break;

                case 'listCart' :
                    // echo 'you have chosen listCart'; // TEST
                    $this->view->output($_SESSION);
                    break;

                case 'addArticle' :
                    // echo 'you have chosen addArticle'; // TEST
                    $this->articleId = filter_input(INPUT_GET, "articleId", FILTER_SANITIZE_STRING);
                    //$statement = "SELECT * FROM products WHERE id=119;"; // TEST
                    // array_push($_SESSION['shoppingCart'], ['articleName' => $data, 'amount' => 1]);

                    $shoppingCart->addToCart($this->articleId);
                    $this->view->output($_SESSION);
                    //$this->view->output($data);
                    //print_r($_SESSION['shoppingCart']);
                    // session_destroy(); // ------------------------------------------- IF ANYTHING GOES WRONG USE THIS ------------------------------------ /
                    // -------------------------------------------------------------------DONT FORGET TO DISABLE --------------------------------------------/
                    break;

                case 'removeArticle' :
                    // echo 'you have chosen removeArticle'; // TEST
                    //print_r($shoppingCart->getProductName(119)); // TEST
                    $this->articleId = filter_input(INPUT_GET, "articleId", FILTER_SANITIZE_STRING);

                    $shoppingCart->removeFromCart($this->articleId);

                    break;

                case 'articleNameById' : // TEST
                    $this->articleId = filter_input(INPUT_GET, "articleId", FILTER_SANITIZE_STRING);
                    //print_r($shoppingCart->getProductName($this->articleId));
                    //$this->view->output($shoppingCart->getProductName($this->articleId)); // This brings it as json format
                    //print_r($shoppingCart->getProductName($this->articleId)); // this brings it as array format
                    print_r($shoppingCart->getProductName($this->articleId)[0]['name']); // this grabs only at 0th position key:name's value , means just name as string format
                    break;

                default:
                    echo "choose your action";
            }
        }

    }


}
