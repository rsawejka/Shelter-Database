<?php
$pageTitle = 'receipt';
include 'includes/header.php';
$animalId = $_GET['animalId'];
$firstName = $_GET['firstName'];
$lastName = $_GET['lastName'];
$card = $_GET['hashedCard'];
$cost = $_GET['cost'];
$hashedCard = substr_replace($card, '#### - #### - ', 0, 12);
?>
<div class="d-flex flex-row justify-content-between noprint col-2 mx-auto">
    <div>
<a href="index.php">Back Home</a>
    </div>
    <div>
<a href="javascript:if(window.print)window.print()">Print</a>
    </div>
    <div>
<a href="animal.php?id=<?= $animalId ?>">Back To Animal</a>
</div>
</div>
<?php
$personQuery = "SELECT `firstName`, `lastName`, `homeAddress`, `personId`, `state`, `phoneNumber`
        FROM `RS_people`
        WHERE RS_people.firstName = '$firstName' AND RS_people.lastName = '$lastName'";
$personResult = mysqli_query($db, $personQuery)
or die('Error in query: ' . mysqli_error($db));

if (!$row = mysqli_fetch_array($personResult)) {
    echo "empty search";
} else {
    echo "<div  class='ps-5 pe-5 pt-3   '>
          <div class='ps-5 pe-5 pb-3'>";
    echo "<div class='border border-3 p-3' id='customBorder'>";
    echo "<h2>Owner Details</h2>";

    echo "<div class='d-flex flex-row justify-content-between ' >";

    echo "<div><h5 class='pb-2'>Owner Name: </h5>" . $row['firstName'] . " " . $row['lastName'] . "</div>";
    echo "<div><h5 class='pb-2'>Home Address: </h5> " . $row['homeAddress'] . " </div>";
    echo "<div><h5 class='pb-2'>State: </h5> " . $row['state'] . " </div>";
    echo "<div><h5 class='pb-2'>Phone Number: </h5> " . $row['phoneNumber'] . " </div>";
    $personId = $row['personId'];
    echo "</div>";
    echo "</div>";
    echo "</div>";

    /* echo '<h2>Owner Details</h2>';
     echo $row['firstName'];
     echo $row['lastName'];
     echo $row['homeAddress'];
     $personId = $row['personId'];

     echo $personId;*/

}
//pull and display pet info

$animalQuery = "SELECT `name`, `id`, `dateArrived`, `microchip`, `image`, `type`, `breed`, `weight`, `birthDate`, `enteredBy`, `status`, `personId`
        FROM `RS_animals`
        WHERE RS_animals.id = '$animalId'";


$animalresult = mysqli_query($db, $animalQuery)
or die('Error in query: ' . mysqli_error($db));

if (!$row = mysqli_fetch_array($animalresult)) {
    echo "empty search";
}else {

    $now = time(); // or your date as well
    $calculatedBDay = strtotime($row['birthDate']);
    $datediff = $now - $calculatedBDay;
    $calcDays = round($datediff / (60 * 60 * 24));





    $years = ($calcDays / 365) ; // days / 365 days
    $years = floor($years); // Remove all decimals

    $month = ($calcDays % 365) / 30.5; // I choose 30.5 for Month (30,31) ;)
    $month = floor($month); // Remove all decimals

    $days = ($calcDays % 365) % 30.5; // the rest of days

    // Echo all information set


    echo "<div class='pt-3'>";
    echo "<h2>Animal Details</h2>";


    echo "<div class='d-flex flex-row justify-content-between'>";

    echo "<div><h5 class='pb-2'>Pet Name: </h5>" . $row['name'] . "</div>";
    if ($row['birthDate'] !== "0000-00-00"){
        echo "<div><h5>Age: </h5>" .  $years.' years - '.$month.' month - '.$days.' days' . "</div>";
    }
    echo "<div><h5 class='pb-2'>Animal Type: </h5> " . $row['type'] . " </div>";
    echo "<div><h5 class='pb-2'>Animal Breed: </h5> " . $row['breed'] . " </div>";
    echo "<div><h5 class='pb-2'>Weight: </h5> " . $row['weight'] . " </div>";
    $id = $row['personId'];
    echo "</div>";
    /*
     echo $row['id'];
     echo $row['microchip'];
     echo $row['type'];*/



}
?>
</div>
<div class="mt-3">
    <h2>Payment Details</h2>
</div>
<div class=" d-flex flex-row justify-content-around">

    <?php
    echo '<div><h5>Card Used: </h5>' . $hashedCard . '</div>';
    echo '<div><h5>Total Cost: </h5>' . $cost . '</div>';


    echo "</div>";
    // then hashed card number

    //once the final submit button is clicked create a receipt and store it in new table(include a receipt ID, animals name and ID also person ID)
    //then assign a personId to the animal




//echo $animalId . $firstName . $lastName . $hashedCard;
include 'includes/footer.php';
?>
