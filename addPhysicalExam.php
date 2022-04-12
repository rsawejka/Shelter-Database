<?php
ob_start();
$pageTitle = 'add physical exam';
$id = $_GET['id'] ?? "";
$date = date("Y-m-d");

include 'includes/header.php';
$currentUserId = $_SESSION['users']['id'];
if (isset($_POST['submit'])){
    $animalId = $_POST['animalId'] ?? "";
    $ears = $_POST['ears'] ?? "";
    $earsComments = $_POST['earsComments'] ?? "";
    $eyes = $_POST['eyes'] ?? "";
    $eyesComments = $_POST['eyesComments'] ?? "";
    $skin = $_POST['skin'] ?? "";
    $skinComments = $_POST['skinComments'] ?? "";
    $enteredBy = $_POST['enteredBy'] ?? "";
    $date = $_POST['date'] ?? "";
    $comments = $_POST['comments'] ?? "";

    $query = "INSERT INTO `RS_physicalExams` 
(`id`, `animalId`, `ears`, `earsComments`, `eyes`, `eyesComments`, `skin`, `skinComments`, `comments`, `enterdBy`, `date`) 
VALUES (NULL, ?,?, ?, ?, ?, ?, ?, ?, ?, ?)";


// execute query

//start here next time
    $stmt = mysqli_prepare($db, $query) or die('Error in query ' . mysqli_error($db));
    mysqli_stmt_bind_param($stmt, "isssssssis", $animalId, $ears, $earsComments, $eyes, $eyesComments, $skin, $skinComments, $comments, $enteredBy, $date);
    $result = mysqli_stmt_execute($stmt) or die('Error executing query.' . mysqli_error($db));

    if ($newId = mysqli_insert_id($db)) {
        echo "added";
        // redirect back to the city page
        //header('Location: addStoreLocation.php');
        //$last_id = mysqli_insert_id($db);
        // echo $last_id;
        header("Location: animal.php?id=$id");;
    } else {
        // let the user know
        echo "SOMETHING WENT WRONG";
    }

}
// insert record

?>
<div class='ps-5 pe-5'>
    <div class='ps-5 pe-5'>
        <h2 class="pt-4 pb-4">Record Physical Exam</h2>
<form method="post">
<!--ears-->
    <div class='form-floating mb-3 col-3'>
        <select name="ears" id="floatingSelect" class="form-select">
            <?php include 'includes/physicalExamSelectMenu.php'?>
        </select>
    <label for="ears">Ears State:</label>
    </div>
    <div class='form-floating mb-3'>
    <textarea class='form-control' id='floatingInput' placeholder='meidcation' name="earsComments"></textarea>
        <label for="earsComments">Ears Comments:</label>

    </div>
    <!--eyes-->
    <div class='form-floating mb-3 col-3'>
    <select name="eyes" id="floatingSelect" class="form-select">
       <?php include 'includes/physicalExamSelectMenu.php'?>
    </select>
    <label for="eyes">Eyes State:</label>
    </div>
    <div class='form-floating mb-3'>
    <textarea class='form-control' id='floatingInput' placeholder='meidcation' name="eyesComments"></textarea>
        <label for="eyesComments">Eyes Comments:</label>
    </div>
    <!--skin-->
    <div class='form-floating mb-3 col-3'>
    <select name="skin" id="floatingSelect" class="form-select">

        <?php include 'includes/physicalExamSelectMenu.php'?>
    </select>
    <label for="skin">Skin State:</label>
    </div>
    <div class='form-floating mb-3'>
    <textarea class='form-control' id='floatingInput' placeholder='meidcation' name="skinComments"></textarea>
        <label for="skinComments">Skin State:</label>
    </div>
    <div class='form-floating mb-3'>
    <textarea class='form-control' id='floatingInput' placeholder='meidcation' name="comments"></textarea>
        <label for="skinComments">Additional Comments:</label>

    </div>
   <input type="hidden" name="enteredBy" value="<?= $currentUserId ?>">
   <input type="hidden" name="date" value="<?= $date ?>">
   <input type="hidden" name="animalId" value="<?= $id ?>">

    <input type="submit" name="submit" id="submit" value="Submit " class="btn btn-primary col-12 mb-2">
</form>
    </div>
    </div>
<?php
include 'includes/footer.php';
?>
