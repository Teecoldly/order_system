<?php 
class semester extends db  
{
    public function use()
    {
        $sql ="SELECT `semester_code` FROM `semeste` WHERE `time_temp` = (SELECT max(`time_temp`) FROM semeste)";
        db::query($sql);
        $num = db:: num_rows();
        $result= db::get_data();
        
        @$data = array('rows'=>$num,
                      'data'=> $result['semester_code']);
       
        return  json_encode($data );
    }
    public function loaddata()
    {
        $sql ="SELECT *  FROM `semeste`";
        db::query($sql);
        $result = db::default_data();
        $data=[];
        while ($row = $result->fetch_assoc()) {
         $data[]= $row;
        }
        return json_encode($data);
    }
    public function insert_semester($year,$tern)
    {
        $year_clear = db::real_string($year);
        $tern_clear = db::real_string($tern);
        $data = $tern_clear ."/".$year_clear;
        $sql = "INSERT INTO `semeste`(`semester_code`, `semester`, `tern`) VALUES ('".$data."',".$year_clear.",".$tern_clear.")";
        db::query($sql);
        echo 1 ;
    }
}


?>