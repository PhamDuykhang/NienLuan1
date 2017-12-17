<?php
if(isset($_POST['btedituser'])){
    require ('../db/connectiondb.php');
    $id=$_POST['id'];
    $pass=md5($_POST['pass']);
    $user=$_POST['user'];
    $updateSQL="UPDATE `taikhoan` SET `PASSWORD`= '$pass' WHERE USERNAME='$user'";
    $result=mysqli_query($conn,$updateSQL);
    if($result){
        $ero=0;
        header('Location: doimatkhau.php?id='.$id.'&eror='.$ero);
    }else {
        $ero=1;
        header('Location: doimatkhau.php?id='.$id.'&eror='.$ero);
    }
}
if(isset($_REQUEST["id"])){
    require ('../db/connectiondb.php');
    $mcb=$_REQUEST["id"];
    $sql=" SELECT taikhoan.USERNAME FROM taikhoan WHERE MACB='$mcb'" ;
    $result=mysqli_query($conn,$sql);
    $taikhoan=mysqli_fetch_array($result);
    $user=$taikhoan["USERNAME"];
}
?>
<?php
    session_start();
    require('../db/paddmin.php');
    $id=$_SESSION['id'];
    require ('../db/connectiondb.php');
    $sql="SELECT canbo.*, donvi.TENDV from canbo, donvi
                        WHERE canbo.MADV=donvi.MADV AND canbo.MACB='$id';";
    $query = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($query);
    $Mnv=$row['MACB'];
    $sname=$row['HOTENCB'];
    $ns=$row['NSCB'];
    $email=$row['EMAIL'];
    $chucvu=$row['CHUCVU'];
    $tendv=$row['TENDV'];

?>
<!DOCTYPE html>
<html>

<head>
    <title>Hệ thống quản lý lương - NK</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../public/css/menustyle.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="../public/css/stylechitiet.css">
    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>

</head>

<body style="background: #FFFFFF; padding: 0px; margin: 0px;">
<div class="Container">
    <div class="row">
        <div id="header">
            <div id="webname"><img src="../public/img/nhanvienlogin/WebName.png" alt="WebName">
                <div id="header_icon">
                    <div id="home" ><a href="../logout.php"><img src="../public/img/nhanvienlogin/thoat.png" style="margin-top: 20px" alt="Thoát"></a></div>
                    <div id="logout" style="margin:0px; padding:0; "><a href="AdminLogin.php"><img src="../public/img/nhanvienlogin/trangchu.png" style="margin: 0px;" alt="Trang chủ"></a></div>
                    <div id="name"><strong style="color: #e0f74f"><?php echo $sname.'  ('. $Mnv.')' ?></strong></div>
                </div>
            </div>
        </div>
    </div>

</div>

<div id="content">
    <div id="menu">
        <ul>
            <li><a href="Listuser.php">Liệt kê</a></li>
            <li><a href="adduser.php">Thêm mới</a></li>
        </ul>
    </div>
    <h3 style="text-align: center">Đổi mật khẩu</h3>
    <div class="row">
        <div class="col-md-1"> </div>
        <div class="col-md-10">
            <?php
            if(isset($_GET['eror'])){
                    $error=$_GET['eror'];
                    if($error==0 ){
                echo '<div class="alert alert-success alert-dismissable">';
                echo    '<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>';
                echo   '<strong>Thành công!</strong> Thay đỗi mật khẩu  thành công';
                echo '</div>';}
                else if($error==1){
                echo ' <div class="alert alert-danger alert-dismissable">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                    <strong>Thêm thất bại!</strong> Có lỗi khi thay đỗi mật khẩu
                  </div>';
            }
            }
            ?>
        </div>
        <div class="col-md-1"> </div>
    </div>
    <form action="doimatkhau.php" method="POST" id="formedditpasss">
        <input type="hidden" name="id" value="<?php echo $mcb; ?>">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4"><div class="form-group">
                    <label for="usr3">Tài khoản</label>
                    <?php echo '<input type="text" name="user" class="form-control" id="usr3" value="'.$user.'" placeholder="Vd:khanga22" readonly>'; ?>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Mật khẩu</label>
                    <input type="password" name="pass" class="form-control" id="exampleInputPassword1" placeholder="Mật khẩu 6 kí tự">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword2">Nhắc lại mật khẩu</label>
                    <input type="password" name="repass" class="form-control" id="exampleInputPassword2" placeholder="Nhập lại mật khẩu ">
                </div>
                <input class="btn btn-success" name="btedituser" type="submit" value="Chỉnh sửa">
                <a href="Listuser.php" class="btn btn-primary">Quay lại </a></div>
            <div class="col-md-4"></div>

        </div>

    </form>

</div>
<div id="footer" style="text-align: center">
    <p>Copyright by Nguyên Khang CIT.CTU.EDU.VN</p>
    <p>Khoa Công nghệ thông tin - Đại học Cần Thơ</p>
</div>
</body>
<script type="text/javascript">
    $(function () {
        var validate= $("#formedditpasss").validate({
            rules :{
                pass : {
                    minlength: 6
                },
                repass :{
                    equalTo: "#exampleInputPassword1",
                }
            },
            messages :{
                pass : {
                    minlength: "Chiều dài mật khẩu tối thiểu 6 ký tự"
                },
                repass:{
                    equalTo : "Mật khẩu xác nhận không chính xác"
                }
            }
        });
    });
</script>
</html>
