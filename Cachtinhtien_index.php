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
            case 'Cachtinhtien_Chinhsua':
                require_once 'Cachtinhtien_Chinhsua.php';
                break;
            default:
                require_once 'Quanlyhethong_Cachtinhtien.php';
        }
    }
    else {
        require_once 'Quanlyhethong_Cachtinhtien.php';
    }
?>
</body>
</html>