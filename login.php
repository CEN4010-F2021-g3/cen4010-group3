<?php
    include_once './includes/header.php'
?>

    <div class="text-center">
        <h1 class="mt-4">Welcome back</h1>
        <form action="./src/login_src.php" method="POST" style="max-width:500px; margin:auto;">
            <img src="./assets/img/fau_logo.png" alt="Logo" height="150">
            <h2>Log In</h2>
            <label for="username" class="visually-hidden-focusable">Email address/Username</label>
            <input type="input" id="username" name="username" class="form-control" placeholder="Email Address/Username" required autofocus>
            <label for="pwd" class="visually-hidden-focusable">Password</label>
            <input type="password" id="pwd" name="pwd" class="form-control mt-2" placeholder="Password" required>
            <div class="mt-3">
                <button type="submit" name="submit" class="btn btn-lg btn-primary btn-block justify-content-center">Log In</button>
            </div>
            <div class="mt-3">
                <h6><a href="./reset_password.php">Forgot your password?</a></h6>
            </div>
            <?php
                //TODO MODIFY ERROR MESSAGES
                if(isset($_GET['error'])){
                    if($_GET['error']=='emptyinput'){
                        echo '<p>Fill in all fields!</p>';
                    }
                    else if($_GET['error'] == 'wronglogin'){
                        echo '<p>Your username or password is incorrect.</p>';
                    }
                }
                //Password updated successfully message
                if(isset($_GET['newpwd'])){
                    if($_GET['newpwd'] == 'passwordupdated'){
                        echo '<p>Your password has been successfully updated!</p>';
                    }
                }
            ?>
        </form>
    </div>
    
    <?php
        include_once './includes/footer.php'
    ?>
