<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
    <link rel="stylesheet" href="Quanlyhethong_Cachtinhtien.css">
    <title>Cách tính tiền</title>
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
                <a href="Quanlyhethong.php" class="list-item-content selected">
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
            <a href="Quanlyhethong.php" class="back">
                <i class="fas fa-arrow-left"></i>
            </a>
            CÁCH TÍNH TIỀN
        </div>
        <div class="container-content">
            <div class="box-danh-sach">
                <?php
                    include_once("CSDL.php");
                    $sql = "SELECT * FROM `cachtinhtien`";
                    $rows = DataProvider::ExecuteQuery($sql);
                ?>
                <table class="danh-sach">
                    <tr>
                        <th>Tên cách tính</th>
                        <th>Giá qua đêm</th>
                        <th>Giá ngày</th>
                        <th>Phụ thu qua giờ</th>
                        <th>Chỉnh sửa</th>
                    </tr>
                    <?php while($row = mysqli_fetch_array($rows)) { ?>
                        <tr>
                            <td><?php echo $row['TenCachTinhTien'] ?></td>
                            <td><?php echo $row['GiaQuaDem'] ?> đ</td>
                            <td><?php echo $row['GiaNgay'] ?> đ</td>
                            <td><?php echo $row['PhuThuQuaGio'] ?> đ/Giờ</td>
                            <td>
                                <a href="Cachtinhtien_index.php?page_layout=Cachtinhtien_Chinhsua&id=<?php echo $row['MaCachTinhTien']; ?>" style="font-size: 16px; color: #27ae60;">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
            <div class="box-form">

            </div>
        </div>
    </div>
</body>
</html>