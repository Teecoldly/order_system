<?php 
class index extends db 
{
    public function __construct() {
        db::__construct();
    }
    public function loadproduct_id()
    {
        $sql = "SELECT  `product_id`,`product_key`,`product_name`,`price` FROM `product`";
     
        db::query($sql);
        return db::default_data();
    }
    public function loadindex_order_all($timestemp)
    {
        $server_month = $this->getmonth($timestemp);
        $server_year = $this->getyeart($timestemp);
        
        $result = $this->loadproduct_id();
        $array=[];
        $number = 0;
        while($row = $result->fetch_assoc()){
            $array[$row['product_id']] = array(
                'key'=>$row['product_key'],
                'name'=>$row['product_name'],
                'price'=>$row['price'],
                'amout'=>$number,
                'total'=>$number
            ); 
        }
        $sql = "SELECT  tbo.timelog,tbds.product_id,pro.product_name,pro.price,tbds.amout FROM tb_order_details tbds INNER JOIN tb_order tbo on tbds.order_id = tbo.order_id INNER join product pro on pro.product_id = tbds.product_id";
        db::query($sql);
        
        $result = db::default_data();
        while($row = $result->fetch_assoc()){
            $month=$this->getmonth($row['timelog']);
            $year=$this->getyeart($row['timelog']);
            if($month== $server_month && $year==$server_year ){
                $array[$row['product_id']]['amout'] +=$row['amout'];
                $array[$row['product_id']]['total'] +=($row['amout']*$row['price']);
            }
        }        
       echo json_encode($array);

    }
    public function load_admin_order_check()
    {
       $sql="SELECT tbo.`order_id`,CONCAT(psn.name,' ',psn.lastname) as name ,tbo.timelog,tbo.`status_admin_id`,tbo.admin_summit_order FROM `tb_order` tbo INNER join teach tc on tc.teach_id = tbo.teach_id LEFT join personnel psn on tc.personnel_id = psn.personnel_id ";
       db::query($sql);
        $array =[];
        $result = db::default_data();
       
        while ($row  = $result->fetch_assoc()) {
        if($row['admin_summit_order']==NULL){
            $time_admin = "ยังไม่ถูกยื่นยันข้อมูล";
        }else{
            $time_admin =db::date_facebookformat($row['admin_summit_order']);
        }
            $array[] = array(
                'order_id'=>$row['order_id'],
                'name'=>$row['name'],
                'time'=>db::date_facebookformat($row['timelog']),
                'time_admin'=>$time_admin,
                'admin_check'=>$row['status_admin_id']

            );
        }
        return json_encode($array);

    }
    public function update_admin_check($order_id,$UID){
        date_default_timezone_set("Asia/Bangkok");
        $sql="UPDATE `tb_order` SET  `status_admin_id`=".db::real_string($UID).",`admin_summit_order` =".time()." WHERE `order_id` = ".db::real_string($order_id);
        db::query($sql);
        
        return 1;
    }
    public function cancel_order($order_id)
    {
        $sql = "UPDATE `tb_order` SET `status_admin_id`=NULL,`admin_summit_order`=NULL WHERE `order_id` =".db::real_string($order_id);
        db::query($sql);
        return 1;
    }
    public function getmonth_year($datetime)
    {
        $monthText = array('มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม');
        $month  = date('m',$datetime);
        $month  = $monthText[$month-1];
        $year   = date('Y',$datetime)+543;
        return  $month . " พ.ศ.".  $year  ;
    }
    public function getmonth($datetime)
    {
        $monthText = array('มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม');
        $month  = date('m',$datetime);
        return   $month;
    }
    public function getyeart($datetime){
        $year   = date('Y',$datetime)+543;
        return $year;
    }
}



?>