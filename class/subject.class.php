<?php 

class subject extends db  
{
    public function load_subject()
    {
        $sql ="SELECT * FROM `subject` ";
        db::query($sql);
        $result =db::default_data();
  
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return json_encode($data);
    }
    public function add_subject($subject_id,$subject_name)
    {
      $data_id = db::real_string($subject_id);
      $data_name = db::real_string($subject_name);
      $sql ="INSERT INTO `subject`(`subject_id`, `subject_name`) VALUES ('".$data_id."','".$data_name."')";
      echo $sql ;
      if(db::query($sql)){
        echo 1;
      }else{
        echo 2;
      }
    }
    public function upadte_subject($subject_id,$subject_name)
    {
      $data_id = db::real_string($subject_id);
      $data_name = db::real_string($subject_name);
      $sql="UPDATE `subject` SET  `subject_name`='".$subject_name."' WHERE `subject_id`='".$data_id."'";
      if(db::query($sql)){
        echo 1;
      }else{
        echo 2;
      }
    }
    public function insert_subject_personel($semester_code,$subject_id,$personnel_id){
      $data_subject_id = db::real_string($subject_id);
      $data_personnel_id = db::real_string($personnel_id);
      $sql1 ="SELECT * FROM `teach` WHERE  `semester_code` ='".$semester_code."' and `subject_id`='".$subject_id."' and `personnel_id`=".$personnel_id;
 
      db::query($sql1);
      if(db::num_rows()>0){
        echo 3;
      }else{
        $sql ="INSERT INTO `teach`( `semester_code`, `subject_id`, `personnel_id`) VALUES ('".$semester_code."','".$data_subject_id."',".$data_personnel_id.")";
        if(db::query($sql)){
          echo 1;
        }else{
          echo 2;
        }
      }
       
    }
  public function  load_subject_personel()
  {
    $sql="SELECT tc.*,CONCAT(p.name, ' ', p.lastname)as name ,sj.subject_name   FROM `teach` tc inner join personnel p on p.personnel_id = tc.`personnel_id` INNER join subject sj on sj.subject_id =tc.`subject_id` order by tc.semester_code ";
    db::query($sql);
    $result =db::default_data();
    while($row = $result->fetch_assoc()){
      $data[]=$row;
    }
    return json_encode($data);
  }
  public function  load_subject_where($uid,$year)
  {
    $sql="SELECT (tc.teach_id)as subject_id_teach,sj.subject_name,tbo.*  FROM `teach` tc  LEFT JOIN tb_order tbo on tc.teach_id =tbo.teach_id INNER join subject sj on sj.subject_id =tc.`subject_id` WHERE  tbo.teach_id is NULL and  tc.personnel_id =  ".$uid ." and tc.semester_code ='".$year."'";
    db::query($sql);
    $result =db::default_data();
    return $result;
  }
}


?>