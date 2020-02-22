<?php 

session_start();
include("../autoload.php");
date_default_timezone_set("Asia/Bangkok");
if(isset($_POST['loadadmincheck'])){
    echo $INDEX->load_admin_order_check();

}elseif(isset($_POST['admin_check_summit'])){
    echo $INDEX->update_admin_check($_POST['admin_check_summit'],$_SESSION['UID']);
}elseif(isset($_POST['admin_cancel'])){
    echo $INDEX->cancel_order($_POST['admin_cancel']);
}else{
    echo $INDEX->loadindex_order_all(time());
}
 
?>