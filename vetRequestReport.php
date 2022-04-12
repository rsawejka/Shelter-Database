<div class="noprint">
<?php
$pageTitle = 'generate vet request reports';
include 'includes/header.php';
$inputDate = "";
?>

        <div class='ps-5 pe-5 text-center'>
    <h2 class="pt-5">Generate Vet Request Per Date</h2>
        </div>
    <form method="post" class="pt-4">
        <div class="form-floating mb-3 col-3 noprint mx-auto">
            <input type="date" name="selectedDate" class="form-control" id="floatingInput">

        </div>
        <div class="col-3 noprint mx-auto">
            <input type="submit" name="selectedDateSubmit"  class="btn btn-primary col-12">
        </div>
    </form>

    <?php
$inputDate = $_POST['selectedDate'] ?? '';
if (isset($_POST['selectedDateSubmit'])){

    //do a joins to get animal details
    $query = "SELECT `type`,`comments`,`date`,`animalId` FROM `RS_vetRequests` WHERE `date` = '$inputDate'";


    $result = mysqli_query($db, $query)
    or die('Error in query: ' . mysqli_error($db));
//find number of rows then if it equals 0 return no results.
    ?>
    <a class="btn btn-primary col-3 mx-auto noprint" style="display: block;" href="javascript:if(window.print)window.print()">Print</a>

</div>


<div class='ps-5 pe-5'>
    <div class='ps-5 pe-5'>
        <h2>Vet Treatments Submitted on <?= $inputDate ?></h2>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Request Number</th>
                <th scope="col">Animal ID</th>
                <th scope="col">Type</th>
                <th scope="col">Comments</th>
                <th scope="col">Submitted on</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $i = 0;
            while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {


                $i++
                ?>

                <tr>
                    <th scope="row"><?= $i ?></th>
                    <td><?= $row['animalId']; ?></td>
                    <td><?= $row['type']; ?></td>
                    <td><?= $row['comments']; ?></td>
                    <td><?= $row['date']; ?></td>
                </tr>


                <?php


            }
            }


            ?>
            </tbody>
        </table>
    </div>
</div>


<?php
include 'includes/footer.php';
?>
