<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
    <link rel="stylesheet" href="Datphong.css">
    <link rel="stylesheet" href="datphong_Dangkiphong.css">
    <title>Đặt phòng</title>
</head>
<body>
    <?php
        ob_start();
        $phong = $_GET['phong'];
        $loaiphong = $_GET['loaiphong'];
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
                <a href="Datphong.php" class="list-item-content selected">
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
                <form action="" method="POST" class="form" autocomplete="off">
                    <input type="text" name="input-ho-ten-khach-hang" placeholder="Họ và tên khách hàng" required>
                    <label for="" name="label-gioi-tinh">Giới tính</label>
                    <label for="" name="label-nam-sinh">Năm sinh</label>
                    <select name="input-gioi-tinh" id="input-gioi-tinh">
                        <option value=""></option>
                        <option value="Nam">Nam</option>
                        <option value="Nữ">Nữ</option>
                        </select>
                    <select name="input-nam-sinh" id="input-nam-sinh">
                        <option value=""></option>
                        <option value="1980">1980</option>
                        <option value="1981">1981</option>
                        <option value="1982">1982</option>
                        <option value="1983">1983</option>
                        <option value="1984">1984</option>
                        <option value="1985">1985</option>
                        <option value="1986">1986</option>
                        <option value="1987">1987</option>
                        <option value="1988">1988</option>
                        <option value="1989">1989</option>
                        <option value="1990">1990</option>
                        <option value="1991">1991</option>
                        <option value="1992">1992</option>
                        <option value="1993">1993</option>
                        <option value="1994">1994</option>
                        <option value="1995">1995</option>
                        <option value="1996">1996</option>
                        <option value="1997">1997</option>
                        <option value="1998">1998</option>
                        <option value="1999">1999</option>
                        <option value="2000">2000</option>
                        <option value="2001">2001</option>
                        <option value="2002">2002</option>
                        <option value="2003">2003</option>
                        <option value="2004">2004</option>
                        <option value="2005">2005</option>
                        <option value="2006">2006</option>
                        <option value="2007">2007</option>
                        <option value="2008">2008</option>
                        <option value="2009">2009</option>
                        <option value="2010">2010</option>
                        <option value="2011">2011</option>
                        <option value="2012">2012</option>
                        <option value="2013">2013</option>
                        <option value="2014">2014</option>
                        <option value="2015">2015</option>
                    </select>
                    <input type="text" name="input-que-quan" placeholder="Quê quán" required>
                    <input type="number" name="input-so-dien-thoai" placeholder="Số điện thoại" required>
                    <input type="number" name="input-cmnd" placeholder="CMND" required>
                    <label for="" name="label-ngay-nhan-phong">Ngày nhận phòng</label>
                    <label for="" name="label-ngay-tra-phong">Ngày trả phòng</label>
                    <input type="date" name="input-ngay-nhan-phong" placeholder="Ngày nhận phòng" value="<?php echo date("Y-m-d"); ?>">
                    <input type="date" name="input-ngay-tra-phong" placeholder="Ngày trả phòng" value="<?php $date = date("Y-m-d"); $nextday = strtotime('+1 day', strtotime($date)); $nextday = date("Y-m-d", $nextday); echo $nextday; ?>">
                    <div style="margin-bottom: 15px;">Phòng đặt: <?php echo $phong; ?></div>
                    <div style="margin-bottom: 15px;">Loại phòng: <?php echo $loaiphong; ?></div>
                    <label for="" name="label-tien-dat-truoc">Tiền đặt trước</label>
                    <input type="number" name="input-tien-dat-truoc" >
                    <label for="" style="position: relative; left: -5px; padding-bottom: 7px; border-bottom: 1px solid black;">0.000đ</label>
                    <input type="text" name="input-ghi-chu" placeholder="Ghi chú">
                    <input type="submit" name="btn-luu" id="btn-luu" value="Lưu">
                </form>
                <?php
                    include_once("CSDL.php");
                    $daynow = strtotime(date('Y-m-d'));
                    $ngay_nhan_phong = (isset($_POST['input-ngay-nhan-phong'])) ? strtotime($_POST['input-ngay-nhan-phong']) : "";
                    $ngay_tra_phong = (isset($_POST['input-ngay-tra-phong'])) ? strtotime($_POST['input-ngay-tra-phong']) : "";

                    if($ngay_nhan_phong >= $daynow && $ngay_nhan_phong < $ngay_tra_phong) {
                        $ho_ten_khach_hang = $_POST['input-ho-ten-khach-hang'];
                        $gioi_tinh = (isset($_POST['input-gioi-tinh'])) ? $_POST['input-gioi-tinh'] : "";
                        $nam_sinh = (isset($_POST['input-nam-sinh'])) ? $_POST['input-nam-sinh'] : "";
                        $que_quan = $_POST['input-que-quan'];
                        $sdt = $_POST['input-so-dien-thoai'];
                        $cmnd = $_POST['input-cmnd'];
                        $ngay_nhan_phong = date('Y-m-d', strtotime($_POST['input-ngay-nhan-phong']));
                        $ngay_tra_phong = date('Y-m-d', strtotime($_POST['input-ngay-tra-phong']));
                        $tien_dat_truoc = (isset($_POST['input-tien-dat-truoc'])) ? $_POST['input-tien-dat-truoc'] : 0;
                        $ghi_chu = $_POST['input-ghi-chu'];

                        if($gioi_tinh != "" && $nam_sinh != "") {
                            $sql = "INSERT INTO `khachhang`(`TenKhachHang`, `GioiTinh`, `QueQuan`, `CMND`, `NamSinh`, `SoDienThoai`) 
                            VALUES ('$ho_ten_khach_hang','$gioi_tinh','$que_quan','$cmnd',$nam_sinh,'$sdt')";
                            $query = DataProvider::ExecuteQuery($sql);

                            $sql = "UPDATE `phong` SET `TinhTrang`='Đã đặt' WHERE `TenPhong` = '$phong'";
                            $query = DataProvider::ExecuteQuery($sql);

                            $sql = "SELECT `MaKhachHang` 
                            FROM `khachhang`
                            WHERE `CMND` = '$cmnd' 
                            and `SoDienThoai` = '$sdt'
                            and `TenKhachHang` = '$ho_ten_khach_hang'";
                            $row_1 = mysqli_fetch_array(DataProvider::ExecuteQuery($sql));

                            $sql = "SELECT `MaPhong`
                            FROM `phong`
                            WHERE `TenPhong` = '$phong'";
                            $row_2 = mysqli_fetch_array(DataProvider::ExecuteQuery($sql));
                            
                            if($tien_dat_truoc == "") $tien_dat_truoc = 0;
                            $tien_dat_truoc = $tien_dat_truoc * 10000;

                            $sql = "INSERT INTO `datphong`(`MaKhachHang`, `MaPhongDat`, `NgayNhanPhong`, `NgayTraPhong`, `TienDatTruoc`) 
                            VALUES ({$row_1['MaKhachHang']}, {$row_2['MaPhong']},'{$ngay_nhan_phong}','{$ngay_tra_phong}',{$tien_dat_truoc})";
                            $query = DataProvider::ExecuteQuery($sql);
                            header('Location:Datphong.php');
                        }
                    }
                ?>
            </div>
        </div>
    </div>
</body>
</html>