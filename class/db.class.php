<?php 
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

class db
{
    private $host ;
    private $userdb;
    private $passworddb;
    private $dbname;
    private $con;
    private $result;

    public function __construct() {
        $this->host = "192.168.64.2";
        $this->userdb="smartheath";
        $this->password="smartheath123456";
        $this->dbname="order_system";
        $this->con = new mysqli($this->host,$this->userdb,$this->password,$this->dbname);
        $this->con->set_charset("utf8");
    }
    public function query($query)
    {
        try {
            
            $this->result=$this->con->query($query);
            return true;
        } catch (mysqli_sql_exception $e) {
             
            return $this->con->errno;
        }
       
    }
    public function num_rows()
    {
        return $this->result->num_rows;
    }
    public function default_data(){
        return $this->result;
    }
    public function get_data()
    {
        return $this->result->fetch_assoc();
    }
    public function real_string($text){
        return $this->con->real_escape_string($text);
    }
    public function date_facebookformat($datetime){
        $text = $this->date_thaiformat( $datetime);
        // $timestamp  = $datetime ;
        // $diff       = time() - $timestamp;

        // $periods    = array('วินาที','นาที','ชั่วโมง');
        // $words      = 'ที่แล้ว';

        // if($diff < 10){
        //     $text   = "เมื่อสักครู่";
        // }
        // else if($diff < 60){
        //     $i      = 0;
        //     $diff   = ($diff == 1)?"":$diff;
        //     $text   = "$diff $periods[$i]$words";
        // }
        // else if($diff < 3600){
        //     $i      = 1;
        //     $diff   = round($diff/60);
        //     // $diff   = ($diff == 3 || $diff == 4)?"":$diff;
        //     $text   = "$diff $periods[$i]$words";
        // }
        // else if($diff < 86400){
        //     // 1 Day
        //     $i      = 2;
        //     $diff   = round($diff/3600);
        //     $diff   = ($diff != 1)?$diff:"" . $diff ;
        //     $text   = "$diff $periods[$i]$words";
        // }
        // else if($diff < 432000){
        //     // 5 Day
        //     $diff   = round($diff/86400);
        //     $text   = $diff.' วันที่แล้ว';
        // }
        // else{
        //     $thMonth = array('ม.ค.','ก.พ.','มี.ค.','เม.ย.','พ.ค.','มิ.ย.','ก.ค.','ส.ค.','ก.ย.','ต.ค.','พ.ย.','ธ.ค.');

        //     $date   = date("d", $timestamp);
        //     $month  = $thMonth[date("m", $timestamp)-1];
        //     $y      = (date("Y", $timestamp)+543)-2500;
        //     $t1     = "$date  $month";
        //     $t2     = "$date  $month  $y";

        //     // if($timestamp < strtotime(date("Y-01-01 00:00:00"))){
        //     //     $text = $t2;
        //     // }
        //     // else{
        //     //     $text = $t1;
        //     // }

        //     $text = $t2;
        // }
        return $text;
    }
    public function shortdate_thaiformat($datetime){
        $monthText = array('ม.ค.','ก.พ.','มี.ค.','เม.ย.','พ.ค.','มิ.ย.','ก.ค.','ส.ค.','ก.ย.','ต.ค.','พ.ย.','ธ.ค.');
        $year   = date('Y',$datetime)+543;
        $month  = date('m',$datetime);
        $date   = date('d',$datetime);

        $month  = $monthText[$month-1];

        if($year == (date('Y')+543)){
            return $date.' '.$month;
        }else{
            return $date.' '.$month.' '.($year - 2500);
        }
    }
    public function datetime_thaiformat($datetime){
        // $monthText = array('มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม');
        $monthText = array('ม.ค.','ก.พ.','มี.ค.','เม.ย.','พ.ค.','มิ.ย.','ก.ค.','ส.ค.','ก.ย.','ต.ค.','พ.ย.','ธ.ค.');
        $hour   = date('H',$datetime);
        $minute = date("i",$datetime);
        $year   = date('Y',$datetime)+543 - 2500;
        $month  = date('m',$datetime);
        $date   = date('d',$datetime);

        // full,short,notime

        $month  = $monthText[$month-1];


        return $date.' '.$month.' '.$year.' '.$hour.':'.$minute.' น.';
    }
    public function date_thaiformat($datetime){
        $monthText = array('มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม');
        $hour   = date("H",$datetime);
        $minute = date("i",$datetime);
        $year   = date('Y',$datetime)+543;
        $month  = date('m',$datetime);
        $date   = date('d',$datetime);

        $month  = $monthText[$month-1];
 
        return $date.' '.$month.' '.$year;
    }
    
     
}

?>