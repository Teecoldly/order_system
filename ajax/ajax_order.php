<?php 

session_start();
include("../autoload.php");
if(isset($_POST["canncel_order"])){
    unset($_SESSION["teach_id"]);
    unset($_SESSION["order"]);
    echo (1);
}else if(isset($_POST["submit_order"]))
{
    $order =$_SESSION["order"];
    $array = json_decode(json_encode($order),true);
     
     $result= $ORDER->order_add($_SESSION["teach_id"],$array);
     if($result =="1"){
        unset($_SESSION["teach_id"]);
        unset($_SESSION["order"]);
     }
     
     

}else{
    $arr=json_decode( $_POST['selectid'] );
    $_SESSION["order"]=$arr;
    echo(1);
}
 

?>