<?php
session_start();
 echo "da thanh cong";
  $con=mysqli_connect("localhost", "root","", "banhang2020");
  $noidung=$_POST['noidung'];
  $id=$_POST['idsach'];
  $today = date("Y-m-d");
  $sql="INSERT INTO binhluan(idhanghoa, noidung, tendangnhap,ngay) values($id,'$noidung','".$_SESSION['tendangnhap']."','$today')";
  $ketqua=mysqli_query($con,$sql);
 
  ?>