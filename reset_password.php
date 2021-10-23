<?php
    include_once './includes/header.php'
?>

    <div class="text-center">
        <h1 class="mt-4">Reset your Password</h1>
        <form action="./src/reset_request_src.php" method="POST" style="max-width:500px; margin:auto;">
            <img src="./assets/img/fau_logo.png" alt="Logo" height="150">
            <h5>Provide your email address and an email will be sent to you with instructions to reset your password</h5>
            <label for="email" class="visually-hidden-focusable">Email address</label>
            <input type="email" id="email" name="email" class="form-control" placeholder="Your email address" required autofocus>
            <div class="mt-3">
                <button type="submit" name="reset-request-submit" class="btn btn-lg btn-primary btn-block justify-content-center">Send Email</button>
            </div>
        </form>
        <?php
            if(isset($_GET['reset'])){
                if($_GET['reset'] == 'success'){
                    echo '<p class="mt-3">Please check your email</p>';
                }
            }
        ?>
    </div>
    

    <?php
    include_once './includes/footer.php'
    ?>