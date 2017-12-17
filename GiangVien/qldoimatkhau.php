<?php
    session_start();

if(isset($_POST['btchangepass'])){
        require ('../db/connectiondb.php');
        $taikhoan=$_POST['user'];
        $oldpassword=md5($_POST['oldpass']);
        $newpassword=md5($_POST['newpass']);
        $sqlcheckpass="SELECT * FROM taikhoan WHERE USERNAME= '$taikhoan' AND PASSWORD= '$oldpassword';";
        $query = mysqli_query($conn,$sqlcheckpass);
        $num_rows = mysqli_num_rows($query);
        $error=0;
        if($num_rows==0){
            $error=2;
        } else if($num_rows>0){
            $sqlchangpass="UPDATE taikhoan SET PASSWORD ='$newpassword',NgayUpDate= CURRENT_DATE 
            WHERE USERNAME= '$taikhoan' ";
            if($querychangpass=mysqli_query($conn,$sqlchangpass)){
                $error=0;
            }else{
                $error=1;
            }
        }

    header('Location: doimatkhau.php?eror='.$error);
    }


    $id=$_SESSION['id'];
    $mdv=$_SESSION['DonVi'];
    require ('../db/connectiondb.php');
    $sql="SELECT canbo.*, donvi.TENDV,taikhoan.USERNAME from canbo, donvi,taikhoan
            WHERE canbo.MADV=donvi.MADV AND taikhoan.MACB=canbo.MACB AND canbo.MACB='$id';";
    $query = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($query);
    $Mnv   = $id;
    $name=$row['HOTENCB'];
    $ns=$row['NSCB'];
    $email=$row['EMAIL'];
    $chucvu=$row['CHUCVU'];
    $tendv=$row['TENDV'];
    $taikhoan=$row['USERNAME'];
/////
///
//

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
</head>
<body style="background: #FFFFFF; padding: 0px; margin: 0px;">
<div class="Container">
    <div class="row">
        <div id="header">
            <div id="webname"><img src="../public/img/nhanvienlogin/WebName.png" alt="WebName">
                <div id="header_icon">
                    <div id="home" ><a href="../logout.php"><img src="../public/img/nhanvienlogin/thoat.png" style="margin-top: 20px" alt="Thoát"></a></div>
                    <div id="logout" style="margin:0px; padding:0; "><img src="../public/img/nhanvienlogin/trangchu.png" style="margin: 0px;" alt="Trang chủ" onclick="window.history.back();"></div>
                    <div id="name"><strong style="color: #e0f74f"><?php echo $name.'  ('. $Mnv.')' ?></strong></div>                    </div>
            </div>
        </div>
    </div>
</div>
</div>
<div id="content">
    <div id="menu">
        <ul>
            <li><a href="#"></a></li>
            <li><a href="#"></a></li>
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
                    echo   '<strong>Thành công!</strong> Thay đổi mật khẩu  thành công';
                    echo '</div>';}
                else if($error==1){
                    echo ' <div class="alert alert-danger alert-dismissable">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                    <strong>Đổi mật khẩu thất bại!</strong> Có lỗi khi thay đổi mật khẩu
                  </div>';
                }else if($error==2){
                    echo ' <div class="alert alert-danger alert-dismissable">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                    <strong>Đổi mật khẩu thất bại!</strong> Nhập sai mật khẩu
                  </div>';
                }
            }
            ?>
        </div>
        <div class="col-md-1"> </div>
    </div>
    <form action="doimatkhau.php" method="POST" id="formedditpasss">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4"><div class="form-group">
                    <label for="usr3">Tài khoản</label>
                    <?php echo '<input type="text" name="user" class="form-control" id="usr3" value="'.$taikhoan.'" placeholder="Vd:khanga22" readonly>'; ?>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Mật khẩu cũ</label>
                    <input type="password" name="oldpass" class="form-control" id="exampleInputPassword1" placeholder="Mật khẩu 6 kí tự">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword2">Mật khẩu mới</label>
                    <input type="password" name="newpass" class="form-control" id="exampleInputPassword2" placeholder="Nhập lại mật khẩu ">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword3">Nhắc lại mật khẩu</label>
                    <input type="password" name="renewpass" class="form-control" id="exampleInputPassword3" placeholder="Nhập lại mật khẩu ">
                </div>
                <input class="btn btn-success" name="btchangepass" type="submit" value="Đổi mật khẩu">
                <a href="QLlogin.php" class="btn btn-primary">Quay lại </a></div>
            <div class="col-md-4"></div>

        </div>

    </form>


</div>

<div id="footer" style="text-align: center">
    <p>Copyright by Nguyên Khang CIT.CTU.EDU.VN</p>
    <p>Khoa Công nghệ thông tin - Đại học Cần Thơ</p>
</div>
<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>

<script type="text/javascript">
    $(function(){
        var validate = $("#formedditpasss").validate({
            rules :{
                oldpass:{
                    required: true,
                },
                newpass :{
                    required: true,
                    minlength: 6
                },
                renewpass :{
                    equalTo: "#exampleInputPassword2",
                }
            },
            messages :{
                oldpass:{
                    required :"Băt buộc nhập mật khẩu",
                },
                newpass:{
                    required :"Băt buộc nhập mật khẩu",
                    minlength : "Mật khẩu tối thiểu 6 ký tự",
                },
                renewpass:{
                    equalTo:"Nhập lại mật khẩu sai"
                }
            }
        });

    });
</script>
</body>
</html>
