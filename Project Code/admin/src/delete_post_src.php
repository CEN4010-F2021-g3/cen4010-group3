<?php
    require_once './functions_admin.php';
    require_once './php_queries_src.php';
    require_once '../../src/dbh_src.php';

    if (isset($_GET['delete'])){
        $id = $_GET['delete'];
        //$sql = "DELETE FROM post WHERE id=$id";
        //mysqli_query($conn, $sql);
        deletePost($conn, $id);
    }