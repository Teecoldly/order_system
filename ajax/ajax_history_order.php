<?php 

session_start();
include("../autoload.php");
if(isset($_POST["delete_order"])){
    echo $ORDER->delete_order($_POST["delete_order"]);
}elseif(isset($_POST["load_histroy_order"])){
    echo $ORDER->load_order_by_orderid($_POST["load_histroy_order"]);
}
else{
    echo $ORDER->load_order_history($_SESSION["UID"]);
}
 

?>