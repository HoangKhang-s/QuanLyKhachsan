<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
    <link rel="stylesheet" href="quanlyhethong_Phong.css">
    <link rel="stylesheet" href="Phong_Them.css">
    <title>Menu</title>
</head>
<body>
    <?php ob_start(); ?>
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
            PHÒNG
            <a href="Phong_Them.php" class="btn-them-moi">
                <i class="fas fa-folder-plus font-size-them-moi"></i>
                Thêm mới
            </a>
        </div>
        <div class="container-content">
            <div class="box-danh-sach">
                <form action="" method="POST" class="box-tim-kiem">
                    <input type="text" name="input-tim-kiem" autocomplete="off" placeholder="Tìm kiếm">
                    <input type="submit" name="tim-kiem" value="Tìm kiếm" class="input-tim-kiem">
                    <input type="submit" name="huy-tim-kiem" id="input-huy-tim-kiem" value="Hủy tìm kiếm" class="input-huy-tim-kiem">
                    <select name="loai-phong" id="loai-phong">
                        <option value=""></option>
                        <option value="Phòng đơn">Phòng đơn</option>
                        <option value="Phòng đôi">Phòng đôi</option>
                    </select>
                </form>
                <?php
                    include_once("CSDL.php");
                    $rows_1 = NULL;
                    $rows_2 = NULL;
                    $input_tim_kiem = (isset($_POST['input-tim-kiem'])) ? $_POST['input-tim-kiem'] : "";
                    $input_loai_phong = (isset($_POST['loai-phong'])) ? $_POST['loai-phong'] : "";
                    if(isset($_POST['huy-tim-kiem']) || ($input_tim_kiem == "" && $input_loai_phong == "")) {
                        $sql = "SELECT `MaPhong`, `TenPhong`, `TenLoaiPhong`, `TenCachTinhTien` 
                        FROM `loaiphong`, `phong`, `cachtinhtien` 
                        WHERE `loaiphong`.`MaLoaiPhong` = `phong`.`MaLoaiPhong` 
                        and `cachtinhtien`.`MaCachTinhTien` = `phong`.`MaCachTinhTien`
                        and `phong`.`MaLoaiPhong` = 1";
                        $rows_1 = DataProvider::ExecuteQuery($sql);
                        $sql = "SELECT `MaPhong`, `TenPhong`, `TenLoaiPhong`, `TenCachTinhTien` 
                        FROM `loaiphong`, `phong`, `cachtinhtien` 
                        WHERE `loaiphong`.`MaLoaiPhong` = `phong`.`MaLoaiPhong` 
                        and `cachtinhtien`.`MaCachTinhTien` = `phong`.`MaCachTinhTien`
                        and `phong`.`MaLoaiPhong` = 2";
                        $rows_2 = DataProvider::ExecuteQuery($sql);
                    }
                    else {
                        if($input_tim_kiem != "" && $input_loai_phong == "") {
                            $sql = "SELECT `MaPhong`, `TenPhong`, `TenLoaiPhong`, `TenCachTinhTien` 
                            FROM `loaiphong`, `phong`, `cachtinhtien` 
                            WHERE `loaiphong`.`MaLoaiPhong` = `phong`.`MaLoaiPhong` 
                            and `cachtinhtien`.`MaCachTinhTien` = `phong`.`MaCachTinhTien`
                            and `loaiphong`.`MaLoaiPhong` = `phong`.`MaLoaiPhong`
                            and `TenPhong` like '%{$input_tim_kiem}%'";
                            $rows_1 = DataProvider::ExecuteQuery($sql);
                            $rows_2 = false;
                        }
                        else {
                            if($input_tim_kiem == "" && $input_loai_phong != "") {
                                $sql = "SELECT `MaPhong`, `TenPhong`, `TenLoaiPhong`, `TenCachTinhTien` 
                                FROM `loaiphong`, `phong`, `cachtinhtien` 
                                WHERE `loaiphong`.`MaLoaiPhong` = `phong`.`MaLoaiPhong` 
                                and `cachtinhtien`.`MaCachTinhTien` = `phong`.`MaCachTinhTien`
                                and `loaiphong`.`MaLoaiPhong` = `phong`.`MaLoaiPhong`
                                and `TenLoaiPhong` = '{$input_loai_phong}'";
                                $rows_1 = DataProvider::ExecuteQuery($sql);
                                $rows_2 = false;
                            }
                            else {
                                $sql = "SELECT `MaPhong`, `TenPhong`, `TenLoaiPhong`, `TenCachTinhTien` 
                                FROM `loaiphong`, `phong`, `cachtinhtien` 
                                WHERE `loaiphong`.`MaLoaiPhong` = `phong`.`MaLoaiPhong` 
                                and `cachtinhtien`.`MaCachTinhTien` = `phong`.`MaCachTinhTien`
                                and `loaiphong`.`MaLoaiPhong` = `phong`.`MaLoaiPhong`
                                and `TenPhong` like '%{$input_tim_kiem}%'
                                and `TenLoaiPhong` = '{$input_loai_phong}'";
                                $rows_1 = DataProvider::ExecuteQuery($sql);
                                $rows_2 = false;
                            }
                        }
                    }
                ?>
                <table class="danh-sach">
                    <tr>
                        <th>Tên phòng</th>
                        <th>Loại phòng</th>
                        <th>Cách tính tiền</th>
                        <th>Chỉnh sửa</th>
                        <th>Xóa</th>
                    </tr>
                    <?php 
                        if($rows_1) {
                            while($row = mysqli_fetch_array($rows_1)) { ?>
                                <tr>
                                    <td><?php echo $row['TenPhong'] ?></td>
                                    <td><?php echo $row['TenLoaiPhong'] ?></td>
                                    <td><?php echo $row['TenCachTinhTien'] ?></td>
                                    <td>
                                        <a href="Phong_index.php?page_layout=Phong_Chinhsua&id=<?php echo $row['MaPhong']; ?>" style="font-size: 16px; color: #27ae60;">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <a onclick="return Del('<?php echo $row['TenPhong']; ?>')" href="Phong_index.php?page_layout=Phong_Xoa&id=<?php echo $row['MaPhong']; ?>" style="font-size: 16px; color: #e74c3c;">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php
                            } 
                        }
                    ?>
                    <?php
                        if($rows_2) {
                            while($row = mysqli_fetch_array($rows_2)) { ?>
                                <tr>
                                    <td><?php echo $row['TenPhong'] ?></td>
                                    <td><?php echo $row['TenLoaiPhong'] ?></td>
                                    <td><?php echo $row['TenCachTinhTien'] ?></td>
                                    <td>
                                        <a href="Phong_index.php?page_layout=Phong_Chinhsua&id=<?php echo $row['MaPhong']; ?>" style="font-size: 16px; color: #27ae60;">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <a onclick="return Del('<?php echo $row['TenPhong']; ?>')" href="Phong_index.php?page_layout=Phong_Xoa&id=<?php echo $row['MaPhong']; ?>" style="font-size: 16px; color: #e74c3c;">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php
                            } 
                        }
                    ?>
                    <script>
                        function Del (name) {
                            return confirm("Bạn có chắc muốn xóa tên phòng: " + name + "?");
                        }
                    </script>
                </table>
            </div>
            <div class="box-form">
                <form action="" method="POST" class="form">
                    <div class="header-form">
                        <span class="name-form">THÊM MỚI</span>
                        <input type="submit" name="submit" class="btn-luu" value="Lưu">
                    </div>
                    <div class="form-group">
                        <label class="label-ten-phong">Tên phòng:</label>
                        <input type="text" name="ten-phong" class="input-ten-phong">
                    </div>
                    <div class="form-group">
                        <label class="label-loai-phong">Loại phòng:</label>
                        <select name="list-loai-phong" id="list-loai-phong">
                            <!-- <option value=""></option> -->
                            <option value="1">Phòng đơn</option>
                            <option value="2">Phòng đôi</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="label-cach-tinh-tien">Cách tính tiền:</label>
                        <select name="list-cach-tinh-tien" id="list-cach-tinh-tien">
                            <option value="1">Phòng đơn</option>
                            <option value="2">Phòng đôi</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="label-mo-ta">Mô tả:</label>
                        <input type="text" name="mo-ta" class="input-mo-ta">
                    </div>
                    <?php
                        $thong_bao_ten_phong = '';
                        $thong_bao_trung_ten_phong = '';

                        $ten_phong = '#';
                        $loai_phong = '#';
                        $cach_tinh_tien = '#';
                        $mo_ta = '#';

                        $kiem_tra = false;

                        if(isset($_POST['submit'])) {
                            $ten_phong = $_POST['ten-phong'];
                            $loai_phong = $_POST['list-loai-phong'];
                            $cach_tinh_tien = $_POST['list-cach-tinh-tien'];
                            $mo_ta = $_POST['mo-ta'];

                            if($ten_phong != '') {
                                $sql = "SELECT * FROM `phong` WHERE `TenPhong` like '{$ten_phong}'";
                                $rows = DataProvider::ExecuteQuery($sql);

                                while ($row = mysqli_fetch_array($rows)) {
                                    $kiem_tra = true;
                                }

                                if($kiem_tra == 1) {
                                    $thong_bao_trung_ten_phong = "Tên phòng đã tồn tại.";
                                }
                                else {
                                    $sql = "INSERT INTO `phong` (`TenPhong`, `MaCachTinhTien`, `MaLoaiPhong`, `MoTaPhong`,`TinhTrang`) VALUES ('$ten_phong', $loai_phong, $cach_tinh_tien, '$mo_ta', 'Trống')";
                                    DataProvider::ExecuteQuery($sql);
                                    header('location: Quanlyhethong_Phong.php');    
                                }
                            }
                            else {
                                if($ten_phong === '') $thong_bao_ten_phong = "Vui lòng điền tên phòng.";
                            }
                        }
                    ?>
                    <span class="thong-bao"><?php echo $thong_bao_trung_ten_phong; ?></span>
                    <span class="thong-bao"><?php echo $thong_bao_ten_phong; ?></span>
                </form>
            </div>
        </div>
    </div>
</body>
</html>