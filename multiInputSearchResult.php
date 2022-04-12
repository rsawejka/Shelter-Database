<?php
$pageTitle = 'Search Results';
include 'includes/header.php';
$nameFromUrl = $_GET['name'] ?? "";
$name = "";
$first = "";
if (!empty($nameFromUrl)){
    $name = "name =";
    $first ="'";

}
$second="";
$incomingDate= "";
$incomingDateFromUrl = $_GET['incomingDate'] ?? "";
if (!empty($incomingDateFromUrl)){
    $incomingDate = "dateArrived =";
    $second="'";
}
$firstAndState = "";
$numCondFromUrl = $_GET['numCond'] ?? "";
if ($numCondFromUrl >= 2){
    $firstAndState = "AND";
}
$secondAndState = "";
$typeOfAnimal = $_GET['typeOfAnimal'] ?? "";
$third = "";
$type = "";
if (!empty($typeOfAnimal)){
    $type = "Type =";
    $third="'";
}
if ($numCondFromUrl >= 3){
    $secondAndState = "AND";
}



$thirdAndState = "";
$animalStatusFromUrl = $_GET['status'] ?? "";
$fourth = "";
$animalStatus = "";
if (!empty($animalStatusFromUrl)){
    $animalStatus = "Status =";
    $fourth="'";
}
if ($numCondFromUrl == 4){
    $thirdAndState = "AND";
}

//echo $name;
//echo $incomingDate;

//create a number of conditionals for AND statements
if (empty($name)){
    $query = "SELECT `name`, `id`, `dateArrived`, `type`, `breed`, `primaryColor`  FROM `RS_animals` 
        WHERE $incomingDate $second$incomingDateFromUrl$second $firstAndState $type $third$typeOfAnimal$third $secondAndState $animalStatus $fourth$animalStatusFromUrl$fourth";
}else{
    $query = "SELECT `name`, `id`, `dateArrived`, `type`, `breed`, `primaryColor` FROM `RS_animals` 
        WHERE  $name $first$nameFromUrl$first $firstAndState $incomingDate $second$incomingDateFromUrl$second $secondAndState $type $third$typeOfAnimal$third $thirdAndState $animalStatus $fourth$animalStatusFromUrl$fourth";
}
if (empty($name) && empty($incomingDateFromUrl)){
    $query = "SELECT `name`, `id`, `dateArrived`, `type`, `breed`, `primaryColor` FROM `RS_animals` 
        WHERE $type $third$typeOfAnimal$third $thirdAndState  $firstAndState $animalStatus $fourth$animalStatusFromUrl$fourth";
}

//echo $query;
$result = mysqli_query($db, $query)
or die('Error in query: ' . mysqli_error($db));
//find number of rows then if it equals 0 return no results.
$numRows =  mysqli_num_rows($result);
if ($numRows === 0){
   echo "empty search";

}

?>
    <div class='ps-5 pe-5'>
    <div class='ps-5 pe-5'>
<h2 class="pt-3 pb-3">Search Results</h2>
    <table class="table">
    <thead>
    <tr>
        <th scope="col">ID</th>
        <th scope="col">Name</th>
        <th scope="col">Type</th>
        <th scope="col">Breed</th>
        <th scope="col">Color</th>
    </tr>
    </thead>
    <tbody>
<?php
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    echo "<div>";
    $id = $row['id'];

    ?>

        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['name'] ?></td>
            <td><?= $row['type'] ?></td>
            <td><?= $row['breed'] ?></td>
            <td><?= $row['primaryColor'] ?></td>
            <td><a class='btn btn-primary col-5 mx-auto' href='animal.php?id=<?= $id ?>'>View</a></td>
        </tr>


    <?php


}

?>
    </tbody>
    </table>
    </div>
    </div>
<?php
include 'includes/footer.php';
?>