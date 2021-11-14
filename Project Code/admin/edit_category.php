<?php
include_once './includes/header_admin.php';

require_once './src/php_queries_src.php';
require_once './src/functions_admin.php';
require_once '../src/dbh_src.php';

if (!isset($_POST['submit_edit'])) {
    header('Location: ./manage_post.php');
}
$category_id = $_POST['category_id'];
$category_row = getCategoryById($conn, $category_id);

?>

<div class="row h-100">
    <!-- dashboard left panel (left sidebar)-->
    <?php include_once './includes/left_sidebar.php' ?>

    <div class="col-10" id="right-panel">
        <div class="row text-center mt-1">
            <h1>Edit Category</h1>
        </div>
        <form action="./src/update_category_src.php" method="POST" enctype="multipart/form-data">
            <!-- category id -->
            <input type="hidden" name="category_id" value="<?php echo $category_id ?>">
            <!-- category name -->
            <div class="mb-3">
                <label for="name" class="form-label">Category Name</label>
                <input type="text" class="form-control" name="name" id="name" aria-describedby="CategoryName" value="<?php echo $category_row['name'] ?>" required>
                <div id="emailHelp" class="form-text">Category name must be unique.</div>
            </div>
            <!-- Category Description-->
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" name="description" id="description" rows="4" required><?php echo $category_row['description'] ?></textarea>
            </div>
            <!-- post image -->
            <div class="mb-3">
                <label for="image">Category Image:</label>
                <input type="file" name="img_file" id="image" required />
                <div id="imageHelp" class="form-text">Allowed extensions: jpg, png, jpeg, bmp, gif</div>
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        </form>
    </div>
</div>

<?php
include_once './includes/footer_admin.php';
?>