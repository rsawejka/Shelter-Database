<?php
$pageTitle = 'index';
$bodyId = 'loginPage';
ob_start();
include 'includes/header.php';
?>
<div>Visitor username and password</div>
<ul>
    <li>username: public@gmail.com</li>
    <li>password: NewPassword123!</li>
    <li>password: NewPassword123!</li>
</ul>
<?php

include 'includes/login.php';
if(isset($_SESSION['users']['email'])){
    header("Location: homePage.php");
}
?>
<?php
include 'includes/footer.php';
?>
