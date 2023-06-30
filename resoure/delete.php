<?php
session_start();
                         if(isset($_GET['id'])){
                             unset($_SESSION['giohang'][$_GET['id']]);
                             header("location: giohang.php");
                         }
                             ?>