<?php
include_once './includes/header.php';
if(!isset($_SESSION['username'])){ //user not logged in
    header('Location: ./login.php?error=notloggedin'); //TODO show error message if user is not logged in. Show message in login page
} else {
    require_once './src/dbh_src.php';
    require_once './src/create_card_src.php';
    $sql = "SELECT * FROM category";
    $resultData = mysqli_query($conn,$sql);
    $cards_html = '';
    while($row = mysqli_fetch_assoc($resultData)){
        $cards_html .= createCategoryCard($row);
    }
}
?>

<div class="container-fluid">
    <!-- banner -->
    <div class="row text-center" id="banner">
        <h1>All post categories</h1>
    </div>
    <!-- category cards -->
    <!-- md determines the number of cards -->
    <div class="row row-cols-1 row-cols-md-3 g-4">
        <?php
            //Print all the category cards with Php
            echo $cards_html;
        ?>
    </div>
    <!-- end category cards -->
</div>

<?php
include_once './includes/footer.php'
?>