<?php
include_once './includes/header_admin.php';

require_once './src/php_queries_src.php';
require_once './src/functions_admin.php';
require_once '../src/dbh_src.php';

$category_rows = getAllCategories($conn);

?>
<?php if(isset($_GET['error'])):?>
    <?php if($_GET['error'] == 'none'):?>
        <div class="alert alert-success">
            Your post has been successfully created!
        </div>
    <?php endif; ?>
<?php endif; ?>

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
            <h1>Create Post</h1>
        </div>
        <form action="./src/create_post_src.php" method="POST" enctype="multipart/form-data">
            <!-- post title -->
            <div class="mb-3">
                <label for="title" class="form-label">Post Title</label>
                <input type="text" class="form-control" name="title"  id="title" aria-describedby="PostTitle" required>
                <div id="emailHelp" class="form-text">Post title must be unique.</div>
            </div>
            <!-- post category -->
            <div class="mb-3">
                <label for="category">Post Category</label>
                <select class="form-select" name="category_id" id="category" aria-label="Select category">
                    <!-- generate categories options with PHP-->
                    <?php foreach($category_rows as $category): ?>
                        <option value="<?php echo($category['id'])?>"><?php echo($category['name'])?></option>
                    <?php endforeach; ?>
                </select>
                <div id="categoryHelp" class="form-text">Choose the category that best fits the content of your post</div>
            </div>
            <!-- post summary-->
            <div class="mb-3">
                <label for="summary" class="form-label">Summary</label>
                <input type="text" class="form-control" name="summary" id="summary" required>
                <div id="summaryHelp" class="form-text">Describe your post in a few words.</div>
            </div>
            <!-- post content-->
            <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea class="form-control" name="content" id="content" rows="4" placeholder="Type your post content here" required></textarea>
            </div>
            <!-- post image -->
            <div class="mb-3">
                <label for="image">Post Image:</label>
                <input type="file" name="img_file" id="image" required/>
                <div id="imageHelp" class="form-text">Allowed extensions: jpg, png, jpeg, bmp, gif</div>
            </div>
            <!-- post is published -->
            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" value="1" name="published" id="flexCheckIndeterminate" checked>
                <label class="form-check-label" for="flexCheckIndeterminate">
                    Publish Post
                </label>
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        </form>

    </div>
</div>

<?php
include_once './includes/footer_admin.php';
?>