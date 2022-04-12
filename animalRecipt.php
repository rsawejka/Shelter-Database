<?php
$pageTitle = 'Animal Recipt';
include 'includes/header.php';
?>
<div class="noprint text-center">
   <form method="post" class="ms-2 me-2">
       <input type="submit" name="backToAnimal" id="backToAnimal"  class="btn btn-primary col-12 mb-2" value="Go to Animal">
       <a class="btn btn-primary col-12 mb-2 aToButton" href="addAnimal.php">Add Another Animal</a>
       <a class="btn btn-primary col-12 mb-2 aToButton" href="index.php">Back Home</a>
       <a class="btn btn-primary col-12 mb-2 aToButton" href="javascript:if(window.print)window.print()">Print</a>
   </form>

</div>


<?php

$id = $_GET['id'] ?? "";
if (isset($_POST['backToAnimal'])){
    header('location: animal.php?id=' . $id);
}
$query = "SELECT `name`, `id`, `dateArrived`, `microchip`, `image`, `type`, `breed`, `weight`, `birthDate`, `enteredBy`, `status`, personId
        FROM `RS_animals`
        WHERE RS_animals.id = $id";

$result = mysqli_query($db, $query)
or die('Error in query1: ' . mysqli_error($db));

if (!$row = mysqli_fetch_array($result)) {
    echo "empty search";
}else{
    //everything needed to be displayed
   ?>
   <div class='ps-4 pe-4'>
<h2 class="text-center">Animal Admission Receipt</h2>
        <h3 class="mt-4">Animal Details</h3>
        <div class="d-flex flex-row justify-content-between border-bottom">
            <div>
                <h5>Animal ID: </h5>
                <div><?php echo $row['id'] ?></div>
            </div>
            <div>
                <h5>Type: </h5>
                <div><?php echo $row['type'] ?></div>
            </div>
            <div>
                <h5>Type: </h5>
                <div><?php echo $row['breed'] ?></div>
            </div>
            <div>
                <h5>Date Arrived: </h5>
                <div><?php echo $row['dateArrived'] ?></div>
            </div>
        </div>
       <?php
}


?>
       <div class="col-11  mx-auto">
<h3 class="mt-4">Animal Intake Form</h3>
       <div class="d-flex flex-row  pt-3 ">
          <div>Staff Initals: ________________</div>
          <div class="ms-5">Animal ID: ________________</div>
       </div>
       <div class="d-flex flex-row  pt-3">
          <div>Weight: ________________</div>
           <div class="ms-5">Sex: <span class="spanPadding">F</span> <span class="spanPadding">FS</span> <span class="spanPadding">M</span> <span class="spanPadding">MN</span></div>
       </div>
       <div class="d-flex flex-row  pt-3  ">
           <div class="d-flex flex-row "> <div>Spay Chack: </div><div class="ms-3">Yes <span class="ms-2">No</span></div></div>
           <div class="ms-5">Microchip: _______________________________________</div>
       </div>
       <div class="d-flex flex-row  pt-3  ">
           <div class="d-flex flex-row "> <div>is animal sick: </div><div class="ms-3">Yes <span class="ms-2">No</span></div></div>
           <div class="d-flex flex-row ms-5"> <div>FIV/Feluk Test: </div><div class="ms-3">Neg <span class="ms-2">Positive</span></div></div>

       </div>
       <div class="d-flex flex-row  pt-3  ">
           <div class="d-flex flex-row "> <div>Heartworm Test: </div><div class="ms-3">Neg <span class="ms-2">Positive</span></div></div>
           <div class="d-flex flex-row ms-5"> <div>ANP9 sent to lab: </div><div class="ms-3">Yes <span class="ms-2">No</span></div></div>

       </div>
       <div class="">

           <div>Ears: <span class="examMargins">Good</span> <span class="examMargins">Earmites</span> <span class="examMargins">Waxy</span> </div>
           <div> _________________________________________________________________</div>
       </div>
       <div class="">

           <div class="pt-3">Eyes: <span class="examMargins">Normal</span> <span class="examMargins">Abnormal</span> </div>
           <div> _________________________________________________________________</div>
       </div>
       <div class="">

           <div class="pt-3">Coat/Skin: <span class="examMargins">Normal</span> <span class="examMargins">Abnormal</span> <span class="examMargins">Color: __________________</span> </div>
           <div> _________________________________________________________________</div>
       </div>
       <div class="">

           <div class="pt-3">Woods Lamp: <span class="examMargins">Neg</span> <span class="examMargins">Positive</span></div>


       </div>
       <div class="">

           <div class="pt-3">Teeth/Mouth: <span class="examMargins">Normal</span> <span class="examMargins">Abnormal</span> </div>
           <div> _________________________________________________________________</div>
       </div>
       <div class="">

           <div class="pt-3">Send Vet Request: <span class="examMargins">Yes</span> <span class="examMargins">No</span> </div>
           <div> _________________________________________________________________</div>
       </div>
       <div class="">

           <div class="pt-3">Behavior Of Animal: </div>
           <div> _________________________________________________________________</div>
       </div>
<div class="mx-auto">
       <div class="d-flex flex-row  pt-1 ">
<div class="d-flex flex-row  pt-1">
    <div class="pt-1">Nails Trimmed: </div>
    <div class=" ms-2">  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-square" viewBox="0 0 16 16">
            <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
        </svg></div>
</div>

           <div class="d-flex flex-row  pt-1 ms-5">
               <div class="pt-1">Droncit: </div>
               <div class=" ms-2">  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-square" viewBox="0 0 16 16">
                       <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                   </svg></div>
           </div>

       </div>
       <div class="d-flex flex-row  pt-1  ">
<div class="d-flex flex-row  pt-1">
    <div class="pt-1">FVRCP: </div>
    <div class=" ms-2">  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-square" viewBox="0 0 16 16">
            <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
        </svg></div>
</div>

           <div class="d-flex flex-row  pt-1 ms-5">
               <div class="pt-1">Capstar: </div>
               <div class=" ms-2">  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-square" viewBox="0 0 16 16">
                       <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                   </svg></div>
           </div>

       </div>
       <div class="d-flex flex-row  pt-1  ">
<div class="d-flex flex-row  pt-1">
    <div class="pt-1">Pyrantel: </div>
    <div class=" ms-2">  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-square" viewBox="0 0 16 16">
            <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
        </svg></div>
</div>

           <div class="d-flex flex-row  pt-1 ms-5">
               <div class="pt-1">Bordetella: </div>
               <div class=" ms-2">  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-square" viewBox="0 0 16 16">
                       <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                   </svg></div>
           </div>

       </div>
       <div class="d-flex flex-row  pt-1 ">
<div class="d-flex flex-row  pt-1">
    <div class="pt-1">Frontline/Revolution: </div>
    <div class=" ms-2">  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-square" viewBox="0 0 16 16">
            <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
        </svg></div>
</div>

           <div class="d-flex flex-row  pt-1 ms-5">
               <div class="pt-1">DAPPV: </div>
               <div class=" ms-2">  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-square" viewBox="0 0 16 16">
                       <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                   </svg></div>
           </div>

       </div>
</div>
</div>
   </div>
