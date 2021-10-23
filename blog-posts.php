<?php
include_once './includes/header.php';
require_once './src/dbh_src.php';
require_once './src/create_card_src.php';


if(!isset($_SESSION['username'])){
    header('Location: ./login.php');
}

$cards_html = '';

if(isset($_GET['category'])){
    $category_slug = $_GET['category'];
    //get all PUBLISHED posts that belong to the given category slug
    $sql = "SELECT post.* FROM post INNER JOIN category ON post.categoryId = category.id WHERE category.slug = '$category_slug' AND post.published=1;";
    $resultData = mysqli_query($conn,$sql);
    while($row = mysqli_fetch_assoc($resultData)){
        //create summary card and append it to $cards_html
        $cards_html .= createPostSummaryCard($row);
    }
} else { //user looking at all blog posts
    //get all published posts
    $sql = "SELECT * FROM post WHERE post.published=1;";
    $resultData = mysqli_query($conn,$sql);
    while($row = mysqli_fetch_assoc($resultData)){
        $cards_html .= createPostSummaryCard($row);
    }
}
?>

<div class="container-fluid">
    <!-- title div -->
    <div class="row text-center">
        <h1>All Blog Posts</h1>
        <?php if(isset($category_slug))echo('<h2>Category: '.$category_slug.'</h2>');?>
    </div>

    <!-- Responsive cards with footer-->
    <div class="row row-cols-1 row-cols-md-5 g-4">
        <!-- Dynamically generated cards -->
        <?php
        echo $cards_html;
        ?>
    </div>
</div>

<?php
include_once './includes/footer.php';
?>
