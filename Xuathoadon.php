<?php
ob_start();
include_once("CSDL.php");

$ho_ten_khach_hang = $_GET['hotenkhachhang'];
$que_quan = $_GET['quequan'];
$sdt = $_GET['sdt'];
$ma_hoa_don = $_GET['mahoadon'];
$phong = $_GET['phong'];
$so_ngay = $_GET['songay'];
$ngay_nhan_phong = $_GET['ngaynhanphong'];
$ngay_tra_phong = $_GET['ngaytraphong'];
$tong_tien_phong = $_GET['tongtienphong'];
$ma_phong = $_GET['maphong'];
$tong_tien_menu = $_GET['tongtienmenu'];
$tong_tien = $_GET['tongtien'];
$tien_tra_truoc = $_GET['tientratruoc'];
$tong_tien_thanh_toan = $_GET['tongtienthanhtoan'];
$ngay_hom_nay = date('d/m/Y');

$sql = "SELECT `TenMenu`, `SoLuong`, `DonGia`, `TongTien`
FROM `menu`, `sudungmenu`
WHERE `menu`.`MaMenu` = `sudungmenu`.`MaMenu`
and `MaPhong` = {$ma_phong}";
$rows = DataProvider::ExecuteQuery($sql);

$sql = "DELETE FROM `sudungmenu` WHERE `MaPhong` = {$ma_phong}";
$query = DataProvider::ExecuteQuery($sql);

$sql = "DELETE FROM `phongthue` WHERE `MaPhong` = {$ma_phong}";
$query = DataProvider::ExecuteQuery($sql);

$sql = "SELECT `MaKhachHang`
FROM `datphong`
WHERE `MaPhongDat` = {$ma_phong}";
$row = mysqli_fetch_array(DataProvider::ExecuteQuery($sql));

$ma_khach_hang = $row['MaKhachHang'];

$sql = "DELETE FROM `datphong` WHERE `MaPhongDat` = {$ma_phong}";
$query = DataProvider::ExecuteQuery($sql);

$sql = "DELETE FROM `khachhang` WHERE `MaKhachHang` = {$ma_khach_hang}";
$query = DataProvider::ExecuteQuery($sql);

$sql = "UPDATE `phong` SET `TinhTrang`='Trống' WHERE `MaPhong` = {$ma_phong}";
$query = DataProvider::ExecuteQuery($sql);

$stt = 1;

$fp = "Hoadon.txt";
$fo = fopen($fp, "w");

$noi_dung = "                              HÓA ĐƠN                                 \n".
            "Họ tên khách hàng: {$ho_ten_khach_hang}                                   \n".
            "Quê quán: {$que_quan}                                                    \n".
            "Số điện thoại: {$sdt}                                             \n".
            "Mã hóa đơn: {$ma_hoa_don}                                         Ngày: {$ngay_hom_nay}\n".
            "--------- Tiền phòng---------                                         \n".
            "STT   Phòng  Số ngày   Ngày nhận phòng  Ngày trả phòng   Thành tiền   \n".
            " 1    {$phong}     {$so_ngay}        {$ngay_nhan_phong}       {$ngay_hom_nay}       {$tong_tien_phong}     \n".
            "                                             Tổng tiền:    {$tong_tien_phong}     \n".
            "--------- Tiền dịch vụ-------                                         \n".
            "STT         Tên menu           Số lượng    Đơn giá      Thành tiền    \n";
fwrite($fo, $noi_dung);
while($row = mysqli_fetch_array($rows)) {
            $noi_dung = " {$stt}           {$row['TenMenu']}                {$row['SoLuong']}         {$row['DonGia']}         {$row['TongTien']}       \n";
            fwrite($fo, $noi_dung);
            $stt = $stt + 1;
}
$noi_dung = "                                             Tổng tiền:   {$tong_tien_menu}       \n".
            "--------- Tổng thanh toán----                                         \n".
            "                                             Tổng tiền:   {$tong_tien}      \n".
            "                                             Trả trước:   {$tien_tra_truoc}      \n".
            "                                       Tổng thanh toán:   {$tong_tien_thanh_toan}      \n".
            "                                             Khách trả:   {$tong_tien_thanh_toan}      \n".
            "                  Cảm ơn quý khách và hẹn gặp lại                     \n".
            "\n".
            "       Khách hàng                                    Nhân viên        \n";
fwrite($fo, $noi_dung);

// Xử lí download

// Báo cho trình duyệt biết dữ liệu trả về là dạng nhị phân
Header("content-Type: application/octet-stream");

// Thông báo dung lượng file muốn download
Header("Content-Length: ".filesize($fp));

// Thông báo cho trình duyệt tên file và phải được download
Header("Content-Disposition: atttachment; filename=".$fp);

// Đọc nội dung file và trả lại cho trình duyệt để xử lí
readfile ($fp);

// Kết thúc download
$fc = fclose($fo);
?>