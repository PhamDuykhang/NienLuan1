<?php
        session_start();
include ('../db/pketoan.php');
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
        //////
        ///
if(isset($_GET["nam"]) AND isset($_GET["thang"])){
    $thang=$_GET["thang"];
    $nam=$_GET["nam"];

        $sqlqureryluong="SELECT lt.*, cb.HOTENCB,cb.CHUCVU,cb.EMAIL, dv.TENDV FROM donvi dv, luongchitiet lt,
        canbo cb WHERE lt.MACB=cb.MACB AND dv.MADV=cb.MADV AND
        `Thang` = $thang AND `Nam` = $nam ";

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
<body style="background: #FFFFFF; padding: 0px; margin: 0px;">
<div class="Container">
    <div class="row">
        <div id="header">
            <div id="webname"><img src="../public/img/nhanvienlogin/WebName.png" alt="WebName">
                <div id="header_icon">
                    <div id="home" ><a href="../logout.php"><img src="../public/img/nhanvienlogin/thoat.png" style="margin-top: 20px" alt="Thoát"></a></div>
                    <div id="logout" style="margin:0px; padding:0; "><a href="KetoanLogin.php"><img src="../public/img/nhanvienlogin/trangchu.png" style="margin: 0px;" alt="Trang chủ"></a></div>
                    <div id="name"><strong style="color: #e0f74f"><?php echo $name.'  ('. $Mnv.')' ?></strong></div>            </div>
            </div>
        </div>
    </div>

</div>

<div id="content">
    <div id="menu">
        <ul>

           <li><a href=""></a></li>

            <li><a href=""></a></li>
        </ul>
    </div>
    <div style="text-align: center"><h2>Lựa chọn bảng lương</h2></div>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-5">
            <form action="Guiemail.php" method="GET" class="form-inline">
                <div class="form-group">
                    <label for="thang">Tháng</label>
                    <select name="thang" class="form-control" id="thang">

                        <?php
                        for ($i=1; $i<=12; $i++){
                            if($i==$_GET['thang']){
                                echo '<option selected value="'.$i.'">Tháng '.$i.'</option>';
                            }else
                                echo '<option value="'.$i.'">Tháng '.$i.'</option>';
                        }?>

                    </select>
                </div>
                <div class="form-group">
                    <label for="nam">Năm</label>
                    <select name="nam" class="form-control" id="nam">
                        <?php
                        for ($i=2019; $i>=2015; $i--){
                            if($i==$_GET['nam']){
                                echo '<option selected value="'.$i.'">Năm '.$i.'</option>';
                            }else
                                echo '<option value="'.$i.'">Năm '.$i.'</option>';
                        }?>

                    </select>
                </div>
                <input class="btn btn-success" name="btxem" type="submit" value="Xem">
            </form></div>
    </div>
    <div class="row"></div>
    <div id="table">
        <form id="formemail">
            <input type="submit" class="btn btn-primary" id="submit" value="Gửi email" style="margin-bottom: 20px;">
<!--            <input type="submit" class="btn btn-primary" id="seenall" value="Gửi tất cả" style="margin-bottom: 20px;">-->

            <span style="color: #4286f4; font-size: large;" id="result" style="margin-bottom: 20px;"></span>
        <table style="font-size: 95%" class="table table-striped table-bordered table-hover" id="dataTables">
            <thead>
            <tr align="center">
                <td>Tên</td>
                <td>Chức vụ</td>
                <td>Đơn vị</td>
                <td>Số ngày làm việc</td>
                <td>Tạm ứng</td>
                <td>Thực lãnh</td>
                <td>Ngày cập nhật</td>
                <td>Gửi email <input type="checkbox" style="width:20px;height:20px;" id="checkAll"></td>
            </tr>
            </thead>
            <tbody>
            <?php
            while ($salarylist = mysqli_fetch_array($resul1)){
                echo '<tr class="odd gradeX" align="center">';
                echo   '<td>'.$salarylist["HOTENCB"].'</td>';
                echo   '<td>'.$salarylist["CHUCVU"].'</td>';
                echo   '<td>'.$salarylist["TENDV"].'</td>';
                echo   '<td>'.$salarylist["NGAYCONG"].'</td>';
                echo   '<td>'.number_format($salarylist["TAMUNG"]).'</td>';
                echo   '<td>'.number_format($salarylist["THUCLINH"]).'</td>';
                echo   '<td>'.$salarylist["curday"].'</td>';
                echo   '<td><input name="listEmail[]" value="'.$salarylist["EMAIL"].'" style="width:20px;height:20px;"type="checkbox"></td>';
                echo  '</tr>';}
            ?>
            </tbody>
        </table>
        </form>
        <?php
        echo '<a target="_blank" href="BangluongDayDu.php?thang='.$thang . '&nam='.$nam.'">Xem bảng lương chi tiết</a>';
        ?>
    </div>
</div>
<div id="footer" style="text-align: center">
    <p>Copyright by Nguyên Khang CIT.CTU.EDU.VN</p>
    <p>Khoa Công nghệ thông tin - Đại học Cần Thơ</p>
</div>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/dt-1.10.16/af-2.2.2/b-1.4.2/cr-1.4.1/fc-3.2.3/fh-3.1.3/kt-2.3.2/r-2.2.0/rg-1.0.2/rr-1.2.3/sc-1.4.3/sl-1.2.3/datatables.min.css"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script type="text/javascript" src="https://cdn.datatables.net/v/bs/dt-1.10.16/af-2.2.2/b-1.4.2/cr-1.4.1/fc-3.2.3/fh-3.1.3/kt-2.3.2/r-2.2.0/rg-1.0.2/rr-1.2.3/sc-1.4.3/sl-1.2.3/datatables.min.js"> </script>
<script>
    $(document).ready(function() {

        var table = $('#dataTables').DataTable({
            responsive: true,
            order: [[ 1, 'asc' ]],
            'language': {
                'info': 'Hiển thị _START_ đến _END_ của _TOTAL_ dữ liệu',
                'lengthMenu': "Hiển thị _MENU_ dữ liệu",
                "paginate": {
                    "previous": "Trước",
                    "next": "Sau",
                    "infoEmpty": "Không có dữ liệu"

                },

                "emptyTable": "Không có dữ liệu trong bảng",
                "search": "Lọc / Tìm kiếm:",
                "thousands": ".",
                "decimal": ",",

            },




        });
        //

        //
        function GetURLParameter(sParam) {
            var sPageURL = window.location.search.substring(1);
            var sURLVariables = sPageURL.split('&');
            for (var i = 0; i < sURLVariables.length; i++){
                var sParameterName = sURLVariables[i].split('=');
                if (sParameterName[0] == sParam)
                {
                    return sParameterName[1];
                }
            }
        }
        var thang = GetURLParameter('thang');
        var nam = GetURLParameter('nam');
        // Handle form submission event
        $('#formemail').on('submit', function(e){

            // Prevent actual form submission
            e.preventDefault();
            // Serialize form data
            var data = table.$("input[name='listEmail[]']").serialize();
            if(data==null) {
                $('#result').css("color", "red");
                $('#result').html("Đang gửi email cho tất cả.........");
            } if(data!=null) {
                $('#result').css("color", "red");
                $('#result').html("Đang gửi email .........");
            }
            // Submit form data via Ajax

            $.ajax({
                url: 'seend.php?thang='+thang+'&nam='+nam,
                type : "get",
                data: data,
                success : function (result){
                    if(result!=null){
                    $('#result').css("color", "green");
                    $('#result').html("Gửi thành công");
                    }
                    if(result==0) {
                        $('#result').css("color", "red");
                        $('#result').html("Không gửi được thư");
                    }
                },

            });
        });
    });
</script>
<script type="application/javascript">
    $(document).ready(function () {
        $("#checkAll").click(function () {
            $('input:checkbox').not(this).prop('checked', this.checked);
        });
    });
</script>
</body>
</html>
