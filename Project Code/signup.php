<?php
    include_once './includes/header.php'
?>
    
    <div class="container" style="margin:auto; max-width:600px">
        <form action="./src/signup_src.php" method="POST">
            <div class="row">
                <div class="col col-lg-4"></div>
                <div class="col col-lg-4 "><img src="./assets/img/fau_logo.png" alt="Logo" height="150" class="mt-5 row justify-content-center"></div>
                <div class="col col-lg-4"></div>
            </div>
            <div>
                <h2 class="text-center">Registration form</h2>
            </div>
            <div class="row mb-2">
                <div class="col">
                    <label for="first" class="visually-hidden-focusable">First Name</label>
                    <input type="input" id="first" name="first" class="form-control" placeholder="First Name" required autofocus>
                </div>
                <div class="col">
                    <label for="last" class="visually-hidden-focusable">Last Name</label>
                    <input type="input" id="last" name="last" class="form-control" placeholder="Last Name" required>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col">
                    <label for="username" class="visually-hidden-focusable">Username</label>
                    <input type="input" id="username" name="username" class="form-control" placeholder="Username" required>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col">
                    <label for="email" class="visually-hidden-focusable">Email</label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="Email Address" required>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col">
                    <label for="pwd" class="visually-hidden-focusable">Password</label>
                    <input type="password" id="pwd" name="pwd" class="form-control" placeholder="Password" required>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col">
                    <label for="pwdconfirm" class="visually-hidden-focusable">Confirm Password</label>
                    <input type="password" id="pwdconfirm" name="pwdconfirm" class="form-control" placeholder="Confirm Password" required>
                </div>
            </div>            
            <div class="row mb-2">
                <button type="submit" name="submit" class="btn btn-lg btn-primary btn-block justify-content-center">Sign Up</button>
            </div>
            <div class="row">
                <h6 class="text-center"> Already have an account? <a href="./login.php">Log In</a></h6>
            </div>
            <!-- Php script to show feedback after signing up -->
            <?php
                //TODO MODIFY ERROR MESSAGES
                if(isset($_GET['error'])){
                    if($_GET['error']=='emptyinput'){
                        echo '<p>Fill in all fields!</p>';
                    }
                    else if($_GET['error'] == 'invalidusername'){
                        echo '<p>Your username is invalid, try again!</p>';
                    }
                    else if($_GET['error']=='invalidemail'){
                        echo '<p>Your email is invalid, try again.</p>';
                    }
                    else if($_GET['error']=='passwordsdonotmatch'){
                        echo '<p class=text-center>Your passwords do not match</p>';
                    }
                    else if($_GET['error'] =='usernametaken'){
                        echo '<p>Your username is already taken by someone else, use another one!</p>';
                    }
                    else if($_GET['error']=='stmtfailed'){
                        echo '<p>Something went wrong, try again.</p>';
                    }
                    else if($_GET['error']== 'none'){
                        echo '<p>You have signed up successfully!</p>';
                    }
                }
            ?>
        </form>
    </div>

    <?php
    include_once './includes/footer.php'
    ?>