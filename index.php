<?php 
session_start();
if(!isset($_SESSION['UID'])){
    header("Location:login.php");
}
if( $_SESSION['status_user']==1){
    header("Location:personnel.php");
}
include_once("autoload.php");
date_default_timezone_set("Asia/Bangkok");
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
    <link href="assets/libs/flot/css/float-chart.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="dist/css/style.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets/extra-libs/multicheck/multicheck.css">
    <link href="assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet">

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
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
             <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Dashboard</h4>
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
            <?php  if($_SESSION["status_user"]==2 ||$_SESSION["status_user"]==3  ){?>
                     <div class="col-12">
                     <div class="card">
                            <div class="card-body">
                                <h4 class="card-title m-b-0">รายวิชาที่เปิดสอนในภาคเรียน <?php
                                $year = ((array)json_decode($SEMESTER->use()))['data'];
                                echo  $year; ?></h4><br>
                                
                            </div>
                            <?php $result = $SUBJECT->load_subject_where($_SESSION['UID'],$year);
                            
                            while($row  = $result->fetch_assoc()){
                            ?>
                            <ul class="list-style-none">
                                <li class="d-flex no-block card-body"> 
                                    <div>
                                        <a href="order.php?teach_id=<?php echo $row['subject_id_teach']?>" class="m-b-0 font-medium p-0">   <i class="mdi mdi-book-open-page-variant w-30px m-t-0"></i> วิชา <?php echo $row['subject_name']?></a>
                                     
                                    </div>
                                </li>
                            </ul>
                                <?php } ?>
                        </div>
                    </div>
                    <?php } ?>
                    <?php  if($_SESSION["status_user"]==3){?>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">รายการขอซื้อ</span></h5>
                                <div class="table-responsive">
                                    <table id="admin_order" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>ลำดับ</th>
                                                <th>รหัสการขอซื้อ</th>
                                                <th>ชื่อ-นามสกุล</th>
                                                <th>วันที่ส่งคำขอซื้อ</th>
                                                <th>วันที่อนุมัติคำขอซื้อ</th>
                                                <th>รายละเอียด</th>
                                                <th>การยืนยัน</th>
                                             
                                            </tr>
                                        </thead>
                                        <tbody  id="admin_order_lists">
                                               
                                        </tbody>
                                         
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php  }?>
              
                    <?php  if($_SESSION["status_user"]==2 ||$_SESSION["status_user"]==3  ){?>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">การอนุมัติการขอซื้อ</span></h5>
                                <div class="table-responsive">
                                    <table id="history" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>ลำดับ</th>
                                                <th>รหัสการขอซื้อ</th>
                                                <th>ยืนยันการขอซื้อ</th>
                                                <th>วันเวลา</th>
                                                <th>ดูรายละเอียด</th>
                                            </tr>
                                        </thead>
                                        <tbody id = "history_tbody">

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            </div>
                
                    </div>
                    <?php  }?>
                    
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            
        </div>
         <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <?php include_once('html_page/footer.php') ?>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
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
    <script src="assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="assets/extra-libs/sparkline/sparkline.js"></script>
    <!--Wave Effects -->
    <script src="dist/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="dist/js/custom.min.js"></script>
    <!--This page JavaScript -->
    <!-- <script src="dist/js/pages/dashboards/dashboard1.js"></script> -->
    <!-- Charts js Files -->
    <script src="assets/libs/flot/excanvas.js"></script>
    <script src="assets/libs/flot/jquery.flot.js"></script>
    <script src="assets/libs/flot/jquery.flot.pie.js"></script>
    <script src="assets/libs/flot/jquery.flot.time.js"></script>
    <script src="assets/libs/flot/jquery.flot.stack.js"></script>
    <script src="assets/libs/flot/jquery.flot.crosshair.js"></script>
    <script src="assets/libs/flot.tooltip/js/jquery.flot.tooltip.min.js"></script>
    <script src="dist/js/pages/chart/chart-page-init.js"></script>
    <script src="assets/extra-libs/multicheck/datatable-checkbox-init.js"></script>
    <script src="assets/extra-libs/multicheck/jquery.multicheck.js"></script>
    <script src="assets/extra-libs/DataTables/datatables.min.js"></script>
    <script src="vendor/sweetalert2/sweetalert2.all.min.js"></script>
    <script src="js/index.js"></script>
    <script src="js/numeral.js"></script>
</body>

</html>