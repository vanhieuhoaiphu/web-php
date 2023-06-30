<?php
session_start();

$conn=mysqli_connect("localhost","root","","banhang2020");

         if(isset($_GET['btn'])){
             $chuoi="";
             if(!empty($_GET['search'])){
                 $chuoi.="timkiem=".$_GET['search'];
                 $chuoi.="&&soluong=".$_GET['searchnb'];
                 $chuoi.="&&soluong2=".$_GET['searchnb2'];
             } else{
             $chuoi.="soluong=".$_GET['searchnb'];
             $chuoi.="&&soluong2=".$_GET['searchnb2'];
             }
             header("location: hanghoa.php?".$chuoi);
         }
         
         
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
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
</head>

<body>

    <!-- navbar -->

    <!-- nav -->
    <nav class="navbar navbar-expand-lg sticky-top" style="background-color:rgba(105,105,105,0.5); color:white;">
        <div class="container-fluid">
            <div class="container">
                <button class="navbar-toggler " style="color:black" type="button" data-toggle="collapse"
                    data-target="#navbarResponsivetop">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsivetop">
                    <a class="nav-brand">
                        <p class="nav-link nav1"> Hotline:0368485425</p>
                    </a>
                    <ul class="navbar-nav ml-auto">
                        <li>
                            <a class="nav-link nav1" href="hienthidonhang.php"><i class="fas fa-bags-shopping"></i>Kiểm
                                tra đơn hàng</a>
                        </li>

                        <?php
                if(isset($_SESSION['tendangnhap'])){
                    
                    ?>
                        <li>
                            <a class="nav-link nav1" href="dangxuat.php"><i class="fas fa-sign-in-alt"></i>Đăng xuất</a>

                        </li>

                        <?php
                }else { 
                 
                    ?>
                        <li>
                            <a class="nav-link nav1" href="login.php"><i class="fas fa-sign-in-alt"></i>Đăng Nhập</a>
                        </li>
                        <?php
                }?>


                </div>
            </div>
        </div>
    </nav>


    <nav class="navbar navbar-expand-lg  sticky-top navbarmenu">
        <div class="container-fluid">
            <button class="navbar-toggler" style="color:black" type="button" data-toggle="collapse"
                data-target="#navbarResponsive">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <a class="navbar-brand" href="index.php">
                    <img src="./css/img/logo.png" height="100px" width="150px" alt="">
                </a>


                <form method="GET" action="" style="margin-left:200px">
                    <input class="search" type="text" placeholder="Search" aria-label="Search" name="search">
                    <select name="searchnb" id="<=" class="search" style="margin-left:-10px; width:150px;">
                        <option value="0">>=</option>
                        <option value="50000">>=50000</option>
                        <option value="100000">>=100000</option>
                        <option value="200000">>=200000</option>
                        <option value="300000">>=300000</option>
                        <option value="500000">>=500000</option>
                    </select>

                    <select name="searchnb2" class="search" style="margin-left:-10px; width:150px;" id=">=">
                        <option value="0">=< </option>
                        <option value="600000">600000=<< /option>
                        <option value="700000">700000=<< /option>
                        <option value="900000">900000=<< /option>
                        <option value="1000000">1000000=<< /option>
                    </select>
                    <button type="submit" name="btn" class="text-center btnsearch"><i
                            class="fas fa-search-plus"></i></button>

                </form>

                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a href="giohang.php" class="nav-link text-light"><i
                                class="fas fa-cart-plus"></i>Giỏ hàng
                            <?php if(isset($_SESSION['giohang'])){
                    echo "(".count($_SESSION['giohang']).")";
                }
                else{
                     echo"(0)";
                }
                ?>
                        </a> </li>

                    <li class="nav-item">

                        <?php if(isset($_SESSION['tendangnhap'])){
                    
                    ?>
                        <div class="dropdown" style="background-color:white;">
                            <button class="dropdown-toggle"
                                style="font-size: 150% !important;background-color:white;color:black !important;"
                                type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                <i class="fas fa-user-circle"></i>Tài khoản
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="nav-link text-light dropdown-item" href="taikhoan.php">Thông tin</a>
                                <a class="nav-link text-light dropdown-item" href="taikhoan.php?matkhau=true">Mật
                                    khẩu</a>

                                <!-- modal -->


                                <!-- Modal -->



                            </div>
                        </div>
                        <?php } ?>
                    </li>

                </ul>
            </div>
        </div>
    </nav>



</body>

</html>