<?php
    // ob_start();
    include_once('CSDL.php');

    $id = $_GET['id'];
    $sql = "DELETE FROM `menu` WHERE `MaMenu` = {$id}";
    DataProvider::ExecuteQuery($sql);
    header('location: Quanlyhethong_Menu.php');
?>