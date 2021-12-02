<?php

/****************************************SELECT statements ****************************************/

//Select all categories
function getAllCategories($conn)
{ //used in dashboard
    $sql = "SELECT * FROM category";
    $resultData = mysqli_query($conn, $sql);
    $category_rows = mysqli_fetch_all($resultData, MYSQLI_ASSOC);
    return $category_rows;
}

//Select a post given an id and returns associative array with the post information
function getPostById($conn, $post_id)
{
    $sql = "SELECT * FROM post WHERE id = $post_id";
    $resultData = mysqli_query($conn, $sql);
    $post_row = mysqli_fetch_assoc($resultData);
    return $post_row;
}

//Select a category given an id and returns the associative array with the caregory information
function getCategoryById($conn, $category_id)
{
    $sql = "SELECT * FROM category WHERE id = $category_id";
    $resultData = mysqli_query($conn, $sql);
    $category_row = mysqli_fetch_assoc($resultData);
    return $category_row;
}

//Select all post data
function getallPosts($conn)
{
    $sql = "SELECT * FROM post";
    $postData = mysqli_query($conn, $sql);
    $post_rows = mysqli_fetch_all($postData, MYSQLI_ASSOC);
    return $post_rows;
}

//Select all user data
function getallUsers($conn)
{
    $sql = "SELECT * FROM users";
    $userData = mysqli_query($conn, $sql);
    $user_rows = mysqli_fetch_all($userData, MYSQLI_ASSOC);
    return $user_rows;
}

/****************************************INSERT statements ****************************************/

//Insert post using prepared statement
function createPost($conn, $authorId, $category_id, $title, $slug, $summary, $content, $published, $image)
{
    $sql = "INSERT INTO post(authorId,categoryId,title,slug,summary,content,published,`image`) VALUES(?,?,?,?,?,?,?,?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header('Location: ../dashboard.php?error=posterror');
        exit();
    }
    mysqli_stmt_bind_param($stmt, 'ssssssss', $authorId, $category_id, $title, $slug, $summary, $content, $published, $image);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("Location: ../dashboard.php?error=none");
}

//Insert category using prepared statement
function createCategory($conn, $name, $slug, $description, $image)
{
    $sql = "INSERT INTO category(name, slug, description, `image`) VALUES(?,?,?,?);";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header('Location: ../dashboard.php?error=posterror');
        exit();
    }

    mysqli_stmt_bind_param($stmt, 'ssss', $name, $slug, $description, $image);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("Location: ../dashboard.php?error=none");
}


/********************************************UPDATE statements**********************************************/
//update a post
function updatePost($conn, $category_id, $title, $slug, $summary, $content, $published, $image, $post_id)
{
    $sql = "UPDATE post SET categoryId=?,title=?,slug=?,summary=?,content=?,published=?,`image`=? WHERE id=?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header('Location: ../dashboard.php?error=posterror');
        exit();
    }
    mysqli_stmt_bind_param($stmt, 'ssssssss', $category_id, $title, $slug, $summary, $content, $published, $image, $post_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("Location: ../manage_post.php?error=none");
}

//update a category
function updateCategory($conn, $category_id, $name, $slug, $description, $image)
{
    $sql = "UPDATE category SET name=?, slug=?, description=?, `image`=? WHERE id=$category_id";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header('Location: ../dashboard.php?error=posterror');
        exit();
    }
    mysqli_stmt_bind_param($stmt, 'ssss', $name, $slug, $description, $image);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("Location: ../manage_category.php?error=none");
}

//Update user status
function grantAdminStatus($conn, $usersId)
{

    $getUsers = "SELECT usersAdmin FROM users where usersId=$usersId";
    mysqli_query($conn, $getUsers);

    $sql = "UPDATE users SET usersAdmin=1 WHERE usersId='$usersId'";
    mysqli_query($conn, $sql);

    header('location: ../manage_users.php?error=none');
    exit();
}

/********************************************DELETE statements**********************************************/
//Delete a post
function deletePost($conn, $id)
{
    $sql = "DELETE FROM post where id=$id";
    mysqli_query($conn, $sql);

    header('location: ../manage_post.php?error=DeletedPost');
    exit();
}

//Delete users
function deleteUser($conn, $usersId)
{
    $sql = "DELETE FROM users where usersId=$usersId";
    mysqli_query($conn, $sql);

    header('location: ../manage_users.php?error=DeletedUser');
    exit();
}

//Delte a category
function deleteCategory($conn, $id)
{
    $sql = "DELETE FROM category where id=$id";
    mysqli_query($conn, $sql);

    header('location: ../dashboard.php?error=none');
    exit();
}
