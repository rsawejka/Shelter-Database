<?php

//combine name with type, incomeing, outgoing(when incorporated),
$t = 0;
$firstName = "";
$lastName = "";
if (isset($_POST['searchForPerson'])){
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $lastName = "";
    //$inputIncomingDate = $_POST['firstName'];
    if (!empty($firstName)){
        $t++;
    }
    $lastName = $_POST['lastName'];
    if (!empty($lastName)){
        $t++;
    }
    //echo "clicked";
    header('location: searchResultsPersonFoster.php?firstName=' . $firstName . "&lastName=" . $lastName . "&animalId=" . $id);
}
?>
<form method="post" class='ps-5'>
    <div class='form-floating mb-3 '>
    <input type="text" name="firstName" class='form-control' id='floatingInput' placeholder='name'>
    <label for="firstName">Person First Name</label>
    </div>
    <div class='form-floating mb-3 '>
    <input type="text" name="lastName" class='form-control' id='floatingInput' placeholder='last name'>
    <label for="lastName">Person Last Name</label>
    </div>
    <input type="submit" name="searchForPerson" value="Search" class='btn btn-primary col-12 mb-2'>
</form>
