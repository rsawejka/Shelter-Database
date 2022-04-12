<?php
ob_start();
//probably make this page a componet so it can be used on home page too.
$pageTitle = 'look up by person name';
include 'includes/header.php';
$animalId = $_GET['animalId'];
?>
<?php
$firstName = "";
$lastName = "";
if(isset($_POST['searchByName'])){
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    header('Location: searchPersonResults.php?animalId=' . $animalId . '&firstName=' . $firstName . '&lastName=' . $lastName);
    echo $firstName . $lastName;
}
?>
<div class='ps-5 pe-5'>
    <div class='ps-5 pe-5'>
<h2 class="pt-3 pb-3">Search For Person</h2>
<form method="post">
    <div class='form-floating mb-3 '>
    <input type="text" name="firstName" class='form-control' id='floatingInput' placeholder='name'>
    <label for="firstName">First Name</label>
    </div>

    <div class='form-floating mb-3 '>
    <input type="text" name="lastName" class='form-control' id='floatingInput' placeholder='lastname'>
    <label for="lastName">Last Name</label>
    </div>

    <input class='btn btn-primary col-12 mb-2' type="submit" name="searchByName" id="searchByName" value="search">
</form>
    </div>
    </div>
<?php
include 'includes/footer.php';
?>
