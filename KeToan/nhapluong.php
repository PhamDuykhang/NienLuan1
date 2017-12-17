<?php
/**
 * Created by PhpStorm.
 * User: pdkhang
 * Date: 08-Oct-17
 * Time: 9:00 PM
 */

session_start();
include ('../db/pketoan.php');
$id=$_SESSION['id'];
require ('../db/connectiondb.php');
if(isset($_GET['btadd'])) {
    $total=$_GET['total'];
    $macb = $_GET['macb'];
    $ten = $_GET['ten'];
    $donvi = $_GET['donvi'];
    $LUONGCOBAN = $_GET['LUONGCOBAN'];
    $ANTRUA = $_GET['ANTRUA'];
    $DIENTHOAI = $_GET['DIENTHOAI'];
    $XANGXE = $_GET['XANGXE/DILAI'];
    $NUOICON = $_GET['NUOICON'];
    $PCTN = $_GET['PCTN'];
    $TONGLUONG = $_GET['TONGLUONG'];
    $NGAYCONG = $_GET['NGAYCONG'];
    $TONGTHU = $_GET['TONGTHU'];
    $TNCN = $_GET['TNCN'];
    $BHXH = $_GET['BHXH'];
    $CPBHXH = $_GET['CPBHXH'];
    $CPBHYT = $_GET['CPBHYT'];
    $CPBHTN = $_GET['CPBHTN'];
    $KPCD = $_GET['KPCD'];
    $TONGCP = $_GET['TONGCP'];
    $LNV_BHXH = $_GET['LNV_BHXH'];
    $LNV_BHYT = $_GET['LNV_BHYT'];
    $LNV_BHTN = $_GET['LNV_BHTN'];
    $LNV_CONG = $_GET['LNV_CONG'];
    $GTBANTHAN = $_GET['GTBANTHAN'];
    $GTNGUOIPT = $_GET['GTNGUOIPT'];
    $THUNHAPBITINHTNCN = $_GET['THUNHAPBITINHTNCN'];
    $THUETNCN = $_GET['THUETNCN'];
    $TAMUNG = $_GET['TAMUNG'];
    $THUCLINH = $_GET['THUCLINH'];
    $thang=$_GET['thang'];
    $nam=$_GET['nam'];
    for($i=0;$i<$total;$i++){

        $mysql="INSERT INTO `luongchitiet`(`MACB`, `LUONGCOBAN`, `ANTRUA`,
            `DIENTHOAI`, `XANGXE/DILAI`, `NUOICON`, `PCTN`, `TONGLUONG`, `NGAYCONG`,
             `TONGTHU`, `TNCN`, `BHXH`, `CPBHXH`, `CPBHYT`, `CPBHTN`, `KPCD`,
             `TONGCP`, `LNV_BHXH`, `LNV_BHYT`, `LNV_BHTN`, `LNV_CONG`, `GTBANTHAN`,
              `GTNGUOIPT`,
            `THUNHAPBITINHTNCN`, `THUETNCN`, `TAMUNG`, `THUCLINH`, `curday`, `Thang`, `Nam`)
              VALUES ('$macb[$i]',$LUONGCOBAN[$i],$ANTRUA[$i],$DIENTHOAI[$i],$XANGXE[$i],$NUOICON[$i],
              $PCTN[$i],$TONGLUONG[$i],$NGAYCONG[$i],$TONGTHU[$i],$TNCN[$i],$BHXH[$i],
              $CPBHXH[$i],$CPBHYT[$i],$CPBHTN[$i],$KPCD[$i],$TONGCP[$i],
              $LNV_BHXH[$i],$LNV_BHYT[$i],$LNV_BHTN[$i],$LNV_CONG[$i],$GTBANTHAN[$i],$GTNGUOIPT[$i],
              $THUNHAPBITINHTNCN[$i],$THUETNCN[$i],$TAMUNG[$i],$THUCLINH[$i],CURRENT_DATE,$thang[$i],$nam[$i]);";
             $error=0;
        if(mysqli_query($conn,$mysql)){

        }
        else{
            $error=1;
        }
    }
 header('Location: nhapluong.php?eror='.$error.'&total='.$total);
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
    if(isset($_GET['eror'])){
        echo '<div class="row">';
        echo '<div class="col-md-1">';echo '</div>';
        echo '<div class="col-md-9">';
        $error=$_GET['eror'];
    if($error==0 ){
        echo '<div class="alert alert-success alert-dismissable">';
        echo    '<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>';
        echo   '<strong>Thành công!</strong> Nhập bảng lương thành công';
        echo '</div>';}
    else if($error==1){
        echo '<div class="alert alert-danger alert-dismissable">';
        echo    '<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>';
        echo   '<strong>Thất bại!</strong> Nhập bảng lương không  thành công';
        echo '</div>';
        }
    }
?>
<form method="GET" action="nhapluong.php">
    <input type="hidden" name="total" value="<?php echo $_GET['total'] ?>">
<table style="font-size: 95%" class="table table-striped table-bordered table-hover" id="dataTables">
    <thead>
    <tr align="center">
        <th rowspan="2">Mã Cán bộ</th>
        <th rowspan="2">Họ tên</th>
        <th rowspan="2">Đơn vị</th>
        <th rowspan="2">Lương cơ bản</th>
        <th colspan="4">Các khoảng hổ trợ</th>
        <th rowspan="2">Phụ cấp trách nhiệm</th>
        <th rowspan="2">Tổng lương</th>
        <th rowspan="2">Ngày công</th>
        <th rowspan="2">Tổng thu nhập thực tế</th>
        <th rowspan="2">Thu nhập chịu thuế TNCN</th>
        <th rowspan="2">Lương đóng BHXH</th>
        <th colspan="5">Các khoản trích vào Chi phí</th>
        <th colspan="4">Các khoản trích trừ vào lương của NV</th>
        <th colspan="2" >Giảm trừ</th>
        <th rowspan="2">Thu nhập tính thuế TNCN</th>
        <th rowspan="2">Thuế TNCN phải nộp</th>
        <th rowspan="2">Tạm ứng</th>
        <th rowspan="2">Thực lỉnh</th>
        <th rowspan="2">Tháng</th>
        <th rowspan="2">Năm</th>

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
            3600000/1ng</th>
    </tr>
    </thead>
    <tbody>
    <?php
    for ($i=1;$i<=$_GET['total'];$i++){

  echo '<tr>
    <td><input type="text" name="macb[]"></td>
       <td><input type="text" name="ten[]"></td>
       <td><input type="text" name="donvi[]"></td>
       <td><input type="text" name="LUONGCOBAN[]"></td>
       <td><input type="text" name="ANTRUA[]"></td>
       <td><input type="text" name="DIENTHOAI[]"></td>
       <td><input type="text" name="XANGXE/DILAI[]"></td>
       <td><input type="text" name="NUOICON[]"></td>
       <td><input type="text" name="PCTN[]"></td>
       <td><input type="text" name="TONGLUONG[]"></td>
       <td><input type="text" name="NGAYCONG[]"></td>
       <td><input type="text" name="TONGTHU[]"></td>
       <td><input type="text" name="TNCN[]"></td>
       <td><input type="text" name="BHXH[]"></td>
       <td><input type="text" name="CPBHXH[]"></td>
       <td><input type="text" name="CPBHYT[]"></td>
       <td><input type="text" name="CPBHTN[]"></td>
       <td><input type="text" name="KPCD[]"></td>
       <td><input type="text" name="TONGCP[]"></td>
       <td><input type="text" name="LNV_BHXH[]"></td>
       <td><input type="text" name="LNV_BHYT[]"></td>
       <td><input type="text" name="LNV_BHTN[]"></td>
       <td><input type="text" name="LNV_CONG[]"></td>
       <td><input type="text" name="GTBANTHAN[]"></td>
       <td><input type="text" name="GTNGUOIPT[]"></td>
       <td><input type="text" name="THUNHAPBITINHTNCN[]"></td>
       <td><input type="text" name="THUETNCN[]"></td>
       <td><input type="text" name="TAMUNG[]"></td>
       <td><input type="text" name="THUCLINH[]"></td>
       <td><input type="text" name="thang[]"></td>
       <td><input type="text" name="nam[]"></td>
   </tr>';
    }
?>
    </tbody>
</table>
    <input type="submit" name="btadd" class="btn btn-success" value="Nhập">
</form>
</body>
</html>
