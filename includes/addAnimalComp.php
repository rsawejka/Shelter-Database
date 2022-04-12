<h3>Create Animal Account</h3>
<?php
//make sure all inputs are not empty
//maybe make the date form spot a hidden input so user does not have choice to dictate the date the animal came in.
if (isset($_POST['submit'])) {
        //check token
        if($_SESSION['csrf_token'] !== $_POST['csrf_token']){
            //something wrong or session expierd, dont update
            die('invalid token');
        }
        // get all the values from the form

        //variable name    NAME of input
        $type = $_POST['type'] ?? "";
        $name = $_POST['name'] ?? '';
        $dateArrived = $_POST['dateArrived'] ?? '';
        $microchipNumber = $_POST['microchipNumber'] ?? '';
        $image = $_POST['image'] ?? '';
        $breed = $_POST['breed'] ?? '';
        $weight = $_POST['weight'] ?? '';
        $birthDate = $_POST['birthDate'] ?? '';
        $enteredBy = $_POST['enteredBy'] ?? '';
        $status = $_POST['status'] ?? '';
        $comments = $_POST['comments'] ?? '';
        $primaryColor = $_POST['primaryColor'] ?? '';
        $secondaryColor = $_POST['secondaryColor'] ?? '';




    $type = strip_tags($type);
    $name = strip_tags($name);
    $dateArrived = strip_tags($dateArrived);
    $microchipNumber = strip_tags($microchipNumber);
    $image = strip_tags($image);
    $breed = strip_tags($breed);
    $weight = strip_tags($weight);
    $birthDate = strip_tags($birthDate);
    $enteredBy = strip_tags($enteredBy);
    $status = strip_tags($status);
    $comments = strip_tags($comments);
    $primaryColor = strip_tags($primaryColor);
    $secondaryColor = strip_tags($secondaryColor);



        // insert record
        $query = "INSERT INTO `RS_animals` 
(`type`, `name`, `dateArrived`, `microchip`, `image`, `breed`, `weight`, `birthDate`, `enteredBy`, `status`, `comments`, `primaryColor`, `secondaryColor`, `id`, `personId`) 
VALUES (?,?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NULL, 0);";
      //  echo $query;
      //  echo $name;
     //   echo $dateArrived;
       // echo $microchipNumber;
      //  echo $image;

        // execute query

        //start here next time
        $stmt = mysqli_prepare($db, $query) or die('Error in query ' . mysqli_error($db));
        mysqli_stmt_bind_param($stmt, "ssssssissssss", $type, $name, $dateArrived, $microchipNumber, $image, $breed, $weight, $birthDate, $enteredBy, $status, $comments, $primaryColor, $secondaryColor);
        $result = mysqli_stmt_execute($stmt) or die('Error executing query.' . mysqli_error($db));

        if ($newId = mysqli_insert_id($db)) {

            // redirect back to the city page
            //header('Location: addStoreLocation.php');
            $last_id = mysqli_insert_id($db);
            echo $last_id;
           header("Location: animalRecipt.php?id=$last_id");;
        } else {
            // let the user know
           echo "SOMETHING WENT WRONG";
       }
    }

?>
<form method="post">
    <div class='container col-12'>
        <div >
<div class="row">
    <div class="col">
    <div class="form-floating mb-3 col">  <?php include 'includes/statusMenu.php';?></div>
    </div>
    <div class="col">
        <div class="form-floating mb-3 ">
            <input type="text" name="image" class="form-control" id="floatingInput" placeholder="img">
            <label for="image">Image URL:</label>

        </div>
    </div>
</div>

        <input type="hidden" name="dateArrived" id="dateArrived" value="<?php echo date('Y-m-d'); ?>" >
        <input type="hidden" name="enteredBy" id="enteredBy" value="<?php echo $_SESSION['users']['firstName'] . " " . $_SESSION['users']['lastName']?>">

        <?php// echo date('m-d-Y')?>
    </div>
    <div class='row'>
        <div class="col">
        <div class="form-floating mb-3 ">
        <input type="text" name="name" class="form-control" id="floatingInput" placeholder="name">
        <label for="name">Name:</label>

    </div>
        </div>
        <div class="col">
        <div class="form-floating mb-3 "><?php include 'includes/typeSelectMenu.php';?></div>
        </div>
        <div class="col">

        <div class="form-floating mb-3  ">

        <input type="text" name="breed" class="form-control" id="floatingInput" placeholder="breed">
        <label for="breed">Breed/Species:</label>
    </div>
    </div>
    </div>
    <div class='row'>
        <div class="col">

        <div class="form-floating mb-3 ">
        <input type="text" name="weight" class="form-control" id="floatingInput" placeholder="weight">
        <label for="weight" class="position-absolute">Weight:</label>

    </div>
        </div>
        <div class="col">

        <div class="form-floating mb-3 ">
        <input type="date" name="birthDate" class="form-control" id="floatingInput" placeholder="dob" value="<?php echo date('Y-m-d'); ?>">
        <label for="birthDate">DOB:</label>

    </div>
        </div>

        <div class="col">

    <div class="form-floating mb-3 ">
        <input type="text" name="microchipNumber" placeholder="micronub" class="form-control" id="floatingInput">
        <label for="microchipNumber">Microchip Number:</label>

    </div>
        </div>
    </div>
    <div class='row'>
        <div class="col">

        <div class="form-floating mb-3">
        <input type="text" name="primaryColor" placeholder="color" class="form-control" id="floatingInput">
        <label for="primaryColor">Primary Color:</label>

    </div>
        </div>
        <div class="col">

        <div class="form-floating mb-3 ">
        <input type="text" name="secondaryColor" placeholder="color" class="form-control " id="floatingInput">
        <label for="secondaryColor" class="">Secondary Color:</label>

    </div>
        </div>
        <div class="col">

        <div class="form-floating mb-3 ">
        <textarea type="text" name="comments" placeholder="comments" class="form-control" id="floatingInput"></textarea>
        <label for="comments">Comments:</label>

    </div>
        </div>
    </div>

    <div>
        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token']?>">
<div class="">
        <input type="submit" name="submit" value="Add Animal" class="btn btn-primary col-5 mx-auto " style="display: block;">
</div>
    </div>
    </div>
</form>
