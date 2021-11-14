<?php
include_once './includes/header.php'
?>

<link href="assets/css/home_page.css" rel="stylesheet" />

<!--Show message that user has logged in-->
<?php if (isset($_REQUEST['info'])) { ?>
    <?php if ($_REQUEST['info'] == "Loggedin") { ?>
        <div class="alert alert-sucess text-center">Welcome to Peace of Mind <?php echo $_SESSION["username"]; ?></div>
    <?php } ?>
<?php } ?>

<!--Title and description of project-->
<div id="intro" class="bg-image shadow-2-strong">
    <div class="mask" style="background-color: rgba(0, 0, 0, 0.8);">
        <div class="container d-flex align-items-center justify-content-center text-center h-100">
            <div class="text-white">
                <h1 class="mb-3">Peace of Mind</h1>
                <h5 class="mb-4 fst-italic">A community where we connect from afar</h5>
                <div class="container-fluid text-center">
                    <p>Although we are apart, it does not mean we can't share what's going on. View what other people are doing. Share what you like and rate them. Comment on other posts and share your thoughts. Together, we can overcome this isolation.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include_once './includes/footer.php'
?>