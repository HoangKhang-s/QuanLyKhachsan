<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
    <link rel="stylesheet" href="Quanlyhethong_Menu.css">
    <title>Menu</title>
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
            MENU
            <a href="Menu_Them.php" class="btn-them-moi">
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
                    <select name="loai-menu" id="loai-menu">
                        <option value=""></option>
                        <option value="Đồ ăn">Đồ ăn</option>
                        <option value="Đồ uống">Đồ uống</option>
                    </select>
                </form>
                <?php
                    include_once("CSDL.php");
                    $rows;
                    $input_tim_kiem = (isset($_POST['input-tim-kiem'])) ? $_POST['input-tim-kiem'] : "";
                    $input_loai_menu = (isset($_POST['loai-menu'])) ? $_POST['loai-menu'] : "";
                    if(isset($_POST['input-huy-tim-kiem']) || ($input_tim_kiem == "" && $input_loai_menu == "")) {
                        $sql = "SELECT * FROM `menu`";
                        $rows = DataProvider::ExecuteQuery($sql);
                    }
                    else {
                        if($input_tim_kiem != "" && $input_loai_menu == "") {
                            $sql = "SELECT * FROM `menu`
                            WHERE `TenMenu` like '%{$input_tim_kiem}%'";
                            $rows = DataProvider::ExecuteQuery($sql);
                        }
                        else {
                            if($input_tim_kiem == "" && $input_loai_menu != "") {
                                $sql = "SELECT * FROM `menu`
                                WHERE `LoaiMenu` = '{$input_loai_menu}'";
                                $rows = DataProvider::ExecuteQuery($sql);
                            }
                            else {
                                $sql = "SELECT * FROM `menu`
                                WHERE `TenMenu` like '%{$input_tim_kiem}%' 
                                and `LoaiMenu` = '{$input_loai_menu}'";
                                $rows = DataProvider::ExecuteQuery($sql);
                            }
                        }
                    }
                ?>
                <table class="danh-sach">
                    <tr>
                        <th>Tên menu</th>
                        <th>Loại menu</th>
                        <th>Đơn giá</th>
                        <th>Chỉnh sửa</th>
                        <th>Xóa</th>
                    </tr>
                    <?php while($row = mysqli_fetch_array($rows)) { ?>
                        <tr>
                            <td><?php echo $row['TenMenu'] ?></td>
                            <td><?php echo $row['LoaiMenu'] ?></td>
                            <td><?php echo $row['DonGia'] ?> đ</td>
                            <td>
                                <a href="Menu_index.php?page_layout=Menu_Chinhsua&id=<?php echo $row['MaMenu']; ?>" style="font-size: 16px; color: #27ae60;">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </td>
                            <td>
                                <a onclick="return Del('<?php echo $row['TenMenu']; ?>')" href="Menu_index.php?page_layout=Menu_Xoa&id=<?php echo $row['MaMenu']; ?>" style="font-size: 16px; color: #e74c3c;">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                    <script>
                        function Del (name) {
                            return confirm("Bạn có chắc muốn xóa tên menu: " + name + "?");
                        }
                    </script>
                </table>
            </div>
            <div class="box-form">

            </div>
        </div>
    </div>
</body>
</html>