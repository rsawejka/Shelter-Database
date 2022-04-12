<?php
ob_start();

$pageTitle = 'add animal';
include 'includes/header.php';
echo "<div class='ps-5 pe-5 pt-3'>";
include 'includes/addAnimalComp.php';
echo "</div>";
?>

<?php
include 'includes/footer.php';
?>
