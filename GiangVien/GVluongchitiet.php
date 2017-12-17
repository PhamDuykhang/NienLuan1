<?php
/**
 * Created by PhpStorm.
 * User: pdkhang
 * Date: 09-Oct-17
 * Time: 10:54 AM
 */

    session_start();
    $id=$_SESSION['id'];
    include ('../db/pgiangvien.php');
    require ('../db/connectiondb.php');

    //////
///
    if(isset($_GET["nam"]) AND isset($_GET["thang"])){
        $thang=$_GET["thang"];
        $nam=$_GET["nam"];
        $sqlqureryluong="SELECT * FROM luongchitiet
        WHERE 
        `Thang` = $thang AND `Nam` = $nam AND MACB='$id';";
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
    <!--    <link rel="stylesheet" href="../public/css/stylechitiet.css">-->
</head>
<body style=" padding: 0px; margin: 0px;">
<?php

if(isset($_GET["nam"]) AND isset($_GET["thang"])){
    $thang=$_GET["thang"];
    $nam=$_GET["nam"];
    if($thang=='all' AND $nam=='all'){
        echo '<h3 style="text-align: center"> Bảng lương tất cả</h3>';
    } else if($thang=='all'){
        echo '<h3 style="text-align: center"> Bảng lương năm '.$nam.'</h3>';
    } else if($nam=='all'){
        echo '<h3 style="text-align: center"> Bảng lương tháng '.$thang.'</h3>';
    } else {
        echo '<h3 style="text-align: center"> Bảng lương tháng '.$thang.' năm '.$nam.'</h3>';
    }


}
echo '<img src="../public/img/print.png" alt="" style="margin-left: 30px;margin-bottom: 10px;" onclick="this.style.display =\'none\';window.print()" height="25px" width="25px">'
?>
<table style="font-size: 95%" class="table table-striped table-bordered table-hover" id="dataTables">
    <thead>
    <tr align="center">
        <th rowspan="2">STT</th>
        <th rowspan="2">Lương cơ bản</th>
        <th colspan="4">Các khoản hỗ trợ</th>
        <th rowspan="2">Phụ cấp trách nhiệm</th>
        <th rowspan="2">Tổng lương</th>
        <th rowspan="2">Ngày công</th>
        <th rowspan="2">Tổng thu nhập thực tế</th>
        <th rowspan="2">Thu nhập chịu thuế TNCN</th>
        <th rowspan="2">Lương đóng BHXH</th>
        <th colspan="5">Các khoản trích vào chi phí</th>
        <th colspan="4">Các khoản trích trừ vào lương của NV</th>
        <th colspan="2" >Giảm trừ</th>
        <th rowspan="2">Thu nhập tính thuế TNCN</th>
        <th rowspan="2">Thuế TNCN phải nộp</th>
        <th rowspan="2">Tạm ứng</th>
        <th rowspan="2">Thực lĩnh</th>
        <th rowspan="2">Ngày</th>

    </tr>
    <tr>
        <th>Ăn trưa</th>
        <th>Điện thoại</th>
        <th>Xăng xe/
            Đi lại</th>
        <th>Nuôi con nhỏ</th>
        <th>BHXH
            (18%)</th>
        <th>BHYT
            (3%)</th>
        <th>BHTN
            (1%)</th>
        <th>KPCĐ
            (2%)</th>
        <th>Cộng</th>
        <th>BHXH
            (8%)</th>
        <th>BHYT
            (1,5%)</th>
        <th>BHTN
            (1%)</th>
        <th>Cộng</th>
        <th>Bản thân</th>
        <th>Người PT
            3600000/ng</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $i=1;
    echo '<tr class="odd gradeX" align="center">';
    while ($salarylist = mysqli_fetch_array($resul1)){
        echo   '<td>'.$i.'</td>';
        echo   '<td>'.number_format($salarylist["LUONGCOBAN"]).'</td>';
        echo   '<td>'.number_format($salarylist["ANTRUA"]).'</td>';
        echo   '<td>'.number_format($salarylist["DIENTHOAI"]).'</td>';
        echo   '<td>'.number_format($salarylist["XANGXE/DILAI"]).'</td>';
        echo   '<td>'.number_format($salarylist["NUOICON"]).'</td>';
        echo   '<td>'.number_format($salarylist["PCTN"]).'</td>';
        echo   '<td>'.number_format($salarylist["TONGLUONG"]).'</td>';
        echo   '<td>'.number_format($salarylist["NGAYCONG"]).'</td>';
        echo   '<td>'.number_format($salarylist["TONGTHU"]).'</td>';
        echo   '<td>'.number_format($salarylist["TNCN"]).'</td>';
        echo   '<td>'.number_format($salarylist["BHXH"]).'</td>';
        echo   '<td>'.number_format($salarylist["CPBHXH"]).'</td>';
        echo   '<td>'.number_format($salarylist["CPBHYT"]).'</td>';
        echo   '<td>'.number_format($salarylist["CPBHTN"]).'</td>';
        echo   '<td>'.number_format($salarylist["KPCD"]).'</td>';
        echo   '<td>'.number_format($salarylist["TONGCP"]).'</td>';
        echo   '<td>'.number_format($salarylist["LNV_BHXH"]).'</td>';
        echo   '<td>'.number_format($salarylist["LNV_BHYT"]).'</td>';
        echo   '<td>'.number_format($salarylist["LNV_BHTN"]).'</td>';
        echo   '<td>'.number_format($salarylist["LNV_CONG"]).'</td>';
        echo   '<td>'.number_format($salarylist["GTBANTHAN"]).'</td>';
        echo   '<td>'.number_format($salarylist["GTNGUOIPT"]).'</td>';
        echo   '<td>'.number_format($salarylist["THUNHAPBITINHTNCN"]).'</td>';
        echo   '<td>'.number_format($salarylist["THUETNCN"]).'</td>';
        echo   '<td>'.number_format($salarylist["TAMUNG"]).'</td>';
        echo   '<td>'.number_format($salarylist["THUCLINH"]).'</td>';
        echo   '<td>'.$salarylist["curday"].'</td>';
        echo  '</tr>';
        $i++;
    }
    ?>
    </tbody>
</table>
</body>
</html>
