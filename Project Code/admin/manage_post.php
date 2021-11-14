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
            Post has been successfully updated!
        </div>
    <?php elseif ($_GET['error'] == 'DeletedPost') : ?>
        <div class="alert alert-success">
            Post has been successfully deleted!
        </div>
    <?php endif; ?>
<?php endif; ?>

<div class="row h-100">
    <?php include_once './includes/left_sidebar.php' ?>
    <div class="col-10" id="right-panel">
        <div class="row text-center mt-1">
            <h1>Manage Post</h1>
        </div>
        <div class="row">
            <?php foreach ($post_rows as $q) { ?>
                <div class="col-4">
                    <div class="card text-white bg-secondary mt-4 p-3">
                        <h5 class="card-title"><?php echo $q['title'] ?></h5>
                        <p class="card-text"><?php echo $q['content'] ?></p>
                        <form action="./edit_post.php" method="POST">
                            <input type="hidden" name="post_id" value="<?php echo $q['id'] ?>">
                            <button type="submit" class="btn btn-info" name="submit_edit">Edit Post</button>
                            <a href="./src/delete_post_src.php?delete=<?php echo $q['id'] ?>" class="btn btn-danger" name="delete">Delete</a>
                        </form>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

    <div class="container-fluid">
        <!-- Modal Begin-->
        <div class="modal fade" id="editPostModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Post</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="./src/update_post_src.php?update=<?php echo $q['id'] ?>" method="POST" id="editPostForm" enctype="multipart/form-data">
                            <div class="mb-3">
                                <input type="text" hidden name="id" value="<?php echo $q['id'] ?>">
                            </div>
                            <div class="mb-3">
                                <label for="title" class="col-form-label">Post Title:</label>
                                <input type="text" class="form-control" id="title" name="title" required>
                            </div>
                            <div class="mb-3">
                                <label for="summary" class="col-form-label">Summary:</label>
                                <input type="text" class="form-control" id="summary" name="summary" required>
                            </div>
                            <div class="mb-3">
                                <label for="content" class="col-form-label">Content:</label>
                                <textarea class="form-control" id="content" name="content" required></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="submit" class="btn btn-primary" form="editPostForm">Submit Changes</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal End-->
    </div>

    <?php
    include_once './includes/footer_admin.php'; //need to use JS for Modal
    ?>