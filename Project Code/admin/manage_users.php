<?php
include_once './includes/header_admin.php';

require_once './src/php_queries_src.php';
require_once './src/functions_admin.php';
require_once '../src/dbh_src.php';

$category_rows = getAllCategories($conn);
$post_rows = getallPosts($conn);
$user_rows = getallUsers($conn);

?>

<?php if (isset($_GET['error'])) : ?>
    <?php if ($_GET['error'] == 'none') : ?>
        <div class="alert alert-success">
            User has been granted administrative priveleges
        </div>
    <?php elseif ($_GET['error'] == 'DeletedUser') : ?>
        <div class="alert alert-success">
            User has been deleted
        </div>
    <?php endif; ?>
<?php endif; ?>

<div class="row h-100">
    <?php include_once './includes/left_sidebar.php' ?>
    <div class="col-10" id="right-panel">
        <div class="row text-center mt-1">
            <h1>Manage Users</h1>
        </div>
        <div class="row">
            <?php foreach ($user_rows as $q) { ?>
                <div class="col-4">
                    <div class="card text-white bg-secondary mt-4 p-3 text-center">
                        <h5 class="card-title"><?php echo $q['usersFirst'] ?></h5>
                        <p class="card-text"><?php echo $q['usersLast'] ?></p>
                        <p class="card-text"><?php echo $q['usersName'] ?></p>
                        <p class="card-text"><?php echo $q['usersEmail'] ?></p>
                        <a href="./src/update_user_admin_status_src.php?update=<?php echo $q['usersId'] ?>" class="btn btn-dark" name="update">Grant Admin Status</a>
                        <a href="./src/delete_user_src.php?delete=<?php echo $q['usersId'] ?>" class="btn btn-dark" name="delete">Delete User</a>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>