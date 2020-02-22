<?php
include("../autoload.php");
if(isset($_POST['year'])){
    echo $SEMESTER->insert_semester($_POST['year'],$_POST['term']);
}else if(isset($_POST['use'])){
    echo  $SEMESTER->use();
}
else{
    echo $SEMESTER->loaddata();
}

?>