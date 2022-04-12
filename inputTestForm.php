<?php
$pageTitle = 'input form page test';
include 'includes/header.php';
?>

<?php


if(isset($_POST['login'])) {
    //check token

    // get form values
    $email = $_POST['email'];
    $password = $_POST['password'];
    $passRegX = '/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.* )(?=.*[^a-zA-Z0-9]).{8,16}$/m';
    $emailRegX = "/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/";
    $passBool = preg_match($passRegX, $password);
    $emailBool = preg_match($emailRegX, $email);
    if (!empty($email) && !empty($password) && $emailBool == true && $passBool == true){
            echo "do stuff here";
    }


}

?>



    <form method="post">
        <div class="formInputs">
            <label for="email">test email</label>
            <input type="text" id="email" name="email" placeholder="Your Email *" value="<?= $email ?>">
        <?php if ($emailBool == false): ?>
        <div>Enter a valid email</div>
        <?php endif ?>
        </div>
        <div class="formInputs">
            <label for="password">testpass</label>
            <input type="password" id="password" name="password"  placeholder="Your Password *" value="">
            <?php if ($passBool == false): ?>
                <div>Enter a valid password</div>
            <?php endif ?>
        </div>
        <div class="form-group">
            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token']?>">
            <div id="loginButton">
                <input class="btn btn-success" type="submit" name="login" value="Login"></div>
        </div>
    </form>





<?php
include 'includes/footer.php';
?>