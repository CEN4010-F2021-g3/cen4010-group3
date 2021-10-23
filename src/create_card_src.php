<?php


/****************************************Functions for categories.php ****************************************/
//Creates and returns a bootstrap card containing information about a post category
function createCategoryCard($category_row){
    return '
    <div class="col">
        <div class="card h-100">
            <img src="./assets/category-img/'.$category_row['image'].'" class="card-img-top category-img" alt="'.$category_row['name'].' image">
            <div class="card-body">
                <a href="blog-posts.php?category='.$category_row["slug"].'"><h5 class="card-title">'.$category_row['name'].'</h5></a>
                <p class="card-text">'.$category_row['description'].'</p>
            </div>
            <div class="card-footer">
                <small class="text-muted">Last blog post 3 mins ago</small>
            </div>
        </div>
    </div>
    ';
    //TODO display last blog post time
}

/****************************************Functions for blog-posts.php ****************************************/

function createPostSummaryCard($post_row){
    return '
    <div class="col">
        <div class="card h-100">
            <img src="./assets/post-img/'.$post_row['image'].'" class="card-img-top post-summary-img" alt="'.$post_row['title'].' image">
            <div class="card-body">
                <a href="single-post.php?post='.$post_row["slug"].'"><h5 class="card-title">'.$post_row['title'].'</h5></a>
                <p class="card-text">'.$post_row['summary'].'</p>
            </div>
            <div class="card-footer">
                <small class="text-muted">Date of creation: '.$post_row['createdAt'].'</small>
            </div>
        </div>
    </div>
    ';
    //TODO display the category of each post
    //TODO display the date of creation in a more user-friendly way
}

/****************************************Functions for single-post.php ****************************************/

function createSingleComment($comment){
    return '
    <div class="comment mt-4 text-justify float-left"> <img src=" '.$comment['usersImg'] .' " alt="profile image" class="rounded-circle" width="40" height="40">
        <h4><a href="./profile.php?username='.$comment['usersName'].' "> '.$comment['usersName'].' </a></h4> <span> '.$comment['createdAt'].'</span> <br>
        <p> '.$comment['content'].' </p>
    </div>
    ';
}