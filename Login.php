<?php
    session_start();
    include_once("CSDL.php");

    if(isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
    
        if($username != '' && $password != '') {
            $check = false;
            $rows = DataProvider::ExecuteQuery("SELECT * FROM taikhoan");
            while ($row = mysqli_fetch_array($rows)) {
                if($row['TenTaiKhoan'] === $username && $row['MatKhau'] === $password) {
                    $_SESSION['username'] = $username;
                    $_SESSION['type_username'] = $row['LoaiTaiKhoan'];
                    $_SESSION['password'] = $password;
                    $check = true;
                    header("Location: Trangchinh.php");
                }
            }
            if($check === false) {
                header("Location: Login.html");
            }
        }
        else {
            header("Location: Login.html");
        }
    }
?>