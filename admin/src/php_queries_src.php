<?php

/****************************************SELECT statements ****************************************/

//Select all categories
function getAllCategories($conn){ //used in dashboard
    $sql = "SELECT * FROM category";
    $resultData = mysqli_query($conn,$sql);
    $category_rows = mysqli_fetch_all($resultData,MYSQLI_ASSOC);
    return $category_rows;
}



/****************************************INSERT statements ****************************************/

//Insert post using prepared statement
function createPost($conn,$authorId,$category_id,$title,$slug,$summary,$content,$published,$image){
    $sql = "INSERT INTO post(authorId,categoryId,title,slug,summary,content,published,`image`) VALUES(?,?,?,?,?,?,?,?);";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql)){
        header('Location: ../dashboard.php?error=posterror');
        exit();
    }
    mysqli_stmt_bind_param($stmt,'ssssssss',$authorId,$category_id,$title,$slug,$summary,$content,$published,$image);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("Location: ../dashboard.php?error=none");
}

/**************************************** Retrieve all post data ****************************************/
function getallPosts($conn){
    $sql = "SELECT * FROM post";
    $postData = mysqli_query($conn, $sql);
    $post_rows = mysqli_fetch_all($postData, MYSQLI_ASSOC);
    return $post_rows;
}

/**************************************** Delete a Post ****************************************/
function deletePost($conn, $id){
    $sql = "DELETE FROM post where id=$id";
    mysqli_query($conn, $sql);
    
    header('location: ../../index.php?info=DeletedPost');
    exit();
}