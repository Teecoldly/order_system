<?php 
include("../autoload.php");
if(isset($_POST['ID'])){
    $PERSONNEL->loadpersonnel_id($_POST['ID']);
    echo $PERSONNEL->getjson();
}else if(isset($_POST['delete_id'])){
    echo $PERSONNEL->delete_id($_POST['delete_id']);
    
}else if(isset($_POST['update_id'])){
    return $PERSONNEL-> personnel_update($_POST['update_id'],$_POST['id_card'],$_POST['name'],$_POST['Lastname'],$_POST['username'],$_POST['password'],$_POST['phone'],$_POST['type_id']);

}else if(isset($_POST['addnew_id'])){
   
    return $PERSONNEL-> personnel_add($_POST['id_card'],$_POST['name'],$_POST['Lastname'],$_POST['username'],$_POST['password'],$_POST['phone'],$_POST['type_id']);

}else if(isset($_POST['allow'])){
    echo $PERSONNEL->update_permission($_POST['personnel_id']);
}
else{
    $PERSONNEL->loadpersonnel();
    echo $PERSONNEL->getjson();
}
 

?>