<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
    <link rel="stylesheet" href="thue_Traphong.css">
    <link rel="stylesheet" href="Thue_Traphong_Doiphong.css">
    <title>Thuê - Trả phòng</title>
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
                <span>THUÊ - TRẢ PHÒNG</span>
            </div>
        </div>
        <div class="container-content">
            <div class="content">
                <div class="label">
                    <label for="r1"><i class="fas fa-door-open" style="margin-right: 5px; font-size: 18px; color: #00b894"></i>Phòng chờ</label>
                    <label for="r2"><i class="fas fa-door-closed" style="margin-right: 5px; font-size: 18px; color: #e17055"></i>Phòng đang thuê</label>
                </div>
                <input type="radio" name="r" id="r1">
                <input type="radio" name="r" id="r2" checked>
                <div class="hightlight"></div>
                <div class="line"></div>
                <div class="slides">
                    <div class="slide-1">
                        <?php
                            ob_start();
                            include_once("CSDL.php");
                            $sql = "SELECT `MaPhong`, `TenPhong`, `TinhTrang` FROM `phong`";
                            $rows = DataProvider::ExecuteQuery($sql);

                            while($row = mysqli_fetch_array($rows)) { 
                                if($row['TinhTrang'] == "Trống") {
                                ?>
                                    <div class="box-phong">
                                        <div class="ten-phong"><?php echo $row['TenPhong']; ?></div>
                                        <div class="noi-dung-phong">
                                            <div class="trang-thai-phong">
                                                <div class="trang-thai">
                                                    <i class="fas fa-door-open icon"></i>
                                                    Chưa sử dụng
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                }
                                else {
                                    if($row['TinhTrang'] == "Đã đặt") {
                                        $sql = "SELECT `TenKhachHang`, `NgayNhanPhong`, `NgayTraPhong`, `SoDienThoai`
                                        FROM `khachhang`, `datphong`, `phong`
                                        WHERE `khachhang`.`MaKhachHang` = `datphong`.`MaKhachHang`
                                        and `phong`.`MaPhong` = `datphong`.`MaPhongDat`
                                        and `TenPhong` = '{$row['TenPhong']}'";

                                        $row_2 = mysqli_fetch_array(DataProvider::ExecuteQuery($sql));
                                    ?>
                                        <div class="box-phong box-phong-da-dat">
                                            <div class="ten-phong"><?php echo $row['TenPhong']; ?></div>
                                            <div class="noi-dung-phong">
                                                <div class="trang-thai-phong">
                                                    <div class="trang-thai">
                                                        <i class="fas fa-door-open icon"></i>
                                                        Đã đặt
                                                    </div>
                                                    <a href="Thue_Traphong_Nhanphongdadat.php?phong=<?php echo $row['TenPhong']; ?>&ngaynhanphong=<?php echo $row_2['NgayNhanPhong']; ?>&ngaytraphong=<?php echo $row_2['NgayTraPhong']; ?>&tenkhachhang=<?php echo $row_2['TenKhachHang']; ?>" class="btn-nhan-phong" onclick="return Confirm('<?php echo $row['TenPhong']; ?>')">Nhận phòng</a>
                                                    <a href="Thue_Traphong_Huydatphong.php?phong=<?php echo $row['TenPhong']; ?>" class="btn-huy-dat-phong" onclick="return Del('<?php echo $row['TenPhong']; ?>')">Hủy đặt phòng</a>
                                                </div>
                                                <div class="noi-dung-nguoi-dat">
                                                    <div class="box-ten-khach-hang">
                                                        <i class="far fa-id-card icon"></i> 
                                                        <?php echo $row_2['TenKhachHang'] ?>
                                                    </div>
                                                    <div class="box-thoi-gian-thue-phong">
                                                        <i class="far fa-clock icon"></i>
                                                        <?php
                                                            $row_2['NgayNhanPhong'] = date('d/m/Y', strtotime($row_2['NgayNhanPhong']));
                                                            $row_2['NgayTraPhong'] = date('d/m/Y', strtotime($row_2['NgayTraPhong']));
                                                            echo $row_2['NgayNhanPhong']." - ".$row_2['NgayTraPhong'];
                                                        ?>
                                                    </div>
                                                    <div class="box-so-dien-thoai">
                                                        <i class="fas fa-phone-alt icon"></i>
                                                        <?php echo $row_2['SoDienThoai']; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                    }
                                }
                        ?>

                            <?php
                            }
                        ?>
                    </div>
                    <div class="slide-2">
                        <?php
                            $sql = "SELECT `MaPhong`, `TenPhong`
                            FROM `phong`
                            WHERE `TinhTrang` = 'Đang sử dụng'";
                            $rows = DataProvider::ExecuteQuery($sql);

                            while($row = mysqli_fetch_array($rows)) {
                                $ma_phong = $row['MaPhong'];
                                $ten_phong = $row['TenPhong'];

                                $sql = "SELECT `ThueTheo`, `ThoiGianThuePhong`, `TienPhongDuTinh`, `TienTraTruoc`
                                FROM `phongthue`
                                WHERE `MaPhong` = {$ma_phong}";
                                $row_2 = mysqli_fetch_array(DataProvider::ExecuteQuery($sql));

                                $thue_theo = $row_2['ThueTheo'];
                                $thoi_gian_thue_phong = $row_2['ThoiGianThuePhong'];
                                $tien_phong_du_tinh = $row_2['TienPhongDuTinh'];
                                $tien_tra_truoc = $row_2['TienTraTruoc'];

                                $sql = "SELECT `DonGia`, `SoLuong`
                                FROM `menu`, `sudungmenu`
                                WHERE `MaPhong` = {$ma_phong}";
                                $rows_2 = DataProvider::ExecuteQuery($sql);

                                $tien_dung_menu = 0;

                                if($rows_2 != NULL) {
                                    while($row_2 = mysqli_fetch_array($rows_2)) {
                                        $tien_dung_menu += $row_2['DonGia'] * $row_2['SoLuong'];
                                    }
                                }

                                $tien_can_thanh_toan_du_tinh = $tien_dung_menu + $tien_phong_du_tinh - $tien_tra_truoc;
                            ?>
                                <div class="box-phong-thue">
                                    <div class="box-ten-phong-thue"><?php echo $ten_phong; ?></div>
                                    <div class="box-noi-dung-phong-thue">
                                        <div class="box-thue-theo">
                                            <i class="fas fa-sun icon"></i>
                                            <?php echo $thue_theo; ?>
                                        </div>
                                        <div class="box-thoi-gian-thue-phong">
                                            <i class="far fa-clock icon" title="Thời gian thuê phòng"></i>
                                            <?php echo $thoi_gian_thue_phong." Ngày"; ?>
                                        </div>
                                        <div class="box-btn-doi-phong">
                                            <a href="Thue_Traphong_Doiphong.php?phong=<?php echo $ten_phong; ?>" class="btn">Đổi phòng</a>
                                        </div>
                                        <div class="box-tien-dung-menu">
                                            <i class="fas fa-utensils icon" title="Tiền dùng menu"></i>
                                            <?php echo $tien_dung_menu; ?>
                                        </div>
                                        <div class="box-phong-du-tinh">
                                            <i class="fas fa-bed icon" title="Tiền phòng dự tính"></i>
                                            <?php echo $tien_phong_du_tinh; ?>
                                        </div>
                                        <div class="box-btn-them-menu">
                                            <a href="" class="btn">Thêm menu</a>
                                        </div>
                                        <div class="box-tien-tra-truoc">
                                            <i class="far fa-credit-card icon" title="Tiền trả trước"></i>
                                            <?php echo $tien_tra_truoc; ?>
                                        </div>
                                        <div class="box-tien-can-thanh-toan-du-tinh">
                                            <i class="fas fa-dollar-sign icon" title="Tiền cần thanh toán dự tính"></i>
                                            <?php echo $tien_can_thanh_toan_du_tinh; ?>
                                        </div>
                                        <div class="box-btn-tra-phong">
                                            <a href="" class="btn">Trả phòng</a>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            }
                        ?>
                    </div>
                </div>
            </div>
            <div class="box-form">
                <?php
                    $ten_phong_cu = $_GET['phong'];
                ?>
                <form action="" method="POST" class="form">
                    <select name="loai-phong" id="loai-phong">
                        <option value="Phòng đơn">Phòng đơn</option>
                        <option value="Phòng đôi">Phòng đôi</option>
                    </select>
                    <input type="submit" class="btn-tim-kiem" name="btn-tim-kiem" value="Tìm kiếm">

                    <?php
                            $loai_phong = (isset($_POST['loai-phong'])) ? $_POST['loai-phong'] : "Phòng đơn";

                            $sql = "SELECT `TenPhong`
                            FROM `loaiphong`, `phong`
                            WHERE `loaiphong`.`MaLoaiPhong` = `phong`.`MaLoaiPhong`
                            and `TenLoaiPhong` = '$loai_phong'
                            and `TinhTrang` = 'Trống'";
                            $rows = DataProvider::ExecuteQuery($sql);
                        ?>
                        
                        <select name="phong" id="phong">

                        <?php
                            while ($row = mysqli_fetch_array($rows)) {
                            ?>
                            <option value="<?php echo $row['TenPhong']; ?>"><?php echo $row['TenPhong']; ?></option>  
                            <?php
                            }
                    ?>
                    </select>

                    <input type="submit" class="btn-luu" name="btn-luu" value="Lưu">
                </form>
                <?php
                    if(isset($_POST['btn-luu'])) {
                        $ten_phong_moi = (isset($_POST['phong'])) ? $_POST['phong'] : "";

                        $sql = "SELECT `MaPhong`
                        FROM `phong`
                        WHERE `TenPhong` = '{$ten_phong_moi}'";
                        $row = mysqli_fetch_array(DataProvider::ExecuteQuery($sql));
                        $ma_phong_moi = $row['MaPhong'];

                        $sql = "SELECT `MaPhong`
                        FROM `phong`
                        WHERE `TenPhong` = '{$ten_phong_cu}'";
                        $row = mysqli_fetch_array(DataProvider::ExecuteQuery($sql));
                        $ma_phong_cu = $row['MaPhong'];

                        $sql = "UPDATE `phong` SET `TinhTrang`='Trống' WHERE `MaPhong` = {$ma_phong_cu}";
                        $query = DataProvider::ExecuteQuery($sql);

                        $sql = "UPDATE `phong` SET `TinhTrang`='Đang sử dụng' WHERE `MaPhong` = {$ma_phong_moi}";
                        $query = DataProvider::ExecuteQuery($sql);

                        $sql = "UPDATE `datphong` SET `MaPhongDat`='$ma_phong_moi' WHERE `MaPhongDat` = {$ma_phong_cu}";
                        $query = DataProvider::ExecuteQuery($sql);

                        $sql = "SELECT `GiaNgay`
                        FROM `phong`, `cachtinhtien`
                        WHERE `cachtinhtien`.`MaCachTinhTien` = `phong`.`MaCachTinhTien`
                        and `MaPhong` = {$ma_phong_moi}";
                        $row = mysqli_fetch_array(DataProvider::ExecuteQuery($sql));
                        $gia_ngay_moi = $row['GiaNgay'];

                        $sql = "SELECT `ThoiGianThuePhong`, `TienTraTruoc`
                        FROM `phongthue`
                        WHERE `MaPhong` = {$ma_phong_cu}";
                        $row = mysqli_fetch_array(DataProvider::ExecuteQuery($sql));

                        $thoi_gian_thue_phong_cu = $row['ThoiGianThuePhong'];
                        $tien_tra_truoc_cu = $row['TienTraTruoc'];

                        $tien_phong_du_tinh_moi = $gia_ngay_moi * $thoi_gian_thue_phong_cu;
                        $tong_tien_thanh_toan_moi = $tien_phong_du_tinh_moi - $tien_tra_truoc_cu;

                        $sql = "UPDATE `phongthue` 
                        SET `MaPhong`={$ma_phong_moi},`TienPhongDuTinh`={$tien_phong_du_tinh_moi},`TongTienThanhToan`={$tong_tien_thanh_toan_moi} 
                        WHERE `MaPhong` = {$ma_phong_cu}";
                        $query = DataProvider::ExecuteQuery($sql);

                        $sql = "UPDATE `sudungmenu` SET `MaPhong`={$ma_phong_moi} WHERE `MaPhong` = {$ma_phong_cu}";
                        $query = DataProvider::ExecuteQuery($sql);

                        Header('Location:Thue_Traphong.php');
                    }
                ?>
            </div>
        </div>
    </div>

    <script>
        function Del (tenphong) {
            return confirm("Bạn có chắc muốn hủy đặt phòng " + tenphong + "?");
        }
        function Confirm (tenphong) {
            return confirm("Xác nhận nhận phòng " + tenphong + "?");
        }
    </script>
</body>
</html>