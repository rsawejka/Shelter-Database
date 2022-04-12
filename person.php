<?php
//every page that uses headers use:
ob_start();
$id = $_GET['id'];
$pageTitle = "";
$firstName = "";
$lastName = "";
//$status = "";
include 'includes/header.php';
if(!empty($id)){
    $pageTitle = $id;

    $query = "SELECT `firstName`, `lastName`, `homeAddress`, `state`, `phoneNumber`
FROM `RS_people` 

WHERE RS_people.personId = '$id'";
}

$result = mysqli_query($db, $query)
or die('Error in query1: ' . mysqli_error($db));

if (!$row = mysqli_fetch_array($result)) {
    echo "empty search";

}

//if ($row['animalPId'] !== 0){

  //  echo $row['animalPId'];
//}else{
  //  echo "not in foster";
//}
//$status = "";
$firstName = $row['firstName'];
$lastName = $row['lastName'];
$pageTitle = $firstName;
echo "    <div  class='ps-5 pe-5 pt-3'>
          <div class='ps-5 pe-5 pb-3'>
          
          <form method='post'>
            <input type='submit' name='updatePerson' class='btn btn-primary col-12 mx-auto mt-3 mb-3' value='update'><h2 class='pt-2 pb-2'>Person Details</h2>
            
            <div class='d-flex flex-row justify-content-between'>
            <div class='form-floating mb-3 col-6'>
           
            <input class='form-control' id='floatingInput' placeholder='name' type='text' name='updatefirstNameSlot' value='{$row['firstName']}'>
             <label for='updatefirstNameSlot'>Frist Name: </label> 
             </div>
            <div class='form-floating mb-3 col-6 ms-1'>
           
             <input class='form-control' id='floatingInput' placeholder='lastname' type='text' name='updateLastNameSlot' value='{$row['lastName']}'>
              <label for='updateLastNameSlot'>Type: </label>
              </div>
</div>
            
  <div class='d-flex flex-row justify-content-between'>
       <div class='form-floating mb-3 col-8'>
            
            <input class='form-control' id='floatingInput' placeholder='updateHomeAddressSlot' type='text' name='updateHomeAddressSlot' value='{$row['homeAddress']}'>
            <label for='updateHomeAddressSlot'>homeAddress: </label> 
            </div>
            
            
         
           <div class='form-floating mb-3 col-1 ms-2 me-2'>
            <input class='form-control' id='floatingInput' placeholder='updateStateSlot' type='text' name='updateStateSlot' value='{$row['state']}'>
             <label for='updateStateSlot'>state: </label> 
             </div>
    <div class='form-floating mb-3 col-3'>
           
            <input  class='form-control' id='floatingInput' placeholder='updatePhoneNumberSlot' type='text' name='updatePhoneNumberSlot' value='{$row['phoneNumber']}'>
             <label for='updatePhoneNumberSlot'>phoneNumber: </label> 
             </div>

</div>

       
            
         
            </form>
            </div>
            
            ";

//echo "<h2>animals under care of " . $firstName . " " . $lastName . "</h2>";
//echo $row['name'];
//echo $row['id'];
if(isset($_POST['updatePerson'])){
    $upFristName = $_POST['updatefirstNameSlot'];
    $upLastName = $_POST['updateLastNameSlot'];
    $upHomeAddress = $_POST['updateHomeAddressSlot'];
    $upState = $_POST['updateStateSlot'];
    $upPhoneNumber = $_POST['updatePhoneNumberSlot'];






    $updateQuary = "UPDATE `RS_people` 
    SET `firstName` = '$upFristName', `lastName` = '$upLastName', `homeAddress` = '$upHomeAddress', `state` = '$upState', `phoneNumber` = '$upPhoneNumber' 
    WHERE `RS_people`.`personId` = '$id';";

    $stmt = mysqli_prepare($db, $updateQuary) or die ('error in query');

    $result = mysqli_stmt_execute($stmt) or die ('error');

// if record was updated correctly
    if (mysqli_affected_rows($db)) {
        // redirect back to the city page
        header('Location: person.php?id=' . $id . '');

    }else{
        echo "nohing happend";
    }
}



//
    $query3 = "SELECT `firstName`, `lastName`, `homeAddress`, `state`, `phoneNumber`, RS_animals.name AS name, RS_animals.id AS id, RS_animals.personId AS animalPId, RS_animals.type AS type
        FROM `RS_people`
        JOIN RS_animals ON RS_people.personId = RS_animals.personId
        WHERE RS_animals.personId = '$id'";

    $result = mysqli_query($db, $query3)
    or die('Error in query: ' . mysqli_error($db));
//find number of rows then if it equals 0 return no results.
$numRows =  mysqli_num_rows($result);
if ($numRows === 0){
    echo "<h4 class='pt-3 pb-3'>$firstName $lastName is not responsible for any animals</h4>";

}else{
    echo "<h2>Animals $firstName Is Responsible For</h2>";
    ?>
<table class="table">
    <thead>
    <tr>
        <th scope="col">Animal ID</th>
        <th scope="col">Animal Name</th>
        <th scope="col">Type</th>
    </tr>
    </thead>
    <tbody>
<?php
    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {


        echo "<div>";


        $id = $row['id'];


?>
        <tr>
            <td class="pt-3"><?= $row['id'] ?></td>
            <td class="pt-3"><?= $row['name'] ?></td>
            <td class="pt-3"><?= $row['type'] ?></td>
            <td class=""><a class='btn btn-primary col-6 mx-auto' href='animal.php?id=<?= $id ?>'>View</a</td>

        </tr>
<?php
    }

    ?>
    </tbody>
</table>
<?php
}


$id = $_GET['id'];
$fosterQuery = "SELECT `fosterId`, `animalId`, `RS_foster`.`personId` AS personId, `RS_animals`.`type` AS type, `RS_animals`.`id` AS id, `RS_animals`.`name` AS name FROM `RS_foster` JOIN RS_animals ON RS_foster.animalId = RS_animals.id JOIN RS_people ON RS_foster.personId = RS_people.personId WHERE RS_people.personId = $id";
$results = mysqli_query($db, $fosterQuery)
or die('Error in query: ' . mysqli_error($db));
$numRow2 =  mysqli_num_rows($results);
if ($numRow2 === 0){
    echo "<h4 class='pt-3 pb-3'>$firstName $lastName is not fostering anything right now</h4>";

}else{

    echo "<h2>$firstName is fostering</h2>";
    ?>
<table class="table">
    <thead>
    <tr>
        <th scope="col">Animal ID</th>
        <th scope="col">Animal Name</th>
        <th scope="col">Type</th>
    </tr>
    </thead>
    <tbody>
<?php

    while($row = mysqli_fetch_array($results, MYSQLI_ASSOC)) {
        $animalId = $row['id'];
       // $firstName = $row['firstName'];


        ?>
        <tr>
            <td class="pt-3"><?= $animalId ?></td>
            <td class="pt-3"><?= $row['name'] ?></td>
            <td class="pt-3"><?= $row['type'] ?></td>
            <td class=""><a class='btn btn-primary col-6 mx-auto' href='animal.php?id=<?= $id ?>'>View</a</td>

        </tr>
<?php

//add a return from foster button that will delete the record in data base
    }
    ?>
    </tbody>
</table>
<?php
}


    //echo $personId;

?>

</div>
</div>
<?php
include 'includes/footer.php';
?>
