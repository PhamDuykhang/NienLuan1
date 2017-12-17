<?php
/**
 * Created by PhpStorm.
 * User: pdkhang
 * Date: 12-Sep-17
 * Time: 9:38 PM
 */
if(isset($_POST["submit"])){
    require ('db/connectiondb.php');
    session_start();
    $username = $_POST["use"];
    $pass= $_POST["pass"];
    $username = strip_tags($username);
    $username = addslashes($username);
    $pass = strip_tags($pass);
    $pass = addslashes($pass);
    $passE=md5($pass);
    $sql="SELECT * FROM `taikhoan` WHERE
        `USERNAME` ='$username' AND
        `PASSWORD`= '$passE'";
//    echo $sql;
//    echo '</br>';
    $query = mysqli_query($conn,$sql);
    $num_rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
//    echo $num_rows; echo '</br>';
//    echo $pass;
    if ($num_rows==0){
        echo '<script type="text/javascript">alert("Tài khoản hoặc mật khẩu đã bị sai");</script>';
    } else
    if($row['TRANGTHAI']==0){

       header('Location: Errorpage.php');
    }
    else{
        $id=$row['MACB'];
        $level=$row['CAPDO'];
        $smdv="SELECT `MADV` FROM `canbo` WHERE `MACB` = '$id';";
        $mdvquery = mysqli_query($conn,$smdv);
        $rowmdv = mysqli_fetch_assoc($mdvquery);
        $_SESSION['username']=$username;
        $_SESSION['id'] =$id;
        $_SESSION['level'] =$level;
        $_SESSION['DonVi']=$rowmdv['MADV'];
        $sqlnumberUrl="SELECT Url FROM chucvu WHERE macv =$level";
        $numberUrlResult=mysqli_query($conn,$sqlnumberUrl);
        $url=mysqli_fetch_assoc($numberUrlResult);
        $link=$url["Url"];
        header('Location:'.$link);
    }
}?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="public/css/styleLogin.css">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Login</title>
</head>
<body>
 <div class="container">
    <h1 class="welcome text-center">HỆ THỐNG QUẢN LÝ LƯƠNG</h1>
        <div class="card card-container">
        <br>
        <h3 class='login_title text-center'>Đăng nhập</h3>
        <hr>
            <form class="form-signin" action="login.php" method="POST">
                <span id="reauth-email" class="reauth-email"></span>
                <input type="text" name="use" id="inputEmail" class="form-control" placeholder="Tài khoản" required autofocus>
                <br>
                <input type="password" name="pass" id="inputPassword" class="login_box" placeholder="Mật khẩu" required>
                <button class="btn btn-lg btn-primary" name="submit" type="submit">Đăng nhập</button>
            </form>
        </div>
    </div>
</body>
</html>
