<?php 
include("../autoload.php");
if(isset($_POST['add']))
{
    echo $SUBJECT->add_subject($_POST['subject_id'],$_POST['subject_name']);
}else if(isset($_POST['update']))
{
    echo $SUBJECT->upadte_subject($_POST['id'],$_POST['name']);
}
else if(isset($_POST['getuse']))
{
    
    $data =(array)((array)json_decode($SEMESTER->use()));
    echo $data['data'];
}
else if(isset($_POST['insert_semester']))
{
    echo $SUBJECT->insert_subject_personel($_POST['semester_code'],$_POST['subject_id'],$_POST['personnel_id']);
}
else if(isset($_POST['load_subject_personel']))
{
    echo $SUBJECT->load_subject_personel();
}
else{
    echo  $SUBJECT->load_subject();
}

?>