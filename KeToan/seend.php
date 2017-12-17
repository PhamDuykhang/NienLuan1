<?php
    require_once ('../db/mail.php');
    require_once ('../db/body.php');
    require ('../db/connectiondb.php');
    session_start();
    $id=$_SESSION['id'];
    $sqlcb="SELECT HOTENCB FROM canbo WHERE MACB='$id'";
    $buffer=mysqli_query($conn,$sqlcb);
    $row=mysqli_fetch_assoc($buffer);
    $hotencanbo=$row['HOTENCB'];
    $sqlcauhinh="SELECT * FROM cauhinhemail WHERE 1";
    $buffer=mysqli_query($conn,$sqlcauhinh);
    $row=mysqli_fetch_assoc($buffer);
    $server=$row['server'];
    $port=$row['port'];
    $user=$row['username'];
    $addressfrom=$row['username'];
    $pass=$row['password'];
    $SMTPSecure=$row['SMTPSecure'];
    if(isset($_GET['listEmail'])) {
        $emailList = $_GET['listEmail'];
        $result = array_unique($emailList);
    }
    else {
        $sqlkiemtra="SELECT EMAIL FROM canbo WHERE 1";
        $query= mysqli_query($conn,$sqlkiemtra);
        $i=0;
        while ($resultraw=mysqli_fetch_array($query)){
            $result[$i]=$resultraw['EMAIL'];
            $i++;
        }
    }
        $emailList=$result;
        if (isset($_GET['thang']) and isset($_GET['nam'])) {
            $thang = $_GET['thang'];
            $nam = $_GET['nam'];
            $title='Bảng lương tháng '.$thang.'năm '.$nam;
            for ($i = 0; $i < count($emailList); $i++) {
                if (!empty($result[$i])) {
                    $SQL="SELECT lt.*, cb.HOTENCB,cb.CHUCVU, dv.TENDV,cb.EMAIL FROM
                        donvi dv, luongchitiet lt, canbo cb WHERE
                        lt.MACB=cb.MACB AND dv.MADV=cb.MADV AND
                        `Thang` = $thang AND `Nam` = $nam AND cb.EMAIL='$result[$i]'";
                    $resul1=mysqli_query($conn,$SQL);
                    $numrow=mysqli_num_rows($resul1);
                    if($numrow==0){
                        continue;
                    }
                    $main='';
                    while ($salarylist = mysqli_fetch_array($resul1)){
                        $name=$salarylist["HOTENCB"];
                        $temp='<tr class="odd gradeX" align="center"> <td>'.$salarylist["HOTENCB"].'</td>
                          <td>'.$salarylist["CHUCVU"].'</td>
                          <td>'.$salarylist["TENDV"].'</td>
                          <td>'.number_format($salarylist["LUONGCOBAN"]).'</td>
                          <td>'.$salarylist["NGAYCONG"].'</td>
                          <td>'.number_format($salarylist["TAMUNG"]).'</td>
                          <td>'.number_format($salarylist["THUCLINH"]).'</td>
                          <td>'.$salarylist["curday"].'</td>
                         </tr>';
                        $main=$main.$temp;
                    }
                    $body=$header.$main.$foter;
                    $email=$result[$i];
                }
                if(Guiemail($title,$body,$addressfrom,$hotencanbo,$email,$name,$server,$port,$user,$pass,$SMTPSecure)){
                    echo '1';
                }

            }
        }
?>
