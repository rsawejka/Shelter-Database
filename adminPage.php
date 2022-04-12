<?php
$pageTitle= "admin stiff";
include 'includes/header.php';
?>
<?php
if(!empty($_SESSION['users']['role'])){
    $userRole = $_SESSION['users']['role'];
    if($userRole === "admin"){
        echo "<div class='ps-5 pe-5 mt-3'>
<div class='ps-5 pe-5'>";
        echo "<h2 class='mb-3'>Create A User Account</h2>";
        if(!empty($_SESSION['users']['role'])){
            $userRole = $_SESSION['users']['role'];
            if($userRole === "admin"){
                include 'includes/signUp.php';
            }
        }
        echo "</div>";
        echo "</div>";
    }else echo "not an admin";
}else die;
?>

<?php
include 'includes/footer.php';
?>