<?php
require ('../db/connectiondb.php');
if(isset($_GET["user"])){
  $user=$_GET["user"];
  $sql="SELECT * FROM taikhoan WHERE USERNAME='$user';";
  $query = mysqli_query($conn,$sql);
  $num_rows = mysqli_num_rows($query);
  if($num_rows==0){
    echo 'true';
  }
  else if ($num_rows>0){
    echo 'false';
  }
} ?>
