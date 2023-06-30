<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="//cdn.ckeditor.com/4.15.0/standard/ckeditor.js"></script>
</head>

<body>
  <?php include "sider.php";
    ?>

  <!-- ajax -->




  <div class="container" style="margin-top:50px">
    <div class="row">
      <div class="col">
        <?php
     $conn=mysqli_connect("localhost","root", "","banhang2020");
     $sql="SELECT *FROM binhluan where id=".$_GET['id'];
     $ketqua=mysqli_query($conn,$sql);
     $comment="";
     while($row=mysqli_fetch_assoc($ketqua)){
     
         $sql1="SELECT tenhang, link from hanghoa where idhanghoa=".$row['idhanghoa'];
         $ketqua1=mysqli_query($conn,$sql1);
         $row1=mysqli_fetch_assoc($ketqua1);
         echo 'Tên hàng: <p>'.$row1['tenhang'].'<br><img src="./css/img/'.$row1['link'].'" alt=""></p>';
         ?>
        <div class="container">
          <p style="color:black; "><i class="fas fa-table"></i>
            <?php echo $row['ngay']."    ".$row['tendangnhap'];?>
          <p>
          <div style="margin-top:30px;margin-left:30px">
            <?php echo $row['noidung'];?>
          </div>
        </div>
        <?php   $comment.=$row['noidung']; }
    ?>
        <div id="dsbinhluan">
        </div>
      </div>
      <div class="col">
        <form action="" method="post">
          <textarea name="noidungbinhluan" id="noidungbinhluan" value=></textarea>
          <script>CKEDITOR.replace('noidungbinhluan');</script>
          <input type="submit" value="COMMENT" name="comment" id="guibinhluan" class="btn btn-danger">
        </form>
      </div>
    </div>
  </div>
  <?php
      if(isset($_POST['comment'])){
          $today=date("Y-m-d");
          $comment.='<p style="margin-top:30px;margin-left:60px">'.$today.' @admin'.$_POST['noidungbinhluan'].'</p>';
          $sql="UPDATE `binhluan` SET `noidung`='$comment' WHERE id=".$_GET['id'];
          $ketqua=mysqli_query($conn,$sql);
      }
      ?>

</body>

</html>