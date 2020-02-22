<?php 
session_start();
include("../autoload.php");
if(isset($_POST['selectid'] )){
    $arr=json_decode( $_POST['selectid'] );
    $_SESSION["edit_order"]=$arr;
    $_SESSION["edit_order_id"]= $_POST['id_edit'];
    echo(1);
}else if(isset($_POST["canncel_order"])){
    unset($_SESSION["edit_order"]);
    unset($_SESSION["edit_order_id"]);
    echo (1);
}else if(isset($_POST["submit_order"]))
{
    $order =$_SESSION["edit_order"];
    $array = json_decode(json_encode($order),true);
     
     $result= $ORDER->order_edit($_SESSION["edit_order_id"],$array);
     if($result =="1"){
        unset($_SESSION["edit_order"]);
        unset($_SESSION["edit_order_id"]);
     }
}
?>
