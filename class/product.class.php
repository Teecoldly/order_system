<?php
class product extends db 
{
    private $result;
    private $json;
    public function __construct() {
        db::__construct();
    }   
    public function product_type_add($type_name)
    {
        try {
            $sql  = "INSERT INTO `product_type`(`type_name`) VALUES ('".db::real_string($type_name)."')";
            db::query($sql);
            echo 1;
        } catch (Exception  $e) {
            echo 0;
        }
         
   
    }
    public function getdate()
    {
        $_month_name = array("01"=>"มกราคม",  "02"=>"กุมภาพันธ์",  "03"=>"มีนาคม",    
        "04"=>"เมษายน",  "05"=>"พฤษภาคม",  "06"=>"มิถุนายน",    
        "07"=>"กรกฎาคม",  "08"=>"สิงหาคม",  "09"=>"กันยายน",    
        "10"=>"ตุลาคม", "11"=>"พฤศจิกายน",  "12"=>"ธันวาคม"); 
        
        $vardate=date('Y-m-d');
        $yy=date('Y');
        $mm =date('m');$dd=date('d'); 
        if ($dd<10){
        $dd=substr($dd,1,2);
        }
       return  $date=$dd ." ".$_month_name[$mm]."  ".$yy+= 543;
    }
    public function product_type_load()
    {
        $sql =  "select * from product_type";
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
    public function product_type_edit($id,$name)
    {
        try {
            $sql  = "UPDATE `product_type` SET  `type_name`='".db::real_string($name)."' WHERE `type_ID` =".db::real_string($id)."";
            db::query($sql);
            echo 2;
        } catch (Exception  $e) {
            echo 0;
        }
    }
    public function product_type_delete($id)
    {
        try {
            $sql  = " DELETE FROM `product_type`  WHERE `type_ID` =".db::real_string($id)."";
            db::query($sql);
            echo 3;
        } catch (Exception  $e) {
            echo 0;
        }
    }
    public function getresult()
    {
        return  $this->result;
    }
    public function product_add($key,$name,$price,$unit_type,$type)
    {
        try {
            $sql  = "INSERT INTO `product`(`product_key`, `product_name`,price, unit_type,`product_type`) VALUES ('".db::real_string($key)."','".db::real_string($name)."',".db::real_string($price).",'".db::real_string($unit_type)."',".db::real_string($type).")";
           
            db::query($sql);
            echo 1;
        } catch (Exception  $e) {
            echo 0;
        }
    }
    public function product_load()
    {
       
        $sql  = "SELECT p.`product_id`, p.`product_key`, p.`product_name` ,p.price,p.unit_type,py.type_ID,py.type_name FROM `product` p INNER join 	product_type py on p.`product_type`= py.type_ID";
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
    public function product_load_order()
    {
       
        $sql  = "SELECT p.`product_id`, p.`product_key`, p.`product_name` ,p.price,py.type_ID,py.type_name FROM `product` p INNER join 	product_type py on p.`product_type`= py.type_ID";
        db::query($sql);
        return $this->result=db::default_data();
        
        
        
    }
    public function product_edit($id,$key,$name,$price,$unit_type,$type)
    {
        try {
            $sql  = "UPDATE `product` SET `product_key`='".db::real_string($key)."',`product_name`='".db::real_string($name)."',`price`='".db::real_string($price)."',unit_type='".db::real_string($unit_type)."',`product_type`=".db::real_string($type)." WHERE  `product_id`=".db::real_string($id)."";
    
            db::query($sql);
            echo 2;
        } catch (Exception  $e) {
            echo 0;
        }
    }
    public function  product_delete($id)
    {
        try {
            $sql  = "DELETE FROM `product` WHERE  `product_id`=".db::real_string($id)."";
    
            db::query($sql);
            echo 3;
        } catch (Exception  $e) {
            echo 0;
        }
    }
     
}



?>