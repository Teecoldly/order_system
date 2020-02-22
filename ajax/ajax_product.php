<?php 
include("../autoload.php");
if(isset($_POST["product_type_add"])){
   echo $PRODUCT->product_type_add($_POST["product_type_add"]);
}
else if(isset($_POST["product_type_edit"])){
    echo $PRODUCT->product_type_edit($_POST["product_type_edit"],$_POST["product_edit"]);
}
else if(isset($_POST["delete_id"])){
    echo $PRODUCT->product_type_delete($_POST["delete_id"]);
}
else if(isset($_POST["product_add_new"])){
    echo $PRODUCT->product_add($_POST["product_add_new"],$_POST["product_name"],$_POST["price"],$_POST["unit_type"],$_POST["type_ids"]);
}
else if(isset($_POST["loadproduct"])){
     $PRODUCT->product_load();
     echo $PRODUCT->getjson();
}
else if(isset($_POST["Edit_id"])){
    echo $PRODUCT->product_edit($_POST["Edit_id"],$_POST["product_key"],$_POST["product_name"],$_POST["price"],$_POST["unit_type"],$_POST["product_type"]);
}
else if(isset($_POST["product_delete"])){
    echo $PRODUCT->product_delete($_POST["product_delete"]);
}
else{
    $PRODUCT->product_type_load();
    echo $PRODUCT->getjson();
}
?>