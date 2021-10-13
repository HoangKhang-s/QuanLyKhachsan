<?php
    include_once("CSDL.php");
    $ten_phong = $_GET['phong'];
    $ngay_nhan_phong = $_GET['ngaynhanphong'];
    $ngay_tra_phong = $_GET['ngaytraphong'];

    $sql = "SELECT `MaPhong`
    FROM `phong`
    WHERE `TenPhong` = '{$ten_phong}'";
    $row = mysqli_fetch_array(DataProvider::ExecuteQuery($sql));
    $ma_phong = $row['MaPhong'];

    $thoi_gian_thue_phong = abs(strtotime($ngay_nhan_phong) - strtotime($ngay_tra_phong)) / 86400;

    $sql = "SELECT `GiaNgay`
    FROM `phong`, `cachtinhtien`
    WHERE `phong`.`MaCachTinhTien` = `cachtinhtien`.`MaCachTinhTien`
    and `MaPhong` = {$ma_phong}";
    $row = mysqli_fetch_array(DataProvider::ExecuteQuery($sql));
    $gia_ngay = $row['GiaNgay'];

    $tien_phong_du_tinh = $thoi_gian_thue_phong * $gia_ngay;

    $sql = "SELECT `MaKhachHang`, `TienDatTruoc`
    FROM `datphong`
    WHERE `MaPhongDat` = {$ma_phong}";
    $row = mysqli_fetch_array(DataProvider::ExecuteQuery($sql));
    $tien_dat_truoc = $row['TienDatTruoc'];
    $ma_khach_hang = $row['MaKhachHang'];

    $tong_tien_thanh_toan = $tien_phong_du_tinh - $tien_dat_truoc;

    $sql = "INSERT INTO `phongthue`(`MaPhong`, `MaKhachHang`, `ThueTheo`, `ThoiGianThuePhong`, `TienPhongDuTinh`, `TienTraTruoc`, `TongTienThanhToan`) 
    VALUES ({$ma_phong}, {$ma_khach_hang}, 'Thuê theo ngày', {$thoi_gian_thue_phong}, {$tien_phong_du_tinh}, {$tien_dat_truoc}, {$tong_tien_thanh_toan})";
    $query = DataProvider::ExecuteQuery($sql);

    $sql = "UPDATE `phong` SET `TinhTrang`='Đang sử dụng' WHERE `MaPhong` = {$ma_phong}";
    $query = DataProvider::ExecuteQuery($sql);

    Header('Location:Thue_Traphong.php');
?>