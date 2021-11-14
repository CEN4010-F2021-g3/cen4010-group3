<?php
include_once './includes/header_admin.php';

require_once './src/php_queries_src.php';
require_once './src/functions_admin.php';
require_once '../src/dbh_src.php';

$category_rows = getAllCategories($conn);

?>
<?php if (isset($_GET['error'])) : ?>
    <?php if ($_GET['error'] == 'none') : ?>
        <div class="alert alert-success">
            Category successfully created!
        </div>
    <?php endif; ?>
<?php endif; ?>

<div class="row h-100">
    <!-- dashboard left panel (left sidebar)-->
    <?php include_once './includes/left_sidebar.php' ?>

    <div class="col-10" id="right-panel">
        <div class="row text-center mt-1">
            <h1>Create Category</h1>
        </div>
        <form action="./src/create_category_src.php" method="POST" enctype="multipart/form-data">
            <!-- category name -->
            <div class="mb-3">
                <label for="name" class="form-label">Category name</label>
                <input type="text" class="form-control" name="name" id="name" aria-describedby="CategoryName" required>
                <div id="emailHelp" class="form-text">Category name must be unique.</div>
            </div>
            <!-- category description-->
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" name="description" id="description" rows="4" placeholder="Type your description here" required></textarea>
            </div>
            <!-- category image -->
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