<?php

    session_start();
    require('../db/paddmin.php');
    ?>
    <?php
    $id=$_SESSION['id'];
    include ('../db/connectiondb.php');
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
    //Truy Van csdl Tai khoan
    $sqluser="SELECT taikhoan.*, canbo.HOTENCB, stt.TrangThai FROM
              taikhoan,canbo,stt
              WHERE taikhoan.MACB=canbo.MACB
              AND taikhoan.TRANGTHAI=stt.stt";
    $queryuser=mysqli_query($conn,$sqluser);
    //$userList=mysqli_fetch_array($queryuser)

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
                            <div id="home">
                                <a href="../logout.php"><img src="../public/img/nhanvienlogin/thoat.png" style="margin-top: 20px" alt="Thoát"></a>
                            </div>
                            <div id="logout" style="margin:0px; padding:0; ">
                                <a href="AdminLogin.php"><img src="../public/img/nhanvienlogin/trangchu.png" style="margin: 0px;" alt="Trang chủ"></a>
                            </div>
                            <div id="name"><strong style="color: #e0f74f"><?php echo $name.'  ('. $Mnv.')' ?></strong></div>
                        </div>
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
            <div style="text-align: center">
                <h2>Danh sách tài khoản</h2>
            </div>
            <div id="table">
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr align="center">
                            <th>STT</th>
                            <th>Tên</th>
                            <th>Tài khoản</th>
                            <th>Trạng thái</th>
                            <th>Hành động</th>
                            <th>Ngày tạo</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    while ($userList=mysqli_fetch_array($queryuser)){

                      echo  '<tr class="odd gradeX" align="center">';
                      echo  '<td>'.$userList["MATK"].'</td>';
                      echo  '<td>'.$userList["HOTENCB"].'</td>';
                      echo  '<td>'.$userList["USERNAME"].'</td>';
                      echo  '<td>'.$userList["TrangThai"].'</td>';
                      echo '<td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="del.php?id='.$userList["MATK"].'" onclick="return confirmAction()"> Delete</a>
                                <i class="fa fa-pencil fa-fw"></i> <a href="edituser.php?id='.$userList["MACB"].'">Edit</a></td>';
                       echo  '<td>'.$userList["NGAYTAO"].'</td>';
                        echo '</tr>';
                    }
                      ?>
                    </tbody>
                </table>
            </div>
        </div>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/dt-1.10.16/af-2.2.2/b-1.4.2/cr-1.4.1/fc-3.2.3/fh-3.1.3/kt-2.3.2/r-2.2.0/rg-1.0.2/rr-1.2.3/sc-1.4.3/sl-1.2.3/datatables.min.css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

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
                        'info': 'Hiển thị _START_ đến _END_ của _TOTAL_ nhân viên',
                        'lengthMenu': "Hiển thị _MENU_ nhân viên",
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
        <SCRIPT LANGUAGE="JavaScript">
            function confirmAction() {
                return confirm("Bạn có chắc muốn xóa tài khoảng này")
            }

        </SCRIPT>
        <div id="footer" style="text-align: center">
            <p>Copyright by Nguyên Khang CIT.CTU.EDU.VN</p>
            <p>Khoa Công nghệ thông tin - Đại học Cần Thơ</p>
        </div>
    </body>

    </html>
