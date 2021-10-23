<?php
    include_once './includes/header.php'
?>

    <div class="text-center">
        <h1 class="mt-4">Group 3 Project</h1>

        <?php
            $selector = $_GET['selector'];
            $validator = $_GET['validator'];
            if(empty($selector) || empty($validator)){
                echo "We could not validate your request!";
            } else {
                if(ctype_xdigit($selector) !== false && ctype_xdigit($validator) !== false){
                    ?>
                        <form action="./src/reset_password_src.php" method="POST" style="max-width:500px; margin:auto;">
                            <input type="hidden" name="selector" value="<?php echo $selector;?>">
                            <input type="hidden" name="validator" value="<?php echo $validator;?>">

                            <img src="./assets/img/fau_logo.png" alt="Logo" height="150">
                            <h2 class="mt-4">Create new password form</h2>
                            <label for="pwd" class="visually-hidden-focusable">New Password</label>
                            <input type="password" id="pwd" name="pwd" class="form-control mb-2" placeholder="New Password" required autofocus>
                            <label for="pwd-repeat" class="visually-hidden-focusable">Repeat password</label>
                            <input type="password" id="pwd-repeat" name="pwd-repeat" class="form-control mb-2" placeholder="Repeat Password" required autofocus>
                            <div class="mt-3">
                                <button type="submit" name="reset-password-submit" class="btn btn-lg btn-primary btn-block justify-content-center">Reset Password</button>
                            </div>
                        </form>

                    <?php
                }
            }
        ?>

        
    </div>
    <?php
        include_once './includes/footer.php'
    ?>