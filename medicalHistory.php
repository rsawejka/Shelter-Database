<?php
$pageTitle = 'medical history';
include 'includes/header.php';
$id = $_GET['id'];

    $query = "SELECT `medication`,`animalId`,`ammountDispensed`,`frequency`,`dateFrom`,`dateTo`,`vetName`,`reason`,`notes` FROM `RS_medications` WHERE animalId = $id";



$result = mysqli_query($db, $query)
or die('Error in query: ' . mysqli_error($db));
//find number of rows then if it equals 0 return no results.
$numRows =  mysqli_num_rows($result);
?>
<a class="btn btn-primary col-3 mx-auto noprint mt-3" style="display: block;" href="javascript:if(window.print)window.print()">Print</a>

<?php
echo "<div class='p-3'>";
echo "<h2>Medication Tabel</h2>";
?>
<table class="table">
    <thead>
    <tr>
        <th scope="col">Due Date: </th>
        <th scope="col">Amount Dispensed: </th>
        <th scope="col">Frequency: </th>
        <th scope="col">Date From: </th>
        <th scope="col">Date To: </th>
        <th scope="col">Vet Name: </th>
        <th scope="col">Reason: </th>
        <th scope="col">Notes: </th>
    </tr>
    </thead>
    <tbody>
<?php
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    echo "<div>";
    ?>
    <tr>
        <td><?= $row['medication'] ?></td>
        <td><?= $row['ammountDispensed'] ?></td>
        <td><?= $row['frequency'] ?></td>
        <td><?= $row['dateFrom'] ?></td>
        <td><?= $row['dateTo'] ?></td>
        <td><?= $row['vetName'] ?></td>
        <td><?= $row['reason'] ?></td>
        <td><?= $row['notes'] ?></td>

    </tr>
<?php
}
?>
    </tbody>
</table>
<?php
$query2 = "SELECT `id`, `animalId`, `dateGiven`, `dueDate`, `enteredBy`, `treatmentGiven`, `nextTreatment` FROM `RS_vetTreatments` WHERE animalId = $id AND dueDate < CURDATE()";


$result2 = mysqli_query($db, $query2)
or die('Error in query: ' . mysqli_error($db));
//find number of rows then if it equals 0 return no results.
$numRows =  mysqli_num_rows($result2);
echo "<h2>All Vet Treatments</h2>";
?>
<table class="table ">
    <thead>
    <tr>
        <th scope="col">Date Given: </th>
        <th scope="col">Treatment Type: </th>
        <th scope="col">Treatment Result: </th>
    </tr>
    </thead>
    <tbody>
<?php
while($row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {


?>

        <tr>
            <td><?= $row2['dateGiven'] ?></td>
            <td><?= $row2['treatmentGiven'] ?></td>
            <td><? //include a treatment result feild add = back ?></td>

        </tr>


<?php

    echo "<div>";

}
?>
    </tbody>
</table>
<?php

$query3 = "SELECT *
  FROM RS_vetTreatments
 WHERE animalId = $id AND dueDate >= CURDATE()";


$result3 = mysqli_query($db, $query3)
or die('Error in query: ' . mysqli_error($db));
//find number of rows then if it equals 0 return no results.

echo "<h2>Vet Treatments Due</h2>";
?>
<table class="table">
    <thead>
    <tr>
        <th scope="col">Due Date: </th>
        <th scope="col">Treatment Type: </th>
    </tr>
    </thead>
    <tbody>
<?php
while($row3 = mysqli_fetch_array($result3, MYSQLI_ASSOC)) {
    echo "<div>";

    ?>

    <tr>
        <td><?= $row3['dueDate']; ?></td>
        <td><?= $row3['treatmentGiven']; ?></td>

        <td><? //include a treatment result feild add = back ?></td>

    </tr>

<?php

}



?>
    </tbody>
</table>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<?php
include 'includes/footer.php';
?>
