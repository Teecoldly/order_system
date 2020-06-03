<?php 
class personnel extends db 
{
    private $result; 
    private $json;
    public function __construct() {
        db::__construct();
       
    }
    public function loadpersonnel()
    {
        $sql =  "select * from personnel p";
        db::query($sql);
        $this->result=db::default_data();
        $data = array();
        $result = array();
        while($row = $this->result->fetch_assoc()){
            $data[]=$row;
        }
        $result['data'] = $data;
    
        $this->json=json_encode($result);
        return $result;
    }
    public function loadpersonnel_type()
    {
        $sql =  "select * from personnel p where type_ID=2 or type_ID=3 ";
        db::query($sql);
        $this->result=db::default_data();
        $data = array();
        $result = array();
        while($row = $this->result->fetch_assoc()){
            $data[]=$row;
        }
        $result['data'] = $data;
    
        $this->json=json_encode($result);
        return $result;
    }
    public function loadpersonnel_id($id)
    {
        $sql =  "select * from personnel where personnel_id =".db::real_string($id)."";
        db::query($sql);
        $this->result=db::default_data();
        $data = array();
        $result = array();
        while($row = $this->result->fetch_assoc()){
            $data[]=$row;
        }
        $result['data'] = $data;
    
        $this->json=json_encode($result);
    }
    public function getjson()
    {
        return $this->json;
    }
    public function update_permission($id)
    {
      $sql ="UPDATE `personnel` SET  `permission`=1 WHERE  `personnel_id` =".$id ; 
      db::query($sql);
      echo 1 ; 
    }
    public function personnel_update($personnel_id,$id_card,$name,$lastname,$username,$password,$phone,$type_ID){
         $sql ="UPDATE personnel SET id_card='".db::real_string($id_card)."' ,`name`='".db::real_string($name)."',`lastname`='".db::real_string($lastname)."',`username`='".db::real_string($username)."',`phone`='".db::real_string($phone)."',`password`='".db::real_string($password)."',`type_ID`= ".db::real_string($type_ID)." WHERE `personnel_id` = ".db::real_string($personnel_id)."";
         
          
        if(db::query($sql))
                echo 1 ;
          else
                echo 0;
          
    }
    public function personnel_add($id_card,$name,$lastname,$username,$password,$phone,$type_ID){
        // check username 
        $sql ="SELECT * FROM `personnel` WHERE `username`='".db::real_string($username)."'";
        db::query($sql);
        if( db::num_rows()>0){
            return json_encode(array('status_t' =>'error','msg'=>'username นี้ถูกใช้งานไปแล้ว'));
        }else{
            $sql ="SELECT * FROM `personnel` WHERE  `id_card`='".db::real_string($id_card)."'";
            db::query($sql);
            if( db::num_rows()>0){
                return json_encode(array('status' =>'error','msg'=>'รหัสบัตรประชนถูกใช้งานไปแล้ว'));
            }else{
                $sql = "SELECT * FROM `personnel` WHERE   `name` ='".db::real_string($name)."' and `lastname` = '".db::real_string($lastname)."'";
                db::query($sql);
                if( db::num_rows()>0){
                    return json_encode(array('status' =>'error','msg'=>'มีชื่อและนามสกุลนี้มีแล้วในระบบ'));

                }else{
                    $sql ="INSERT INTO `personnel` ( `id_card`, `name`, `lastname`, `username`, `password`,phone, `type_ID`) VALUES ('".db::real_string($id_card)."', '".db::real_string($name)."', '".db::real_string($lastname)."', '".db::real_string($username)."','".db::real_string($password)."','".db::real_string($phone)."', ".db::real_string($type_ID).")";
                    db::query($sql);
                    return json_encode(array('status' =>'success','msg'=>'กรุณารอยื่นยันจากหัวหน้าแผนก'));
                }
            }
        }
     
        
   }
    public function delete_id($id)
    {
      $sql="DELETE FROM `personnel` WHERE  `personnel_id` = '$id'";
    
      if(db::query($sql)==1)
      echo 2 ;
      else{
        echo 4 ;
      }
    }
}




?>