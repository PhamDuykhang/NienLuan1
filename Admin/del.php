<?php
/**
 * Created by PhpStorm.
 * User: pdkhang
 * Date: 06-Oct-17
 * Time: 7:14 PM
 */
require ('../db/connectiondb.php');
$id=$_GET['id'];
$delsqltk="DELETE FROM `taikhoan` WHERE MATK=$id;";
$delsqlCB="DELETE FROM `canbo` WHERE MACB=$id;";
    if(mysqli_query($conn,$delsqltk) AND mysqli_query($conn,$delsqlCB) ){
        echo '<script type="text/javascript">alert("Tài khoảng đã được xóa");</script>';
    }
    else{
        echo mysqli_error($conn); echo '</br>';
    }
    header('Location: Listuser.php');?>
