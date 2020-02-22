<?php
 
class order extends db  
{
    private $orderid;
 
    public function order_add($teach_id,$sessionproduct){
   
        $time = time();
        $sql = "INSERT INTO `tb_order`(`teach_id` , `timelog`) VALUES (".db::real_string($teach_id).",$time  )";
        db::query($sql);
        $sql = "select order_id from tb_order where  teach_id = ".db::real_string($teach_id) ." and timelog = $time";
        db::query($sql);
        
        $result =db::get_data();
        $this->orderid = $result["order_id"];
  
        return  $this->order_add_details($this->orderid,$sessionproduct);
    }
    public function order_edit($order_id,$sessionproduct){
        date_default_timezone_set("Asia/Bangkok");
        $time = time();
        $sql = "UPDATE `tb_order` SET  `timelog`= ".$time." WHERE `order_id` = ".$order_id;
        db::query($sql);
        $sql = "DELETE FROM `tb_order_details` WHERE `order_id` = ".$order_id;
        db::query($sql);
        return  $this->order_add_details($order_id,$sessionproduct);
    }
    public function order_add_details($orderid,$arr_idpro){
        
        foreach ($arr_idpro as $key => $value) {
            $sql ="INSERT INTO `tb_order_details`( `order_id`, `product_id`, `amout`) VALUES ($orderid,$key,$value)";
            db::query($sql);
             
        }
       return 1; 
    }
    
    
    public function load_order_history($id)
    {
    $sql = 'SELECT tbo.order_id,CONCAT(  pes.name," ",pes.lastname)as name , tbo.timelog,tbo.admin_summit_order from tb_order tbo LEFT JOIN personnel pes on tbo.status_admin_id = pes.personnel_id INNER JOIN teach tc on tc.teach_id = tbo.`teach_id` where tc.personnel_id ='.$id. '';
    db::query($sql);
 
    $result = db::default_data();

    $data=[];
        while ($row= $result->fetch_assoc()) {
            if($row['admin_summit_order']==NULL){
                $time_admin = "ยังไม่ถูกยื่นยันข้อมูล";
            }else{
                $time_admin =db::date_facebookformat($row['admin_summit_order']);
            }
           $data[]=  array(
               'order'=>$row['order_id'],
               'name'=>$row['name'],
               'timelogs_number'=> db::date_facebookformat($row['timelog']),
               'time_admin'=>$time_admin 
           );
        }
    $temp['data']=$data;
    return json_encode($temp);
    }
    public function load_time_by_order($order_id)
    {
        $sql = "SELECT `timelog` FROM `tb_order` WHERE `order_id` =".$order_id;
        db::query($sql);
        $result = db:: get_data();
        return db::date_thaiformat($result['timelog']);
    }
    public function load_name_subject_and_semester_code($order_id)
    {
        $sql = "SELECT tc.semester_code,sj.subject_name from tb_order tbo INNER join teach tc on tbo.teach_id = tc.teach_id INNER JOIN subject sj on tc.subject_id = sj.subject_id WHERE tbo.order_id=".$order_id;
        db::query($sql);
        $result = db:: get_data();
        return  $result;
    }
    public function load_name_order_by_id($id) // โหลดคนออก order
    {
        $sql  = "SELECT CONCAT(  pn.name,' ',pn.lastname)as name from tb_order tb  INNER join teach tc  on  tb.teach_id = tc.teach_id INNER join personnel pn on tc.personnel_id = pn.personnel_id  WHERE tb.order_id = ".db::real_string($id);
     
        db::query($sql);
        $result = db:: get_data();
       
        return  $result['name'];
    }

    public function load_name_timelog_admincheck_by_id($id)
    {
        $sql  = "SELECT CONCAT( pn.name,' ',pn.lastname)as name,`admin_summit_order` from tb_order tb LEFT JOIN personnel pn on tb.status_admin_id = pn.personnel_id WHERE tb.order_id = ".db::real_string($id);
     
        db::query($sql);
        $result = db:: get_data();
        if($result['name']==NULL){
            $name =NULL;
        }else{
            $name =$result['name'];
        }
        if($result['admin_summit_order']==NULL){
            $time =NULL;
        }else{
            $time =db::date_thaiformat($result['admin_summit_order']);
            
        }
       $data = array('name' => $name,
                     'timer_admin' => $time);
        return  $data;
    }
    public function load_order_by_id($id)
    {
        
        $sql =' SELECT  pro.product_key,pro.product_name,pro.price,tbdt.`amout`,pro.unit_type,pro_t.type_name FROM `tb_order_details` tbdt  INNER JOIN product pro on tbdt.`product_id` = pro.product_id INNER JOIN product_type pro_t on pro.product_type = pro_t.type_ID WHERE tbdt.`order_id` = '.$id;
        db::query($sql);
        $result = db::default_data();
       
        return $result;
    }
    public function delete_order($id_order)
    {
     $sql = "DELETE FROM `tb_order_details` WHERE `order_id`=".$id_order;
     db::query($sql);
     $sql = "DELETE FROM `tb_order` WHERE `order_id`=".$id_order;
     db::query($sql);
        return 1 ;
    }
}


?>