<?php
  require ('../db/connectiondb.php');
  if(isset($_GET["ma_nhan_vien"])){
    $manv=$_GET["ma_nhan_vien"];
    $sql="SELECT * FROM taikhoan WHERE MACB='$manv';";
    $query = mysqli_query($conn,$sql);
    $num_rows = mysqli_num_rows($query);
    if($num_rows==0){
      echo 'true';
    }
    else if ($num_rows>0){
      echo 'false';
    }
  }
if(isset($_GET["congviec"])){
  $cv=$_GET["congviec"];
  $sql="SELECT * FROM chucvu WHERE TenChucVu='$cv';";
    $query = mysqli_query($conn,$sql);
    $num_rows = mysqli_num_rows($query);
    if($num_rows==0){
        echo 'true';
    }
    else if ($num_rows>0){
        echo 'false';
    }
}
if(isset($_GET["donvi"])){
    $dv=$_GET["donvi"];
    $sql="SELECT * FROM donvi WHERE TENDV='$dv';";
    $query = mysqli_query($conn,$sql);
    $num_rows = mysqli_num_rows($query);
    if($num_rows==0){
        echo 'true';
    }
    else if ($num_rows>0){
        echo 'false';
    }
}
if(isset($_GET["madonvi"])){
    $mdv=$_GET["madonvi"];
    $sql="SELECT * FROM donvi WHERE MADV='$mdv';";
    $query = mysqli_query($conn,$sql);
    $num_rows = mysqli_num_rows($query);
    if($num_rows==0){
        echo 'true';
    }
    else if ($num_rows>0){
        echo 'false';
    }
}
 ?>
