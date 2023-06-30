<?php
$conn = mysqli_connect("localhost", "root", "", "banhang2020");
 if ($_SERVER[ "REQUEST_METHOD"] == "POST"){
    $tenhang = $_POST['tenhang'];
     $soluong= $_POST['soluong']; 
     $dongia =$_POST['dongia'];
     
     if(!empty($_POST['iddanhmuc'])){
        
        $iddanhmuc = $_POST['iddanhmuc'];
     $mieuta=$_POST['mieuta'];
  
  
        // Upload file
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
       
      
    $sql = "INSERT INTO hanghoa(tenhang, soluong, dongia, iddanhmuc , link,link2, mieuta,daban) VALUES('$tenhang', $soluong, $dongia, $iddanhmuc, '$link','$xau', '$mieuta',0)";
    $ketqua = mysqli_query($conn, $sql);
    
 }
} 
?>
<html>

<head>

    <script src="//cdn.ckeditor.com/4.15.0/standard/ckeditor.js"></script>
</head>

<body>
    <?php include 'sider.php';?>
    <div class="container" style="margin-top:50px">

        <center>

            <h1>Thêm Hàng hóa</h1>
            <form method="post" enctype="multipart/form-data" action="">
                <div class="container">
                    <center>
                        <table class="table  table-hover">
                            <tr>
                                <td>
                                    Tên Mặt hàng:
                                </td>
                                <td><input type="text" name="tenhang" size="60" require></td>
                            </tr>
                            <tr>
                                <td>
                                    Số lượng:
                                </td>
                                <td><input type="number" name="soluong" min="1" require></td>
                            </tr>
                            <tr>
                                <td>
                                    Đơn giá:
                                </td>
                                <td><input type="number" name="dongia" min="1" require></td>
                            </tr>
                            <tr>
                                <td>
                                    Danh mục:
                                </td>
                                <td>
                                    <select name="iddanhmuc">
                                        <?php
$sql = "SELECT * FROM danhmuc"; 
$ketqua = mysqli_query($conn, $sql); 
while ($row = mysqli_fetch_assoc($ketqua)){
    echo '<option value="'.$row[ 'iddanhmuc'].'">' .$row['tendanhmuc'].'</option>';
}
?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Miêu tả chi tiết
                                </td>
                                <td>
                                    <textarea name="mieuta" id="mieuta" require></textarea>
                                    <script>CKEDITOR.replace('mieuta');</script>
                                </td>
                            </tr>
                            <tr>
                                <td>Link:</td>
                                <td><input type="file" name="link[]" id="" multiple>

                                </td>
                            </tr>
                        </table>




                        <input type="submit" class="btn btn-primary" value="Thêm">
                    </center>
                </div>
        </center>
    </div>

    </form>
</body>

</html>