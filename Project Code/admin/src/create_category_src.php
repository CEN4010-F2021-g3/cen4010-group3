<?php
 require_once './functions_admin.php';
 require_once './php_queries_src.php';
 require_once '../../src/dbh_src.php';

session_start();
if(isAdmin() && isSubmit()){
    print_r($_POST);
    $authorId = $_SESSION['userid'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $image = $_FILES['img_file'];
    $slug = '';
    $imageNewName = ''; //will contain the name of the image for DB
    $imageDestination = 'assets/category-img/';

    $slug = createSlug($name);
    if(!checkValidSlug($conn,$slug)){
        echo('Slug already exists in the database');
        return; //modify this
    }
    $imageNewName = uploadImage($image,$slug,$imageDestination);
    if(empty($imageNewName)){
        echo("There has been an error uploading image");
        return; //modify this
    }
    createCategory($conn,$name,$slug,$description,$imageNewName);

} else {
    $_SESSION['message'] = 'Something went wrong'; //error message
}