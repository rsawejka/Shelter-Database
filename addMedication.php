<?php
$pageTitle  = "add medication";
include 'includes/header.php';
$animalId = $_GET['id'] ?? "";
if (isset($_POST['submit'])) {

//variable name    NAME of input
    $medication = $_POST['medication'] ?? "";

    $ammountDispensed = $_POST['ammountDispensed'] ?? '';
    $frequency = $_POST['frequency'] ?? '';
    $dateFrom = $_POST['dateFrom'] ?? '';
    $dateTo = $_POST['dateTo'] ?? '';
    $vetName = $_POST['vetName'] ?? '';
    $reason = $_POST['reason'] ?? '';
    $notes = $_POST['notes'] ?? '';


}
if (isset($_POST['submit'])){


$query = "INSERT INTO `RS_medications` (`rowId`, `medication`, `animalId`, `ammountDispensed`, `frequency`, `dateFrom`, `dateTo`, `vetName`, `reason`, `notes`) 
VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = mysqli_prepare($db, $query) or die('Error in query ' . mysqli_error($db));
mysqli_stmt_bind_param($stmt, "siissssss", $medication, $animalId, $ammountDispensed, $frequency, $dateFrom, $dateTo, $vetName, $reason, $notes);
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
}
?>
<div class='ps-5 pe-5'>
    <div class='ps-5 pe-5'>
        <h2 class="pt-4 pb-4">Add a Medication</h2>
<form method="post">
    <div class="d-flex flex-row justify-content-between">


    <div class='form-floating mb-3 col-6 me-1'>

        <input type="text" name="medication" class='form-control' id='floatingInput' placeholder='meidcation'>
        <label for="medication">Medication:</label>
    </div>
    <div class='form-floating mb-3 col-6 ms-1'>

        <input type="text" name="frequency" class='form-control' id='floatingInput' placeholder='frequency'>
        <label for="frequency">Frequency:</label>
    </div>
    </div>
    <div class="d-flex flex-row justify-content-between">
    <div class='form-floating mb-3 col-6 me-1'>

        <input type="text" name="ammountDispensed" class='form-control' id='floatingInput' placeholder='ammount dispenced'>
        <label for="ammountDispensed">Amount Dispensed:</label>
    </div>
    <div class='form-floating mb-3 col-6 ms-1'>

        <input type="text" name="vetName" class='form-control' id='floatingInput' placeholder='vetName'>
        <label for="vetName">VetName:</label>
    </div>
    </div>
    <div class="d-flex flex-row justify-content-between">
    <div class='form-floating mb-3 col-6 me-1'>


            <input type="date" name="dateFrom" class='form-control' id='floatingInput' placeholder='dateFrom'>
            <label for="dateFrom">Date From:</label>
        </div>


    <div class='form-floating mb-3 col-6 ms-1'>

        <input type="date" name="dateTo" class='form-control' id='floatingInput' placeholder='dateTo'>
        <label for="dateTo">Date To:</label>
    </div>
    </div>
    <div class='form-floating mb-3 '>

        <textarea type="text" name="Reason" class='form-control' id='floatingInput' placeholder='Reason'></textarea>
        <label for="reason">Reason:</label>
    </div>
    <div class='form-floating mb-3 '>

        <textarea type="text" name="notes" class='form-control' id='floatingInput' placeholder='notes'></textarea>
        <label for="notes">Notes:</label>
    </div>
    <div>


        <input type="submit" name="submit" class="btn btn-primary col-12 mb-2" value="Add Medication">
    </div>
</form>
    </div>
    </div>

<?php
include 'includes/footer.php';
?>
