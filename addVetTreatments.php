<?php
ob_start();
$pageTitle = 'add vet treatments';
include 'includes/header.php';
$id = $_GET['id'];
//$numOfTreatments = $_POST['numOfTreatments'] ?? "";
//$numOfTreatments++;
//$treatments = [];
$dateGiven = "";
$treatmentType = "";
$nextTreatmentDue = "";
$nextTreatmentType = "";

?>
<!--<form method="post">
    <input type="number" name="numOfTreatments" id="numOfTreatments">
    <input type="submit" name="next" id="next" value="GO">
</form>-->
<?php
if (isset($_POST['backToAnimal'])){
    header('location: animal.php?id=' . $id);
}
echo "<div class='ps-5 pe-5'>
    <div class='ps-5 pe-5'>";
echo "<form method='post'>";
//$s = 0;
//$select = [];
//$select1 = "";
//$select2 = "";
//or ($i = 1; $i < $numOfTreatments; $i++){


    //$select = $_POST['select' . $i] ?? "";
    echo "<h2 class='pt-4 pb-4'>Add Vet Treatment </h2>";

    echo "<div class='form-floating mb-3'>";
    echo "<input type='date' name='dateGiven' class='form-control' id='floatingInput' placeholder='frequency'>";
    echo "<label for='dateGiven'>Treatment Date Given</label>";
    echo "</div>";



    echo "<div class='form-floating mb-3'>";
    echo "<select name='treatmentType' id='floatingSelect' class='form-select mb-3'>";
    include 'includes/vetTreatementsSelectMenu.php';
    echo "</select>";
    echo "<label for='treatmentType'>Treatment Type Given</label>";
    echo "<div>";

    echo "<div class='form-floating mb-3'>";
    echo "<input type='date' name='nextTreatmentDue' class='form-control' id='floatingInput' placeholder='frequency'>";
echo "<label for='nextTreatmentDue'>Next Treatment Due</label>";

echo "</div>";


    echo "<div class='form-floating mb-3'>";
    echo "<select name='nextTreatmentType' id='floatingSelect' class='form-select mb-3'>";
    include 'includes/vetTreatementsSelectMenu.php';
    echo "</select>";
echo "<label for='nextTreatmentType'>Next Treatment Type</label>";
echo "</div>";
   $first = $_SESSION['users']['firstName'];
   $last = $_SESSION['users']['lastName'];

    echo "<input type='hidden' name='enteredBy' value='$first $last'>";

//}
echo "<input type='submit' class='btn btn-primary col-12 mb-2' name='submit' value='Add Treatments'>";
echo "<input type='submit' class='btn btn-primary col-12 mb-2' name='backToAnimal' value='Back To Animal'>";

echo "</form>";
echo "</div>";
echo "</div>";

if (isset($_POST['submit'])){
    $dateGiven = $_POST['dateGiven'];
    $treatmentType = $_POST['treatmentType'];
    $nextTreatmentDue = $_POST['nextTreatmentDue'];
    $nextTreatmentType = $_POST['nextTreatmentType'];
    $enteredBy = $_POST['enteredBy'];

    // insert record
    $query = "INSERT INTO `RS_vetTreatments` 
(`id`, `animalId`, `dateGiven`, `dueDate`, `enteredBy`, `treatmentGiven`, `nextTreatment`)
VALUES (NULL, ?, ?, ?, ?, ?, ?);";
    //  echo $query;
    //  echo $name;
    //   echo $dateArrived;
    // echo $microchipNumber;
    //  echo $image;

    // execute query

    //start here next time
    $stmt = mysqli_prepare($db, $query) or die('Error in query ' . mysqli_error($db));
    mysqli_stmt_bind_param($stmt, "isssss", $id, $dateGiven, $nextTreatmentDue, $enteredBy, $treatmentType, $nextTreatmentType);
    $result = mysqli_stmt_execute($stmt) or die('Error executing query.' . mysqli_error($db));

    if ($newId = mysqli_insert_id($db)) {
    echo "added";
        $dateGiven = "";
        $treatmentType = "";
        $nextTreatmentDue = "";
        $nextTreatmentType = "";
        $enteredBy = "";
        // redirect back to the city page
        //header('Location: addStoreLocation.php');
      //  $last_id = mysqli_insert_id($db);
        //echo $last_id;
        //header("Location: animalRecipt.php?id=$last_id");;
    } else {
        // let the user know
        echo "SOMETHING WENT WRONG";
    }
}

echo "</div>";
echo "</div>";
?>
<?php
include 'includes/footer.php';
?>
