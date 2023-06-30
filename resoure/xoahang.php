<?php
    $conn=mysqli_connect("localhost","root","","banhang2020");
    $sql="SELECT idhoadon FROM `chitiet` WHERE idhanghoa=".$_GET['id'];
    $ketqua=mysqli_query($conn,$sql);
    while($row=mysqli_fetch_assoc($ketqua)){
        $sql="DELETE FROM hoadon where  idhoadon=".$row['idhoadon']." and xacnhan=0";
        $ketqua=mysqli_query($conn,$sql);
    }
   
    $sql="DELETE FROM chitiet where  idhanghoa=".$_GET['id'];
    $ketqua=mysqli_query($conn,$sql);
    $sql="DELETE FROM binhluan where  idhanghoa=".$_GET['id'];
    $ketqua=mysqli_query($conn,$sql);
    
    $sql="DELETE FROM hanghoa where  idhanghoa=".$_GET['id'];
    $ketqua=mysqli_query($conn,$sql);
    header("location: quanlisp.php?id=".$_GET['iddm']."&&page=".$_GET['page']);
    ?>