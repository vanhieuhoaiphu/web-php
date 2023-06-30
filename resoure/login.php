<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" href="./css/login.css">
	<link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
		integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
		integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
		crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
		integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
		crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
		integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV"
		crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.0/css/all.css"
		integrity="sha384-OLYO0LymqQ+uHXELyx93kblK5YIS3B2ZfLGBmsJaUyor7CpMTBsahDHByqSuWW+q" crossorigin="anonymous">
	<link rel="stylesheet" href="./css/menu.css">


	<?php
session_start();
if(isset($_POST['submit'])){
    $tendangnhap=$_POST['tendagnhap'];
    $password=md5($_POST['matkhaudn']);
 $conn = mysqli_connect("localhost", "root", "", "banhang2020");
 $sql = "SELECT * FROM dangnhap where tendangnhap='$tendangnhap' and matkhau='$password'";
 $ketqua = mysqli_query($conn, $sql);  
 $row = mysqli_fetch_assoc($ketqua);  
    if(mysqli_num_rows($ketqua)>0){
		
        $_SESSION['quyenhang']=$row['quyenhan'];
        $_SESSION['tendangnhap']=$row['tendangnhap'];
        if($row['quyenhan']=='admin'){
          header('location: doanhthu.php'); 
        }
        else{
          header('location: hanghoa1.php'); 
        }
      
   } 
    }
?>
</head>

<body>




	<!-- dang nhap -->

	<form action="" method="POST">
		<div class="login-wrap">
			<div class="login-html">
				<input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Đăng
					nhập</label>
				<input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab">Đăng kí</label>
				<div class="login-form">
					<div class="sign-in-htm">
						<div class="group">
							<label for="user" class="label">Tên đăng nhập</label>
							<input id="user" type="text" class="input" name='tendagnhap'>
						</div>
						<div class="group">
							<label for="pass" class="label">Mật khẩu</label>
							<input id="pass" type="password" class="input" data-type="password" name='matkhaudn'>
						</div>
						<div class="group">
							<input id="check" type="checkbox" class="check" checked>
							<label for="check"><span class="icon"></span> Keep me Signed in</label>
						</div>
						<div class="group">
							<input type="submit" class="button" name='submit' value="Sign In">
						</div>
						<div class="hr"></div>
						<div class="foot-lnk">
							<a href="#forgot">Quên mật khẩu?</a>
						</div>
					</div>


					<!-- dang ki -->

					<div class="sign-up-htm" style="margin-bottom:100px;">
						<div class="row">
							<div class="col">
								<div class="group">
									<label for="user" class="label">Tên đăng nhập</label>
									<input id="user" type="text" name="tendangnhap" class="input">
								</div>
							</div>
							<div class="col">
								<div class="group">
									<label for="user" class="label">Email</label>
									<input id="user" type="text" name="email" class="input">
								</div>
							</div>
						</div>


						<div class="group">
							<label for="user" class="label">SĐT</label>
							<input id="user" type="text" name="phone" class="input">
						</div>
						<div class="group">
							<label for="pass" class="label">Mật khẩu</label>
							<input id="pass" type="password" name="matkhau" class="input" data-type="password">
						</div>
						<div class="group">
							<label for="pass" class="label">Nhập lại mật khẩu</label>
							<input id="pass" type="password" name="matkhau1" class="input" data-type="password">
						</div>
						<div class="group">
							<label for="pass" class="label">Địa chỉ</label>
							<input id="pass" type="text" name="address" class="input">
						</div>
						<div class="group">
							<input type="submit" class="button" name="dangki" value="Sign Up">
						</div>
						<div class="hr"></div>
						<div class="foot-lnk">
							<label for="tab-1">Already Member?</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>



	<?php

if(isset($_POST["dangki"])){
    $test="/^[A-Za-z0-9]{8,32}$/";

      $tendangnhap=$_POST['tendangnhap'];
      $password=md5($_POST['matkhau']);
      $password1=md5($_POST['matkhau1']);
      $quyenhan="user";
      $phone=$_POST['phone'];
      $address=$_POST['address'];
      $email=$_POST['email'];
      $conn = mysqli_connect("localhost", "root", "", "banhang2020");
      if($password==$password1){
      if(preg_match($test,$_POST['matkhau'])){
      $sql = "SELECT * FROM dangnhap WHERE  tendangnhap='$tendangnhap' and vohieu=0";
      $ketqua = mysqli_query($conn, $sql);
      if(mysqli_num_rows($ketqua)>0){$hienthi="Đã tồn tại";}
        else{ 
             $sql1="INSERT INTO dangnhap(tendangnhap,matkhau,quyenhan,sdt,diachi,gmail,avatar) VALUES('$tendangnhap','$password','$quyenhan','$phone','$address','$email','avatar.png')";
			 $ketqua = mysqli_query($conn, $sql1);
			 $hienthi="Đăng kí thành công";
			
		  }
		   
		 } else{ $hienthi="Mật khẩu không hợp lệ";}
	 
		 
	  } else{ $hienthi="Mật khẩu không trung khớp";}
	  ?>
	<div class="modal fade" id="modalConfirmDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
		aria-hidden="true">
		<div class="modal-dialog modal-sm modal-notify modal-danger" role="document">
			<!--Content-->
			<div class="modal-content text-center">
				<!--Header-->
				<div class="modal-header d-flex justify-content-center">
					<p class="heading">
						<?php echo $hienthi?>
					</p>
				</div>

				<!--Body-->
				<div class="modal-body">

					<i class="fas fa-times fa-4x animated rotateIn"></i>

				</div>

				<!--Footer-->
				<div class="modal-footer flex-center">
					<a href="" class="btn  btn-outline-danger">Yes</a>

				</div>
			</div>
			<!--/.Content-->
		</div>
	</div>
	<script>
		$("#modalConfirmDelete").modal("show");
	</script>
	<?php   
}
?>


</body>

</html>
<?php
 include "form.php";
 ?>