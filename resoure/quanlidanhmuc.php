<?php include("sider.php"); ?>
<html>

<head>
  <style>
    .service {

      box-shadow: 0px 1px 5px 2px rgb(178, 178, 241);
      margin: 10px;

    }
  </style>

  <?php
 $conn = mysqli_connect("localhost", "root", "", "banhang2020");
if (isset($_POST['themdanhmuc'])){

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
    // Upload file
    move_uploaded_file($_FILES['link']['tmp_name'], 'css/img/'.$_FILES['link']['name']);
    $link=($_FILES['link']['name']) ;
    $sql = "INSERT INTO danhmuc(tendanhmuc,link) VALUES('".$_POST['tendanhmuc']."','$link')"; 
    $ketqua = mysqli_query($conn, $sql);
   
}
}
?>
</head>

<body>
  <div class="container service">

    <center>
      <form style="margin-top:50px;margin-bottom:30px" action="" method="POST" enctype="multipart/form-data">
        Tên danh mục: <input type="text" name="tendanhmuc"> <br>
        <input type="file" name="link" id=""><br>
        <input type="submit" value="Thêm Danh mục" name="themdanhmuc" class="btn btn-warning">
      </form>
    </center>

    <table class="table table-bordered table-hover text-center" style="width:1100px">
      <thead>
        <tr>
          <td>
            Tên
          </td>
          <td>
            Ảnh
          </td>
          <td>
            Sửa/Xóa
          </td>
        </tr>
      </thead>
      <tbody>
        <?php
       $sql="SELECT * FROM danhmuc";
       $ketqua=mysqli_query($conn,$sql);
       while($row=mysqli_fetch_assoc($ketqua)){
           ?>
        <tr>
          <td>
            <?php echo $row['tendanhmuc'];?>
          </td>
          <td><img src="./css/img/<?php echo $row['link'];?>" style="width:100px;height:100px" alt=""></td>
          <td><a href="xulidanhmuc.php?xoa=<?php echo $row['iddanhmuc'];?>" class="btn btn-danger">Xóa</a>
            <a href="xulidanhmuc.php?sua=<?php echo $row['iddanhmuc'];?>" class="btn btn-danger">Sửa</a>
          </td>
        </tr>
        <?php
       }
       ?>
      </tbody>
    </table>

  </div>
</body>

</html>