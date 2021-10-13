<?php
    // ob_start();
    include_once('CSDL.php');

    $id = $_GET['id'];
    $sql = "DELETE FROM `phong` WHERE `MaPhong` = {$id}";
    DataProvider::ExecuteQuery($sql);
    header('location: Quanlyhethong_Phong.php');
?>