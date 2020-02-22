 
<?php 
session_start();
if(!isset($_GET['ORDER_ID'])){
    header("location:index.php");
}
require_once "vendor/fpdf182/fpdf.php";
include_once("autoload.php");
 
$data=$ORDER->load_order_by_id($_GET['ORDER_ID']);
$data1=$ORDER->load_name_subject_and_semester_code($_GET['ORDER_ID']);
$data2=$ORDER->load_name_timelog_admincheck_by_id($_GET['ORDER_ID']);
if($data2['name']==NULL){
    $_SESSION["admincheck"] = "ข้อมูลนี้ยังไม่ถูกหัวหน้าแผนกยื่นยันการในตรวจขอสั่งซื้อวัสดุการสอน";
}
$_SESSION["sm"]=$data1['semester_code'];
$_SESSION["smn"]=$data1['subject_name'];
$_SESSION['order_name']=$ORDER->load_name_order_by_id($_GET['ORDER_ID']);
 
 
 
 
 
class mypdf extends FPDF{
function header(){
  
    $this->AddFont('THSarabunNew','','THSarabunNew.php');
    $this->SetFont('THSarabunNew','',20);
  
    $this->Cell(0,5,iconv('UTF-8', 'cp874', 'รายการขอสั่งซื้อวัสดุการสอน สาขาวิทยาศาสตร์คอมพิวเตอร์'),0,0,'L');
    $this->Ln(10);
    $this->Cell(0,5,iconv('UTF-8', 'cp874', 'ประจำปีการศึกษา '.$_SESSION["sm"]),0,0,'L');
    $this->Ln(10);
    $this->Cell(0,5,iconv('UTF-8', 'cp874', 'วิชา '.$_SESSION["smn"]),0,0,'L');
 
    $this->Ln(15);
    if(isset($_SESSION["admincheck"])){
        $this->Cell(0,5,iconv('UTF-8', 'cp874', $_SESSION["admincheck"]),0,0,'C');
        $this->Ln(8);
    }
    
}
function headertb(){
    $this->AddFont('THSarabunNew','b','THSarabunNew_b.php');
    $this->SetFont('THSarabunNew','b',16);
    $this->Cell(20,10,iconv('UTF-8', 'cp874', 'ลำดับ'),1,0,'C');
    $this->Cell(30,10,iconv('UTF-8', 'cp874', 'รายการ'),1,0,'C');
    
    $this->Cell(20,10,iconv('UTF-8', 'cp874', 'จำนวน'),1,0,'C');
    $this->Cell(30,10,iconv('UTF-8', 'cp874', 'หน่วยเรียก'),1,0,'C');
    $this->Cell(30,10,iconv('UTF-8', 'cp874', 'ราคาต่อหน่วย'),1,0,'C');
   
    $this->Cell(30,10,iconv('UTF-8', 'cp874', 'จำนวนเงิน'),1,0,'C');
    $this->Cell(30,10,iconv('UTF-8', 'cp874', 'ประเภท'),1,0,'C');
    $this->Ln();
}
    
function getdt($datacheck){
    $this->AddFont('THSarabunNew','','THSarabunNew.php');
    $this->SetFont('THSarabunNew','',16);
    $number =1 ; 
    $data =$datacheck;
    while($row = $data->fetch_assoc()){
        $this->Cell(20,10,iconv('UTF-8', 'cp874', ($number++)),1,0,'C');
        $this->Cell(30,10,iconv('UTF-8', 'cp874', $row['product_name']),1,0,'C');
        $this->Cell(20,10,iconv('UTF-8', 'cp874', number_format( $row['amout'])),1,0,'C');
        $this->Cell(30,10,iconv('UTF-8', 'cp874', $row['unit_type']),1,0,'C');
        $this->Cell(30,10,iconv('UTF-8', 'cp874', number_format( $row['price'])),1,0,'C');
        $this->Cell(30,10,iconv('UTF-8', 'cp874', number_format($row['price']*$row['amout'])),1,0,'C');
        $this->Cell(30,10,iconv('UTF-8', 'cp874', $row['type_name']),1,0,'C');
        $this->Ln();
        
    }
    $this->Ln();
 
    $this->AddFont('THSarabunNew','','THSarabunNew.php');
    $this->SetFont('THSarabunNew','',16);
    
 
    $this->Cell(0,10,iconv('UTF-8', 'cp874',"_______________________"),0,1,'R');
    $this->Cell(0,10,iconv('UTF-8', 'cp874',"(".$_SESSION['order_name'].")"),0,1,'R');
    $this->Cell(0,10,iconv('UTF-8', 'cp874',"ผู้เสนอโครงการ"),0,1,'R');

}
function Footer()
        {
            $this->AddFont('THSarabunNew','','THSarabunNew.php');
            // Position at 1.5 cm from bottom
        
            // Arial italic 8
            $this->SetFont('THSarabunNew','',16);
            // Page number
        
            $this->Cell(0,10,iconv('UTF-8', 'cp874', 'หน้า ').$this->PageNo().'/{nb}',0,0,'C');
        }
 
}
$pdf = new mypdf();
$pdf->AliasNbPages();

$pdf->AddPage();
 
$pdf->headertb();
$pdf->getdt($data);
$pdf->Output();
 
unset($_SESSION["order_name"]);
 unset($_SESSION["sm"]);
 unset($_SESSION["smn"]);
 if($_SESSION["admincheck"]){
    unset($_SESSION["admincheck"]);
 }
?>

