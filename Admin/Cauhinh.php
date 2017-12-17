<?php
    if (isset($_GET['bteditcv'])){
        require ('../db/connectiondb.php');
        $chucvu=$_GET['congviec'];
        $url=$_GET['url'];
        $id=$_GET['id'];
        $sql="UPDATE chucvu SET TenChucVu='$chucvu', Url= '$url' WHERE macv='$id'";
        if($result=mysqli_query($conn,$sql)){
            $error=0;
        }else{
            $error=1;
        }
        header('Location: Cauhinh.php?mcv='.$id.'&f=edit&action=cv&error='.$error);
    }
    if (isset($_GET["bteditdv"])){
        require ('../db/connectiondb.php');
        $id=$_GET['id'];
        $dv=$_GET['donvi'];
        $sql="UPDATE donvi SET TENDV= '$dv' WHERE MADV='$id'";
        if($result=mysqli_query($conn,$sql)){
            $error=0;
        }else{
            $error=1;
        }
        header('Location: Cauhinh.php?id='.$id.'&f=edit&action=dv&error='.$error);

    }
    if(isset($_GET["btaddcv"])){
        require ('../db/connectiondb.php');
        $conviet=$_GET['congviec'];
        $url=$_GET['url'];
        $sql="INSERT INTO chucvu (TenChucVu,Url) VALUE ('$conviet','$url')";
        if($result=mysqli_query($conn,$sql)){
            $error=0;
        }else{
            $error=1;
        }
        header('Location: Cauhinh.php?id='.$id.'&f=add&action=cv&error='.$error);
    }
    if(isset($_GET['btadddv'])){
        require ('../db/connectiondb.php');
        $madv=$_GET['madonvi'];
        $tendv=$_GET['donvi'];
        $sql="INSERT INTO donvi (MADV,TENDV) VALUE ('$madv','$tendv')";
        if($result=mysqli_query($conn,$sql)){
            $error=0;
        }else{
            $error=1;
        }
    header('Location: Cauhinh.php?id='.$id.'&f=add&action=dv&error='.$error);
    }
    if(isset($_POST['btsavemail'])){
        require ('../db/connectiondb.php');
        $email=$_POST['diachimail'];
        $password=$_POST['password'];
        $diachiserver=$_POST['diachiserver'];
        $port=$_POST['port'];
        $SMTPSecure=$_POST['SMTPSecure'];
        $sqlupdatemail="UPDATE cauhinhemail SET username='$email',password='$password',SMTPSecure='$SMTPSecure',port='$port',server='$diachiserver' WHERE 1";
        if(mysqli_query($conn,$sqlupdatemail)){
            $error=0;
        }else{
            $error=1;
        }
       header('Location: Cauhinh.php?action=email&error='.$error);
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
            <li><a href="Cauhinh.php?action=cv">Chức vụ</a></li>
            <li><a href="Cauhinh.php?action=cv&f=add">Thêm chức vụ</a></li>
            <li><a href="Cauhinh.php?action=dv">Đơn vị</a></li>
            <li><a href="Cauhinh.php?action=dv&f=add">Thêm đơn vị</a></li>
            <li><a href="Cauhinh.php?action=email">Cấu hình để gửi email</a></li>
        </ul>
    </div>
    <?php
     if(isset($_GET['action'])) {
         $action = $_GET['action'];
         if ($action == 'cv') {
             if(isset($_GET['f'])){
                 $fund= $_GET['f'];
                  $fund;
                 if($fund=='del'){
                     $id= $_GET['mcv'];
                     $sql="DELETE FROM chucvu WHERE macv='$id'";
                     if($result=mysqli_query($conn,$sql)){
                         $ero=0;
                     } else {
                         $ero=1;
                     }
                     header('Location: Cauhinh.php?action=cv&eror='.$ero);
                 } else
                 if($fund=='add'){
                     if(isset($_GET['error'])){
                         $error=$_GET['error'];
                         if($error==0 ){
                             echo ' <div class="row">
                            <div class="col-md-1"> </div>
                            <div class="col-md-10">';
                             echo '<div class="alert alert-success alert-dismissable">';
                             echo    '<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>';
                             echo   '<strong>Thành công!</strong>Thêm thành công';
                             echo '</div>';}
                         else if($error==1){
                             echo ' <div class="row">
                            <div class="col-md-1"> </div>
                            <div class="col-md-10">';
                             echo '<div class="alert alert-danger alert-dismissable">';
                             echo    '<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>';
                             echo   '<strong>Thất bại!</strong>Có lỗi khi thêm';
                             echo '</div>';
                             echo '</div> <div class="col-md-1"> </div> </div>';
                         }}
                     echo '<form action="Cauhinh.php" method="GET" id="fromaddcv">           
                        <div class="row">
                            <div class="col-md-4"></div>
                            <div class="col-md-4">
                          
                                <div class="form-group">
                                    <label for="chucvu">Tên chức vụ</label>
                                     <input type="text" name="congviec" class="form-control" id="chucvu" >
                                </div>
                                <div class="form-group">
                                    <label for="url">Url</label>
                                    <input type="text" name="url" class="form-control" id="url" >
                                </div>
                               
                                <input class="btn btn-success" name="btaddcv" type="submit" value="Thêm mới">
                                <a href="Cauhinh.php?action=cv" class="btn btn-primary">Quay lại </a></div>
                            <div class="col-md-4"></div>              
                        </div>               
                    </form>';
                 }
                 else if($fund='edit') {
                     if (isset($_GET['error'])) {
                         $error = $_GET['error'];
                         if ($error == 0) {
                             echo ' <div class="row">
                            <div class="col-md-1"> </div>
                            <div class="col-md-10">';
                             echo '<div class="alert alert-success alert-dismissable">';
                             echo '<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>';
                             echo '<strong>Thành công!</strong>Chỉnh sửa thành công';
                             echo '</div> </div>';
                         } else if ($error == 1) {
                             echo ' <div class="row">
                            <div class="col-md-1"> </div>
                            <div class="col-md-10">';
                             echo '<div class="alert alert-danger alert-dismissable">';
                             echo '<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>';
                             echo '<strong>Thành công!</strong>Chỉnh sửa thành công';
                             echo '</div> </div>';
                         }
                         echo '<div class="col-md-1"> </div> </div>';
                     }
                     $id = $_GET['mcv'];
                     $sqlcv = "SELECT * FROM chucvu WHERE macv='$id'";
                     $resultcv = mysqli_query($conn, $sqlcv);
                     $ifcv = mysqli_fetch_assoc($resultcv);
                     echo '<form action="Cauhinh.php" method="GET" id="fromeditcv">           
                        <div class="row">
                            <div class="col-md-4"></div>
                            <div class="col-md-4">
                             <div class="form-group">                                   
                                     <input type="hidden" name="id" class="form-control" value="' . $ifcv["macv"] . '">
                                </div>
                                <div class="form-group">
                                    <label for="chucvu">Tên chức vụ</label>
                                     <input type="text" name="congviec" class="form-control" id="chucvu" value="' . $ifcv["TenChucVu"] . '">
                                </div>
                                <div class="form-group">
                                    <label for="url">Url</label>
                                    <input type="text" name="url" class="form-control" id="url" value="' . $ifcv["Url"] . '">
                                </div>
                               
                                <input class="btn btn-success" name="bteditcv" type="submit" value="Chỉnh sửa">
                                <a href="Cauhinh.php?action=cv" class="btn btn-primary">Quay lại </a></div>
                            <div class="col-md-4"></div>
                
                        </div>
                
                    </form>';
                 }
             } else {
                 if(isset($_GET['eror'])){
                     $error=$_GET['eror'];
                     echo ' <div class="row">
                            <div class="col-md-1"> </div>
                            <div class="col-md-10">';
                     if($error==0 ){
                         echo '<div class="alert alert-success alert-dismissable">';
                         echo '<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>';
                         echo '<strong>Thành công!</strong>Xóa thành công';
                         echo '</div>';}
                     else if($error==1){
                         echo ' <div class="alert alert-danger alert-dismissable">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                <strong>Thất bại!</strong> Có lỗi khi Xóa';
                         echo '<div class="col-md-1"> </div></div>';
                     }
                 }
                 $sql = "SELECT * FROM chucvu ;";
                 $resul = mysqli_query($conn, $sql);
                 echo ' <h3 style="text-align: center">Danh sách chức vụ</h3>';
                 echo '<div id="table">
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr align="center">
                            <th>STT</th>
                            <th>Chức vụ</th>
                            <th>Url</th>                    
                            <th>Hành động</th>         
                        </tr>
                    </thead>
                    <tbody>';
                 while ($dscv = mysqli_fetch_array($resul)) {
                     echo '<tr class="odd gradeX" align="center">';
                     echo '<td>' . $dscv["macv"] . '</td>';
                     echo '<td>' . $dscv["TenChucVu"] . '</td>';
                     echo '<td>' . $dscv["Url"] . '</td>';
                     echo '<td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="Cauhinh.php?mcv='.$dscv["macv"].'&f=del&action=cv" onclick="return confirmAction()"> Delete</a>
                                <i class="fa fa-pencil fa-fw"></i> <a href="Cauhinh.php?mcv=' . $dscv["macv"] . '&f=edit&action=cv">Edit</a></td>';
                     echo '</tr>';
                 }
             }
         } else if ($action == 'dv'){
             if(isset($_GET['f'])){
                 $fund= $_GET['f'];
                 if($fund=='del'){
                     $id= $_GET['id'];
                     $sql="DELETE FROM donvi WHERE MADV='$id'";
                     if($result=mysqli_query($conn,$sql)){
                         $ero=0;
                     } else {
                         $ero=1;
                     }
                     header('Location: Cauhinh.php?action=dv&eror='.$ero);
                 } else if($fund=='add'){
                     if(isset($_GET['error'])){
                         $error=$_GET['error'];
                         if($error==0 ){
                             echo ' <div class="row">
                            <div class="col-md-1"> </div>
                            <div class="col-md-10">';
                             echo '<div class="alert alert-success alert-dismissable">';
                             echo    '<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>';
                             echo   '<strong>Thành công!</strong>thêm thành công';
                             echo '</div>';
                         }
                         else if($error==1){
                             echo ' <div class="row">
                            <div class="col-md-1"> </div>
                            <div class="col-md-10">';
                             echo '<div class="alert alert-danger alert-dismissable">';
                             echo    '<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>';
                             echo   '<strong>Thất bại!</strong>Có lỗi khi thêm';
                             echo '</div>';
                             echo '  </div> <div class="col-md-1"> </div> </div>';
                         }
                     }
                     echo '<form action="Cauhinh.php" method="GET" id="fromadddv">           
                        <div class="row">
                            <div class="col-md-4"></div>
                            <div class="col-md-4">
                             <div class="form-group">     
                                     <label for="madonvi">Mã đơn vị</label>
                                     <input type="text" name="madonvi" id="madonvi" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="chucvu">Tên đơn vị</label>
                                     <input type="text" name="donvi" class="form-control" id="chucvu">
                                </div>
                            
                                <input class="btn btn-success" name="btadddv" type="submit" value="Thêm mới">
                                <a href="Cauhinh.php?action=dv" class="btn btn-primary">Quay lại </a></div>
                            <div class="col-md-4"></div>
                
                        </div>
                
                    </form>';
                 }
                 else if($fund=='edit'){
                      $id= $_GET['id'];

                     if(isset($_GET['error'])){
                         $error=$_GET['error'];
                         if($error==0 ){
                             echo ' <div class="row">
                            <div class="col-md-1"> </div>
                            <div class="col-md-10">';
                             echo '<div class="alert alert-success alert-dismissable">';
                             echo    '<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>';
                             echo   '<strong>Thành công!</strong>Sửa thành công';
                             echo '</div>';}
                         else if($error==1){
                             echo ' <div class="row">
                            <div class="col-md-1"> </div>
                            <div class="col-md-10">';
                             echo '<div class="alert alert-danger alert-dismissable">';
                             echo    '<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>';
                             echo   '<strong>Thất bại!</strong>Có lỗi khi sửa';
                             echo '</div>';
                             echo '  </div> <div class="col-md-1"> </div> </div>';
                         }}
                     $sqldv="SELECT * FROM donvi WHERE MADV='$id'";
                     $resultdv=mysqli_query($conn,$sqldv);
                     $ifdv=mysqli_fetch_assoc($resultdv);
                     echo '<form action="Cauhinh.php" method="GET" id="fromeditdv">           
                        <div class="row">
                            <div class="col-md-4"></div>
                            <div class="col-md-4">
                             <div class="form-group">                                   
                                     <input type="text" name="id" class="form-control" value="'.$ifdv["MADV"].'" readonly >
                                </div>
                                <div class="form-group">
                                    <label for="chucvu">Tên chức vụ</label>
                                     <input type="text" name="donvi" class="form-control" id="chucvu" value="'.$ifdv["TENDV"].'">
                                </div>
                            
                                <input class="btn btn-success" name="bteditdv" type="submit" value="Chỉnh sữa">
                                <a href="Cauhinh.php?action=dv" class="btn btn-primary"><span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span>Quay lại </a></div>
                            <div class="col-md-4"></div>
                
                        </div>
                
                    </form>';
                 }
             } else
             {
                 if(isset($_GET['eror'])){
                     $error=$_GET['eror'];
                     echo ' <div class="row">
                            <div class="col-md-1"> </div>
                            <div class="col-md-10">';
                     if($error==0 ){

                         echo '<div class="alert alert-success alert-dismissable">';
                         echo    '<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>';
                         echo   '<strong>Thành công!</strong>Xóa thành công';
                         echo '</div>';}
                     else if($error==1){
                         echo ' <div class="alert alert-danger alert-dismissable">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                    <strong>Thất bại!</strong> Có lỗi khi Xóa
                  ';
                         echo '  
            <div class="col-md-1"> </div>
        </div>';
                     }

                 }
             $sql = "SELECT * FROM donvi ;";
             $resul = mysqli_query($conn, $sql);
             echo ' <h3 style="text-align: center">Danh sách đơn vị</h3>';
             echo '<div id="table">
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr align="center">
                            <th>Mã đơn vị</th>
                            <th>Đơn vị</th>                                
                            <th>Hành động</th>        
                        </tr>
                    </thead>
                    <tbody>';
             while ($dsdv = mysqli_fetch_array($resul)) {
                 echo '<tr class="odd gradeX" align="center">';
                 echo '<td>' . $dsdv["MADV"] . '</td>';
                 echo '<td>' . $dsdv["TENDV"] . '</td>';
                 echo '<td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="Cauhinh.php?id='.$dsdv["MADV"].'&f=del&action=dv" onclick="return confirmAction()"> Delete</a>
                                <i class="fa fa-pencil fa-fw"></i> <a href="Cauhinh.php?id=' . $dsdv["MADV"] . '&f=edit&action=dv">Edit</a></td>';
                 echo '</tr>';
             }
         }
     }else if($action=='email'){

             if(isset($_GET['error'])){
                 $error=$_GET['error'];
                 echo ' <div class="row">
                            <div class="col-md-1"> </div>
                            <div class="col-md-10">';
                 if($error==0){

                     echo '<div class="alert alert-success alert-dismissable">';
                     echo    '<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>';
                     echo   '<strong>Thành công!</strong>Lưu cấu hình thành công';
                     echo '</div>';}
                 else if($error==1){
                     echo ' <div class="alert alert-danger alert-dismissable">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                    <strong>Thất bại!</strong> Có lỗi khi lưu
                  ';
                     echo '  
            <div class="col-md-1"> </div>
        </div>';
                 }

             }
             $sql="SELECT * FROM cauhinhemail ";
             $query = mysqli_query($conn,$sql);
             $row = mysqli_fetch_assoc($query);
            echo '<div class="row"> 
                <div class="col-md-3"></div>
                <div class="col-md-6">
            <form action="Cauhinh.php" method="POST" id="formcauhinhmail">
                 <div class="form-group">
            <label for="emaild">Tài khoản Email:</label>
            <input type="text" name="diachimail" class="form-control" id="emaild" value="'.$row['username'].'">
                </div>
                 <div class="form-group">
            <label for="pass">Mật khẩu</label>
            <input type="password" name="password" class="form-control" id="pass" value="'.$row['password'].'">
                </div>
                 
                 <div class="form-group">
            <label for="server">Địa chỉ mail server</label>
            <input type="text" name="diachiserver" class="form-control" id="server" value="'.$row['server'].'">
                </div>
                 <div class="form-group">
            <label for="server">SMTPSecure</label>
            <input type="text" name="SMTPSecure" class="form-control" id="server" value="'.$row['SMTPSecure'].'">
                </div>
               <div class="form-group">
            <label for="server">Port</label>
            <input type="text" name="port" class="form-control" id="server" value="'.$row['port'].'">
                </div> 
     <input type="submit" name="btsavemail" class="btn btn-primary btn-lg btn-block" value="Lưu cấu hình">        
    </form>
   
                </div>
                <div class="col-md-3"></div>
                </div> ';
         }
     }
                      ?>
    </tbody>
    </table>
</div>
</div>
</div>
<div id="footer" style="text-align: center">
    <p>Copyright by Nguyên Khang CIT.CTU.EDU.VN</p>
    <p>Khoa Công nghệ thông tin - Đại học Cần Thơ</p>
</div>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/dt-1.10.16/af-2.2.2/b-1.4.2/cr-1.4.1/fc-3.2.3/fh-3.1.3/kt-2.3.2/r-2.2.0/rg-1.0.2/rr-1.2.3/sc-1.4.3/sl-1.2.3/datatables.min.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs/dt-1.10.16/af-2.2.2/b-1.4.2/cr-1.4.1/fc-3.2.3/fh-3.1.3/kt-2.3.2/r-2.2.0/rg-1.0.2/rr-1.2.3/sc-1.4.3/sl-1.2.3/datatables.min.js">


</script>
<script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true,
            order: [
                [0, 'asc']
            ],
            'language': {
                'info': 'Hiển thị _START_ đến _END_ của _TOTAL_ dữ liệu ',
                'lengthMenu': "Hiển thị _MENU_ dữ liệu",
                "emptyTable": "Không có dữ liệu trong bảng",
                "paginate": {
                    "previous": "Trước",
                    "next": "Sau",
                    "infoEmpty": "Không có dữ liệu"

                },
                "search": "Lọc / Tìm kiếm:"
            },
        });
    });

</script>
<script type="text/javascript">
    $(function (){
        var validate1= $("#fromeditcv").validate({
            rules :{
                congviec : {
                    required :true,
                },
                url:{
                    required :true,
                }
            },
            messages :{
                congviec : {
                    required: "Trường này không được để trống"
                },
                url:{
                    required: "Trường này không được để trống"
                }
            }
        });
    });
    $(function () {
        var validate= $("#fromaddcv").validate({
            rules :{
                congviec : {
                    required :true,
                    remote : 'checkid.php'
                },
                url:{
                    required :true,
                }
            },
            messages :{
                congviec : {
                    required: "Trường này không được để trống",
                    remote : "Tên chức vụ đã bị trùng"
                },
                url:{
                    required: "Trường này không được để trống"
                }
            }
        });

    })

    $(function () {
        var validate= $("#fromeditdv").validate({
            rules :{
                donvi : {
                    required :true,
                },
            },
            madonvi :{
                required :true,
            },
            messages :{
                donvi : {
                    required: "Trường này không được để trống",
                }
            },

        });
    })
    $(function () {
        var validate= $("#fromadddv").validate({
            rules :{
                madonvi : {
                    required :true,
                    remote : 'checkid.php'
                },
                donvi : {
                    required :true,
                    remote : 'checkid.php'
                },
            },
            messages :{
                madonvi : {
                    required: "Trường này không được để trống",
                    remote : "Mã đơn vị bị trùng"
                },
                donvi : {
                    required: "Trường này không được để trống",
                    remote : "Tên đơn vị bị trùng "
                }
            }
        });

    })
</script>
<SCRIPT type="text/javascript">
    function confirmAction() {
        return confirm("Bạn có chắc muốn xóa")
    }

</SCRIPT>
</body>
</html>
