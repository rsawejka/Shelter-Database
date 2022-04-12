<?php
ob_start();
$pageTitle = "Create New Person";
include 'includes/header.php';
if (isset($_POST['createNewPerson'])){
    //allow to add person record here
    $query = 'INSERT INTO `RS_people` (`firstName`, `lastName`, `homeAddress`, `state`, `phoneNumber`, `personId`) VALUES (?, ?, ?, ?, ?, NULL)';
    $newFirstName = $_POST['firstName'] ?? "";
    $newLastName = $_POST['lastName'] ?? "";
    $newHomeAddress = $_POST['homeAddress'] ?? "";
    $newState = $_POST['state'] ?? "";
    $newPhoneNumber = $_POST['phoneNumber'] ?? "";

    $numCondFromUrl = $_GET['numCond'] ?? "";

    $stmt = mysqli_prepare($db, $query) or die('Error in query ' . mysqli_error($db));
    mysqli_stmt_bind_param($stmt, "sssss", $newFirstName, $newLastName, $newHomeAddress, $newState, $newPhoneNumber);
    $result = mysqli_stmt_execute($stmt) or die('Error executing query.' . mysqli_error($db));

    if ($newId = mysqli_insert_id($db)) {
        if (isset($_POST['createNewPerson'])){
            header('Location: multiSearchResultPersonHome.php?animalId=firstName=' . $newFirstName . '&lastName=' . $newLastName . '&numCond=' . $numCondFromUrl);
        }
        //add a header here to redirct to a payment page with person id and animal id
        // header("Location: addAnimal.php");;
    } else {
        // let the user know
        echo "SOMETHING WENT WRONG";
    }
}

?>
<div class='ps-5 pe-5'>
    <div class='ps-5 pe-5 pt-3'>
        <form method="post">
            <div class="form-floating mb-3 ">


                <input type="text" name="firstName" class="form-control" id="floatingInput" placeholder="name">
                <label for="firstName">First Name</label>
            </div>
            <div class="form-floating mb-3 ">


                <input type="text" name="lastName" class="form-control" id="floatingInput" placeholder="name">
                <label for="lastName">lastName</label>
            </div>
            <div class="form-floating mb-3 ">


                <input type="text" name="homeAddress" class="form-control" id="floatingInput" placeholder="name">
                <label for="homeAddress">homeAddress</label>

            </div>

            <div class="form-floating mb-3 ">


                <input type="text" name="state" class="form-control" id="floatingInput" placeholder="name">
                <label for="state">state</label>
            </div>
            <div class="form-floating mb-3 ">


                <input type="text" name="phoneNumber" class="form-control" id="floatingInput" placeholder="name">
                <label for="phoneNumber">phoneNumber</label>
            </div>
            <input type="submit" name="createNewPerson" id="createNewPerson" class="btn btn-primary col-12" value="Create New Person">
        </form>
    </div>
</div>
<?php
include 'includes/footer.php';
?>