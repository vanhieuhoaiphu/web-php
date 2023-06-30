<?php
   if(isset($_GET['id'])){
        $conn=mysqli_connect("localhost","root","","banhang2020");
        $sql="delete  from binhluan where id=".$_GET['id'];
        $ketqua=mysqli_query($conn,$sql);
        header("location: quanlibinhluan.php");
   }