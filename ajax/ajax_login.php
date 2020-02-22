<?php 
session_start();
include_once("../autoload.php");
if(isset($_POST['username'])&& isset($_POST['password'])){
    $username =$_POST['username'];
    $password = $_POST['password'];
    $result=$LOGIN->login($username,$password);

    if($result==0){
        echo $result;
    }else{
        if ($LOGIN->get("permission")==1){
            $_SESSION["UID"] = $LOGIN->get("personnel_id");
            $_SESSION["name"] = $LOGIN->get("name");
            $_SESSION["lastname"] = $LOGIN->get("lastname");
            $_SESSION["status_user"]= $LOGIN->get("type_ID");
            echo "success";
        }else{
            echo "Not_allown";
        }
        
        
    }
     
}
 
?>