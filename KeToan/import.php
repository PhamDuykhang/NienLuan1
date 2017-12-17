
<?php
    if(isset($_POST["submit"])){
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $pattern = '/[0-9]$/';
        require ('../Classes/PHPExcel.php');
        require ('../db/connectiondb.php');
        require ('../db/kiemtra.php');
        $file = $_FILES['file']['tmp_name'];
        try {
            $ExcelReader = PHPExcel_IOFactory::createReaderForFile($file);
            $ExcelReader->setLoadSheetsOnly('Sheet1');
            $obj = $ExcelReader->load($file);
            $highestRow = $obj->setActiveSheetIndex()->getHighestRow();
            $sheetData = $obj->getActiveSheet()->toArray('null', true, true, true);
        } catch (Exception $e){
            die('Error loading file "'.pathinfo($file,PATHINFO_BASENAME).'": '.$e->getMessage());
        }
        $patternThang = '/(0[1-9]|[12]\d|3[01])/';
        $patternNam = '/^\d{4}$/';
        if( !empty($_POST['thang']) AND !empty($_POST['nam'])){
            $thang=$_POST['thang'];
            $nam=$_POST['nam'];
            if (!preg_match($patternThang, $thang) OR !preg_match($patternNam, $nam)){
                $error=3;
                header('Location: import.php?eror='.$error);
            }
        } else {
            $date=$sheetData[8]['A'];
            $thang=substr( $date,  7, 2);
            $nam=substr($date, 15, 4);
            $error=0;
            if (!preg_match($patternThang, $thang) OR !preg_match($patternNam, $nam)){
                $error=1;
                header('Location: import.php?eror='.$error);
            }
        }

        $totalError=0;
        $errorList[]=0;

        if(KiemTraCoTonTaiBanLuong($thang,$nam,$conn)){
            $error=2;
            header('Location: import.php?eror='.$error.'&thang='.$thang.'&nam='.$nam);
        }
else {

        for ($row = 12; $row<=$highestRow; $row++){
            $A=$sheetData[$row]['A'];
            if (!preg_match($pattern,$A)){
                continue;
            }
            $B=$sheetData[$row]['B'];
            $B=str_replace(',','',$B);
            $D=$sheetData[$row]['D'];
            $D=str_replace(',','',$D);
            $E=$sheetData[$row]['E'];
            $E=str_replace(',','',$E);
            $F=$sheetData[$row]['F'];
            $F=str_replace(',','',$F);
            $G=$sheetData[$row]['G'];
            $G=str_replace(',','',$G);
            $H=$sheetData[$row]['H'];
            $H=str_replace(',','',$H);
            $I=$sheetData[$row]['I'];
            $I=str_replace(',','',$I);
            $J=$sheetData[$row]['J'];
            $J=str_replace(',','',$J);
            $K=$sheetData[$row]['K'];
            $K=str_replace(',','',$K);
            $L=$sheetData[$row]['L'];
            $L=str_replace(',','',$L);
            $M=$sheetData[$row]['M'];
            $M=str_replace(',','',$M);
            $N=$sheetData[$row]['N'];
            $N=str_replace(',','',$N);
            $O=$sheetData[$row]['O'];
            $O=str_replace(',','',$O);
            $P=$sheetData[$row]['P'];
            $P=str_replace(',','',$P);
            $Q=$sheetData[$row]['Q'];
            $Q=str_replace(',','',$Q);
            $R=$sheetData[$row]['R'];
            $R=str_replace(',','',$R);
            $S=$sheetData[$row]['S'];
            $S=str_replace(',','',$S);
            $T=$sheetData[$row]['T'];
            $T=str_replace(',','',$T);
            $U=$sheetData[$row]['U'];
            $U=str_replace(',','',$U);
            $V=$sheetData[$row]['V'];
            $V=str_replace(',','',$V);
            $W=$sheetData[$row]['W'];
            $W=str_replace(',','',$W);
            $X=$sheetData[$row]['X'];
            $X=str_replace(',','',$X);
            $Y=$sheetData[$row]['Y'];
            $Y=str_replace(',','',$Y);
            $Z=$sheetData[$row]['Z'];
            $Z=str_replace(',','',$Z);
            $AA=$sheetData[$row]['AA'];
            $AA=str_replace(',','',$AA);
            $AB=$sheetData[$row]['AB'];
            $AB=str_replace(',','',$AB);
            $AC=$sheetData[$row]['AC'];
            $AC=str_replace(',','',$AC);
            $AD=$sheetData[$row]['AD'];
            $AD=str_replace(',','',$AD);
            $AE=$sheetData[$row]['AE'];
            $AE=str_replace(',','',$AE);

            KiemTraCB($A,$B,$D,$E,$conn);



            $mysql="INSERT INTO `luongchitiet`(`MACB`, `LUONGCOBAN`, `ANTRUA`,
            `DIENTHOAI`, `XANGXE/DILAI`, `NUOICON`, `PCTN`, `TONGLUONG`, `NGAYCONG`,
             `TONGTHU`, `TNCN`, `BHXH`, `CPBHXH`, `CPBHYT`, `CPBHTN`, `KPCD`,
             `TONGCP`, `LNV_BHXH`, `LNV_BHYT`, `LNV_BHTN`, `LNV_CONG`, `GTBANTHAN`,
              `GTNGUOIPT`,
            `THUNHAPBITINHTNCN`, `THUETNCN`, `TAMUNG`, `THUCLINH`, `curday`, `Thang`, `Nam`)
              VALUES ('$A',$F,$G,$H,$I,$J,
              $K,$L,$M,$N,$O,$P,
              $Q,$R,$S,$T,$U,
              $V,$W,$X,$Y,$Z,$AA,
              $AB,$AC,$AD,$AE,CURRENT_DATE,$thang,$nam);";
            if(mysqli_query($conn,$mysql)){
                $error=0;
            }
            else{
                $totalError=$totalError+1;
                $errorList[]=$row;
            }
    }
        if($totalError>0){
            $strError="";
            for($i=1;$i<=$totalError;$i++){
                $strError=$strError.'&r'.$i.'='.$errorList[$i];
            }
            $error=1;
         header('Location: import.php?total='.$totalError.'&'.$strError.'&eror='.$error);
        }else{

        header('Location: import.php?eror='.$error);
        }
    }}
?>
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
?>
<!DOCTYPE html>
<html>
<head>
    <title>Hệ thống quản lý lương - NK</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../public/css/menustyle.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="../public/css/stylechitiet.css">
</head>
<body style="background-color:#FFFFFF; padding: 0px; margin: 0px;">
    <div class="Container">
        <div class="row">
            <div id="header">
                <div id="webname"><img src="../public/img/nhanvienlogin/WebName.png" alt="WebName">
                    <div id="header_icon">
                         <div id="home" ><a href="../logout.php"><img src="../public/img/nhanvienlogin/thoat.png" style="margin-top: 20px" alt="Thoát"></a></div>
                        <div id="logout" style="margin:0px; padding:0; "><a href="KetoanLogin.php"><img src="../public/img/nhanvienlogin/trangchu.png" style="margin: 0px;" alt="Trang chủ"></a></div>
                        <div id="name"><strong style="color: #e0f74f"><?php echo $name.'  ('. $Mnv.')' ?></strong></div>                    </div>
                </div>
            </div>
        </div>

    </div>

    <div id="content">
        <div id="menu">
            <ul>
                <?php
                $thang=date('m');
                $nam=date('Y');
                echo '<li><a href="KTQuanliLuong.php?thang='.$thang.'&nam='.$nam.'">Xem toàn bộ bảng lương</a></li>';
                ?>
                <li><a href="import.php">Nhập bảng lương</a></li>
            </ul>
        </div>
        <?php
        if(isset($_GET['eror'])){
            echo '<div class="row">';
            echo '<div class="col-md-1">';echo '</div>';
            echo '<div class="col-md-9">';
            $error=$_GET['eror'];
            if($error==0 ){
                echo '<div class="alert alert-success alert-dismissable">';
                echo    '<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>';
                echo   '<strong>Import thành công!</strong> Nhập bảng lương thành công';
                echo '</div>';}
            else if($error==1){
                echo ' <div class="alert alert-warning alert-dismissable">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                    <strong>Cảnh báo</strong>'; for($i=1;$i<=$_GET['total'];$i++){
                        echo '</br>';
                        $t='r'.$i;
                        echo 'Dòng thứ '.$_GET[$t].' có lỗi vui lòng kiểm tra lại';
                }
                  echo '</div>';
            }else if($error==2){
                $thang=$_GET['thang'];
                $nam=$_GET['nam'];
                echo '<div class="alert alert-warning alert-dismissable">';
                echo    '<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>';
                echo   '<strong>Import thất bại!</strong> Bảng lương nhập vào đã có trong cơ sở dữ liệu nếu bạn vẫn muốn nhập lương vui lòng ấn vào nút ghi đè và upload 1 lần nữa';
                echo '</div>';
                echo '<a href="../db/dellluong.php?thang='.$thang.'&nam='.$nam.'" class="btn btn-primary">Ghi đè </a>';

            }else if($error==3){
                echo ' <div class="alert alert-danger alert-dismissable">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                    <strong>Import thất bại!</strong> Bạn đã nhập sai tháng và năm vui lòng nhập lại
                  </div>';
        }
            echo '</div>';
            echo '</div>';
        }
        ?>
        <div style="text-align: center">
            <h2>Nhập dữ liệu từ file Microsoft Excel</h2>
        </div>
        <div class="row" style="margin-bottom: 100px;">
            <div class="col-md-2"></div>
            <div class="col-md-4">
                <form method="POST" action="import.php" enctype="multipart/form-data" id="formUpload">
                    <div class="form-group">
                        <label for="thang">Tháng</label>
                        <select class="form-control" name="thang" id="sel1">
                            <option value="">--------------</option>
                            <?php
                            for($i=1;$i<=12;$i++){
                            echo '<option value="'.$i.'">Tháng '.$i.'</option>';
                            }
                            ?>
                        </select>
                        <label for="nam">Năm</label>
                        <input type="text" id="nam" name="nam" class="form-control" placeholder="có thể nhập hoặc không">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile">File</label>
                        <input type="file" name="file" id="exampleInputFile">
                        <p class="help-block">Chọn file Excel từ từ máy tính</p>
                    </div>
                    <button type="submit" name="submit" class="btn btn-success">Tải lên</button>
                    <?php if(!isset($_GET['total'])){
                        $total=1;
                    }  else {
                        $total=$_GET['total'];
                    }
                    ?>
                    <a target="_blank" href="nhapluong.php?total=<?php echo $total;  ?>" class="btn btn-info" role="button">Nhập thủ công</a>
                </form>
            </div>
            <div class="col-md-2"></div>
        </div>

    </div>
<div id="footer" style="text-align: center">
		    <p>Copyright by Nguyên Khang CIT.CTU.EDU.VN</p>
		    <p>Khoa Công nghệ thông tin - Đại học Cần Thơ</p>
		</div>
</body>
<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>

<script type="text/javascript">
    $(function(){
        var validate = $("#formUpload").validate({
            rules :{
                file:{
                    required :true
                },
            },
            messages :{
                file:{
                    required :"Chọn tập tin trước khi upload"
                }
            }
        });

    });
</script>
</html>
