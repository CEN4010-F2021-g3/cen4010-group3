<?php
    require_once './functions_admin.php';
    require_once './php_queries_src.php';
    require_once '../../src/dbh_src.php';

    if (isset($_GET['delete'])){
        $usersId = $_GET['delete'];
        deleteUser($conn, $usersId);
    }