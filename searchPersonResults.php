<?php
ob_start();
$pageTitle = 'results';
include 'includes/header.php';
$animalId = $_GET['animalId'];
$firstName = $_GET['firstName'];
$lastName = $_GET['lastName'];
//echo $animalId . $firstName . $lastName;
$query = "SELECT * FROM `RS_people` WHERE `firstName` = '$firstName' AND `lastName` = '$lastName'";
$result = mysqli_query($db, $query)
or die('Error in query: ' . mysqli_error($db));
//find number of rows then if it equals 0 return no results.
$numRows =  mysqli_num_rows($result);
if ($numRows === 0){
    include "includes/createPersonComp.php";

    ?>
    <?php
}else{
    if (isset($_POST['continue'])){
        header('Location: getPayment.php?animalId=' . $animalId . '&firstName=' . $firstName . '&lastName=' . $lastName);
    }
    echo "<div class='ps-5 pe-5'><h2 class='mt-3 mb-3'>Search Results</h2>";
    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){

        $personId = $row['personId'];
        echo '<div class="d-flex flex-row justify-content-between ps-5 pe-5">';
        echo '<div><h5>First Name</h5>' . $row['firstName'] . '</div>';
        echo '<div><h5>Last Name</h5>' . $row['lastName'] . '</div>';
        echo '<div><h5>Home Address</h5>' . $row['homeAddress'] . '</div>';
        echo '<div><h5>Phone Number</h5>' . $row['phoneNumber'] . '</div>';
        echo '</div>';
        echo "<form method='post' >";
        echo "<div class='ps-5 pe-5'><input class='btn btn-primary col-12 mb-2 mt-3' type='submit' name='continue' id='Continue' value='Continue'></div>";
        echo "</form>";
        //add a header here to redirct to a payment page with person id and animal id
    }

    echo "</div>";
}

?>
<?php
include 'includes/footer.php';
?>
