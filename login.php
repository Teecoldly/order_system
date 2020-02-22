<?php 
session_start();
if(isset($_SESSION['UID'])){
    header("Location:index.php");
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
 <style>
 input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

/* Firefox */
input[type=number] {
  -moz-appearance:textfield;
}
 
 </style>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
<?php include_once("html_page/icon_and_name.php"); ?>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="vendor/sweetalert2/sweetalert2.min.css">
	  
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form class="login100-form validate-form">
					<span class="login100-form-title p-b-26">
					ระบบการจัดการวัสดุโครงการสอน
					</span>
					<span class="login100-form-title p-b-48">
					 <img src="assets/images/logo-icon.png" height="250">
						
					</span>

					<div class="wrap-input100 validate-input" data-validate = "กรุณากรอก Username " i>
						<input class="input100" type="text" name="username" id ="username">
						<span class="focus-input100" data-placeholder="username"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="กรุณากรอก Password " >
						<span class="btn-show-pass">
							<i class="zmdi zmdi-eye"></i>
						</span>
						<input class="input100" type="password" name="password" id="password">
						<span class="focus-input100" data-placeholder="Password"></span>
						
					</div>
					<div align="right">
					<a class="txt2" href="#"  data-toggle='modal' data-target='#addnew' >สมัครสมาชิก</a>
					</div>
				 
					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							
							<button class="login100-form-btn" id="login">
								Login
							</button>
						</div>
					</div>

					<div class="text-center p-t-115">
						<span class="txt1">
                                พบปัญหาในการใช้งานกรุณาติดต่อเจ้าหน้าที่
						</span>

						 
					</div>
				</form>
			</div>
		</div>
	</div>
	

	 
	<div class="modal fade" id="addnew" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">สมัครสมาชิก<h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                   
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">รหัสบัตรประชาชน:</label>
                        <input type="number" class="form-control" id="id_card_add" >

                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">ชื่อ:</label>
                        <input type="text" class="form-control" id="name_add">

                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">นามสกุล:</label>
                        <input type="text" class="form-control" id="Lastname_add">

                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">username:</label>
                        <input type="text" class="form-control" id="username_add">

                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">password:</label>
                        <input type="password" class="form-control" id="password_add">

                    </div>
                    
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">เบอร์โทร</label>
                        <input type="text" class="form-control" id="phone_add">

                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                    <button type="button" class="btn btn-primary" id="personal_add">บันทึก</button>
                </div>
            </div>
        </div>
    </div>
<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
 
    <script src="js/login.js"></script>
	 
    <script src="js/personnel.js"></script>
    <script src="vendor/sweetalert2/sweetalert2.all.min.js"></script>
</body>
</html>