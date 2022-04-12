<?php

$pageTitle = 'physical exam history';
include 'includes/header.php';
$id = $_GET['id'] ?? "";

$query = "SELECT `animalId`, `ears`, `earsComments`, `eyes`, `eyesComments`, `skin`, `skinComments`, `comments`, `enterdBy`, `date`  FROM `RS_physicalExams` WHERE animalId = $id ORDER BY date DESC";
$result = mysqli_query($db, $query)
or die('Error in query: ' . mysqli_error($db));
//find number of rows then if it equals 0 return no results.
$numRows =  mysqli_num_rows($result);
?>
<div class='ps-5 pe-5'>
    <div class='ps-5 pe-5'>
<?php
if ($numRows === 0){
    echo "empty";

    ?>


    <?php
}else{
$i = 0;
    echo "<div class='d-flex flex-row ms-5  mt-5 col-12 flex-wrap'>";
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
    $i++;
    echo "<div class='pt-3 col-4'>";

    echo "<h2 class='pb-3'>Physical exam number $i</h2>";
    echo "<h5>Date of exam</h5><div>" . $row['date'] . "</div>";
    $personId = $row['animalId'];
    echo "<div><h3>Ears</h3>" . $row['ears'] . "</div>";
    echo "<div><h6>Ear Comments</h6>" . $row['earsComments']  . "</div>";
    echo "<div><h3>Eyes Status</h3>" . $row['eyes'] . "</div>";
    echo "<div><h6>Eyes Comments</h6>" . $row['eyesComments'] . "</div>";
    echo  "<div><h3>Skin Status</h3>" . $row['skin']  . "</div>";
    echo "<div><h6>Skin Comments</h6>" . $row['skinComments'] . "</div>";
    echo "<div><h3>Additional Comments</h3>" . $row['comments'] . "</div>";
    echo  "<div>" . $row['enterdBy'] . "</div>";
    $orgDate = $row['date'];
    $newDate = date("m-d-Y", strtotime($orgDate));

    echo "<div>" . $newDate . "</div>";
    echo "</div>";


    //add a header here to redirct to a payment page with person id and animal id
}}
?>
    </div>
    </div>
    </div>
    </div>

<?php
include 'includes/footer.php';
?>
