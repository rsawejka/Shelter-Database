<?php
ob_start();
$pageTitle = 'Person Search Results';
include 'includes/header.php';
$firstNameFromUrl = $_GET['firstName'] ?? "";
$numCondFromUrl = $_GET['numCond'] ?? "";
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
if ($numCondFromUrl == 2){
    $firstAndState = "AND";
}


//echo $firstName;
//echo $lastName;

//create a number of conditionals for AND statements
if (empty($firstName)){
    $query = "SELECT `firstName`, `lastName`, `personId`, `homeAddress`, `phoneNumber` FROM `RS_people` 
        WHERE $lastName $second$lastNameFromUrl$second $firstAndState";
}else{
    $query = "SELECT `firstName`, `lastName`, `personId`, `homeAddress`, `phoneNumber` FROM `RS_people` 
        WHERE  $firstName $first$firstNameFromUrl$first $firstAndState $lastName $second$lastNameFromUrl$second";
}

$result = mysqli_query($db, $query)
or die('Error in query: ' . mysqli_error($db) . $query);
//find number of rows then if it equals 0 return no results.
$numRows =  mysqli_num_rows($result);
if ($numRows === 0){
    echo "<div class='text-center mt-3'><h2>" . 'Empty Search Create An Account' . "</h2></div>";
    include "includes/createPersonCompHome.php";


}else{


?>
    <div class='ps-5 pe-5'>
        <div class='ps-5 pe-5'>
            <h2 class="pt-3 pb-3">Search Results</h2>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Person ID</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Home Address</th>
                    <th scope="col">Phone Number</th>
                </tr>
                </thead>
                <tbody>
<?php
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    echo "<div>";
    $id = $row['personId'];

    ?>
    <tr>
        <td><?= $row['personId'] ?></td>
        <td><?= $row['firstName'] ?></td>
        <td><?= $row['lastName'] ?></td>
        <td><?= $row['homeAddress'] ?></td>
        <td><?= $row['phoneNumber'] ?></td>

        <td><a class='btn btn-primary col-5 mx-auto' href='person.php?id=<?= $id ?>'>View</a></td>
    </tr>
                </div>
    <?php


}
?>
        </tbody>
        </table>
        <?php
echo "<div class='text-center'><h5>Or</h5></div>";
echo "<form method='post'><div class='text-center mt-3'> <input type='submit' name='createNewPerson' id='createNewPerson' class='btn btn-primary col-12' value='Create New Person Account'></div></form>";
if (isset($_POST['createNewPerson'])){
    header('location: addPerson.php');

}
}
?>

</div>
</div>
</div>
</div>
<?php
include 'includes/footer.php';
?>