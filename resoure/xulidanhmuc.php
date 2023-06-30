<?php
include 'sider.php';
  $conn=mysqli_connect("localhost","root","","banhang2020"); 
 if(isset($_POST['submit'])){
  if ($_FILES['link']['error'] > 0)
  {
      ?>
<div class="con">

  <div class="modal fade" id="modalConfirmDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-sm modal-notify modal-danger" role="document">
      <!--Content-->
      <div class="modal-content text-center">
        <!--Header-->

        <div class="modal-header d-flex justify-content-center">

          <p class="heading">Lỗi file</p>

        </div>

        <!--Body-->
        <div class="modal-body">

          <i class="fas fa-times fa-4x animated rotateIn"></i>

        </div>

        <!--Footer-->
        <div class="modal-footer flex-center">
          <a href=""> <input type="submit" value="Yes" class="btn  btn-outline-danger"> </a>

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
  else{
  move_uploaded_file($_FILES['link']['tmp_name'], 'css/img/'.$_FILES['link']['name']);
  $link=($_FILES['link']['name']) ;
  $tendanhmuc=$_POST['tendanhmuc'];

  $sql="UPDATE `danhmuc` SET `tendanhmuc`='$tendanhmuc',`link`='$link' WHERE iddanhmuc=".$_GET['sua'];
  $ketqua=mysqli_query($conn,$sql);
 }

 }

if(isset($_GET['xoa'])){
  $sql="SELECT * FROM `hanghoa` WHERE iddanhmuc=".$_GET['xoa'];
  $ketqua=mysqli_query($conn,$sql);
  
  while($row=mysqli_fetch_assoc($ketqua)){
 
    $sql1="DELETE FROM `binhluan` WHERE idhanghoa=".$row['idhanghoa'];
    $ketqua1=mysqli_query($conn,$sql1);
  }
  $sql="DELETE FROM `hanghoa` WHERE iddanhmuc=".$_GET['xoa'];
  $ketqua=mysqli_query($conn,$sql);

    $sql="DELETE FROM `danhmuc` WHERE iddanhmuc=".$_GET['xoa'];
    $ketqua=mysqli_query($conn,$sql);
  header("location: quanlidanhmuc.php");
} 

if(isset($_GET['sua'])){
  $sql="select *from danhmuc where iddanhmuc=".$_GET['sua'];
  $ketqua=mysqli_query($conn,$sql);
  $row=mysqli_fetch_assoc($ketqua);
  ?>
  <div class="container">
    <h2>Sửa danh mục</h2>
    <form action="" enctype="multipart/form-data" method="post">
      Name: <input type="text" name="tendanhmuc" id="" value="<?php echo $row['tendanhmuc'];?>">
      Ảnh <div class="container">
        <img src="./css/img/<?php echo $row['link'];?>" height="100px" width="100px" alt="">
        <input type="file" name="link" id="" multiple>
      </div>
      <input type="submit" value="Cập nhật" name='submit' class="btn btn-primary">
    </form>
  </div>
  <?php
}
    ?>