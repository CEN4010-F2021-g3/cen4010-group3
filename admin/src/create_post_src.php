<?php
 require_once './functions_admin.php';
 require_once './php_queries_src.php';
 require_once '../../src/dbh_src.php';

session_start();
if(isAdmin() && isSubmit()){
    print_r($_POST);
    $authorId = $_SESSION['userid'];
    $title = $_POST['title'];
    $category_id = $_POST['category_id'];
    $summary = $_POST['summary'];
    $content = $_POST['content'];
    $image = $_FILES['img_file'];
    $slug = '';
    $imageNewName = ''; //will contain the name of the image for DB
    $imageDestination = 'assets/post-img/';
    if(isset($_POST['published'])){
        $published = 1;
    } else {
        $published = 0;
    }
    if(!checkEmptyPostFields($title,$category_id,$summary,$content,$image)){
        echo("There are empty fields in the form"); //TODO modify this later to show message in dashboard
        return;
    }
    $slug = createSlug($title);
    if(!checkValidSlug($conn,$slug)){
        echo('Slug already exists in the database');
        return; //modify this
    }
    $imageNewName = uploadImage($image,$slug,$imageDestination);
    if(empty($imageNewName)){
        echo("There has been an error uploading image");
        return; //modify this
    }
    createPost($conn,$authorId,$category_id,$title,$slug,$summary,$content,$published,$imageNewName);

} else {
    $_SESSION['message'] = 'Something went wrong'; //error message
}

