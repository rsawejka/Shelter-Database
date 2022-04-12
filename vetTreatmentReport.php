<div class="noprint">
<?php

$pageTitle = 'generate vet treatments';
include 'includes/header.php';
$inputDate = "";
?>
    <div class='ps-5 pe-5 text-center'>
        <h2 class="pt-5">Generate Vet Treatments Due Per Date</h2>
    </div>
<form method="post" class="pt-4">
<div class="form-floating mb-3 col-3 noprint mx-auto">
    <input type="date" name="selectedDate" class="form-control" id="floatingInput">

</div>
    <div class="col-3 noprint mx-auto">
    <input type="submit" name="selectedDateSubmit"  class="btn btn-primary col-12">
    </div>
</form>
<?php
$inputDate = $_POST['selectedDate'] ?? '';
if (isset($_POST['selectedDateSubmit'])){
    $query = "SELECT `RS_vetTreatments`.`id`, `animalId`, `dateGiven`, `dueDate`, `RS_vetTreatments`.`enteredBy`, `treatmentGiven`, `nextTreatment`, RS_animals.id AS spacificAnimalId, RS_animals.name AS name 
FROM `RS_vetTreatments` 
JOIN RS_animals ON RS_animals.id =  RS_vetTreatments.animalId
WHERE dueDate = '$inputDate'";

?>
</div>

<a class="btn btn-primary col-3 mx-auto noprint" style="display: block;" href="javascript:if(window.print)window.print()">Print</a>

    <?php
    $result = mysqli_query($db, $query)
    or die('Error in query: ' . mysqli_error($db));
//find number of rows then if it equals 0 return no results.

    ?>
<div class='ps-5 pe-5'>
    <div class='ps-5 pe-5'>
   <h2 class="pb-3 pt-5">Vet Treatments Due On <?= $inputDate ?></h2>
<table class="table">
    <thead>
    <tr>
        <th scope="col">Treatment Number</th>
        <th scope="col">Animal ID</th>
        <th scope="col">Name</th>
        <th scope="col">Treatment Due</th>
        <th scope="col">Date Due</th>
    </tr>
    </thead>
    <tbody>
<?php
$i = 0;
    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {


        $i++
?>

            <tr>
                <th scope="row"><?= $i ?></th>
                <td><?= $row['spacificAnimalId']; ?></td>
                <td><?= $row['name']; ?></td>
                <td><?= $row['nextTreatment']; ?></td>
                <td><?= $row['dueDate']; ?></td>
            </tr>


<?php


    }
}


?>
    </tbody>
</table>
    </div>
    </div>

<?php
include 'includes/footer.php';
?>
