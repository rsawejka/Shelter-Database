<?php
?>
<div id="loginPage">

        <?php

        $emailBool = true;
        $passBool = true;
        $email = "";
        if(isset($_POST['login'])){
            //check token
            if($_SESSION['csrf_token'] !== $_POST['csrf_token']){
                //something wrong or session expierd, dont update
                die('invalid token');
            }
            // get form values
            $email = $_POST['email'];
            $password = $_POST['password'];
            $passRegX = '/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.* )(?=.*[^a-zA-Z0-9]).{8,16}$/m';
            $emailRegX = "/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/";
            $passBool = preg_match($passRegX, $password);
            $emailBool = preg_match($emailRegX, $email);
            if (!empty($email) && !empty($password) && $emailBool == true && $passBool == true){

                // get user record from database and check login
                $query = "SELECT userId, email, password, role, timesLogged, firstName, lastName FROM authDemoUsers WHERE email = ?";
                $stmt = mysqli_prepare($db, $query);
                mysqli_stmt_bind_param($stmt, "s", $email);
                mysqli_stmt_execute($stmt);

                // bind these variables to the columns in the record (same order)
                mysqli_stmt_bind_result($stmt, $userId, $email, $hashedPassword, $role, $timesLogged, $firstName, $lastName);

                // fetch the values into the variables
                // (this is what you would loop over if you had more than one record)
                mysqli_stmt_fetch($stmt);



                // check the password

                if(password_verify($password, $hashedPassword)){


                    // update the session with the current user
                    $_SESSION['users']['email'] = $email;
                    $_SESSION['users']['role'] = $role;
                    $_SESSION['users']['id'] = $userId;
                    $_SESSION['users']['firstName'] = $firstName;
                    $_SESSION['users']['lastName'] = $lastName;
                    $uID = $_SESSION['users']['id'];

                    // redirect
                    // include 'includes/trackTimesLogged.php';
                    $newTimesLogged = intval($timesLogged);
                    $newNewTimesLogged = $newTimesLogged++;
                    if ($newNewTimesLogged === 0){
                        header('Location: firstTimePass.php?newPass=' . $hashedPassword . '');
                        die();
                    }else{
                        header('Location: homePage.php?id=' . $newTimesLogged . '');
                        die();
                    }


                    die();
                }else{
                    echo"<div id='warning'>wrong password or email</div>";
                }
            }

        }

        // logout and redirect to login page
        if(isset($_GET['logout'])){
            // remove session data
            // (only removes username, reuses same cookie -- this is bad)
            unset($_SESSION['users']);

            // destroy the session (and cookie)
            session_destroy();

            // redirect
            header("Location: index.php");
            die();
        }

        ?>
        <?php if(isset($_SESSION['users'])): ?>

            <form method="get">
                <input type="submit" name="logout" value="Log Out">
            </form>
        <?php else: ?>
        <form method="post" class="container-sm mt-5">
            <h2 class="textF8F4E3">Login Here:</h2>
            <div class="formInputs">
                <div class='form-floating mb-3 '>

                <input type="text" class='form-control' id='floatingInput' name="email" placeholder="Your Email *" value="<?= $email ?>">
                    <label for="email">Enter Your Email:</label>
                </div>
                <?php if (isset($_POST['login'])): ?>
                <?php if (empty($email)): ?>
                    <div class="error">Enter a email</div>
                <?php endif ?>
                <?php endif ?>
                <?php if ($emailBool == false): ?>
                    <div class="error">Enter a valid email</div>
                <?php endif ?>
            </div>
            <div class="formInputs">
                <div class='form-floating mb-3 '>

                <input type="password" class='form-control' id='floatingInput' name="password"  placeholder="Your Password *" value="">
                    <label for="password">Enter Your Password:</label>
                </div>
                <?php if (isset($_POST['login'])): ?>
                <?php if (empty($password)): ?>
                    <div class="error">Enter a password</div>
                <?php endif ?>
                <?php endif ?>
                <?php
                if ($passBool == false) { ?>
                    <div class="error">you must enter a valid password</div>
                <?php } ?>
            </div>
            <div class="form-group">
                <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token']?>">
                <div id="loginButton">
                    <input class='btn btn-primary col-12 mb-2' type="submit" name="login" value="Login"></div>
            </div>
            <div><a class="textF8F4E3"  href="forgotPassword.php">Forgot Password</a></div>
        </form>

    </div>
</div>
</div>
<?php endif;
//echo '<div id="logInfo">Welcome ' . $_SESSION['users']['email'] . ' </div>';
?>

