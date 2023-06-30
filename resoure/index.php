<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/index.css">
    <link rel="stylesheet" href="./OwlCarousel2-2.3.4/dist/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="./OwlCarousel2-2.3.4/dist/assets/owl.theme.default.min.css">
</head>

<body>

    <?php
  include 'menu.php';
  include 'danhmuc.php';
  ?>

    <!-- slide -->
    <div class="container">
        <div class="row">
            <div class="col-4">

            </div>
            <div class="col-8">
                <div id="slides" class="carousel slide" data-ride="carousel">
                    <ul class="carousel-indicators">
                        <?php
                
                  $sql="select * from slide";
                  $ketqua=mysqli_query($conn,$sql);
                  $dem=0;
                while(mysqli_num_rows($ketqua)>$dem){
                    if($dem==0){
                        ?>
                        <li data-target="#slides" data-slide-to="<?php echo $dem; ?>" class="active"></li>
                        <?php
                    } else{
                    ?>
                        <li data-target="#slides" data-slide-to="<?php echo $dem; ?>"></li>
                        <?php
                   
                }  $dem++; }
                  ?>


                    </ul>
                    <div class="carousel-inner ">
                        <?php 
               $dem=0;
                while($row=mysqli_fetch_assoc($ketqua)){
                    if($dem==0){
                    ?>
                        <div class="carousel-item active">
                            <img src="./css/img/<?php echo $row['link'];?>">
                            <div class="carousel-caption">
                                <h4 class="display-4"
                                    style="background-color: rgba(145, 141, 141,0.5) !important;padding: 10px;">
                                    <?php echo $row['name'];?>
                                </h4>


                            </div>
                        </div>
                        <?php
                } else{
                    ?>
                        <div class="carousel-item">
                            <img src="./css/img/<?php echo $row['link'];?>">
                            <div class="carousel-caption">
                                <h4 class="display-4"
                                    style="background-color: rgba(145, 141, 141,0.5) !important;padding: 10px;">
                                    <?php echo $row['name'];?>
                                </h4>
                            </div>
                        </div>
                        <?php
                } $dem++;}
                ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col service">
                <center><i class="fas fa-truck-moving"></i>Miễn phí giao hang cho các đơn hàng từ 450.000</center>
            </div>
            <div class="col service">
                <center><i class="far fa-clock"></i>Giao hàng trong ngày</center>
            </div>
            <div class="col service">
                <center>Thanh toán khi nhận hàng</center>
            </div>
        </div>
    </div>

    <div class="container" style="margin-top:20px">
        <div class="row">
            <div class="col title">
                <h4 class=' bg-warning'>
                    Ưu thích
                </h4>

            </div>
            <!-- khuyen mai -->
        </div>
    </div>


    <div class="container" style="margin-bottom:50px; ">
        <div class="owl-carousel owl-theme">
            <?php
    
      $sql="SELECT * FROM hanghoa ORDER BY daban DESC limit 10 offset 0";
      $ketqua=mysqli_query($conn,$sql);
      while($row=mysqli_fetch_assoc($ketqua)){
        if($row['hienthi']==0){
?>

            <div class="item">

                <div class="row1 product">

                    <a style="text-decoration: none;" href="chitiet.php?id=<?php echo $row['idhanghoa'];?>">
                        <div>

                            <img src="./css/img/<?php echo $row['link'];?>" height="170px" width="208px"
                                class="mx-auto d-block" alt="">
                            <p style="    position: absolute;
    top: 10px;
    right: 10px;
    background: #0f9ed8; border-radius: 50%;
    white-space: pre-line;
    width: 55px;
    text-align: center;
    color:white;
    ">Hot</p>
                            <p class="text-center">
                                <?php echo $row['tenhang']?>
                            </p>
                            <p style="color: black;">
                                <?php echo number_format($row['dongia'], 0, ',', '.');?> <sub>đ</sub>
                            </p>

                        </div>
                    </a>
                </div>
            </div>
            <?php
    }
}
    ?>

        </div>
    </div>





    <div class="container" style="margin-top:20px">
        <div class="row">
            <div class="col title">
                <h4 class=' bg-warning'>
                    Hàng mới
                </h4>

            </div>
            <!-- khuyen mai -->
        </div>
    </div>


    <div class="container" style="margin-top:20px">
        <div class="owl-carousel owl-theme">
            <?php
   
      $sql="SELECT * FROM hanghoa ORDER BY daban ASC limit 10 offset 0";
      $ketqua=mysqli_query($conn,$sql);
      while($row=mysqli_fetch_assoc($ketqua)){
        if($row['hienthi']==0){
?>

            <div class="item">

                <div class="row1 product">

                    <a href="chitiet.php?id=<?php echo $row['idhanghoa'];?>" class="text-decoration-none">
                        <div>

                            <img src="./css/img/<?php echo $row['link'];?>" height="170px" width="208px"
                                class="mx-auto d-block" alt="">
                            <p class="text-center" style="  white-space: pre;
                                                        word-wrap: break-word;
                                                            width: 100%;">
                                <?php echo $row['tenhang']?>
                            </p>
                            <p style="color: black;">
                                <?php echo number_format($row['dongia'], 0, ',', '.');?><sub>đ</sub>
                            </p>

                        </div>
                    </a>
                </div>
            </div>
            <?php
    }
}
    ?>


        </div>
    </div>







    <?php
 include ("form.php");
?>



    <script src="./OwlCarousel2-2.3.4/docs/assets/vendors/jquery.min.js" type="text/javascript"></script>
    <script src="./OwlCarousel2-2.3.4/dist/owl.carousel.js" type="text/javascript"></script>
    <script type="text/javascript">
        $('.owl-carousel').owlCarousel({
            loop: true,
            margin: 10,
            nav: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 3
                },
                1000: {
                    items: 5
                }
            }
        })
    </script>
</body>

</html>