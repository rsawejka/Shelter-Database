<?php
ob_start();
$pageTitle = "reset pass";
include 'includes/header.php';
$hashedPass = $_GET['newPass'];

$type = "password";
$otherType = "submit";
$passInputOne = "";
$passInputTwo = "";
$passBool1 = true;
$passBool2 = true;

if(isset($_POST['continue'])){
    $passInputOne = $_POST['changePass1'];
    $passInputTwo = $_POST['changePass2'];
    $passRegX = '/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.* )(?=.*[^a-zA-Z0-9]).{8,16}$/m';
    $passBool1 = preg_match($passRegX, $passInputOne);
    $passBool2 = preg_match($passRegX, $passInputTwo);
if (!empty($passInputOne) && !empty($passInputTwo) && $passBool1 == true && $passBool2 == true){
    //check to see if the passwords match
    if($passInputOne === $passInputTwo){
        echo "they are equal";
        //then hash the password
        $passInputTwo = password_hash($passInputTwo, PASSWORD_DEFAULT);
        //echo $changedPassword;
        //then update record in database
        $query = "UPDATE `authDemoUsers` SET `password` = '$passInputTwo' WHERE `authDemoUsers`.`password` = '$hashedPass'";
        // execute query
        $stmt = mysqli_prepare($db, $query) or die ('error in query');

        $result = mysqli_stmt_execute($stmt) or die ('error');

// if record was updated correctly
        if (mysqli_affected_rows($db)) {
            
            $newTimesLogged = 1;
            // redirect back to the city page
            header('Location: homePage.php?id=' . $newTimesLogged . '');
            die();
        }else{
            echo "nohing happend";
        }


    }else{
        echo "not equal";
    }
}else{
        echo "not good";
    }

}

if (isset($_POST['inputType'])){
    $passInputOne = $_POST['changePass1'];
    $passInputTwo = $_POST['changePass2'];
    $type = "text";
    $otherType = "hidden";
}
?>
<!--get user input-->
<div class='ps-5 pe-5 pt-5'>
    <div class='ps-5 pe-5'>
<h2>Change Password</h2>
<form method="post">
    <div class='form-floating mb-3 '>
    <input type="<?= $type ?>" name="changePass1" class='form-control' id='floatingInput'  placeholder="New Password" value="<?= $passInputOne ?>" >
    <label for="changePass1">New Password</label>
    </div>
    <?php if (isset($_POST['continue'])): ?>
    <?php if (empty($passInputOne)): ?>
        <div>you must enter a password here</div>
    <?php endif ?>
    <?php endif ?>
    <div class='form-floating mb-3 '>
    <input type="<?= $type ?>" name="changePass2" class='form-control' id='floatingInput'  placeholder="Confirm New Password" value="<?= $passInputTwo ?>">
    <label for="changePass2">Confirm New Password</label>
    </div>
    <?php if (isset($_POST['continue'])): ?>
    <?php if (empty($passInputTwo)): ?>
        <div>you must enter a password here</div>
    <?php endif ?>
    <?php endif ?>
    <?php if ($passBool1 == false || $passBool2 == false) { ?>
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
    <div class="d-flex flex-row">
        <div class="w-50  me-3">
            <input class=" btn btn-primary col-12 mb-2" type="<?= $otherType ?>" name="inputType" id="inputType" value="Show Password">
        </div>
        <div class="w-50 ms-3 ">
        <input class=" btn btn-primary col-12 mb-2" type="submit" name="continue" value="Continue">
        </div>
    </div>

</form>
    </div>
</div>

    <?php

?>

<?php
include 'includes/footer.php';
?>
