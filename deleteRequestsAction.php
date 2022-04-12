<?php
$id = $_GET['id'] ?? '';

$pageTitle = "delete account";
include "includes/header.php";
?>
<a href='deleteRequests.php?' class='mt-3 btn btn-primary col-12'>Back To Delete Requests</a>
<?php
$deleteRequestsQuery = "DELETE FROM `RS_deleteRequests` 
WHERE `RS_deleteRequests`.`animalId` = $id";

// execute query
$deleteRequestsResult = mysqli_query($db, $deleteRequestsQuery) or die('Error updating record.');

// if record was updated correctly
if(mysqli_affected_rows($db)){
    echo "<div>Deleted delete request</div>";
}
$deleteAnimalQuery = "DELETE FROM `RS_animals` 
WHERE `RS_animals`.`id` = $id
LIMIT 1";

// execute query
$deleteAnimalResult = mysqli_query($db, $deleteAnimalQuery) or die('Error updating recordd.');

// if record was updated correctly
if(mysqli_affected_rows($db)){
    echo "<div>Deleted Animal Account</div>";
}
$deleteRequestsFosterQuery = "DELETE FROM `RS_foster` 
WHERE `RS_foster`.`animalId` = $id";

// execute query
$deleteRequestsFosterResult = mysqli_query($db, $deleteRequestsFosterQuery) or die('Error updating record.');

// if record was updated correctly
if(mysqli_affected_rows($db)){
    echo "<div>Deleted Foster Entry</div>";
}
$deleteRequestsMedicationQuery = "DELETE FROM `RS_medications` 
WHERE `RS_medications`.`animalId` = $id";

// execute query
$deleteRequestsMedicationResult = mysqli_query($db, $deleteRequestsMedicationQuery) or die('Error updating record.');

// if record was updated correctly
if(mysqli_affected_rows($db)){
    echo "<div>Deleted Medication Entries</div>";
}
$deleteRequestsPhysicalExamsQuery = "DELETE FROM `RS_physicalExams` 
WHERE `RS_physicalExams`.`animalId` = $id";

// execute query
$deleteRequestsPhysicalExamsResult = mysqli_query($db, $deleteRequestsPhysicalExamsQuery) or die('Error updating record.');

// if record was updated correctly
if(mysqli_affected_rows($db)){
    echo "<div>Deleted Physical Exam Entries</div>";
}
$deleteRequestsReceiptsQuery = "DELETE FROM `RS_receipts` 
WHERE `RS_receipts`.`animalId` = $id";

// execute query
$deleteRequestsReceiptsResult = mysqli_query($db, $deleteRequestsReceiptsQuery) or die('Error updating record.');

// if record was updated correctly
if(mysqli_affected_rows($db)){
    echo "<div>Deleted Receipt Entries</div>";
}
$deleteRequestsVetRequestsQuery = "DELETE FROM `RS_vetRequests` 
WHERE `RS_vetRequests`.`animalId` = $id";

// execute query
$deleteRequestsVetRequestsResult = mysqli_query($db, $deleteRequestsVetRequestsQuery) or die('Error updating record.');

// if record was updated correctly
if(mysqli_affected_rows($db)){
    echo "<div>Deleted Vet Requests Entries</div>";
}
$deleteRequestsVetTreatmentsQuery = "DELETE FROM `RS_vetTreatments` 
WHERE `RS_vetTreatments`.`animalId` = $id";

// execute query
$deleteRequestsVetTreatmentsResult = mysqli_query($db, $deleteRequestsVetTreatmentsQuery) or die('Error updating record.');

// if record was updated correctly
if(mysqli_affected_rows($db)){
    echo "<div>Deleted Vet Treatment Entries</div>";
}


?>
<?php
include "includes/footer.php";
?>
