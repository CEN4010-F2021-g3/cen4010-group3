<?php
    include_once './includes/header.php';
    
    if(!isset($_SESSION['username'])){ //user is not logged in
        header('Location: ./login.php');
    } else{ //user is logged in
        $profile_username = $_GET['username'];
        if($_GET['username'] == $_SESSION['username']){ //user looking at his own profile
            echo '<div class="alert alert-primary">Hello '.$_SESSION["username"].', welcome to your profile page. Feel free to edit your information!</div>';
        }
        require_once './src/dbh_src.php';
        $sql = "SELECT usersFirst,usersLast,usersEmail,usersImg,usersBio FROM users WHERE usersName='$profile_username'";
        $resultData = mysqli_query($conn,$sql);
        $row = mysqli_fetch_assoc($resultData);
        $profile_firstname = $row['usersFirst'];
        $profile_lastname = $row['usersLast'];
        $profile_email = $row['usersEmail'];
        $profile_img = $row['usersImg'];
        $profile_bio = $row['usersBio'];
    }
    
?>
    <div class="container-fluid">

        <!-- modal section -->
        <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProfileLabel">Edit your profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="./src/update_profile_src.php" method="POST" id="editProfileForm" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="firstname" class="col-form-label">First name:</label>
                    <input type="text" class="form-control" id="firstname" name="firstname">
                </div>
                <div class="mb-3">
                    <label for="lastname" class="col-form-label">Last name:</label>
                    <input type="text" class="form-control" id="lastname" name="lastname">
                </div>
                <div class="mb-3">
                    <label for="email" class="col-form-label">Email Address:</label>
                    <input type="text" class="form-control" id="email" name="email">
                </div>
                <div class="mb-3">
                    <label for="biography" class="col-form-label">Biography:</label>
                    <textarea class="form-control" id="biography" name="biography"></textarea>
                </div>
                <div class="mb-3">
                    <label for="img_file">Profile Image:</label>
                    <input type="file" name="img_file" id="img_file"/>
                </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" name="submit" class="btn btn-primary" form="editProfileForm">Submit Changes</button>
            </div>
            </div>
        </div>
        </div>
        <!-- end of modal -->
        <!-- beginning of profile body -->
        <div class="row mx-auto">
            <!-- profile information card -->
            <div class="col-md-3">
                <div class="card" style="max-width:350px">
                    <?php 
                    if(is_null($profile_img)){ //If user does not have a profile image
                        echo '<img class="card-img-top" src="./assets/profile-img/profile_default.png" alt="Card image" style="width:100%">';
                    }
                    else{
                        echo '<img class="card-img-top" src="'.$profile_img.'" alt="Card image" style="width:100%">';
                    }
                    ?>
                    <div class="card-body">
                    <h4 class="card-title text-center"><?php echo $profile_username?></h4>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">First Name: <?php echo $profile_firstname ?></li>
                        <li class="list-group-item">Last Name: <?php echo $profile_lastname ?></li>
                        <li class="list-group-item">Contact email: <?php echo $profile_email ?></li>
                    <?php //Display user's biography text
                    if(is_null($profile_bio)){
                        echo '<li class="list-group-item">Biography: </li>';
                    } else{
                        echo '<li class="list-group-item">Biography: '.$profile_bio.'</li>';
                    }
                    ?>
                    </ul>
                    <?php //Show edit profile button only if user is looking at his own profile
                    if($profile_username == $_SESSION['username']){
                        echo('<div class="card-footer text-center">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editProfileModal">Edit Profile Info</button>
                        </div>');
                    }
                    ?>
                    </div>
                </div>
            </div>
            <!-- end of profile card -->
            <div class="col-md-9">
                <!-- Blog posts by the user -->
                <div class="row">
                    <h3>Blog Posts by <?php echo $profile_username?></h3>
                    <!-- post card (will loop through this with php) -->
                    <?php
                        $sql = "SELECT post.* FROM post INNER JOIN users ON post.authorId = users.usersId WHERE post.published=1 AND users.usersName = '$profile_username' ";
                        $resultData = mysqli_query($conn,$sql);
                        $post_rows = mysqli_fetch_all($resultData, MYSQLI_ASSOC);
                    ?>
                    <?php foreach($post_rows as $post):?>
                        <div class="card mb-3" >
                            <div class="row g-0">
                                <div class="col-md-3">
                                <img src="./assets/post-img/<?php echo $post['image']?>" class="img-fluid rounded-start" alt="...">
                                </div>
                                <div class="col-md-8">
                                <div class="card-body">
                                    <a href="./single-post.php?post=<?php echo $post['slug']?>"><h5 class="card-title"><?php echo $post['title']?></h5></a>
                                    <p class="card-text"><?php echo $post['summary']?></p>
                                    <p class="card-text"><small class="text-muted"><?php echo $post['createdAt']?></small></p>
                                </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach;?>
                </div>
                <div class="row">
                    <h3>Post comments by <?php echo $profile_username?></h3>
                    <!-- Comments card (will loop through this with php) -->
                    <?php
                        $sql = "SELECT post_comment.*,post.title,post.slug FROM post_comment INNER JOIN users ON post_comment.userId = users.usersId INNER JOIN post ON post_comment.postId = post.id 
                                WHERE post.published=1 AND users.usersName = '$profile_username'";
                        $resultData = mysqli_query($conn,$sql);
                        $comment_rows = mysqli_fetch_all($resultData, MYSQLI_ASSOC);
                    ?>
                    <?php foreach($comment_rows as $comment):?>
                        <div class="card mb-3" >
                            <div class="row g-0">
                                <div class="col">
                                <div class="card-body">
                                    <a href="./single-post.php?post=<?php echo $comment['slug']?>"><h5 class="card-title">Post Title: <?php echo $comment['title']?></h5></a>
                                    <p class="card-text"><?php echo $comment['content']?></p>
                                    <p class="card-text"><small class="text-muted"><?php echo $comment['createdAt']?></small></p>
                                </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach;?>
                </div>
            </div>
        </div>
    </div>
<?php
    include_once './includes/footer.php';


    // echo('<form action="edit-profile.php" method="POST">
    //                         <input type="hidden" id="custId" name="username" value="'.$_SESSION['username'].'">
    //                         <button type="submit" name="submit" class="btn btn-lg btn-primary btn-block justify-content-center">Edit profile information</button>
    //                         </form>');
?>