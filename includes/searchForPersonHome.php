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
    header('location: multiSearchResultPersonHome.php?firstName=' . $firstName . '&lastName=' . $lastName . '&numCond=' . $t );
}
?>
<form method="post">
    <div class="form-floating mb-3 ">

    <input type="text" name="firstName" class="form-control" id="floatingInput" placeholder="First Name Here">
        <label for="firstName">Person First Name</label>

    </div>
    <div class="form-floating mb-3 ">

    <input type="text" name="lastName" class="form-control" id="floatingInput" placeholder="Last">
        <label for="lastName">Person Last Name</label>

    </div>

    <input type="submit" name="searchForPerson" value="Search" class="btn btn-primary col-12">
</form>
