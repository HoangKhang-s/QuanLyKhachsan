<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
    <link rel="stylesheet" href="Quanlyhethong.css">
    <title>Quản lý hệ thống</title>
</head>
<body>
    <div class="header">
        <div class="logo"></div>
        <ul class="list">
            <li class="list-item">
                <a href="Trangchinh.php" class="list-item-content">
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
                <a href="" class="list-item-content selected">
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
        <div class="container-name">
            <div>
                <span>QUẢN LÝ HỆ THỐNG</span>
            </div>
        </div>
        <div class="container-content">
            <div class="boxs">
                <div class="box">
                    <a href="Quanlyhethong_Cachtinhtien.php">
                        <i class="fas fa-dollar-sign"></i>
                        <div class="line"></div>
                        <span>Cách tính tiền</span>
                    </a>
                </div>
                <div class="box">
                    <a href="Quanlyhethong_Loaiphong.php">
                        <i class="fas fa-home"></i>
                        <div class="line"></div>
                        <span>Loại phòng</span>
                    </a>
                </div>
                <div class="box">
                    <a href="Quanlyhethong_Phong.php">
                        <i class="fas fa-bed"></i>
                        <div class="line"></div>
                        <span>Phòng</span>
                    </a>
                </div>
                <div class="box">
                    <a href="Quanlyhethong_Menu.php">
                        <i class="fas fa-utensils"></i>
                        <div class="line"></div>
                        <span>Menu</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>