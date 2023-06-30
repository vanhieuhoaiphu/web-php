<!DOCTYPE html>

<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>

<body>
  <?php include "menu.php";
 
  $tendangnhap=$_SESSION['tendangnhap'];
  if(isset($_POST['doimatkhau'])){
    $test="/^[A-Za-z0-9]{8,32}$/";
    $sql = "SELECT matkhau FROM dangnhap where tendangnhap='$tendangnhap'";
    $ketqua = mysqli_query($conn, $sql);
    $row=mysqli_fetch_assoc($ketqua);
    if(md5($_POST['matkhau1'])==$row['matkhau']){
      if($_POST['matkhau2']==$_POST['matkhau3']){
        if(preg_match($test,$_POST['matkhau2'])){
        $ps=md5($_POST['matkhau2']);
        $sql="UPDATE `dangnhap` SET `matkhau`='$ps' WHERE tendangnhap='$tendangnhap'";
        $ketqua = mysqli_query($conn, $sql);
     
        }else $mess="Mật khẩu không hợp lệ";
      }
      else $mess="Sai mật khẩu";
    } else $mess="Sai mật khẩu";
   
  }
  if(isset($_GET['matkhau'])){
?>
  <center>
    <form action="" method="POST" style="margin-top:100px;margin-bottom:100px">



      <div class="login-wrap">

        <div class="sign-in-htm">
          <div class="group">
            <label for="pass" class="label">Mật khẩu cũ</label>
            <input id="pass" type="password" class="input" data-type="password" name='matkhau1'>
          </div>
          <div class="group">
            <label for="pass" class="label" style="margin-left:-10px;">Mật khẩu mới</label>
            <input id="pass" type="password" class="input" data-type="password" name='matkhau2'>
          </div>
          <div class="group">
            <label for="pass" class="label" style="margin-left:-50px;">Xác nhận mật khẩu</label>
            <input id="pass" type="password" class="input" data-type="password" name='matkhau3'>
          </div>

          <div class="group">
            <input type="submit" class="btn btn-danger" class="button" name='doimatkhau' value="Đổi mật khẩu">
          </div>
          <div class="hr"></div>

        </div>
    </form>
  </center>


  <?php
  }
  else{

 
    if(isset($_POST['submit'])){
      $ten=$_POST['ten'];
      $diachi=$_POST['diachi'];
      $sodt=$_POST['sdt'];
      $email=$_GET['email'];
      if(isset($_FILES['file']['name'])){
        $tmpFilePath = $_FILES['file']['tmp_name'];
    
        //Make sure we have a file path
          if ($tmpFilePath != ""){
            $link=$_FILES['file']['name'];
          //Setup our new file path
          $newFilePath = "./css/img/" . $_FILES['file']['name'];
          move_uploaded_file($tmpFilePath, $newFilePath);
          $sql="UPDATE `dangnhap` SET tenkhach='$ten',sdt='$sodt',diachi='$diachi', avatar='$link' WHERE tendangnhap='$tendangnhap'";
          }
    
      }
     else{
      $sql="UPDATE `dangnhap` SET tenkhach='$ten',sdt='$sodt',diachi='$diachi', gmail='$email' WHERE tendangnhap='$tendangnhap'";
     }
     
      $ketqua=mysqli_query($conn,$sql);
    }
   
    
    
    $sql = "SELECT * FROM dangnhap where tendangnhap='$tendangnhap'";
    $ketqua = mysqli_query($conn, $sql);  
    $row = mysqli_fetch_assoc($ketqua); 
    ?>
  <div class="container" style="margin-top:100px; margin-bottom:100px">
    <center>
      Thành viên đã mua :
      <?php $sql1="SELECT SUM(tongtien) FROM `hoadon` WHERE tendangnhap='$tendangnhap';";
     $ketqua1 = mysqli_query($conn, $sql1);  
     $row1 = mysqli_fetch_assoc($ketqua1); 
     echo $row1['SUM(tongtien)'];
     if(empty($row1['SUM(tongtien)'])){
       echo '0';
     }
     else{
      echo $row1['SUM(tongtien)'];
     }
    ?> <br>
      Ưu đãi:
      <?php if($row1['SUM(tongtien)']>1000000) echo "5%";
     else echo "0%";
     ?>
      <form action="" method="post" style="width:500px" enctype="multipart/form-data">
        <img src="./css/img/<?php echo $row['avatar'];?>" class="img-cricle" width="100px" alt="">
        <input type="file" name="file" id="">
        <br>
        Tên: <input class="form-control" type="text" name="ten" id="" value="<?php echo $row['tenkhach'];?>">
        Địa chỉ: <input class="form-control" type="text" name="diachi" id="" value="<?php echo $row['diachi'];?>">
        Số điện thoại: <input class="form-control" type="text" name="sdt" id="" value="<?php echo $row['sdt'];?>">
        Email: <input class="form-control" type="text" name="email" id="" value="<?php echo $row['gmail'];?>">

        <input type="submit" name="submit" class="btn btn-danger" value="Cập nhật">
      </form>
      <!-- Material input -->
    </center>
  </div>
  <?php
  }
?>

  <?php include "form.php";
    ?>
</body>

</html>