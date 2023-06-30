<?php include("sider.php");
 ?>
<html>

<head>

  <?php
if (isset($_GET['hienthi']))
{
    $sql = "UPDATE `hanghoa` SET `hienthi`=". $_GET['hienthi']." WHERE idhanghoa=". $_GET['id'] ;
    $ketqua = mysqli_query($conn, $sql); 
  header("Location: quanlisp.php?id=". $_GET['iddm']."&&page=". $_GET['page']);
 }
if(isset($_POST['submit'])){

$tenhang=$_POST['tenhang'];
$soluong=$_POST['soluong'];
$dongia=$_POST['dongia'];
  $iddanhmuc=$_POST['iddanhmuc'];
$mieuta=$_POST['mieuta'];
$total = count($_FILES['link']['name']);
$xau="";
// Loop through each file
for( $i=0 ; $i < $total ; $i++ ) {
$link=$_FILES['link']['name'][0] ;
//Get the temp file path
$tmpFilePath = $_FILES['link']['tmp_name'][$i];

//Make sure we have a file path
if ($tmpFilePath != ""){
//Setup our new file path
$newFilePath = "./css/img/" . $_FILES['link']['name'][$i];

$xau.=$_FILES['link']['name'][$i]."   ";

//Upload the file into the temp dir
move_uploaded_file($tmpFilePath, $newFilePath);
}
}
if(empty($link)){
  $sql = "UPDATE  hanghoa SET tenhang='$tenhang' , soluong=$soluong  ,dongia=$dongia, iddanhmuc=$iddanhmuc,mieuta='$mieuta' WHERE idhanghoa=".$_GET['sua'];
}
else{
  $sql = "UPDATE  hanghoa SET tenhang='$tenhang' , soluong=$soluong  ,dongia=$dongia, iddanhmuc=$iddanhmuc, link='$link' ,link2='$xau' ,mieuta='$mieuta' WHERE idhanghoa=".$_GET['sua'];
}
 
  $ketqua = mysqli_query($conn, $sql);

  
 

}
?>

  <script src="http://cdn.ckeditor.com/4.6.2/standard-all/ckeditor.js"></script>
</head>

<body>


  <h1>Sửa Hàng hóa</h1>



  <form action="" method="POST" enctype="multipart/form-data">
    <?php

 if (isset($_GET['sua']))
 {
     $sql = "SELECT * FROM hanghoa WHERE idhanghoa=".$_GET['sua'] ;
     $ketqua = mysqli_query($conn, $sql); 
    $row1 = mysqli_fetch_assoc($ketqua); 
  }
    ?>
    <div class="container">
      <center>
        <table class="table">
          <tr>
            <td>
              Tên Mặt hàng:

              <input type="text" name="tenhang" value="<?php echo $row1['tenhang']; ?>" size="50">
            </td>
          </tr>
          <tr>
            <td>
              Số lượng:

              <input type="text" name="soluong" value="<?php echo $row1['soluong']; ?>">
            </td>
          </tr>
          <tr>
            <td>
              Đơn giá:

              <input type="text" name="dongia" value="<?php echo $row1['dongia']; ?>">
            </td>
          </tr>
          <tr>
            <td>
              Danh mục:

              <select name="iddanhmuc">
                <?php
 $sql = "SELECT * FROM danhmuc where iddanhmuc=".$row1['iddanhmuc'];
 $ketqua = mysqli_query($conn, $sql);
 $row = mysqli_fetch_assoc($ketqua);
 echo '<option value="'.$row['iddanhmuc'].'" '.$selected.'>' .$row['tendanhmuc'].'</option>';
$sql = "SELECT * FROM danhmuc";
 $ketqua = mysqli_query($conn, $sql);
  while ($row = mysqli_fetch_assoc($ketqua))
{
if($row['iddanhmuc']!=$row1['iddanhmuc']){
  echo '<option value="'.$row['iddanhmuc'].'" '.$selected.'>' .$row['tendanhmuc'].'</option>';
}
 
}
 ?>
              </select>
            </td>
          </tr>
          <tr>
            <td>
              <textarea name="mieuta" id="mieuta" class="form-control ckeditor"><?php echo $row1['mieuta'];?></textarea>
              <script>
                CKEDITOR.replace('mieuta', {
                  height: 300,
                  filebrowserUploadUrl: "upload.php"
                });
              </script>
            </td>
          </tr>
          <tr>
            <td>
              <div class="container">
                <div class="row">
                  <?php
      $arr=explode("   ", $row1['link2']);
                 for($i=0;$i<count($arr)-1;$i++){
                  ?>
                  <img class="imgview" height="100px" width="100px" src="./css/img/<?php echo $arr[$i];?>" alt="">
                  <?php
                 }
                 ?>
                </div>
                <input type="file" name="link[]" id="" multiple>
              </div>
            </td>
          </tr>

        </table>
        <input type="submit" name='submit' class="btn btn-primary" value="Sửa">
      </center>
    </div>






  </form>

</body>

</html>