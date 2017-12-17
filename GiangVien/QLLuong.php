<?php
    session_start();
include ('../db/pquanly.php');
    $id=$_SESSION['id'];
    require ('../db/connectiondb.php');
    $sql="SELECT canbo.*, donvi.TENDV from canbo, donvi
        WHERE canbo.MADV=donvi.MADV AND canbo.MACB='$id';";
    $query = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($query);
    $Mnv=$row['MACB'];
    $name=$row['HOTENCB'];
    $ns=$row['NSCB'];
    $email=$row['EMAIL'];
    $chucvu=$row['CHUCVU'];
    $tendv=$row['TENDV'];
    if(isset($_GET["nam"]) AND isset($_GET["thang"])){
        $thang=$_GET["thang"];
        $nam=$_GET["nam"];
        if($thang=='all' AND $nam=='all'){
            $sqlqureryluong="SELECT *FROM luongchitiet WHERE MACB= '$Mnv'";
        }else if($thang=='all'){
            $sqlqureryluong="SELECT *FROM luongchitiet WHERE
                   `Nam`= '$nam' AND MACB= '$Mnv'";
        } else if($nam=='all'){
            $sqlqureryluong="SELECT *FROM luongchitiet WHERE `Thang` = '$thang'
                    AND MACB= '$Mnv'";
        }else {
            $sqlqureryluong = "SELECT *FROM luongchitiet WHERE `Thang` = '$thang'
                    AND `Nam`= '$nam' AND MACB= '$Mnv'";
        }
        $resul1=mysqli_query($conn,$sqlqureryluong);
    }

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
<body style="background: #fffff; padding: 0px; margin: 0px;">
   <div class="Container">
   <div class="row">
    <div id="header">
        <div id="webname"><img src="../public/img/nhanvienlogin/WebName.png" alt="WebName">
            <div id="header_icon">
                <div id="home" ><a href="../logout.php"><img src="../public/img/nhanvienlogin/thoat.png" style="margin-top: 20px" alt="Thoát"></a></div>
                        <div id="logout" style="margin:0px; padding:0; "><a href="qllogin.php"><img src="../public/img/nhanvienlogin/trangchu.png" style="margin: 0px;" alt="Trang chủ"></a></div>
                <div id="name"><strong style="color: #e0f74f"><?php echo $name.'  ('. $Mnv.')' ?></strong></div>            </div>
        </div>
    </div>
       </div>

</div>

<div id="content">
<div id="menu">
    <ul><?php
        echo '<li><a href="QLLuong.php?thang='.$thang.'&nam='.$nam.'">Bảng lương</a></li>';
//       echo  '<li><a href="QLLuongNv.php">Lương nhân viên</a></li>';
        echo '<li><a href="QLLuongNv.php?thang='.$thang.'&nam='.$nam.'">Bảng lương nhân viên</a></li>';
        ?>
    </ul>
</div>
<div style="text-align: center"><h2>Bảng lương</h2></div>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-5">
            <form action="QLLuong.php" method="GET" class="form-inline">
                <div class="form-group">

                    <select name="thang" class="form-control" id="thang">
                        <?php
                        for ($i=1; $i<=12; $i++){
                            if($i==$_GET['thang']){
                                echo '<option selected value="'.$i.'">Tháng '.$i.'</option>';
                            }else
                            echo '<option value="'.$i.'">Tháng '.$i.'</option>';
                        }?>
                        <option value="all">Tất cả</option>
                    </select>
                </div>
                <div class="form-group">

                    <select name="nam" class="form-control" id="nam">
                        <?php
                        for ($i=2019; $i>=2015; $i--){
                            if($i==$_GET['nam']){
                                echo '<option selected value="'.$i.'">Năm '.$i.'</option>';
                            }else
                            echo '<option value="'.$i.'">Năm '.$i.'</option>';
                        }?>
                        <option value="all">Tất cả</option>
                    </select>
                </div>
                <input class="btn btn-success" name="btxem" type="submit" value="Xem">
            </form>
        </div>
    </div>
<div id="table">
<table class="table table-striped table-bordered table-hover" id="dataTables">
    <thead>
    <tr align="center">
        <td>STT</td>
        <td>Lương cơ bảng</td>
        <td>Số ngày làm việc</td>
        <td>Tổng trích trừ</td>
        <td>Thu nhập chịu thuế TNCN</td>
        <td>Thuế TNCN</td>
        <td>Tạm ứng</td>
        <td>Thực lãnh</td>
        <td>Ngày cập nhật</td>
    </tr>
    </thead>
    <tbody>

    <?php
    $stt=1;
    while ($salarylist = mysqli_fetch_array($resul1)){
        echo '<tr class="odd gradeX" align="center">';
        echo  '<td>'.$stt.'</td>';
        echo   '<td>'.number_format($salarylist["LUONGCOBAN"]).'</td>';
        echo   '<td>'.$salarylist["NGAYCONG"].'</td>';
        $number=$salarylist["TONGCP"]+ $salarylist["LNV_CONG"];
        echo   '<td>'.number_format($number).'</td>';
        echo   '<td>'.number_format($salarylist["THUNHAPBITINHTNCN"]).'</td>';
        echo   '<td>'.number_format($salarylist["THUETNCN"]).'</td>';
        echo   '<td>'.number_format($salarylist["TAMUNG"]).'</td>';
        echo   '<td>'.number_format($salarylist["THUCLINH"]).'</td>';
        echo   '<td>'.$salarylist["curday"].'</td>';
        echo  '</tr>';
        $stt=$stt+1;
    }
    ?>

    </tbody>
    </table>

      <?php
    echo '<a target="_blank" href="QLLuongDaydu.php?thang='.$thang . '&nam='.$nam.'">Xem bảng lương chi tiết</a>';
    ?>
    </div>
</div>
   <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/dt-1.10.16/af-2.2.2/b-1.4.2/cr-1.4.1/fc-3.2.3/fh-3.1.3/kt-2.3.2/r-2.2.0/rg-1.0.2/rr-1.2.3/sc-1.4.3/sl-1.2.3/datatables.min.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <script type="text/javascript" src="https://cdn.datatables.net/v/bs/dt-1.10.16/af-2.2.2/b-1.4.2/cr-1.4.1/fc-3.2.3/fh-3.1.3/kt-2.3.2/r-2.2.0/rg-1.0.2/rr-1.2.3/sc-1.4.3/sl-1.2.3/datatables.min.js"> </script>
     <script>
    $(document).ready(function() {
        $('#dataTables').DataTable({
                responsive: true,
        order: [[ 0, 'asc' ]],
				'language': {
                    'info': 'Hiển thị _START_ đến _END_ của _TOTAL_ Tháng',
                    'lengthMenu': "Hiển thị _MENU_ Tháng",
                    "paginate": {
				            "previous": "Trước",
                            "next": "Sau",
                            "infoEmpty": "Không có dữ liệu"

				          },
                    "search": "Lọc / Tìm kiếm:",
                    "thousands": ".",
                    "decimal": ","
                    },




        });
    });
    </script>
    <div id="footer" style="text-align: center">
		    <p>Copyright by Nguyên Khang CIT.CTU.EDU.VN</p>
		    <p>Khoa Công nghệ thông tin - Đại học Cần Thơ</p>
		</div>
    </body>
</html>
