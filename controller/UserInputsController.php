<?php

class UserInputsController
{
    private $action;
    private $view;
    private $lisTypesData;
    private $productTypes;
    private $articleId;
    private $cart; // 29

    public function __construct()
    {
        $this->view = new JsonView();
    }

    public function route()
    {
        $db = new DatabaseService();
        $db->connect();
        // Session
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = array();
        }
        $shoppingCart = new ShoppingCartModel();
        if (isset($_GET['action'])) {
            $this->action = filter_input(INPUT_GET, "action", FILTER_SANITIZE_STRING);
            switch ($this->action) {
                case 'listTypes' :
                    $modelTypes = new StoreTypesModel();
                    $this->lisTypesData = $db->queryData("SELECT id, name FROM  product_types ORDER BY name");
                    $data = $modelTypes->fetchTypesData($this->lisTypesData);
                    $this->view->output($data);
                    break;
                case 'listProductsByTypeId' :
                    $typeId = filter_input(INPUT_GET, "typeId", FILTER_SANITIZE_STRING);
                    $modelProducts = new StoreProductsModel();
                    $statement = "SELECT t.name AS productTypeName, p.name AS articleName FROM product_types t JOIN products p ON t.id = p.id_product_types WHERE t.id =" . $typeId;
                    $data = $this->productTypes = $db->queryData($statement);
                    $resultData = $modelProducts->fetchProductsData($data);
                    $this->view->output($resultData);
                    break;
                case 'listCart' :
                    $arrayToShow['cart'] = $shoppingCart->listCart();
                    $this->view->output($arrayToShow);
                    break;
                case 'addArticle' :
                    $this->articleId = filter_input(INPUT_GET, "articleId", FILTER_SANITIZE_STRING);
                    $shoppingCart->addToCart($this->articleId);
                    $this->view->output($_SESSION);
                    break;
                case 'removeArticle' :
                    $this->articleId = filter_input(INPUT_GET, "articleId", FILTER_SANITIZE_STRING);
                    $shoppingCart->removeFromCart($this->articleId);
                    $this->view->output($_SESSION);
                    break;
                case 'articleNameById' : // TEST
                    $this->articleId = filter_input(INPUT_GET, "articleId", FILTER_SANITIZE_STRING);
                    print_r($shoppingCart->getArticleName($this->articleId)[0]['name']); // this grabs only at 0th position key:name's value , means just name as string format
                    break;
                default:
                    echo "choose your action";
            }
        }

    }


}
