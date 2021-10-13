<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
    <link rel="stylesheet" href="Datphong.css">
    <title>Đặt phòng</title>
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
                <a href="" class="list-item-content selected">
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
                <span>ĐẶT PHÒNG</span>
            </div>
        </div>
        <div class="container-content">
            <div class="box-danh-sach-dat-phong">
                <form action="" method="POST" class="form-tim-kiem">
                    <input type="text" name="input-tim-kiem" placeholder="Tìm kiếm" autocomplete="off" class="input-tim-kiem">
                    <input type="submit" name="btn-tim-kiem" value="Tìm kiếm" class="btn-tim-kiem">
                    <input type="submit" name="btn-huy-tim-kiem" value="Hủy tìm kiếm" class="btn-huy-tim-kiem">
                    <select name="input-loai-phong" id="input-loai-phong">
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
                    $input_loai_phong = (isset($_POST['input-loai-phong'])) ? $_POST['input-loai-phong'] : "";
                    if(isset($_POST['btn-huy-tim-kiem']) || ($input_tim_kiem == "" && $input_loai_phong == "")) {
                        $sql = "SELECT `TenPhong`, `TenLoaiPhong` 
                        FROM `phong`, `loaiphong`
                        WHERE `phong`.`MaLoaiPhong` = `loaiphong`.`MaLoaiPhong`
                        and `phong`.`MaLoaiPhong` = 1
                        and `TinhTrang` = 'Trống'";
                        $rows_1 = DataProvider::ExecuteQuery($sql);
                        $sql = "SELECT `TenPhong`, `TenLoaiPhong` 
                        FROM `phong`, `loaiphong`
                        WHERE `phong`.`MaLoaiPhong` = `loaiphong`.`MaLoaiPhong`
                        and `phong`.`MaLoaiPhong` = 2
                        and `TinhTrang` = 'Trống'";
                        $rows_2 = DataProvider::ExecuteQuery($sql);
                    }
                    else {
                        if($input_tim_kiem != "" && $input_loai_phong == "") {
                            $sql = "SELECT `TenPhong`, `TenLoaiPhong`
                            FROM `phong`, `loaiphong`
                            WHERE `phong`.`MaLoaiPhong` = `loaiphong`.`MaLoaiPhong`
                            and `TenPhong` like '%{$input_tim_kiem}%'
                            and `TinhTrang` = 'Trống'";
                            $rows_1 = DataProvider::ExecuteQuery($sql);
                        }
                        else {
                            if($input_tim_kiem == "" && $input_loai_phong != "") {
                                $sql = "SELECT `TenPhong`, `TenLoaiPhong`
                                FROM `phong`, `loaiphong`
                                WHERE `phong`.`MaLoaiPhong` = `loaiphong`.`MaLoaiPhong`
                                and `loaiphong`.`TenLoaiPhong` = '{$input_loai_phong}'
                                and `TinhTrang` = 'Trống'";
                                $rows_1 = DataProvider::ExecuteQuery($sql);
                            }
                            else {
                                $sql = "SELECT `TenPhong`, `TenLoaiPhong`
                                FROM `phong`, `loaiphong`
                                WHERE `phong`.`MaLoaiPhong` = `loaiphong`.`MaLoaiPhong`
                                and `loaiphong`.`TenLoaiPhong` = '{$input_loai_phong}'
                                and `TenPhong` like '%{$input_tim_kiem}%'
                                and `TinhTrang` = 'Trống'";
                                $rows_1 = DataProvider::ExecuteQuery($sql);
                            }
                        }
                    }
                ?>
                <table class="danh-sach-dat-phong">
                    <tr class="header-table">
                        <td>Tên phòng</td>
                        <td>Loại phòng</td>
                        <td style="width: 150px"></td>
                    </tr>

                    <?php 
                    if($rows_1) {
                        while($row = mysqli_fetch_assoc($rows_1)) { ?>
                            <tr class="content">
                                <td><?php echo $row['TenPhong']; ?></td>
                                <td><?php echo $row['TenLoaiPhong']; ?></td>
                                <td>
                                    <a href="Datphong_Dangkiphong.php?phong=<?php echo $row['TenPhong']; ?>&loaiphong=<?php echo $row['TenLoaiPhong']; ?>" class="btn-dat-phong">Đặt phòng</a>
                                </td>
                            </tr>
                        <?php }
                    }
                    if($rows_2) {
                        while($row = mysqli_fetch_assoc($rows_2)) { ?>
                            <tr class="content">
                                <td><?php echo $row['TenPhong']; ?></td>
                                <td><?php echo $row['TenLoaiPhong']; ?></td>
                                <td>
                                    <a href="Datphong_Dangkiphong.php?phong=<?php echo $row['TenPhong']; ?>&loaiphong=<?php echo $row['TenLoaiPhong']; ?>" class="btn-dat-phong">Đặt phòng</a>
                                </td>
                            </tr>
                        <?php }
                    }
                    ?>
                    
                </table>
            </div>
            <div id="box-form-dat-phong">
                
            </div>
        </div>
    </div>
</body>
</html>