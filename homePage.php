<?php
ob_start();
//search for animal by incoming date, outgoing date, microchip, name, id,
$pageTitle= "home page";
echo "</div>";
echo '<div>';
include 'includes/header.php';
echo "</div>";
//include 'includes/trackTimesLogged.php';
if (empty($_SESSION['users']['email'])){
    header('Location: index.php');
    die();
}else{

    if(empty($_GET['id'])){
        echo "";
    }else{
        $personId = $_SESSION['users']['id'];
        $id = $_GET['id'];
        $query = "UPDATE `authDemoUsers` SET `timesLogged` = '$id' WHERE `authDemoUsers`.`userId` = '$personId';";
// execute query
        $stmt = mysqli_prepare($db, $query) or die ('error in query');

        $result = mysqli_stmt_execute($stmt) or die ('error');

// if record was updated correctly
        if (mysqli_affected_rows($db)) {
            // redirect back to the city page
            //header('Location: adminEditPage.php');
            // die();
        }

    }

//add an option to search for people and then see what animals they have adopted out to them also show all of their receipts

//if (isset($_POST['generateDailyVetTreatments'])){
    //   header('location: vetTreatmentReport.php');
//}
//if (isset($_POST['generateDailyVetRequests'])){
    //   header('location: vetRequestReport.php');
//}
//echo "<div>";
//include 'includes/searchByIncomingDate.php';
//echo "</div>";
    ?>

    <?php
}
echo "<div id='revHome'>
<div>
<div class='container'>

        <div class='row'>
            <div class='col'>
                <h2 class='pt-4 pb-4'>General Search</h2>
                ";
include 'includes/searchByMulti.php';
echo "
 
            </div>
            <div class='col'>
                <h2 class='pt-4 pb-4'>Search By Id</h2>
                ";
include 'includes/searchId.php';
echo "
                <h2>Search By Microchip</h2>";
include 'includes/searchByMicro.php';
echo "
       
        </div> 
        <div class='col'>
            <h2 class='pt-4 pb-4'>Search By Person</h2>";

include 'includes/searchForPersonHome.php';
echo "
     </div>
      </div>
   
</div>
</div>
";

include 'includes/footer.php';

?>
