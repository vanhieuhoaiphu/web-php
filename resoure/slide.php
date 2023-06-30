<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php 
        include 'sider.php';
    if(isset($_GET['xoa'])){
        $sql="DELETE FROM `slide` WHERE id=". $_GET['xoa'];
        $ketqua = mysqli_query($conn, $sql);
    }
    ?>
    <style>
        .service {

            box-shadow: 0px 1px 5px 2px rgb(178, 178, 241);
            margin: 10px;

        }
    </style>
</head>

<body>
    <div class="container service">

        <?php

    if (isset($_POST['tendanhmuc'])){

        if ($_FILES['link']['error'] > 0)
        {
            echo 'File Upload Bị Lỗi';
        }
        else{
            // Upload file
            move_uploaded_file($_FILES['link']['tmp_name'], 'css/img/'.$_FILES['link']['name']);
            $link=($_FILES['link']['name']) ;
            $conn = mysqli_connect("localhost", "root", "", "banhang2020");
            $sql = "INSERT INTO slide(link, name) VALUES('$link','".$_POST['tendanhmuc']."')"; 
            $ketqua = mysqli_query($conn, $sql);
        }
        }
    ?>
        <center>
            <form style="margin-top:50px;margin-bottom:30px" action="" method="POST" enctype="multipart/form-data">
                Miêu tả: <input type="text" name="tendanhmuc">
                <input type="file" name="link" id="">
                <input type="submit" class="btn btn-warning" value="Thêm Danh mục">
            </form>
        </center>
        <table class="table table-bordered table-hover text-center" style="width:1100px">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Ảnh</th>
                    <th scope="col">Miêu tả</th>
                    <th scope="col">Sửa/Xóa</th>

                </tr>
            </thead>
            <tbody>
                <?php
          $sql="SELECT * FROM `slide`";
          $ketqua = mysqli_query($conn, $sql);
          while($row=mysqli_fetch_assoc($ketqua)){
            echo "<tr><td>".$row['id']."</td>";
            echo "<td><img src=./css/img/".$row['link']." width=100px></td>";
            echo "<td>".$row['name']."</td>";
echo "<td><a class='btn btn-danger' href=?xoa=".$row['id'].">Xóa</a></td>";
          }
          ?>
    </div>
</body>

</html>