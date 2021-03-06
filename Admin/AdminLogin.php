<?php

    session_start();
      require('../db/paddmin.php');
    $id=$_SESSION['id'];
    $msv=$_SESSION['DonVi'];
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
	<meta charset="UTF-8">
	<head>
		<title>Hệ thống quản lý lương - NK</title>
		<link rel="stylesheet" href="../public/css/stylePanel.css">
	</head>
	<body style="background: #c2ddfc; padding: 0px; margin: 0px;">
		<div id="header">
			<div id="webname"><img src="../public/img/nhanvienlogin/WebName.png" alt="WebName">
				<div id="header_icon">
				 <div id="home" ><a href="../logout.php"><img src="../public/img/nhanvienlogin/thoat.png" style="margin-top: 20px" alt="Thoát"></a></div>
                        <div id="logout" style="margin:0px; padding:0; "><a href="AdminLogin.php"><img src="../public/img/nhanvienlogin/trangchu.png" style="margin: 0px;" alt="Trang chủ"></a></div>
                        <div id="name"><strong style="color: #e0f74f"><?php echo $name.'  ('. $Mnv.')' ?></strong></div>
                    </div>
				</div>
			</div>
		</div>
		<div id="content">
			<div id="information"><h2 style="text-align: center; color: #ed1e1e">Thông tin nhân viên</h2>
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tbody>
					<tr >
						<td style="text-align: left" width="24%"><div style="background-color: #c9c9c9;height: 30px; line-height: 30px; padding-left:5px">Mã nhân viên</div></td>
						<td><div style="padding-left: 10px; color: #4286f4"><b><?php echo $Mnv ;?></b></div></td>
					</tr>
					<tr >
						<td style="text-align: left" width="24%"><div style="background-color: #c9c9c9;height: 30px; line-height: 30px; padding-left:5px">Họ tên</div></td>
						<td><div style="padding-left: 10px; color: #4286f4"><b><?php echo $name?></b></div></td>
					</tr>
					<tr >
						<td style="text-align: left" width="24%"><div style="background-color: #c9c9c9;height: 30px; line-height: 30px; padding-left:5px">Ngày sinh</div></td>
						<td><div style="padding-left: 10px; color: #4286f4"><b><?php echo $ns ?></b></div></td>
					</tr>
					<tr >
						<td style="text-align: left" width="24%"><div style="background-color: #c9c9c9;height: 30px; line-height: 30px; padding-left:5px">Đơn vị</div></td>
						<td><div style="padding-left: 10px; color: #4286f4"><b><?php echo $tendv ?></b></div></td>
					</tr>
					<tr >
						<td style="text-align: left" width="24%"><div style="background-color: #c9c9c9;height: 30px; line-height: 30px; padding-left:5px">Chức vụ</div></td>
						<td><div style="padding-left: 10px; color: #4286f4"><b><?php echo $chucvu ?></b></div></td>
					</tr>
					<tr >
						<td style="text-align: left" width="24%"><div style="background-color: #c9c9c9;height: 30px; line-height: 30px; padding-left:5px">Email</div></td>
						<td><div style="padding-left: 10px; color: #4286f4"><b><?php echo $email?></b></div></td>
					</tr>
					</tbody>
				</table>
			</div>
			<div id="function">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tbody>
						<tr style="padding: 5px">
							<td style="padding-top: 5px">
								<div class="itemFuntion"><a href="Listuser.php"><img src="../public/img/nhanvienlogin/computer-1331579_960_720.png" height="67px" width="67px" alt=""></a></div>
							</td>
							<td style="padding-top: 5px">
								<div class="itemFuntion"><a href="Cauhinh.php?action=cv"><img src="../public/img/nhanvienlogin/cauhinh.png" height="67px" width="67px" alt=""></a></div>
							</td>
						</tr>
						<tr>
							<td style="padding-top: 5px">
								<div class="itemFuntion"><b>Quản lý tài khoản</b></div>
							</td>
							<td style="padding-top: 5px">
								<div class="itemFuntion"><b>Cấu hình</b></div>
							</td>
						</tr>
						<tr style="padding: 5px">
							<td style="padding-top: 5px">
								<div class="itemFuntion"><img src="../public/img/nhanvienlogin/sign-question-icon.png" height="67px" width="67px" alt=""></div>
							</td>
							<td style="padding-top: 5px">
								<div class="itemFuntion"><img src="../public/img/nhanvienlogin/sign-question-icon.png" height="67px" width="67px" alt=""></div>
							</td>
						</tr>
						<tr>
							<td style="padding-top: 5px">
								<div class="itemFuntion"><b>Chức năng đang phát triển</b></div>
							</td>
							<td style="padding-top: 5px">
								<div class="itemFuntion"><b>Chức năng đang phát triển</b></div>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<div id="footer" style="text-align: center">
		    <p>Copyright by Nguyên Khang CIT.CTU.EDU.VN</p>
		    <p>Khoa Công nghệ thông tin - Đại học Cần Thơ</p>
		</div>
	</body>
</html>
