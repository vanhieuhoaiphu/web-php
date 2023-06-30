<?php include "sider.php";
    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    if(isset($_POST['them'])){
        $today = date("Y-m-d");
        $noidung=$_POST['mieuta'];
        $sql="INSERT INTO `baiviet`( `noidung`, `ngay`) VALUES ('$noidung','$today')";
        $ketqua=mysqli_query($conn,$sql);
    }
    if(isset($_GET['xoa'])){
      $sql="DELETE FROM `baiviet` WHERE id=". $_GET['xoa'];  
      $ketqua=mysqli_query($conn,$sql);
    }
    ?>
    <style>
        p {
            width: 300px;
            height:200px;
            overflow: hidden;
            text-overflow: ellipsis;
            line-height: 20px;
            -webkit-line-clamp: 5;
            display: -webkit-box;
            -webkit-box-orient: vertical;
        }
    </style>
</head>

<body>

    <script src="http://cdn.ckeditor.com/4.6.2/standard-all/ckeditor.js"></script>
    <form action="" method="POST">
        <textarea name="mieuta" id="mieuta" class="form-control ckeditor" require ></textarea>
        <script>
            CKEDITOR.replace('mieuta', {
                height: 600,width:1000,
                filebrowserUploadUrl: "upload.php"
            });
        </script>
        <input type="submit" value="Thêm bài viết" name='them'>
    </form>
   

</body>

</html>