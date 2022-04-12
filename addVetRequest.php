<?php
ob_start();
$pageTitle = 'add vet request';
include 'includes/header.php';
$id = $_GET['id'] ?? "";
if (isset($_POST['submit'])) {


    //variable name    NAME of input
    $type = $_POST['requestMenu'] ?? "";
    $comments = $_POST['comments'] ?? '';
    $date = $_POST['date'] ?? '';
    $animalId = $_POST['animalId'] ?? '';





    $type = strip_tags($type);
    $comments = strip_tags($comments);

    $date = strip_tags($date);
    $animalId = strip_tags($animalId);




    // insert record
    $query = "INSERT INTO `RS_vetRequests` (`id`, `type`, `comments`, `date`, `animalId`) VALUES (NULL, ?, ?, ?, ?);";


    // execute query

    //start here next time
    $stmt = mysqli_prepare($db, $query) or die('Error in query ' . mysqli_error($db));
    mysqli_stmt_bind_param($stmt, "sssi", $type, $comments, $date, $animalId);
    $result = mysqli_stmt_execute($stmt) or die('Error executing query.' . mysqli_error($db));

    if ($newId = mysqli_insert_id($db)) {

        // redirect back to the city page
        //header('Location: addStoreLocation.php');
       // $last_id = mysqli_insert_id($db);
       // echo $last_id;
        header("Location: animal.php?id=$id");;
    } else {
        // let the user know
        echo "SOMETHING WENT WRONG";
    }
}

?>
<div class='ps-5 pe-5'>
    <div class='ps-5 pe-5'>
        <h2 class="pt-4 pb-4">Add Vet Request</h2>
<form method="post">

    <div class='form-floating mb-3'>
        <?php include 'includes/animalCareRequestMenu.php'?>
    </div>
    <div class='form-floating mb-3'>


        <textarea type="text" name="comments" class='form-control' id='floatingInput' placeholder='meidcation'></textarea>
        <label for="type">Comments:</label><br>
    </div>



        <input type="hidden" name="date" class='form-control' id='floatingInput' placeholder='meidcation' value="<?php echo date('Y-m-d') ?>">




    <div>
        <input type="hidden" name="animalId" value="<?= $id ?>">

        <input type="submit" name="submit" class="btn btn-primary col-12 mb-2" value="Add Animal Care Request">
    </div>
</form>
    </div>
    </div>
<?php
include 'includes/footer.php';
?>
