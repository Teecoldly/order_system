<?php 
class login extends db 
{
    
    private $result;
 
    private $Data;
    
    public function __construct() {
       db::__construct();
    }
    public function login($username,$password)
    {
        
        $sql = "Select * from personnel where username ='".db::real_string($username). "' and password = '".db::real_string($password). "'";
    
        db::query($sql);
        $this->result= db::num_rows();
        if($this->result==0){
           return 0;
        }else{
          
            $this->Data= db::get_data();
           
            return 1 ; 
        }
        
    }
    public function get($slot)
    {
      
        return $this->Data[$slot];
    }

}




?>