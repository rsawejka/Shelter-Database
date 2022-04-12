<?php
//combine name with type, incomeing, outgoing(when incorporated),
$t = 0;
$firstName = "";
$lastName = "";
if (isset($_POST['searchForPerson'])){
    $lastName = $_POST['lastName'];
    $firstName = $_POST['firstName'];
    if (!empty($firstName)){
        $t++;
    }
    $lastName = $_POST['lastName'];
    if (!empty($lastName)){
        $t++;
    }
    //echo "clicked";
    header('location: multiInputSearchResultPerson.php?firstName=' . $firstName . '&lastName=' . $lastName . '&numCond=' . $t );
}
?>
<div class='ps-5 pe-5'>
    <div class='ps-5 pe-5'>
<form method="post">
    <div class='form-floating mb-3 '>
    <input type="text" name="firstName" class='form-control' id='floatingInput' placeholder="First Name Here">
    <label for="firstName">Person First Name</label>
    </div>


    <div class='form-floating mb-3 '>
    <input type="text" name="lastName" class='form-control' id='floatingInput' placeholder='lastname'>
    <label for="lastName">Person Last Name</label>
    </div>


    <input class='btn btn-primary col-12 mb-2' type="submit" name="searchForPerson" value="Search">
</form>
    </div>
    </div>
