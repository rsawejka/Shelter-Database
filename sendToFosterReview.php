<?php
ob_start();
$pageTitle = 'send to foster review';
include 'includes/header.php';
$animalId = $_GET['animalId'];
$firstName = $_GET['firstName'];
$lastName = $_GET['lastName'];
$personId = $_GET['personId'];
$homeAddress = "";
$phoneNumber = "";

//show who is fostering and stuff




//then on animal page if status == foster show the foster info

//when page is submitted  animals status changes to "in foster"
if (isset($_POST['sendToFoster'])){
    //then add the animal id and person id to the RS_foster table
    $query = "INSERT INTO `RS_foster` (`fosterId`, `animalId`, `personId`) VALUES (NULL, ?, ?)";

    $stmt = mysqli_prepare($db, $query) or die('Error in query ' . mysqli_error($db));
    mysqli_stmt_bind_param($stmt, "ii", $animalId, $personId);
    $result = mysqli_stmt_execute($stmt) or die('Error executing query.' . mysqli_error($db));

    if ($newId = mysqli_insert_id($db)) {
        // redirect back to the city page
        //header('Location: addStoreLocation.php');
        echo "added";
        //header("Location: addAnimal.php");;
    } else {
        // let the user know
        echo "SOMETHING WENT WRONG";
    }

    $newQuery = "UPDATE `RS_animals` SET `status` = 'InFoster' WHERE `RS_animals`.`id` = '$animalId'";


    $stmt = mysqli_prepare($db, $newQuery) or die ('error in query');

    $result = mysqli_stmt_execute($stmt) or die ('error');

// if record was updated correctly
    if (mysqli_affected_rows($db)) {
        // redirect back to the city page
        header('Location: animal.php?id=' . $animalId . '');

    }else{
        echo "nohing happend";
    }
}


?>
<div class='ps-5 pe-5'>
<div class='ps-5 pe-5'>
    <?php
    $personQuery = "SELECT `firstName`, `lastName`, `homeAddress`, `state`, `phoneNumber`
FROM `RS_people` 

WHERE RS_people.personId = '$personId'";
    $result = mysqli_query($db, $personQuery)
    or die('Error in query1: ' . mysqli_error($db));

    if (!$row = mysqli_fetch_array($result)) {
        echo "empty search";
        die();
    }else{
        $homeAddress = $row['homeAddress'];
        $phoneNumber = $row['phoneNumber'];
    }



    $animalQuery = "SELECT `name`, `id`, `dateArrived`, `microchip`, `image`, `type`, `breed`, `weight`, `birthDate`, `enteredBy`, `status`, `comments`, `primaryColor`, `secondaryColor`, personId
        FROM `RS_animals`
        WHERE RS_animals.id = $animalId";




    $result = mysqli_query($db, $animalQuery)
    or die('Error in query1: ' . mysqli_error($db));

    if (!$row = mysqli_fetch_array($result)) {
        echo "empty search";
        die();
    }else{
        echo '<h2 class="pt-3">New Foster For ' . $row['name']  .  ':' . '</h2>';
        echo "<div class='d-flex flex-row justify-content-between ps-5 pe-5 pt-3'>";

        echo '<div><h5>First Name</h5>' . $firstName . '</div>';
        echo  '<div><h5>Last Name</h5>' . $lastName . '</div>';
        echo  '<div><h5>Home Address</h5>' . $homeAddress . '</div>';
        echo  '<div><h5>Phone Number</h5>' . $phoneNumber . '</div>';
        echo '</div>';

        echo '<h2 class="mt-3">Details For' . $row['name'] . '</h2>';
        echo "<div class='d-flex flex-row justify-content-between ps-5 pe-5 pt-3'>";

        echo '<div><h5>Animal Id</h5>' . $animalId . '</div>';
        echo  '<div><h5>Name</h5>' . $row['name'] . '</div>';
        echo  '<div><h5>Type</h5>' . $row['type'] . '</div>';
        echo  '<div><h5>Breed</h5>' . $row['breed'] . '</div>';
        echo '</div>';

    }



    ?>
<form method="post">
    <input class='btn btn-primary col-12 mb-2 mt-3' type="submit" id="sendToFoster" name="sendToFoster" value="Confirm">
</form>
</div>
</div>
<?php
include 'includes/footer.php';
?>
