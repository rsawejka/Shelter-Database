<?php
$pageTitle = 'Person Search Results';
include 'includes/header.php';
$firstNameFromUrl = $_GET['firstName'] ?? "";
$firstName = "";
$first = "";
if (!empty($firstNameFromUrl)){
    $firstName = "firstName =";
    $first ="'";

}
$second="";
$lastName= "";
$lastNameFromUrl = $_GET['lastName'] ?? "";
if (!empty($lastNameFromUrl)){
    $lastName = "lastName =";
    $second="'";
}
$firstAndState = "";
$numCondFromUrl = $_GET['numCond'] ?? "";
if ($numCondFromUrl >= 2){
    $firstAndState = "AND";
}


//echo $firstName;
//echo $lastName;

//create a number of conditionals for AND statements
if (empty($firstName)){
    $query = "SELECT `firstName`, `lastName`, `personId` FROM `RS_people` 
        WHERE $lastName $second$lastNameFromUrl$second $firstAndState";
}else{
    $query = "SELECT `firstName`, `lastName`, `personId` FROM `RS_people` 
        WHERE  $firstName $first$firstNameFromUrl$first $firstAndState $lastName $second$lastNameFromUrl$second";
}

echo $query;
$result = mysqli_query($db, $query)
or die('Error in query: ' . mysqli_error($db));
//find number of rows then if it equals 0 return no results.
$numRows =  mysqli_num_rows($result);
if ($numRows === 0){
    echo "empty search";
    include "includes/createPersonComp.php";

}
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    echo "<div>";
    echo $row['firstName'];
    $id = $row['personId'];
    echo "<a href='person.php?id=$id'>$id</a>";


}

?>

<?php
include 'includes/footer.php';
?>