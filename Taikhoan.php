<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
    <link rel="stylesheet" href="Taikhoan.css">
    <title>Tài khoản</title>
</head>
<body>  
    <?php
        session_start();
        $username = $_SESSION['username'];
        $type_username = $_SESSION['type_username'];
        $password = $_SESSION['password'];
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
                <a href="Quanlyhethong.php" class="list-item-content">
                    <i class="fas fa-cog icon"></i>QUẢN LÝ HỆ THỐNG
                </a>
            </li>
            <li class="list-item">
                <a href="" class="list-item-content selected">
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
                <span>TÀI KHOẢN</span>
            </div>
        </div>
        <div class="container-content">
            <div class="label">
                <label for="r1">Thông tin tài khoản</label>
                <label for="r2">Đổi mật khẩu</label>
            </div>
            <input type="radio" name="r" id="r1" checked>
            <input type="radio" name="r" id="r2">
            <div class="hightlight"></div>
            <div class="line"></div>
            <div class="slides">
                <div class="slide-1">
                    <div class="ten-tai-khoan">
                        <i class="fas fa-user-circle"></i>
                        <span style="display: flex; flex-direction: column; margin-top: 8px;">
                            <span style="font-size: 12px; color: #7f8c8d;">Tên tài khoản</span>
                            <span style="margin-top: 5px"><?php echo $username; ?></span>
                        </span>
                    </div>
                    <div class="loai-tai-khoan">
                        <i class="fas fa-user"></i>
                        <span style="display: flex; flex-direction: column; margin-top: 8px;">
                            <span style="font-size: 12px; color: #7f8c8d;">Loại tài khoản</span>
                            <span style="margin-top: 5px"><?php echo $type_username; ?></span>
                        </span>
                    </div>
                </div>
                <div class="slide-2">
                    <form action="" class="form" method="POST">
                        <div class="box box-mk-cu">
                            <input type="password" name="mk-cu" class="input" required>
                            <label for="mk-cu">Mật khẩu cũ</label>
                        </div>
                        <div class="box">
                            <input type="password" name="mk-moi" class="input" required>
                            <label for="mk-moi">Mật khẩu mới</label>
                        </div>
                        <div class="box">
                            <input type="password" name="xac-nhan-mk-moi" class="input" required>
                            <label for="xac-nhan-mk-moi">Xác nhận mật khẩu mới</label>
                        </div>
                        <input type="submit" name="cap-nhat" value="Lưu">
                    </form>
                    <?php
                        include_once("CSDL.php");
                        $color = '';
                        $thong_bao = '';

                        if(isset($_POST['cap-nhat'])) {
                            $mk_cu = $_POST['mk-cu'];
                            $mk_moi = $_POST['mk-moi'];
                            $xac_nhan_mk_moi = $_POST['xac-nhan-mk-moi'];

                            if($mk_cu !== $password) {
                                $thong_bao = "Mật khẩu cũ không chính xác.\nVui lòng nhập lại.";
                                $color = "color: red;";
                            }
                            else {
                                if($mk_cu === $mk_moi) {
                                    $thong_bao = "Mật khẩu mới trùng với mật khẩu cũ.\nVui lòng nhập lại.";
                                    $color = "color: red;";
                                }
                                else {
                                    if($mk_moi !== $xac_nhan_mk_moi) {
                                        $thong_bao = "Xác nhận mật khẩu mới không chính xác.\nVui lòng nhập lại.";
                                        $color = "color: red;";
                                    }
                                    else {
                                        $thong_bao = "Đổi mật khẩu thành công.";
                                        $color = "color: green;";    
                                        $sql = "UPDATE `taikhoan` SET `MatKhau` = '".$mk_moi."' WHERE `TenTaiKhoan` = '{$username}';";
                                        DataProvider::ExecuteQuery($sql);
                                        $_SESSION['password'] = $mk_moi;
                                    }
                                }
                            }
                        }
                        echo "<span style=\"margin: 14px 0 0 24px; {$color}\">{$thong_bao}</span>";
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>