<?php 
session_start();
if(!isset($_SESSION['UID'])){
    header("location:login.php");
}
if(!isset($_SESSION['order'])){
    header("location:order.php");
}
if(!$_SESSION["teach_id"]){
 
    header("location:login.php");
}
 
include_once("autoload.php");
  
?>
<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <?php include_once("html_page/icon_and_name.php"); ?>
    <!-- Custom CSS -->
    <link href="dist/css/style.min.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <?php  include_once("html_page/header.php");?>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <?php  include_once("html_page/sidebar.php");?>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">รายละเอียดการสั้งซื้อ</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><?php
                                    $namefile = basename($_SERVER['PHP_SELF']);
                                    $subtext = substr( $namefile ,0, strpos( $namefile,".php"));
                                    echo  $subtext ;
                                    ?></li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-body printableArea">
                            
                            <div class="row">
                                <div class="col-md-12">
                                   
                                    <div class="pull-righ text-right">
                                        <address>
                                            <h3>คุณ</h3>
                                            <h4 class="font-bold"><?php  echo $_SESSION['name']." ". $_SESSION['lastname']?></h4>
                                           
                                            <p class="m-t-30"><b>วันที่:</b> <i class="fa fa-calendar"></i> <?php echo $PRODUCT->getdate(); ?></p>
                                         
                                        </address>
                                    </div>
                                </div>
                            
                                <div class="col-md-12">
                                <center><h4 class="font-bold">รายการสั่งซื้อ </h4></center>
                                    <div class="table-responsive m-t-40" style="clear: both;">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">รายการ</th>
                                                    <th class="text-center">รหัสสินค้า</th>
                                                    <th class="text-center">ชื่อสินค้า</th>
                                                    <th class="text-center">รายละเอียดวัสดุ</th>
                                                    <th class="text-right">ราคาสินค้า</th>
                                                    <th class="text-right">จำนวน</th>
                                                    <th class="text-right">ราคาสุทธิ</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                                <?php 
                                                $data = $PRODUCT->product_load_order();
                                                $i=1;
                                                $order =$_SESSION["order"];
                                                $array = json_decode(json_encode($order),true);
                                                $total = 0;
                                               while( $row=$data->fetch_assoc()){;
                                                $id= $row["product_id"];
                                                    if(array_key_exists($id,$array)){
                                                        
                                                 ?>
                                                <tr>
                                                    <td class="text-center"><?php echo($i++) ?></td>
                                                    <td class="text-center"><?php echo($row["product_key"]) ?></td>
                                                    <td class="text-center"><?php echo($row["product_name"]) ?></td>
                                                    <td class="text-center"><?php echo($row["detail"]) ?></td>
                                                    <td class="text-right"><?php echo($row["price"]) ?></td>
                                                    <td class="text-right"> <?php echo(number_format($array[$row["product_id"]] ))?> </td>
                                                    <td class="text-right"> <?php echo(number_format($row["price"]*$array[$row["product_id"]],2) ) ?></td>
                                                </tr>
                                               <?php   $total +=$row["price"]*$array[$row["product_id"]];}}?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="pull-right m-t-30 text-right">
                                        <p>ราคารวม <?php echo(number_format($total,2)); ?> บาท</p>
                                         
                                        <hr>
                                        <h3><b>ราคาสุทธิ :</b>  <?php echo( number_format($total,2)); ?> บาท</h3>
                                    </div>
                                    <div class="clearfix"></div>
                                    <hr>
                                
                                    <div class="text-right">
                                    <button class="btn btn-warning" type="submit" id="id_cancel_order"> ยกเลิกคำขอสซื้อ </button>
                                        <button class="btn btn-danger" type="submit" id="id_submit_order"> ยื่นยันคำขอซื้อ </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Right sidebar -->
                <!-- ============================================================== -->
                <!-- .right-sidebar -->
                <!-- ============================================================== -->
                <!-- End Right sidebar -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
           <!-- footer -->
            <!-- ============================================================== -->
            <?php include_once('html_page/footer.php') ?>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="assets/libs/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="assets/extra-libs/sparkline/sparkline.js"></script>
    <!--Wave Effects -->
    <script src="dist/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="dist/js/custom.min.js"></script>
    <script src="js/show_dt.js"></script>
    <script src="vendor/sweetalert2/sweetalert2.all.min.js"></script>
</body>

</html>