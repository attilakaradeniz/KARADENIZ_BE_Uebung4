<?php

class UserInputsController{
    private $action;
    private $view;
    private $lisTypesData;
    private $productTypes;

    public function __construct()
    {
        $this->view = new JsonView();
    }

    public function route(){
        $db = new DatabaseService();
        $db->connect();

        if(isset($_GET['action'])){
            $this->action = $_GET['action'];

            switch ($this->action) {
                case 'listTypes' :
                    $modelTypes = new StoreTypesModel();
                    $this->lisTypesData = $db->queryData("SELECT id, name FROM  product_types ORDER BY name");
                    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//                    //$modelTypes->tableData($this->lisTypesData);
//                    echo "\n";
//                    echo "\n";
//                    //print_r($this->lisTypesData);  // TEST to see the data
//                    $bosArray = array();
//                foreach($this->lisTypesData as $item){
//                    $bosArray[] = $item;
//                    print_r($item);
//                    echo '<pre>';
//                }
//
//                    $testToSee = array( 'product' => 'cream', 'tip' => 'vicik', 'price' => 'coookcok');
//                    $JSON_testToSee = json_encode($testToSee);
//                    $testToSee = "[".$testToSee."]";
//
//                    $this->view->output($testToSee);
//
//                    //$this->view->output($JSON_testToSee);
//
//                    //print_r($testToSee);
//                    //echo $testToSee;
//
//                    echo "\n";
//                    echo "\n";
                    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                    $data = $modelTypes->fetchTypesData($this->lisTypesData);
                    $this->view->output($data);

                     //print_r($modelTypes->fetchTypesData($this->lisTypesData)); // TEST

                    break;

                case 'listProductsByTypeId' :

                    $typeId = filter_input(INPUT_GET, "typeId", FILTER_SANITIZE_STRING);
                    $modelProducts = new StoreProductsModel();
                    $statement = "SELECT t.name AS productTypeName, p.name AS productName FROM product_types t JOIN products p ON t.id = p.id_product_types WHERE t.id =".$typeId;
                    $data = $this->productTypes = $db->queryData($statement);
                    $resultData = $modelProducts->fetchProductsData($data);
                    $this->view->output($resultData);

                    break;

                case 'listCart' :
                    echo 'you have chosen listCart'; // TEST

                    break;

                case 'addArticle' :
                    echo 'you have chosen addArticle'; // TEST

                    break;

                case 'removeArticle' :
                    echo 'you have chosen removeArticle'; // TEST

                    break;

                default: echo "choose your action";
            }
        }

    }





}
