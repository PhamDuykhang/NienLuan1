<?php
    if(isset($_POST["btadd"])) {
        require ('../db/connectiondb.php');
        $sqldsbophaan="SELECT * FROM `donvi`;";
        $qbp=mysqli_query($conn,$sqldsbophaan);
        $num=mysqli_num_rows($qbp);
        $dsbp=mysqli_fetch_assoc($qbp);
        $manv=$_POST["ma_nhan_vien"];
        $name=$_POST["ten_nhan_vien"];
        $email=$_POST["email"];
        $bophan=$_POST["bo_phan"];
        $chucvu=$_POST["chucvu"]; // Value :Mã chức vụ;
        $slqcv="SELECT TenChucVu FROM chucvu WHERE macv=$chucvu ";
        $resul=mysqli_query($conn,$slqcv);
        $tenchucvu=mysqli_fetch_assoc($resul);
        $ifchucvu=$tenchucvu["TenChucVu"];
        $taikhoan=$_POST["user"];
        $matkhau=md5($_POST["pass"]);
        $ngaysinh=$_POST["ngaysinh"];
        $stt=$_POST["stt"]; // 1 hiện 0 ẩn
        $nvsql="INSERT INTO `canbo`(`MACB`, `MADV`, `HOTENCB`, `NSCB`, `EMAIL`, `CHUCVU`)
        VALUES ('$manv', '$bophan', '$name', '$ngaysinh','$email','$ifchucvu');";
        mysqli_query($conn,$nvsql);
        $usql="INSERT INTO `taikhoan`(`MACB`, `USERNAME`, `PASSWORD`,
         `TRANGTHAI`, `CAPDO`, `NGAYTAO`) VALUES ('$manv','$taikhoan','$matkhau','$stt',
         '$chucvu',CURRENT_DATE);";
        if(mysqli_query($conn,$usql)){
            $ero=0;
        } else{
            $ero=1;
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
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body style="background: #fffff; padding: 0px; margin: 0px;">
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

        <div class="row">
            <div class="col-md-1"> </div>
            <div class="col-md-10">
                <?php
                if(isset($ero) AND $ero==0 ){
                echo '<div class="alert alert-success alert-dismissable">';
                echo    '<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>';
                echo   '<strong>Thành công!</strong> Thêm mới một tài khoản thành công';
                echo '</div>';} else if(isset($ero) AND $ero==1){
                    echo ' <div class="alert alert-danger alert-dismissable">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                    <strong>Thêm thất bại!</strong> Có lỗi khi tạo mới tài khoảng
                  </div>';
                }
                ?>
            </div>
            <div class="col-md-1"> </div>
        </div>
        <h3 style="text-align: center">Thêm tài khoản</h3>
        <form action="adduser.php" method="POST" id="formadd">
            <div class="row" style="margin-bottom: 10px">
                <div class="col-md-1"></div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="usr">Mã số nhân viên</label>
                        <input type="text"  name="ma_nhan_vien" class="form-control" id="usr" placeholder="A22">
                    </div>
                    <div class="form-group">
                        <label for="usr1">Tên nhân viên</label>
                        <input type="text"   name="ten_nhan_vien" class="form-control" id="usr1" placeholder="Nguyễn Văn A">

                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Địa chỉ email</label>
                        <input type="email"  name="email" class="form-control" id="exampleInputEmail1" placeholder="a22@gmail.com">
                    </div>

                    <div class="form-group">
                        <label for="sel1">Phòng/Khoa</label>
                        <select name="bo_phan" class="form-control" id="sel1">
                            <?php
                            require ('../db/connectiondb.php');
                            $sqldsbophaan="SELECT * FROM `donvi`;";
                            $qbp=mysqli_query($conn,$sqldsbophaan);

                           while ($dsbp=mysqli_fetch_array($qbp)){
                                echo '<option value="'.$dsbp['MADV'].'">'.$dsbp['TENDV'].'</option>';
                            }?>
                      </select>
                    </div>
                    <div class="form-group">
                        <label for="sel2">Chức vụ</label>
                        <select name="chucvu" class="form-control" id="sel2">
                            <?php
                                $sql='SELECT * FROM chucvu;';
                                $result=mysqli_query($conn,$sql);
                                while ($dscv=mysqli_fetch_array($result)){
                                    echo '<option value="'.$dscv["macv"].'">'.$dscv["TenChucVu"].'</option>';
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="ngaysinh">Ngày sinh</label>
                        <input   type="text" name="ngaysinh" class="form-control" id="ngaysinh" placeholder="dd-mm-yyyy">
                    </div>
                    <div class="form-group">
                        <label for="usr3">Tài khoản</label>
                        <input  type="text" name="user" class="form-control" id="usr3" placeholder="khanga22">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Mật khẩu</label>
                        <input type="password"  name="pass" class="form-control" id="exampleInputPassword1" placeholder="Mật khẩu 6 kí tự">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword2">Nhắc lại mật khẩu</label>
                        <input type="password"  name="repass" class="form-control" id="exampleInputPassword2" placeholder="Nhập lại mật khẩu ">
                    </div>
                    <div class="form-group">
                    <label for="">Trạng thái</label>
                    <div class="radio">

                        <label>
            <input type="radio" name="stt" id="optionsRadios1" value="1" checked>
            Hiện
          </label>
                </div>
                            <div class="radio">
                                <label>
            <input type="radio" name="stt" id="optionsRadios2" value="0">
           Ẩn
          </label>
                        </div>
                        </div>

                    <input class="btn btn-success" name="btadd" type="submit" value="Thêm tài khoản">
                    <!-- <button type="button" class="btn btn-primary" id="reset">Kiểm tra lại</button> -->
                    <a href="Listuser.php" class="btn btn-primary">Quay lại </a>
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
  var validate = $("#formadd").validate({
    rules :{
      ma_nhan_vien:{
        required :true,
        remote : 'checkid.php'
      },
      ten_nhan_vien:{
        required :true
      },
      email :{
        email:true,
        required: true,
      },
      ngaysinh :{
        dateFormat:true
      },
      user :{
        required:true,
        remote : 'checkuser.php'
      },
      pass :{
        minlength: 6
      },
      repass :{
         equalTo: "#exampleInputPassword1",
      }
    },
      messages :{
        ma_nhan_vien : {
          remote : "Mã nhân viên bị trùng",
          required: "Không được bỏ trống",
        },ten_nhan_vien :{
          required:"Không được bỏ trống",
        },
        email:{
          email: "Nhập sai định dạng",
          required: "Đây là trường bắt buộc"
        },
        user:{
          required: "Không được bỏ trống",
          remote : "Tài khoản bị trùng"
        },
        pass:{
            required :"Băt buộc nhập mật khẩu",
            minlength : "Mật khẩu tối thiểu 6 ký tự",
        },
        repass:{
          equalTo:"Nhập lại mật khẩu sai"
        }
    }
  });

});

</script>
</html>
