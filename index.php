<?php
session_start();
include "config/config.php";

$inputController = new UserInputsController();
$inputController->route();




