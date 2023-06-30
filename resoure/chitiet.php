<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./css/chitiet.css">
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="./OwlCarousel2-2.3.4/dist/assets/owl.carousel.min.css">
  <link rel="stylesheet" href="./OwlCarousel2-2.3.4/dist/assets/owl.theme.default.min.css">
  <style>
    .container1::before {
      display: table;
      content: "";
      border-top: 1px solid #0f9ed8;
      width: 100%;
      position: absolute;
      top: 50%;

    }

    .container1 {
      text-align: center;
      padding: 20px 0;
      position: relative;
    }

    .container1 p {
      font-size: 24px;
      background: #fff;
      position: absolute;
      padding: 0 20px;
      color: #0f9ed8;
      margin-top: -20px;
      margin-left: 500px;
    }
  </style>

</head>

<body>
  <div class="body">
    <?php
include 'menu.php';
include 'danhmuc.php';

   ?>
    <?php if(isset($_POST['muahang'])){
                if(isset($_SESSION['tendangnhap'])){
                if(isset($_POST['soluong'])){  
               $tendangnhap= $_SESSION['tendangnhap'];
               $today = date("Y-m-d");
               $sql="SELECT dongia FROM hanghoa where idhanghoa=".$_GET['id'];
               $ketqua=mysqli_query($conn,$sql);
               $row=mysqli_fetch_assoc($ketqua);
                $tongTien=$_POST['soluong']*$row['dongia'];
               $sql="INSERT INTO hoadon( `tendangnhap`, `ngay`, `tongtien`,xacnhan) VALUES('$tendangnhap','$today','$tongTien',0);";   
               $ketqua=mysqli_query($conn,$sql);
               $row1= mysqli_insert_id($conn);


              //  tru so hang
               $sql="SELECT * FROM hanghoa WHERE idhanghoa=".$_GET['id'];
               $ketqua=mysqli_query($conn,$sql);
               while($row2=mysqli_fetch_assoc($ketqua)){
                $sql="INSERT INTO chitiet( idhoadon, idhanghoa, dongia,soluong) values($row1,$row2[idhanghoa],$row2[dongia],".$_POST['soluong'].")";
                $sqlhh="SELECT  `soluong` FROM `hanghoa` WHERE idhanghoa=".$row2['idhanghoa'];
                $ketqua1=mysqli_query($conn,$sqlhh);
                $rowhh=mysqli_fetch_assoc($ketqua1);
                $soluong=$rowhh['soluong']-$_POST['soluong'];
                $daban=$_POST['soluong'];
                $sql1="UPDATE hanghoa SET soluong=$soluong,daban=$daban WHERE idhanghoa=".$row2['idhanghoa'];
                $ketqua1=mysqli_query($conn,$sql);
                $ketqua1=mysqli_query($conn,$sql1);
              }
              ?>
    <?php
            } else{ $hienthi="Hàng hóa không còn";}
            } 
            }
          if(isset($_GET['sao'])){
            $sql="SELECT danhgia , soluongdanhgia  FROM hanghoa where idhanghoa=".$_GET['id'];
            $ketqua=mysqli_query($conn,$sql);
            $row=mysqli_fetch_assoc($ketqua);
            
            $row['danhgia']=$row['danhgia']*$row['soluongdanhgia']+$_GET['sao'];
            $row["soluongdanhgia"]++;
            $row['danhgia']/=$row['soluongdanhgia'];
            $sao= $row['danhgia'];
            $soluongdanhgia= $row["soluongdanhgia"];
            $sql="UPDATE `hanghoa` SET `danhgia`=$sao,`soluongdanhgia`=$soluongdanhgia WHERE idhanghoa=". $_GET['id'];
            $ketqua=mysqli_query($conn,$sql);
          }
            ?>


    <!--Modal: modalConfirmDelete-->

    <!-- them hang vao gio -->
    <?php 
    $conn = mysqli_connect("localhost", "root", "", "banhang2020");
    $sql = "SELECT * FROM hanghoa WHERE idhanghoa=".$_GET['id'];
    $ketqua = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($ketqua);
    $chitiet=$row['mieuta'];
  
    if(isset($_POST['themhang'])){
      if(isset($_POST['soluong'])){
        if( !isset($_SESSION['giohang'][$_GET['id']])){
          $_SESSION['giohang'][$_GET['id']]=$_POST['soluong'];
      }else{
         $_SESSION['giohang'][$_GET['id']]+=$_POST['soluong'];
      }
     $hienthi="Thêm hàng thành công";

     
    } else{
      $hienthi="Hàng đã hết";
    }  
    ?>
    <div class="modal fade" id="modalConfirmDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
      aria-hidden="true">
      <div class="modal-dialog modal-sm modal-notify modal-danger" role="document">
        <!--Content-->
        <div class="modal-content text-center">
          <!--Header-->
          <div class="modal-header d-flex justify-content-center">
            <p class="heading">
              <?php echo $hienthi;?>
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
    <!-- binh luan -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>
      $(document).ready(function () {

        $("#guibinhluan").click(function () {

          var url_string = window.location.href;

          var url = new URL(url_string);
          var idsp = url.searchParams.get("id");

          var txt = $("#noidungbinhluan").val();

          $.post("xulybinhluan.php", { noidung: txt, idsach: idsp }, function (result) {
            $("#dsbinhluan").append('<hr>' + txt);
          });

        });
      });
    </script>


    <!--Modal: modalConfirmDelete-->
    <!-- img san pham -->
    <form action="" method="POST">
      <div class="container">
        <div class="row">
          <div class="col colchitiet">
            <img id="view" src="./css/img/<?php echo $row['link'];?>" alt="">
            <center>
              <div>
                <?php 
                 $arr=explode("   ", $row['link2']);
                 for($i=0;$i<count($arr)-1;$i++){
                  ?>
                <img class="imgview" onmouseover="bigImg(this)" src="./css/img/<?php echo $arr[$i];?>" alt="">
                <?php
                 }
                 ?>

                <script>
                  function bigImg(x) {
                    document.getElementById("view").src = x.getAttribute('src');
                  }  
                </script>

              </div>
            </center>
          </div>
          <div class="col colchitiet">
            <h2>
              <?php echo $row['tenhang'];?>
            </h2>
            <div class="container">
              <div class="row ">
                <div style="margin-left:30px">
                  <?php echo $row['danhgia'];?> <i class="fas fa-star"></i>

                  <p>Đã bán(
                    <?php echo $row['daban'];?>) Đánh giá (
                    <?php echo $row['soluongdanhgia'];?>)
                  </p>
                </div>
              </div>
              <hr>
              <center>
                <p style="color:red; background-color:rgb(235, 225, 225);">
                  <?php $dongia=$row['dongia']; echo number_format($row['dongia'], 0, ',', '.');?><sup>Đ</sup>
                </p>
              </center>
              <hr>





              <div class="row">
              </div>
              <div class="row">
                <div class="col">
                  <h4>Chọn số lượng mua</h4>
                </div>
              </div>
              <?php
            if($row['soluong']>0){
        ?>
              <input type="number" class="form-control form1" name="soluong" min='1' value='1'
                max="<?php echo $row['soluong'];?>">
              <p>Số lượng sản phẩm có sẵn
                <?php echo $row['soluong'];?>
              </p>
              <?php
            }
        ?>
              <br>
              <center>
                <?php
         if(isset($_SESSION['tendangnhap'])){
             ?>
                <input class="btn btn-danger" type="submit" value="Mua hàng" name="muahang">
                <?php
         }
         else{
             ?>
                <input type="button" class="btn btn-primary" data-toggle="modal" data-target="#muahang" value="Mua hàng"
                  style="margin-top:-20px">
                <?php
         }
           ?>
                <input type="submit" class="btn btn-primary" name="themhang" value="Thêm hàng">

                <!-- mua hang -->




                <div class="modal fade" id="muahang" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                  aria-hidden="true">


                  <div class="modal-dialog modal-sm modal-notify modal-danger" role="document">
                    <!--Content-->
                    <div class="modal-content text-center">
                      <!--Header-->
                      <div class="modal-header d-flex justify-content-center">
                        <p class="heading">Đăng nhập để mua hàng</p>
                      </div>

                      <!--Body-->
                      <div class="modal-body">
                        <form action="" action="POST">

                          <div class="modal-footer flex-center">
                            <input type="submit" class="btn  btn-danger waves-effect" value="Yes">
                            <input type="submit" class="btn  btn-danger waves-effect" value="No">
                          </div>
                        </form>



                      </div>

                      <!--Footer-->

                    </div>
                    <!--/.Content-->

                  </div>
                  <!-- Modal Header -->


                  <!-- Modal body -->


                  <!-- Modal footer -->



                </div>





              </center>
            </div>
          </div>
        </div>
      </div>
    </form>



    <!-- san pham cung loai -->
    <div class="container colchitiet">

      <div class="container" style="margin-bottom:50px; ">
        <center>
          <h2 style="margin-top:20px !important; padding-top:20px !important">Sản phẩm cùng loại</h2>
        </center>
        <div class="owl-carousel owl-theme">
          <?php
      $conn=mysqli_connect("localhost","root","","banhang2020");
      $sql="SELECT * FROM `hanghoa` WHERE iddanhmuc=(SELECT iddanhmuc FROM hanghoa where idhanghoa=$_GET[id]) LIMIT 10 OFFSET 0";
      $ketqua=mysqli_query($conn,$sql);
      while($row=mysqli_fetch_assoc($ketqua)){
        $iddanhmuc=$row['iddanhmuc'];
?>

          <div class="item">

            <div class="row1 col1">

              <a href="chitiet.php?id=<?php echo $row['idhanghoa'];?>" class="text-decoration-none">
                <div>

                  <img src="./css/img/<?php echo $row['link'];?>" height="170px" width="208px" class="mx-auto d-block"
                    alt="">
                  <p class="text-center" style="     white-space: nowrap;
                        text-overflow: ellipsis;
                        overflow: hidden;
                        width: 100%;
                        border: 1px solid rgb(255, 255, 255);">
                    <?php echo $row['tenhang']?>
                  </p>


                </div>
              </a>
            </div>
          </div>
          <?php
    }
    ?>


        </div>
      </div>
    </div>

    <!-- mo ta chi tiet -->

    <div class="container">

    </div>


    <div class="container ">

      <div class="row">

        <div class="col colchitiet">
          <div class="container1">
            <p>Chi tiết sản phẩm</p>
          </div>

          <br>
          Danh mục:
          <?php 
     $sql = "SELECT * FROM danhmuc WHERE iddanhmuc=".$iddanhmuc;
     $ketqua = mysqli_query($conn, $sql);
     $row = mysqli_fetch_assoc($ketqua); 
     echo $row["tendanhmuc"];
    ?>
          <h4>Mô tả sản phẩm</h4><br>
          Mô tả chi tiết: <p class="text-justify">
            <?php echo $chitiet;?>
          </p>

          <a href="?id=<?php echo $_GET['id'];?>&&sao=5" class="btn">5<i class="fas fa-star"></i></a>
          <a href="?id=<?php echo $_GET['id'];?>&&sao=4" class="btn">4<i class="fas fa-star"></i></a>
          <a href="?id=<?php echo $_GET['id'];?>&&sao=3" class="btn">3<i class="fas fa-star"></i></a>
          <a href="?id=<?php echo $_GET['id'];?>&&sao=2" class="btn">2<i class="fas fa-star"></i></a>
          <a href="?id=<?php echo $_GET['id'];?>&&sao=1" class="btn">1<i class="fas fa-star"></i></a>
        </div>

      </div>

    </div>


    <!-- binh luan -->

    <?php
  if(isset($_SESSION['quyenhang'])){
      ?>
    <div class="container">
      <div class="row">
        <div class="col">
          <textarea name="noidungbinhluan" id="noidungbinhluan" cols="50" rows="5" class="form-control"></textarea>
        </div>
        <div class="col">
          <input type="submit" value="Gửi" id="guibinhluan" class="btn btn-danger">
        </div>
      </div>


    </div>
    <?php
  }
  ?>
    <div class="container">
      <div class="row colchitiet">

        <?php

        $sql="SELECT * FROM binhluan where idhanghoa=".$_GET['id'];
        $ketqua1=mysqli_query($conn,$sql);
        if(mysqli_num_rows($ketqua)>0){
        while($dong=mysqli_fetch_assoc($ketqua1)){
          ?>
        <div class="container">
          <p style="color:black; "><i class="fas fa-table"></i>
            <?php echo $dong['ngay']."    ".$dong['tendangnhap'];?>
          <p>
          <div style="margin-top:30px;margin-left:30px">
            <?php echo $dong['noidung'];?>
          </div>
          <br>
        </div>
        <?php    }
    }
        ?>

      </div>


    </div>

    <div class="container">
      <div class="row">
        <div id="dsbinhluan" class="col colchitiet">

        </div>
      </div>
    </div>

  </div>


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


  <?php include 'form.php';
    ?>

</body>

</html>