<?php
  session_start();
  unset($_SESSION['giohang']);
   unset($_SESSION['quyenhang']);
   unset($_SESSION['tendangnhap']);
   header("location:login.php");
   ?>