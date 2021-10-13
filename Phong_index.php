<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>
<body>
<?php
    if(isset($_GET['page_layout'])) {
        switch($_GET['page_layout']) {
            case 'Phong_Chinhsua':
                require_once 'Phong_Chinhsua.php';
                break;
            case 'Phong_Xoa':
                require_once 'Phong_Xoa.php';
                break;
            default:
                require_once 'Quanlyhethong_Phong.php';
        }
    }
    else {
        require_once 'Quanlyhethong_Phong.php';
    }
?>
</body>
</html>