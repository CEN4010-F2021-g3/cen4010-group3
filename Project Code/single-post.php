<?php
include_once './includes/header.php';
require_once './src/dbh_src.php';
require_once './src/create_card_src.php';

//checking get values
if(isset($_GET['error'])){
    if($_GET['error'] == 'commenterror'){
        echo "<div class='alert alert-danger'>We could not submit your comment</div>";
    }
    if($_GET['error'] == 'none'){
        echo "<div class='alert alert-success'>Your comment has been submitted!</div>";
    }
}
if(!isset($_SESSION['username'])){
    header('Location: ./login.php');
}
if(!isset($_GET['post'])){
    echo "<div class='alert alert-danger'>We could not find your post!</div>";
} else{
    //select post from given slug
    $post_slug = $_GET['post'];
    $sql = "SELECT * FROM post WHERE slug = '$post_slug' AND published = 1";
    $resultDataPost = mysqli_query($conn,$sql);
    $post_row = mysqli_fetch_assoc($resultDataPost);
    $post_id = $post_row['id'];
    //select all comments for given post, retrieve all from comment table and only username and image from users table
    $sql = "SELECT post_comment.*, users.usersName, users.usersImg FROM `post_comment` LEFT JOIN `users` ON post_comment.userId = users.usersId WHERE postId = '$post_id'";
    $resultDataComments = mysqli_query($conn,$sql);
    $comment_rows = mysqli_fetch_all($resultDataComments,MYSQLI_ASSOC);
    //create comments in html format
    $comments_html = '';
    foreach($comment_rows as $comment){
        //loop through each associative array where $comment corresponds to one row
        $comments_html .= createSingleComment($comment);
    }
    ?>

<div class="container">    
    <div class="row post-title my-3">
        <h1><?php echo $post_row['title']?></h1>
    </div>
    <div class="row post-image">
        <img src="./assets/post-img/<?php echo($post_row['image']);?>" alt="<?php echo($post_row['summary']) ?>" id="post-image">
    </div>
    <div class="row post-content">
        <?php echo $post_row['content']?>
    </div>
    <div class="row post-info">
        Post Created on <?php echo $post_row['createdAt'] ?>
    </div>
    <div class="row likes my-2">
        <!-- TODO add like and dislike buttons -->
        <!-- TODO add edit and delete button and make them functional-->
        <div class="col">
            <a class="btn btn-primary" href="#">Like the Post</a><?php echo($post_row['likesCount'])?> Liked the post
            <a class="btn btn-primary" href="#">Dislike the Post</a><?php echo($post_row['likesCount'])?> People disliked the post
        </div>
    </div>
    <div class="row add-comment-form my-2">
        <form action="./src/create_comment_src.php" method="POST">
            <label for="comment-input">Write a new comment</label>
            <textarea class="form-control" name="content" id="comment-input" rows="2" placeholder="Type your comment here" required></textarea>
            <button type="submit" name="submit" class="btn btn-success mt-2">Submit Comment</button>
            <input type="hidden" name="post_id" value="<?php echo($post_id) ?>">
            <input type="hidden" name="post_slug" value="<?php echo($post_slug) ?>">
        </form>
    </div>
    <div class="row comments-container">
        <div class="col-12 pb-4">
            <h1>All comments</h1>
            <!-- single comment goes here -->
            <?php echo($comments_html) ?>
        </div>
    </div>
</div>

<?php
}
include_once './includes/footer.php';
?>