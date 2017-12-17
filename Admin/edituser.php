<?php

if(isset($_GET["id"])){
    $macanbo=$_GET["id"];
    require ('../db/connectiondb.php');
    $sqlcb="SELECT  * FROM  `canbo` WHERE MACB='$macanbo';";
    $resulcb=mysqli_query($conn,$sqlcb);
    while ($ifList=mysqli_fetch_array($resulcb)){
        $ifcbMCB=$ifList["MACB"];
        $ifcbrMDV=$ifList["MADV"];
        $ifcbHoTen=$ifList["HOTENCB"];
        $ifcbNSCB=$ifList["NSCB"];
        $ifcbCVCB=$ifList["CHUCVU"];
        $ifcbEmail=$ifList["EMAIL"];
    }
    $sqluser="SELECT  * FROM  taikhoan WHERE MACB='$macanbo';";
    $resuluser=mysqli_query($conn,$sqluser);
    while ($ifurList=mysqli_fetch_array($resuluser)){
        $ifurUser=$ifurList["USERNAME"];
        $ifurStt=$ifurList["TRANGTHAI"];
        $ifurCapdo=$ifurList["CAPDO"];
    }

}
if(isset($_POST["btedit"])) {
    require ('../db/connectiondb.php');
    $sqldsbophaan="SELECT * FROM `donvi`;";
    $qbp=mysqli_query($conn,$sqldsbophaan);
    $num=mysqli_num_rows($qbp);
    $dsbp=mysqli_fetch_assoc($qbp);
    //
    //
    $manv=$_POST["id"];
    $name=$_POST["ten_nhan_vien"];
    $email=$_POST["email"];
    $bophan=$_POST["bo_phan"];
    $chucvu=$_POST["chucvu"];
    $slqcv="SELECT TenChucVu FROM chucvu WHERE macv='$chucvu'";
    $resul=mysqli_query($conn,$slqcv);
    $tenchucvu=mysqli_fetch_assoc($resul);
    $nameCV=$tenchucvu["TenChucVu"];
    $ngaysinh=$_POST["ngaysinh"];
    $stt=$_POST["stt"]; // 1 hiện 0 ẩn
    $nvsql="UPDATE `canbo` SET
        `MADV`='$bophan',`HOTENCB`='$name',`NSCB`='$ngaysinh',
        `EMAIL`='$email',`CHUCVU`='$nameCV'  WHERE MACB = '$manv' ";
    mysqli_query($conn,$nvsql);
    $usql="UPDATE taikhoan SET `TRANGTHAI`=$stt,`CAPDO`=$chucvu, NgayUpDate= CURRENT_DATE WHERE MACB='$manv' ;";
    if(mysqli_query($conn,$usql)){
        $ero=0;
        header('Location: edituser.php?id='.$manv.'&eror='.$ero);
    }else {
        $ero=1;
        header('Location: edituser.php?id='.$manv.'&eror='.$ero);
    }


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
    <h3 style="text-align: center">Chỉnh sửa tài khoản</h3>
    <div class="row">
        <div class="col-md-1"> </div>
        <div class="col-md-10">
            <?php
            if(isset($_GET['eror'])){
                $error=$_GET['eror'];
                if($error==0 ){
                    echo '<div class="alert alert-success alert-dismissable">';
                    echo    '<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>';
                    echo   '<strong>Thành công!</strong>Chỉnh sửa thành công';
                    echo '</div>';}
                else if($error==1){
                    echo ' <div class="alert alert-danger alert-dismissable">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                    <strong>Thêm thất bại!</strong> Có lỗi khi chỉnh sửa
                  </div>';
                }
            }
            ?>
        </div>
        <div class="col-md-1"> </div>
    </div>
    <form action="edituser.php" method="POST" id="formseddit">
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-1"></div>
            <div class="col-md-4">
                <div class="form-group">

                    <label for="usr">Mã số nhân viên</label>
                    <?php echo '<input type="text"  name="id" class="form-control" id="usr" value="'.$ifcbMCB.'" readonly>';?>
                    <p class="text-danger" id="msg"></p>
                </div>
                <div class="form-group">
                    <label for="usr1">Tên nhân viên</label>
                    <?php echo '<input type="text" name="ten_nhan_vien" value="'.$ifcbHoTen.'" class="form-control" id="usr1" placeholder="Nguyễn Văn A">';?>

                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Địa chỉ email</label>
                   <?php echo '<input type="email" name="email" class="form-control" value="'.$ifcbEmail.'" id="exampleInputEmail1" placeholder="Vd:a22@gmail.com">';?>
                </div>

                <div class="form-group">
                    <label for="sel1">Phòng/Khoa</label>
                    <select name="bo_phan" class="form-control" id="sel1">
                        <?php
                        require ('../db/connectiondb.php');
                        $sqldsbophaan="SELECT * FROM `donvi`;";
                        $qbp=mysqli_query($conn,$sqldsbophaan);
                        while ($dsbp=mysqli_fetch_array($qbp)){
                            if ($dsbp['MADV']==$ifcbrMDV){
                            echo '<option value="'.$dsbp['MADV'].'" selected>'.$dsbp['TENDV'].'</option>';
                        } else
                            {
                            echo '<option value="'.$dsbp['MADV'].'">'.$dsbp['TENDV'].'</option>';
                        }}?>
                    </select>
                </div>

            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="sel2">Chức vụ</label>
                    <select name="chucvu" class="form-control" id="sel2">
                        <?php
                        $sql='SELECT * FROM chucvu;';
                        $result=mysqli_query($conn,$sql);
                        while ($dscv=mysqli_fetch_array($result)){
                            if($dscv["TenChucVu"]==$ifcbCVCB){
                                echo '<option value="'.$dscv["macv"].'" selected>'.$dscv["TenChucVu"].'</option>';
                            } else {
                                echo '<option value="'.$dscv["macv"].'">'.$dscv["TenChucVu"].'</option>';
                            }
                        }

                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="ngaysinh">Ngày sinh</label>
                   <?php echo '<input type="text" name="ngaysinh" class="form-control" value="'.$ifcbNSCB.'" id="ngaysinh" placeholder="dd-mm-yyyy">';?>
                </div>
                <div class="form-group">
                    <label for="">Trạng thái</label>
                    <?php
                     require ('../db/connectiondb.php');
                     $sqlstt= " SELECT * FROM stt;";
                     $resulstt=mysqli_query($conn,$sqlstt);
                     while ($liststt=mysqli_fetch_array($resulstt)){
                    echo '<div class="radio">';
                        echo '<label>';
                        if($ifurStt==$liststt["stt"]){
                          echo '  <input type="radio" name="stt" id="optionsRadios1" value="'.$liststt["stt"].'" checked>';
                            echo $liststt["TrangThai"];} else{
                            echo '  <input type="radio" name="stt" id="optionsRadios1" value="'.$liststt["stt"].'">';
                            echo $liststt["TrangThai"];
                        }
                       echo '</label>';
                    echo '</div>';
                     }
                   ?>
                </div>

                <input class="btn btn-success" name="btedit" type="submit" value="Sữa đổi">
                <a href="Listuser.php" class="btn btn-primary">Quay lại </a>
                <a href="doimatkhau.php?id=<?php echo $macanbo; ?>" class="btn btn-primary">Thay đổi mật khẩu </a>
            </div>
        </div>

    </form>

</div>
<div id="footer" style="text-align: center">
    <p>Copyright by Nguyên Khang CIT.CTU.EDU.VN</p>
    <p>Khoa Công nghệ thông tin - Đại học Cần Thơ</p>
</div>

</body>
<script type="text/javascript">
    $.validator.addMethod("dateFormat",
        function(value, element) {
            return value.match(/^(\d{1,2})-(\d{1,2})-(\d{4})$/);
        },
        "Nhập đúng định dạng dd-mm-yyyy.");
    $(function(){
        var validate = $("#formseddit").validate({
            rules :{
                ten_nhan_vien :{
                    required :true,
                },
                email :{
                    email:true,
                    required: true,
                },
                ngaysinh :{
                    dateFormat:true
                }
            },
            messages :{
                ten_nhan_vien :{
                    required:"Không được bỏ trống",
                },
                email:{
                    email: "Nhập sai định dạng",
                    required: "Đây là trường bắt buộc"
                }

            }
        });

    });
</script>
</html>
