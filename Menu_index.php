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
            case 'Menu_Chinhsua':
                require_once 'Menu_Chinhsua.php';
                break;
            case 'Menu_Xoa':
                require_once 'Menu_Xoa.php';
                break;
            default:
                require_once 'Quanlyhethong_Menu.php';
        }
    }
    else {
        require_once 'Quanlyhethong_Menu.php';
    }
?>
</body>
</html>