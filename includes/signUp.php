<?php
$accountCreated = false;
$emailBool = true;
$passBool = true;
$email = "";
$password = "";
$firstName = "";
$lastName = "";
if (isset($_POST['signup'])) {
    //check token
    if ($_SESSION['csrf_token'] !== $_POST['csrf_token']) {
        //something wrong or session expierd, dont update
        die('invalid token');
    }
    // get form values
    $email = $_POST['email'];
    $password = $_POST['password'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $passRegX = '/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.* )(?=.*[^a-zA-Z0-9]).{8,16}$/m';
    $emailRegX = "/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/";
    $passBool = preg_match($passRegX, $password);
    $emailBool = preg_match($emailRegX, $email);
    if (!empty($email) && !empty($password) && $emailBool == true && $passBool == true){
        // encrypt password (after validation)
        $newPassword = password_hash($password, PASSWORD_DEFAULT);

        // add user to database
        $query = "INSERT INTO authDemoUsers
                            (email, password, role, timesLogged, firstName, lastName)
                            VALUES
                            (?, ?, 'user', 0, ?, ?)";

        // prepare, bind, and execute query
        $stmt = mysqli_prepare($db, $query);
        mysqli_stmt_bind_param($stmt, "ssss", $email, $newPassword, $firstName, $lastName);
        mysqli_stmt_execute($stmt);


        // check if record was created
        if (mysqli_stmt_insert_id($stmt)) {
            $accountCreated = true;
            echo '<div>account created</div>';
            $to = $email;
            $subject = "Set up account: New Password";
            $message = '<html>
                    <body>
                    <head>
                    <title>Set new password</title>
                    </head>
                    <div>                    
                    <a href="https://rsawejka.bitlampsites.com/portfolio/Final/">click here to go log in</a>
                    <div>Your Temporary password: ' . $password . '</div>
                    </div>
                    </body>
                    </html>';
            $headers = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            $headers .= 'From: Ryans Shelter Buddy <rsawejka@bitlamp.wctc.edu>' . "\r\n";

            mail($to, $subject, $message, $headers);

        } else {
            echo '<div>Error creating account! </div>';
        }
    }


if($accountCreated == true){
    $email = "";
    $password = "";
    $firstName = "";
    $lastName = "";
}
}

?>

    <form method="post">
        <div class='form-floating mb-3 '>
            <input class='form-control' id='floatingInput' placeholder='email' type="text" name="email" placeholder="New user email" value="<?= $email ?>">
            <label for="email">Email</label>
            <?php if (isset($_POST['signup'])): ?>
            <?php if (empty($email)): ?>
                <div>Enter a email</div>
            <?php endif ?>
            <?php endif ?>

            <?php if ($emailBool == false): ?>
                <div>Enter a valid email</div>
            <?php endif ?>

        </div>
        <div class='form-floating mb-3 '>
            <input class='form-control' id='floatingInput' placeholder='password' type="text" name="password" placeholder="new user password" value="<?= $password ?>">
            <label for="password">Password</label>
        </div>
        <?php if (isset($_POST['signup'])): ?>
        <?php if (empty($password)): ?>
            <div>Enter a password</div>
        <?php endif ?>
        <?php endif ?>
        <?php
        if ($passBool == false) { ?>
            <div>Your password must include
                <ul>
                    <li>One uppercase</li>
                    <li>One lowercase</li>
                    <li>One symbol</li>
                    <li>One number</li>
                    <li>8 - 16 characters</li>
                </ul>
            </div>
        <?php } ?>
        <div>
            <div class='form-floating mb-3 '>
            <input class='form-control' id='floatingInput' placeholder='firstName' type="text" name="firstName" placeholder="users first name" value="<?= $firstName ?>">
                <label for="firstName">First Name</label>
            </div>
            <div class='form-floating mb-3 '>
            <input class='form-control' id='floatingInput' placeholder='lastName' type="text" name="lastName" placeholder="users last name" value="<?= $lastName ?>">
            <label for="lastName">Last Name</label>
            </div>
        </div>
        <div>
            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">

            <input class="btn btn-primary col-12 mb-2" type="submit" name="signup" value="Sign Up">
        </div>
    </form>
</div>
</div>
</div>

