<?php 
session_start();
include("../autoload.php");

$result= $ORDER->delete_order_admin($_POST["id_order"],$_POST["product_id"]);
echo $result;
?>