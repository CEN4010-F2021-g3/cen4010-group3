<?php
include_once './includes/header.php';
require_once './src/dbh_src.php';
require_once './src/create_card_src.php';


if(!isset($_SESSION['username'])){
    header('Location: ./login.php');
}

$cards_html = '';

if(isset($_GET['category'])){
    //User reached blog-posts through Categories page
    $category_slug = $_GET['category'];
    //get all PUBLISHED posts that belong to the given category slug
    $sql = "SELECT post.* FROM post INNER JOIN category ON post.categoryId = category.id WHERE category.slug = '$category_slug' AND post.published=1;";
    $resultData = mysqli_query($conn,$sql);
    while($row = mysqli_fetch_assoc($resultData)){
        //create summary card and append it to $cards_html
        $cards_html .= createPostSummaryCard($row);
    }
} elseif(isset($_GET['search-submit'])){
    //User has used search bar
    $search_input = $_GET['search-input'];
    $sql = "SELECT post.* FROM post INNER JOIN category ON post.categoryId = category.id INNER JOIN users ON post.authorId = users.usersId WHERE post.published=1 AND 
            (post.title LIKE '%$search_input%' OR post.summary LIKE '%$search_input%' OR post.content LIKE '%$search_input%' OR post.createdAt LIKE '%$search_input%' OR users.usersName LIKE '%$search_input%'
            OR users.usersFirst LIKE '%$search_input%' OR users.usersLast LIKE '%$search_input%')";
    $resultData = mysqli_query($conn,$sql);
    if(!mysqli_num_rows($resultData)){
        echo '<div class="alert alert-danger" role="alert">
            No results found for your search!
             </div>';
    } else {
        echo '<div class="alert alert-success" role="alert">
            These posts match your search for: ' . $search_input . '
            </div>';
    }
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

<div class="container">
    <!-- title div -->
    <div class="row text-center">
        <h1>All Blog Posts</h1>
        <?php if(isset($category_slug))echo('<h2>Category: '.$category_slug.'</h2>');?>
    </div>
    <!-- search bar -->
    <form action="./blog-posts.php" method="GET">
        <div class="input-group mb-3">
            <input type="text" class="form-control form-control-lg" placeholder="Search Here" name="search-input">
            <button type="submit" class="input-group-text btn btn-primary" name="search-submit"><i class="fas fa-search me-2"></i> Search</button>
        </div>
    </form>
    <!-- Responsive cards with footer-->
    <div class="row row-cols-1 row-cols-md-4 g-4">
        <!-- Dynamically generated cards -->
        <?php
        echo $cards_html;
        ?>
    </div>
</div>

<?php
include_once './includes/footer.php';
?>
