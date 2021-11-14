<?php
function isAdmin(){
    if($_SESSION['useradmin'] == 1) {return true;}
    else {return false;}        
}

function isSubmit(){
    if(isset($_POST['submit'])){
        return true;
    } else {
        return false;
    }
}

function checkEmptyPostFields($title, $category_id, $summary, $content, $image){
    //checks if blog post form fields are empty. Returns true if every field is filled.
    if(empty($title) || empty($category_id) || empty($summary) || empty($content)){
        return false;
    } else if(empty($image['name']) || $image['size'] <= 0){
        return false;
    } else{
        return true;
    }
}

function uploadImage($image, $slug, $destinationFolder){
    //Uploads new image, $newName should be the slug name and $destinationFolder must be given from outermost folder
    //example $destinationFolder = 'assets/post-img/'
    //returns name of new image file
    $fileName = $image['name'];
    $fileTmpName = $image['tmp_name'];
    $fileError = $image['error'];

    $fileExt = explode('.',$fileName);
    $fileActualExt = strtolower(end($fileExt));
    $allowed = array('jpg','png','jpeg','bmp','gif');
    if(in_array($fileActualExt,$allowed)){
        if($fileError === 0){
            $fileNameNew = $slug.".".$fileActualExt;
            $fileDestination = '../../' . $destinationFolder . $fileNameNew;
            unlink($fileDestination);
            move_uploaded_file($fileTmpName,$fileDestination);
            return $fileNameNew;
        } else {
            echo "There was an error uploading your image";
            return;
        }
    } else {
        echo "You cannot upload files/images of this type!";
        return;
    }
}

function createSlug($name){
    //converts string to slug format
    $name = strtolower($name);
    $slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $name);
    return $slug;
}

function checkValidSlug($conn,$slug){
    //Checks if slug already exists in the database. Returns true if slug is valid to use.
    $sql = "SELECT * from post WHERE slug='$slug' ";
    $result = mysqli_query($conn,$sql);
    $rowCount = mysqli_num_rows($result);
    if($rowCount > 0){
        return false;
    } else {
        return true;
    }
}


/*----------------------------------------Edit Post Functions--------------------------------------------------------*/
function checkValidSlugEdit($conn,$slug,$post_id){
    //Checks if slug already exists in the database. Returns true if slug is valid to use.
    $sql = "SELECT * from post WHERE slug='$slug' AND id != $post_id";
    $result = mysqli_query($conn,$sql);
    $rowCount = mysqli_num_rows($result);
    if($rowCount > 0){
        return false;
    } else {
        return true;
    }
}