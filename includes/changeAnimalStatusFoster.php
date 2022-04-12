<?php
$deleteEditQuery = "UPDATE `RS_animals` SET `status` = 'Available' WHERE `RS_animals`.`id` = '$id'";
$result = mysqli_query($db, $deleteEditQuery) or die('Error updating record.');

// if record was updated correctly
if(mysqli_affected_rows($db)){
    // redirect back to the city page
   // include 'includes/changeAnimalStatusFoster.php';
    header('Location: animal.php?id=' . $id);
    die();
}else{
    // let the user know
    echo "SOMETHING WENT WRONG";
}
?>
