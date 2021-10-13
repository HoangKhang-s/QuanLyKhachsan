<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
    <link rel="stylesheet" href="trangchinh.css">
    <title>Trang chính</title>
</head>
<body>
    <div class="header">
        <div class="logo"></div>
        <ul class="list">
            <li class="list-item">
                <a href="Trangchinh.php" class="list-item-content selected">
                    <i class="fas fa-home icon"></i>TRANG CHÍNH
                </a>        
            </li>
            <li class="list-item">
                <a href="Thue_Traphong.php" class="list-item-content">
                    <i class="fas fa-retweet icon"></i>THUÊ - TRẢ PHÒNG
                </a>
            </li>
            <li class="list-item">
                <a href="Datphong.php" class="list-item-content">
                    <i class="fas fa-calendar-alt icon"></i>ĐẶT PHÒNG
                </a>
            </li>
            <li class="list-item">
                <a href="Quanlyhethong.php" class="list-item-content">
                    <i class="fas fa-cog icon"></i>QUẢN LÝ HỆ THỐNG
                </a>
            </li>
            <li class="list-item">
                <a href="Taikhoan.php" class="list-item-content">
                    <i class="fas fa-user-circle icon"></i>TÀI KHOẢN
                </a>
            </li>
            <li class="list-item">
                <a href="Login.html" class="list-item-content">
                    <i class="fas fa-sign-out-alt icon"></i>ĐĂNG XUẤT
                </a>
            </li>
        </ul>
    </div>
    <div class="container">
        <?php
            include_once("CSDL.php");
            $sql = "SELECT * FROM `phong` WHERE `TinhTrang` = 'Trống' or `TinhTrang` = 'Đã đặt'";
            $rows = DataProvider::ExecuteQuery($sql);
            $count_phong_cho = mysqli_num_rows($rows);

            $sql = "SELECT * FROM `phong` WHERE `TinhTrang` = 'Đang sử dụng'";
            $rows = DataProvider::ExecuteQuery($sql);
            $count_phong_dang_thue = mysqli_num_rows($rows);
        ?>
        <div class="container-name">
            <div>
                <span>THÔNG TIN HỆ THỐNG</span>
            </div>
        </div>
        <div class="container-content">
            <div class="boxs">
                <div class="box">
                    <div class="box-content">
                        <div class="icon"><i class="fas fa-retweet" style="color: #f3bb45"></i></div>
                        <div class="text">
                            <span>Thuê trong ngày</span>
                            <span style="font-size: 20px; padding-top: 5px">0 lượt</span>
                        </div>
                        <div class="line"></div>
                        <span class="link">
                            <a href="" id="cap-nhat"><i class="fas fa-sync-alt"></i>Cập nhật</a>
                        </span>
                    </div>
                </div>
                <div class="box">
                    <div class="box-content">
                        <div class="icon"><i class="fas fa-door-open" style="color: #009688"></i></div>
                        <div class="text">
                            <span>Phòng chờ</span>
                            <span style="font-size: 20px; padding-top: 5px"><?php echo $count_phong_cho; ?> phòng</span>
                        </div>
                        <div class="line"></div>
                        <span class="link">
                            <a href=""><i class="fas fa-key"></i>Thuê phòng</a>
                        </span>
                    </div>
                </div>
                <div class="box">
                    <div class="box-content">
                        <div class="icon"><i class="fas fa-door-closed" style="color: #ff5722"></i></div>
                        <div class="text">
                            <span>Phòng đang thuê</span>
                            <span style="font-size: 20px; padding-top: 5px"><?php echo $count_phong_dang_thue; ?> phòng</span>
                        </div>
                        <div class="line"></div>
                        <span class="link">
                            <a href=""><i class="fas fa-reply"></i>Thêm menu & trả phòng</a>
                        </span>
                    </div>
                </div>
            </div>
            <!-- <div class="box-lich-su-nhat-ky">

            </div> -->
        </div>
    </div>

    <script>
        var cap_nhat = document.getElementById("cap-nhat");
        cap_nhat.onclick = function () {
            location.reload();
        }
    </script>
</body>
</html>