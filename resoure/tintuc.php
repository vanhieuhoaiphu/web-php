<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
      
    </style>
</head>

<body>
    <?php
    include "menu.php";
    include "danhmuc.php";
    ?>
    <div class="container">
        <div class="row">

            <?php 
            $dem=0;
            if(isset($_GET['id']) ){
                $sql="SELECT * FROM `baiviet` where id=". $_GET['id'];
            }
            else{
                $sql="SELECT * FROM `baiviet` ";
            }
           
$ketqua=mysqli_query($conn,$sql); 
while($row=mysqli_fetch_assoc($ketqua)){
    if($dem==0){
    ?>

<div class="container">
<center>
            <?php echo $row['noidung'];?>
            </div>
            </center>
            <?php $dem++;
} else{
    ?>
            <div class="row service">
                <a href="?id=<?php echo $row['id'];?>">
                    <p>
                        <?php echo $row['noidung'];?>
                    </p>
                </a>
            </div>

            <?php }
}
?>

        </div>


    </div>
</body>
<?php
include "form.php";
?>
</html>