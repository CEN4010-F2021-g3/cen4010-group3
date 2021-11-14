<?php
    require_once './functions_admin.php';
    require_once './php_queries_src.php';
    require_once '../../src/dbh_src.php';

    if (isset($_REQUEST['update'])){
        $usersId = $_REQUEST['update']; 
        grantAdminStatus($conn, $usersId);
    }