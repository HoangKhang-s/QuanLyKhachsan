<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
    <link rel="stylesheet" href="Cachtinhtien_Chinhsua.css">
    <title>Cách tính tiền</title>
</head>
<body>
    <?php 
        ob_start(); 
        include_once("CSDL.php");
        $id = $_GET['id'];
        $sql = "SELECT * FROM `cachtinhtien` WHERE `MaCachTinhTien` = $id";
        $rows_up = DataProvider::ExecuteQuery($sql);
        $row_up = mysqli_fetch_assoc($rows_up);
    ?>
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
                <form action="" method="POST" class="form">
                    <div class="header-form">
                        <span class="name-form">CHỈNH SỬA</span>
                        <input type="submit" name="submit" class="btn-luu" value="Lưu">
                    </div>
                    <div class="form-group">
                        <label class="label-ten-cach-tinh">Tên cách tính: <?php echo $row_up['TenCachTinhTien']; ?></label>
                    </div>
                    <div class="form-group">
                        <label class="label-gia-qua-dem">Giá qua đêm:</label>
                        <input type="number" name="gia-qua-dem" class="input-gia-qua-dem" value="<?php echo $row_up['GiaQuaDem'] / 1000; ?>" autocomplete = "off">
                        <span>.000 đ</span>
                    </div>
                    <div class="form-group">
                        <label class="label-gia-ngay">Giá ngày:</label>
                        <input type="number" name="gia-ngay" class="input-gia-ngay" value="<?php echo $row_up['GiaNgay'] / 1000; ?>" autocomplete = "off">
                        <span>.000 đ</span>
                    </div>
                    <div class="form-group">
                        <label class="label-phu-thu-qua-gio">Phụ thu quá giờ:</label>
                        <input type="number" name="phu-thu-qua-gio" class="input-phu-thu-qua-gio" value="<?php echo $row_up['PhuThuQuaGio'] / 1000; ?>" autocomplete = "off">
                        <span>.000 đ/Giờ</span>
                    </div>
                    <?php
                        $thong_bao_gia_qua_dem = '';
                        $thong_bao_gia_ngay = '';
                        $thong_bao_phu_thu_qua_gio = '';

                        $gia_qua_dem = '#';
                        $gia_ngay = '#';
                        $phu_thu_qua_gio = '#';

                        $kiem_tra = false;

                        if(isset($_POST['submit'])) {
                            $gia_qua_dem = $_POST['gia-qua-dem'];
                            $gia_ngay = $_POST['gia-ngay'];
                            $phu_thu_qua_gio = $_POST['phu-thu-qua-gio'];

                            if($gia_qua_dem != '' && $gia_ngay != '' && $phu_thu_qua_gio != '') {
                                $gia_qua_dem *= 1000;
                                $gia_ngay *= 1000;
                                $phu_thu_qua_gio *= 1000;
                                $sql = "UPDATE `cachtinhtien` SET `GiaQuaDem` = '$gia_qua_dem', `GiaNgay` = '$gia_ngay', `PhuThuQuaGio` = $phu_thu_qua_gio WHERE `MaCachTinhTien` = $id";
                                DataProvider::ExecuteQuery($sql);
                                header('location: Quanlyhethong_CachTinhTien.php');    
                                
                            }
                            else {
                                if($gia_qua_dem == '') $thong_bao_gia_qua_dem = "Vui lòng điền giá qua đêm.";
                                if($gia_ngay == '') $thong_bao_gia_ngay = "Vui lòng điền giá ngày.";
                                if($phu_thu_qua_gio == '') $thong_bao_phu_thu_qua_gio = "Vui lòng điền phụ thu quá giờ.";
                            }
                        }
                    ?>
                    <span class="thong-bao-1"><?php echo $thong_bao_gia_qua_dem; ?></span>
                    <span class="thong-bao-2"><?php echo $thong_bao_gia_ngay; ?></span>
                    <span class="thong-bao-3"><?php echo $thong_bao_phu_thu_qua_gio; ?></span>
                </form>
            </div>
        </div>
    </div>
</body>
</html>