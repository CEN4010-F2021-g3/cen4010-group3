<?php
include_once './includes/header_admin.php';

require_once './src/php_queries_src.php';
require_once './src/functions_admin.php';
require_once '../src/dbh_src.php';

$category_rows = getAllCategories($conn);
$post_rows = getallPosts($conn);

?>

<div class="row h-100">
    <div class="col-2" id="left-panel">
        <ul class="navbar-nav px-1">
            <li class="nav-item"><a class="nav-link" href="#">Create Post</a></li>
            <li class="nav-item"><a class="nav-link" href="./manage_post.php">Manage Posts</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Create Category</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Manage Categories</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Manage Users</a></li>
        </ul>
    </div>
    <div class="col-10" id="right-panel">
        <div class="row text-center mt-1">
            <h1>Manage Post</h1>
        </div>
        <div class="row">
        <?php foreach($post_rows as $q){?>
        <div class="col-4">
            <div class="card text-white bg-dark mt-5">
                <h5 class="card-title"><?php echo $q['title']?></h5>
                <p class="card-text"><?php echo $q['content']?></p>
                <a href="./src/edit_post_src.php" class="btn btn-dark">Edit</a>
                <a href="./src/delete_post_src.php?delete=<?php echo $q['id']?>" class="btn btn-dark" name="delete">Delete</a>
            </div>
        </div>
        <?php }?>
    </div>
    </div>
</div>