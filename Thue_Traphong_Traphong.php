<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
    <link rel="stylesheet" href="thue_Traphong_Traphong.css">
    <title>Hóa đơn</title>
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
                <a href="Thue_Traphong.php" class="list-item-content selected">
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
        <div class="container-name">
            <div>
                <span>HÓA ĐƠN</span>
            </div>
        </div>
        <div class="container-content">
            <div class="box-hoa-don">
            <?php
                include_once("CSDL.php");

                $ten_phong_thue = $_GET['phong'];
                // thêm hoa đơn -> database
                $sql = "SELECT `phong`.`MaPhong`, `MaKhachHang`, `TienPhongDuTinh`, `TienTraTruoc`
                FROM `phongthue`, `phong`
                WHERE `phongthue`.`MaPhong` = `phong`.`MaPhong`
                and `TenPhong` = '{$ten_phong_thue}'";
                $row = mysqli_fetch_array(DataProvider::ExecuteQuery($sql));

                $ma_phong_thue = $row['MaPhong'];
                $ma_khach_hang = $row['MaKhachHang'];

                $tong_tien_phong = $row['TienPhongDuTinh'];
                $tien_tra_truoc = $row['TienTraTruoc'];

                $sql = "SELECT `TenKhachHang`
                FROM `khachhang`
                WHERE `MaKhachHang` = {$ma_khach_hang}";
                $row = mysqli_fetch_array(DataProvider::ExecuteQuery($sql));

                $ho_ten_khach_hang = $row['TenKhachHang'];

                $sql = "SELECT `DonGia`, `SoLuong`
                FROM `menu`, `sudungmenu`
                WHERE `menu`.`MaMenu` = `sudungmenu`.`MaMenu`
                and `MaPhong` = {$ma_phong_thue}";
                $rows = DataProvider::ExecuteQuery($sql);

                $tong_tien_menu = 0;

                while($row = mysqli_fetch_array($rows)) {
                    $tong_tien_menu += $row['DonGia'] * $row['SoLuong'];
                }

                $tong_tien_thanh_toan = $tong_tien_phong + $tong_tien_menu - $tien_tra_truoc;

                $sql = "INSERT INTO `hoadon`(`HoTenKhachHang`, `TenPhongThue`, `TongTienPhong`, `TongTienMenu`, `TienTraTruoc`, `TongTienThanhToan`) 
                VALUES ('{$ho_ten_khach_hang}','{$ten_phong_thue}',{$tong_tien_phong},{$tong_tien_menu},{$tien_tra_truoc},{$tong_tien_thanh_toan})";
                $query = DataProvider::ExecuteQuery($sql);

                // lấy thông tin để ghi hóa đơn

                $sql = "SELECT `TenKhachHang`, `QueQuan`, `SoDienThoai`
                FROM `khachhang`
                WHERE `MaKhachHang` = {$ma_khach_hang}";
                $row = mysqli_fetch_array(DataProvider::ExecuteQuery($sql));

                $ho_ten_khach_hang = $row['TenKhachHang'];
                $que_quan = $row['QueQuan'];
                $sdt = $row['SoDienThoai'];

                $sql = "SELECT MAX(`MaHoaDon`) as `MaHoaDon`
                FROM `hoadon`
                WHERE `TenPhongThue` = '{$ten_phong_thue}'";
                $row = mysqli_fetch_array(DataProvider::ExecuteQuery($sql));

                $ma_hoa_don = $row['MaHoaDon'];
                $ngay_hom_nay = date('d/m/Y');
                $phong = $ten_phong_thue;

                $sql = "SELECT `ThoiGianThuePhong`, `NgayNhanPhong`, `NgayTraPhong`, `TienPhongDuTinh`
                FROM `phongthue`, `phong`, `datphong`
                WHERE `phong`.`MaPhong` = `MaPhongDat`
                and `phong`.`MaPhong` = `phongthue`.`MaPhong`
                and `TenPhong` = '{$phong}'";
                $row = mysqli_fetch_array(DataProvider::ExecuteQuery($sql));

                $so_ngay = $row['ThoiGianThuePhong'];
                $ngay_nhan_phong = date('d/m/Y', strtotime($row['NgayNhanPhong']));
                $ngay_tra_phong = date('d/m/Y', strtotime($row['NgayTraPhong']));
                $tong_tien_phong = $row['TienPhongDuTinh'];

                $sql = "SELECT `TongTienMenu`, `TienTraTruoc`, `TongTienThanhToan`
                FROM `hoadon`
                WHERE `MaHoaDon` = {$ma_hoa_don}";
                $row = mysqli_fetch_array(DataProvider::ExecuteQuery($sql));

                $tong_tien_menu = $row['TongTienMenu'];

                $tong_tien = $tong_tien_phong + $tong_tien_menu;
                $tien_tra_truoc = $row['TienTraTruoc'];
                $tong_tien_thanh_toan = $row['TongTienThanhToan'];
            ?>
            <pre>
  Họ tên khách hàng: <?php echo $ho_ten_khach_hang; ?> <br>
  Quê quán: <?php echo $que_quan; ?> <br>
  Số điện thoại: <?php echo $sdt; ?> <br>
  Mã hóa đơn: <?php echo $ma_hoa_don; ?>                                         Ngày: <?php echo $ngay_hom_nay; ?> <br>
  --------- Tiền phòng--------- <br>
  STT   Phòng  Số ngày   Ngày nhận phòng  Ngày trả phòng   Thành tiền <br>
   1    <?php echo $phong; ?>     <?php echo $so_ngay; ?>        <?php echo $ngay_nhan_phong; ?>       <?php echo $ngay_hom_nay; ?>       <?php echo $tong_tien_phong; ?> <br>
                                               Tổng tiền:    <?php echo $tong_tien_phong; ?> <br>
  --------- Tiền dịch vụ------- <br>
  STT         Tên menu           Số lượng    Đơn giá      Thành tiền <br>
<?php
$sql = "SELECT `TenMenu`, `SoLuong`, `DonGia`, `TongTien`
FROM `menu`, `sudungmenu`
WHERE `menu`.`MaMenu` = `sudungmenu`.`MaMenu`
and `MaPhong` = {$ma_phong_thue}";
$rows = DataProvider::ExecuteQuery($sql);

$stt = 1;

while($row = mysqli_fetch_array($rows)) { 
?>
   <?php echo $stt; ?>           <?php echo $row['TenMenu']; ?>                <?php echo $row['SoLuong']; ?>         <?php echo $row['DonGia']; ?>         <?php echo $row['TongTien']; ?> <br> 
<?php
$stt = $stt + 1;
}
?>
                                               Tổng tiền:   <?php echo $tong_tien_menu; ?> <br>
  --------- Tổng thanh toán---- <br>
                                              Tổng tiền:   <?php echo $tong_tien; ?> <br>
                                              Trả trước:   <?php echo $tien_tra_truoc; ?> <br>
                                        Tổng thanh toán:   <?php echo $tong_tien_thanh_toan; ?> <br>
                                              Khách trả:   <?php echo $tong_tien_thanh_toan; ?> <br>
            </pre>
          </div>
          <a href="Xuathoadon.php?hotenkhachhang=<?php echo $ho_ten_khach_hang; ?>&quequan=<?php echo $que_quan; ?>&sdt=<?php echo $sdt; ?>&mahoadon=<?php echo $ma_hoa_don; ?>&phong=<?php echo $phong; ?>&songay=<?php echo $so_ngay; ?>&ngaynhanphong=<?php echo $ngay_nhan_phong; ?>&ngaytraphong=<?php echo $ngay_tra_phong; ?>&tongtienphong=<?php echo $tong_tien_phong; ?> <br>&maphong=<?php echo $ma_phong_thue; ?>&tongtienmenu=<?php echo $tong_tien_menu; ?>&tongtien=<?php echo $tong_tien; ?>&tientratruoc=<?php echo $tien_tra_truoc; ?>&tongtienthanhtoan=<?php echo $tong_tien_thanh_toan; ?>" class="btn-xuat-hoa-don">Xuất hóa đơn</a>
        </div>
    </div>
</body>
</html>