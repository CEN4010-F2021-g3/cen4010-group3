<?php
include_once './includes/header_admin.php';

require_once './src/php_queries_src.php';
require_once './src/functions_admin.php';
require_once '../src/dbh_src.php';

$category_rows = getAllCategories($conn);
$post_rows = getallPosts($conn);

?>

<?php if (isset($_GET['error'])) : ?>
    <?php if ($_GET['error'] == 'none') : ?>
        <div class="alert alert-success">
            Category has been successfully updated!
        </div>
    <?php endif; ?>
<?php endif; ?>

<div class="row h-100">
    <?php include_once './includes/left_sidebar.php' ?>
    <div class="col-10" id="right-panel">
        <div class="row text-center mt-1">
            <h1>Manage Category</h1>
        </div>
        <div class="row">
            <?php foreach ($category_rows as $q) { ?>
                <div class="col-4">
                    <div class="card text-white bg-secondary mt-4 p-3">
                        <h5 class="card-title"><?php echo $q['name'] ?></h5>
                        <p class="card-text"><?php echo $q['slug'] ?></p>
                        <p class="card-text"><?php echo $q['description'] ?></p>
                        <form action="./edit_category.php" method="POST">
                            <input type="hidden" name="category_id" value="<?php echo $q['id'] ?>">
                            <button type="submit" class="btn btn-info" name="submit_edit">Edit Category</button>
                            <a href="./src/delete_category_src.php?delete=<?php echo $q['id'] ?>" class="btn btn-danger" name="delete">Delete</a>
                        </form>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>