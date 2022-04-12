<?php
$pageTitle = 'index';
$bodyId = 'loginPage';
include 'includes/header.php';

include 'includes/login.php';
if(isset($_SESSION['users']['email'])){
    header("Location: homePage.php");
}
?>
<?php
include 'includes/footer.php';
?>
