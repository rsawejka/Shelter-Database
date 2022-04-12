<?php
//every page that uses headers use:
ob_start();

$deleteRequestModal = false;
//each data output should be in a text feild so it can be updated from the one page
$id = $_GET['id'] ?? "";
$deleteRequestModal =  $_GET['deleteRequestModal'] ?? "";
$microchip = $_GET['microchip'] ?? "";
$pageTitle = "indevidual animal";
include 'includes/header.php';
$personId = "";
$name = "";
if(!empty($id)){
    $pageTitle = $id;
    // JOIN RS_people ON RS_people.personId = RS_animals.personId RS_people.firstName, RS_people.lastName, RS_people.personId
    $query = "SELECT `name`, `id`, `dateArrived`, `microchip`, `image`, `type`, `breed`, `weight`, `birthDate`, `enteredBy`, `status`, `comments`, `primaryColor`, `secondaryColor`, personId
        FROM `RS_animals`
        WHERE RS_animals.id = $id";
}else{
    $id = "";
}
if(!empty($microchip)){
    $pageTitle = $microchip;
    //JOIN RS_people ON RS_people.personId = RS_animals.personId RS_people.firstName, RS_people.lastName, RS_people.personId
    $query = "SELECT `name`, `id`, `dateArrived`, `microchip`, `image`, `type`, `breed`, `weight`, `birthDate`, `enteredBy`, `status`, `comments`, `primaryColor`, `secondaryColor`, personId
        FROM `RS_animals`
       

        WHERE `RS_animals`.`microchip` = '$microchip'";
}else{
    $microchip = "";
}

?>
<?php
if ($deleteRequestModal == true){
    ?>
    <script type="text/javascript">
        window.addEventListener("load", function(){
            var deleteRequestModal = new bootstrap.Modal(document.getElementById('deleteRequestModal'), {})
            deleteRequestModal.toggle()
        });
    </script>
    <!-- Modal -->
    <div class="modal fade" id="deleteRequestModal" tabindex="-1" aria-labelledby="deleteRequestModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php echo "Added Delete Request" ?>
                </div>
                <div class="modal-footer">
                    <form method="post">


                    <input name="deleteModalClose" type="submit" class="btn btn-secondary" data-bs-dismiss="modal" value="Close">
                    </form>
                    <?php
                    if (isset($_POST['deleteModalClose'])){
                        header('location: animal.php?id=' . $id);
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
<?php
}
?>

<?php

$result = mysqli_query($db, $query)
or die('Error in query1: ' . mysqli_error($db));

if (!$row = mysqli_fetch_array($result)) {
    echo "empty search";
    die();
}else{
if (!empty($row['comments'])){
?>
    <script type="text/javascript">
        window.addEventListener("load", function(){
            var myModal = new bootstrap.Modal(document.getElementById('exampleModal'), {})
            myModal.toggle()
        });
    </script>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Comments For <?= $row['name'] ?>: </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php echo $row['comments'] ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


<?php
}
?>


<div class="d-flex flex-row mx-auto ps-5 pe-5">

    <?php
    if (empty($row['image'])){
        echo "<div class='w-25 ps-5 me-5'>";
        echo "<div ><img class='imgClass' src='images/placeholder.png'></div>";
        echo "<form method='post'>";
        echo "<div>
         <div class='form-floating mb-3 '>
        <input type='text' name='image' class='form-control' id='floatingInput' placeholder='img'>
        <label for='image'>Enter an Image URL</label>
        </div>
        <input type='submit' class='btn btn-primary col-12 mb-2' name='submit' value='Enter New Image'>
    </div>";

        if (isset($_POST['submit'])){
            echo "new image added";
            $newImgURL = $_POST['image'];
            $newquery = "UPDATE `RS_animals` SET `image` = '$newImgURL' WHERE `RS_animals`.`id` = '$id';";

            $stmt = mysqli_prepare($db, $newquery) or die ('error in query');

            $result = mysqli_stmt_execute($stmt) or die ('error');

// if record was updated correctly
            if (mysqli_affected_rows($db)) {
                // redirect back to the city page
                header('Location: animal.php?id=' . $id . '');

            }else{
                echo "nohing happend";
            }

        }
        echo "</form>";
    }else{
        echo "
          <div id='this' class='w-25 ps-5 me-5'><img class='imgClass pt-5 ' src='{$row['image']}'</div>";
    }
    $now = time(); // or your date as well
    $calculatedBDay = strtotime($row['birthDate']);
    $datediff = $now - $calculatedBDay;
    $calcDays = round($datediff / (60 * 60 * 24));





    $years = ($calcDays / 365) ; // days / 365 days
    $years = floor($years); // Remove all decimals

    $month = ($calcDays % 365) / 30.5; // I choose 30.5 for Month (30,31) ;)
    $month = floor($month); // Remove all decimals

    $days = ($calcDays % 365) % 30.5; // the rest of days

    // Echo all information set
    echo '<div class="pt-3 pb-3"><div> Animal ID: '.  $row['id'] . '</div>';
    if ($row['birthDate'] !== "0000-00-00"){
        echo "<div>Age: " .  $years.' years - '.$month.' month - '.$days.' days' . "</div>";
    }
    echo '</div>';
    ?>

    <div><form method="post">
           <div><input type="submit" name="addPhysicalExam" value="Physical Exam" class="btn btn-primary col-12 mb-2"></div>
            <div> <input type="submit" name="physicalExamHistory" value="Physical Exam History" class="btn btn-primary col-12 mb-2"></div>
                <div> <input type="submit" name="addVetTreatment" value="Add Vet Treatement" class="btn btn-primary col-12 mb-2"></div>

                    <div> <input type="submit" name="addMedication" value="Add Medication" class="btn btn-primary col-12 mb-2"></div>
                        <div>  <input type="submit" name="medicalHistory" value="View Medical History" class="btn btn-primary col-12 mb-2"></div>
                            <div>  <input type="submit" name="addVetRequest" value="Add A Vet Request" class="btn btn-primary col-12 mb-2"></div>

            <?php
            $seeIfDeleteRequestQuery = "SELECT `animalId` FROM RS_deleteRequests WHERE `animalId` = $id";
            $seeIfDeleteRequestResult = mysqli_query($db, $seeIfDeleteRequestQuery)
            or die('Error in query11: ' . mysqli_error($db));

            $numRows =  mysqli_num_rows($seeIfDeleteRequestResult);
            if ($numRows === 0){
                echo "<div>  <input type='submit' name='deleteRequest' value='Request To Delete Account' class='btn btn-primary col-12 mb-2'></div>";
            }else{
                echo "<div>  <input type='disabled' value='Delete Request Sent' class='btn btn-primary col-12 mb-2'></div>";
            }
            ?>


        </form></div>

</div>
<div id="other" class='w-75 pt-5'>
    <?php

    $formatDate = date("m-d-Y", strtotime($row['dateArrived']));



    if(isset($_POST['adoptAnimal'])){
        header('Location: searchPerson.php?animalId=' . $id . '');
    }
    ?>
    <form method="post">

        <?php
        $personId = $row['personId'];
        $name = $row['name'];
        $id = $row['id'];
        if(($row['status'] == 'Adopted' || $row['status'] == 'EuthanasiaRequest' || $row['status'] == 'Euthanized' || $row['status'] == 'DOA' || $row['status'] == 'InFoster')){
            //$adoptQuery = "SELECT `name`, `id`, `dateArrived`, `microchip`, `image`, `type`, `breed`, `weight`, `birthDate`, `enteredBy`, `status`, RS_people.firstName AS firstName, RS_people.lastName as lastName, RS_people.personId
            // FROM `RS_animals`
            // JOIN RS_people ON RS_people.personId = RS_animals.personId";
            // $result = mysqli_query($db, $adoptQuery)
            // or die('Error in query: ' . mysqli_error($db));
            // echo "<div><h2>animal is adopted out by  " . $row['firstName'] . " "  . $row['lastName'] . "</h2></div>";
        }else{
            echo "<input type='submit' name='adoptAnimal' id='adoptAnimal' value='Adopt Out' class='btn btn-primary col-12 mb-2'>";
        }?>
        <div >
            <input type='submit' name='updateAnimal' id='updateAnimal' value="Update" class="btn btn-primary col-12 mb-2">
                <div>Entered By: <?=$row['enteredBy']?></div>
            <div >Date Arrived: <?=$formatDate?></div>


            <div class="form-floating mb-3 ">
                <select name='updateStatusSlot' value='<?=$row['status']?>' id="floatingSelect" class="form-select">
                    <option  <?php if($row['status'] == "Adopted") echo 'selected="selected"'; ?> value='Adopted'>Adopted</option>
                    <option  <?php if($row['status'] == "returned") echo 'selected="selected"'; ?> value='returned'>Returned</option>
                    <option  <?php if($row['status'] == "InFoster") echo 'selected="selected"'; ?> value='InFoster'>In Foster</option>
                    <option  <?php if($row['status'] == "Available") echo 'selected="selected"'; ?> value='Available'>Available For Adoption</option>
                    <option <?php if($row['status'] == "Stray") echo 'selected="selected"'; ?> value='Stray'>Stray</option>
                    <option <?php if($row['status'] == "DOA") echo 'selected="selected"'; ?> value='DOA'>DOA</option>
                    <option <?php if($row['status'] == "EuthanasiaRequest") echo 'selected="selected"'; ?> value='EuthanasiaRequest'>Euthanasia Request</option>
                    <option <?php if($row['status'] == "Euthanized") echo 'selected="selected"'; ?> value='Euthanized'>Euthanized</option>
                </select>
                <label for='updateStatusSlot'>status:</label>

            </div>
            <?php
            echo "
            <div class='form-floating mb-3 '>
           
            <input class='form-control' id='floatingInput' placeholder='name' type='text' name='updateNameSlot' value='{$row['name']}'>
             <label for='updateNameSlot'>Name: </label> 
            </div>
            <div class='form-floating mb-3 '>
           
            <input class='form-control' id='floatingInput' placeholder='name' type='text' name='updateTypeSlot' value='{$row['type']}'>
             <label for='updateTypeSlot'>Type: </label> 
            </div>
            <div class='form-floating mb-3 '>
            
            <input class='form-control' id='floatingInput' placeholder='name' type='text' name='updateBreedSlot' value='{$row['breed']}'>
            <label for='updateBreedSlot'>Breed/Species: </label> 
            </div>
            <div class='form-floating mb-3 '>
           
            <input class='form-control' id='floatingInput' placeholder='name' type='text' name='updateWeightSlot' value='{$row['weight']}'>
             <label for='updateWeightSlot'>Weight: </label> 
            </div>
            <div class='form-floating mb-3 '>
           
            <input class='form-control' id='floatingInput' placeholder='name' type='text' name='updateMicrochipSlot' value='{$row['microchip']}'>
             <label for='updateMicrochipSlot'>Microchip: </label> 
            </div>
            <div class='form-floating mb-3 '>
           
             <input class='form-control' id='floatingInput' placeholder='name' type='text' name='updatePrimaryColorSlot' value='{$row['primaryColor']}'>
              <label for='updatePrimaryColorSlot'>Primary Color: </label>
             </div>
            <div class='form-floating mb-3 '>
           
             <input class='form-control' id='floatingInput' placeholder='name' type='text' name='updateSecondaryColorSlot' value='{$row['secondaryColor']}'>
              <label for='updateSecondaryColorSlot'>Secondary Color: </label>
             </div>
            <div class='form-floating mb-3 '>
           
            <input type='date' value='{$row['birthDate']}' name='updateBirthDateSlot' class='form-control' id='floatingInput' placeholder='name'>
             <label for='updateBirthDateSlot'>DOB</label>
            </div>
            <div class='form-floating mb-3 '>
            
            <textarea name='updateCommentsSlot' class='form-control' id='floatingInput' placeholder='name'>{$row['comments']}</textarea>
            <label for='updateCommentsSlot'>Comments</label>
            </div>
            </form>
            </div>";



            }
            if(isset($_POST['updateAnimal'])){
                $updatedName = $_POST['updateNameSlot'];
                $updatedStatus = $_POST['updateStatusSlot'];
                $updatedMicro = $_POST['updateMicrochipSlot'];
                $updatedDOB = $_POST['updateBirthDateSlot'];
                $updatedCommentsSlot = $_POST['updateCommentsSlot'];
                $updatePrimaryColorSlot= $_POST['updatePrimaryColorSlot'];
                $updateSecondaryColorSlot = $_POST['updateSecondaryColorSlot'];


                $updatedWeight = $_POST['updateWeightSlot'];
                $updatedBreed = $_POST['updateBreedSlot'];
                $updatedType = $_POST['updateTypeSlot'];

                $dateDefault = '0000-00-00';
                if (empty($_POST['updateBirthDateSlot'])){
                    $updatedDOB = $dateDefault;
                }

                $updateQuary = "UPDATE `RS_animals` 
    SET `name` = '$updatedName', `microchip` = '$updatedMicro', `Type` = '$updatedType', `breed` = '$updatedBreed', `weight` = '$updatedWeight', `birthDate` = '$updatedDOB', `status` = '$updatedStatus', `comments` = '$updatedCommentsSlot', `primaryColor` = '$updatePrimaryColorSlot', `secondaryColor` = '$updateSecondaryColorSlot' WHERE `RS_animals`.`id` = '$id';";

                $stmt = mysqli_prepare($db, $updateQuary) or die ('error in query');

                $result = mysqli_stmt_execute($stmt) or die ('error');

// if record was updated correctly
                if (mysqli_affected_rows($db)) {
                    // redirect back to the city page
                    header('Location: animal.php?id=' . $id . '');

                }else{
                    echo "nohing happend";
                }
            }
            echo "<br>";


            ?>
</div>

</div>





<?php
$id = $_GET['id'] ?? "";
if (isset($_POST['addPhysicalExam'])){
   header('location: addPhysicalExam.php?id=' . $id);
}
if (isset($_POST['physicalExamHistory'])){
   header('location: physicalExamHistory.php?id=' . $id);
}
if (isset($_POST['addVetTreatment'])){
   header('location: addVetTreatments.php?id=' . $id);
}
if (isset($_POST['addMedication'])){
   header('location: addMedication.php?id=' . $id);
}
if (isset($_POST['medicalHistory'])){
   header('location: medicalHistory.php?id=' . $id);
}
if (isset($_POST['addVetRequest'])){
   header('location: addVetRequest.php?id=' . $id);
}
if (isset($_POST['deleteRequest'])){
    $deleteRequestQuery = "INSERT INTO `RS_deleteRequests` 
(`animalId`) 
VALUES (?);";


    // execute query

    //start here next time
    $stmt = mysqli_prepare($db, $deleteRequestQuery) or die('Error in query ' . mysqli_error($db));
    mysqli_stmt_bind_param($stmt, "i", $id);
    $result = mysqli_stmt_execute($stmt) or die('Error executing query.' . mysqli_error($db));

    if ($newId = mysqli_insert_id($db)) {

        header("Location: animal.php?id=$id&deleteRequestModal=true");;
    } else {
        // let the user know
        echo "SOMETHING WENT WRONG";
    }
}
if (isset($_POST['return'])){
    $returnQuery = "UPDATE `RS_animals` SET `personId` = 0, status = 'returned' WHERE `RS_animals`.`id` = '$id';";

    $stmt = mysqli_prepare($db, $returnQuery) or die ('error in query');

    $result = mysqli_stmt_execute($stmt) or die ('error');

// if record was updated correctly
    if (mysqli_affected_rows($db)) {
        // redirect back to the city page
        header('Location: animal.php?id=' . $id . '');

    }else{
        echo "nohing happend";
    }
}
?>
<?php
if ($personId != 0){

    $query = "SELECT `name`, `id`, `dateArrived`, `microchip`, `image`, `type`, `breed`, `weight`, `birthDate`, `enteredBy`, `status`, RS_people.firstName AS firstName, RS_people.personId AS  personId, RS_people.lastName, RS_people.homeAddress, RS_people.state, RS_people.phoneNumber
        FROM `RS_animals`
        JOIN RS_people ON RS_people.personId = RS_animals.personId
        WHERE RS_animals.id = $id";

    $result = mysqli_query($db, $query)
    or die('Error in query: ' . mysqli_error($db));

    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $personId = $row['personId'];
        echo "    <div id='adoptorDiv' class='pt-5 pb-5 mb-3'>
                <div class='ps-5 pe-5'>
                <div class='ps-5 pe-5'>";
        echo "<h2>Owner of $name</h2>";
        echo "<div class='d-flex flex-row justify-content-between'>";

        echo "<div><h5 class='pb-2'>Owner Name: </h5><a href='person.php?id=$personId'>" . $row['firstName'] . " " . $row['lastName'] . "</a></div>";
        echo "<div><h5 class='pb-2'>Home Address: </h5> " . $row['homeAddress'] . " </div>";
        echo "<div><h5 class='pb-2'>State: </h5> " . $row['state'] . " </div>";
        echo "<div><h5 class='pb-2'>Phone Number: </h5> " . $row['phoneNumber'] . " </div>";
        echo "<div class='pt-3'><form method='post'><input class='btn btn-primary col-12 mb-2' type='submit'  name='return' id='return' name='return' value='Return'></form></div>";
        $id = $row['personId'];
        echo "</div>";
        echo "</div>";
        echo "</div>";
        echo "</div>";


    }

    //echo $personId;
}else{
    if ($row['status'] == 'Adopted' || $row['status'] == 'EuthanasiaRequest' || $row['status'] == 'Euthanized' || $row['status'] == 'DOA' || $row['status'] == 'InFoster'){
        if ($row['status'] == 'InFoster'){
            $id = $_GET['id'] ?? "";

            $fosterQuery = "SELECT * FROM `RS_foster` JOIN RS_animals ON RS_foster.animalId = RS_animals.id JOIN RS_people ON RS_foster.personId = RS_people.personId WHERE animalId = '$id'";
            $result = mysqli_query($db, $fosterQuery)
            or die('Error in query: ' . mysqli_error($db));

            while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                $personId = $row['personId'];
                $firstName = $row['firstName'];

                echo "<div class='p-5'>";
                echo "<div class='ps-5 pe-5'>";
                echo "<h2 class='mb-4'>Foster Responsible For $name: </h2>";
                echo "<div class='d-flex flex-row justify-content-between'>";
                echo "<div><h5>First Name:</h5>" . $row['firstName'] . "</div>";
                echo "<div><h5>Home Address:</h5>" . $row['homeAddress'] . "</div>";
                echo "<div><h5>Phone Number:</h5>" . $row['phoneNumber'] . "</div>";
                echo "<a class='aToButton mt-4 btn btn-primary mb-2' href='person.php?id=$personId'>View</a>";
                echo "</div>";
                echo "</div>";
                echo "<form method='post'>";
                echo "<div class='ps-5 pe-5 pt-3'>";
                echo "<input class='btn btn-primary col-12 mb-2' type='submit' name='returnFromFoster' id='returnFromFoster' name='returnFromFoster' value='Return From Foster'>";
                echo '<div>';
               echo "</form>";
                echo "</div>";

//add a return from foster button that will delete the record in data base
            }

        }
    }else{

        echo "<div class='p-5'><h2 class='ps-5 pe-5'>Put Animal In Foster</h2>";
        include "includes/searchForPersonFoster.php";
        echo '</div>';
    }
}
if (isset($_POST['returnFromFoster'])){
    $id = $_GET['id'] ?? "";
    //echo $id;
    $deleteQuery = "DELETE FROM `RS_foster` WHERE `RS_foster`.`animalId` = '$id'";
    // execute query
    $result = mysqli_query($db, $deleteQuery) or die('Error updating record.');

    // if record was updated correctly
    if(mysqli_affected_rows($db)){
        // redirect back to the city page
        include 'includes/changeAnimalStatusFoster.php';
        //header('Location: animal.php?id=' . $id);
        die();
    }else{
        // let the user know
        echo "SOMETHING WENT WRONG";
    }

}
?>
<?php
include 'includes/footer.php';
?>

