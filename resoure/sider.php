<?php
session_start();
if($_SESSION['quyenhang']!='admin'){
    header("location: index.php");
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Bootstrap CSS CDN -->
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
    <link rel="stylesheet" href="./css/sider.css">
    <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css"
        integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/0baefdcfbf.js" crossorigin="anonymous"></script>
</head>

<body>

    <div class="wrapper ">
        <!-- Sidebar  -->
        <nav id="sidebar" class="bg-success" style="height:100vh; width: 18%;">
            <div class="sidebar-heading">
                <center>
                    <h3><i class="fas fa-user-shield"></i>Admin</h3>
                </center>
            </div>

            <ul class="list-unstyled components">

                <li>
                    <a href="quanlinguoidung.php?page=1">Quản lí người dùng</a>
                </li>
                <li>
                    <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Quản lí
                        sản phẩm</a>
                    <ul class="collapse list-unstyled" id="homeSubmenu">
                        <?php
                           $conn=mysqli_connect("localhost", "root","","banhang2020");
                           $sql = "SELECT * FROM danhmuc "; 
                           $ketqua = mysqli_query($conn, $sql); 
                           while ($row=mysqli_fetch_assoc($ketqua)){
                               ?>
                        <li>
                            <a href="quanlisp.php?id=<?php echo $row['iddanhmuc'];?>&&page=1">
                                <?php echo $row['tendanhmuc'];?>
                            </a>
                        </li>
                        <?php
                           }?>
                        <li>
                            <a href="themsanpham.php">Thêm sửa xóa</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="quanlidanhmuc.php">Quản lí danh mục</a>
                </li>
                <li>
                    <a href="quanlibinhluan.php?page=1">Bình luận</a>
                </li>
                <li>
                    <a href="baiviet.php">Bài viết</a>
                </li>
                <li>
                    <a href="doanhthu.php">Doanh thu</a>
                </li>
                <li>
                    <a href="quanlidonhang.php?page=1">Đơn hàng</a>
                </li>
                <li>
                    <a href="slide.php">Slide</a>
                </li>
                <li>
                    <a href="dangxuat.php">Đăng xuất</a>
                </li>

            </ul>


        </nav>

        <!-- Page Content  -->
        <div id="content">







            <!-- jQuery CDN - Slim version (=without AJAX) -->

</body>

</html>