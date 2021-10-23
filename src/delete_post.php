<?php
    include_once './dbh_src.php';
    //Delete the post with the post ID
    if(isset($_REQUEST['delete'])){
        $id = $_REQUEST['id'];
        $sql = "DELETE FROM post WHERE id='$id'";
        $query = mysqli_query($conn, $sql);

        // Redirect user to the home page
        header('location: ../index.php?info=DeletedPost');
        exit();
    }
?>