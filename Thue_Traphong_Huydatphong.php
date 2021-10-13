<?php
    include_once("CSDL.php");

    $ten_phong = $_GET['phong'];

    $sql = "SELECT `phong`.`MaPhong`, `MaKhachHang`
    FROM `phong`, `datphong`
    WHERE `MaPhong` = `MaPhongDat`
    and `TenPhong` = '{$ten_phong}'";
    $query = DataProvider::ExecuteQuery($sql);
    $row = mysqli_fetch_array($query);
    $ma_khach_hang = $row['MaKhachHang'];
    $ma_phong = $row['MaPhong'];

    $sql = "DELETE FROM `datphong` 
    WHERE `MaKhachHang` = {$ma_khach_hang}
    and `MaPhongDat` = {$ma_phong}";
    $query = DataProvider::ExecuteQuery($sql);

    $sql = "SELECT * FROM `datphong` 
    WHERE `MaKhachHang` = {$ma_khach_hang}";
    $rows = DataProvider::ExecuteQuery($sql);
    $count = mysqli_num_rows($rows);

    if($count == 0) {
        $sql = "DELETE FROM `khachhang`
        WHERE `MaKhachHang` = '{$ma_khach_hang}'";
        $query = DataProvider::ExecuteQuery($sql);
    }

    $sql = "UPDATE `phong` SET `TinhTrang`='Trống' WHERE `TenPhong` = '{$ten_phong}'";
    $query = DataProvider::ExecuteQuery($sql);
    Header('Location:Thue_Traphong.php');
?>