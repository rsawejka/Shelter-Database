<?php
ob_start();
$pageTitle = 'Delete Requests';
include 'includes/header.php';

$query = "SELECT animalId AS deleteId, RS_animals.id AS animalTableId, RS_animals.name AS name, RS_animals.breed AS breed
FROM RS_deleteRequests 
JOIN RS_animals ON RS_deleteRequests.animalId = RS_animals.id
";
$result = mysqli_query($db, $query)
or die('Error in query: ' . mysqli_error($db));
//find number of rows then if it equals 0 return no results.
$numRows =  mysqli_num_rows($result);
if ($numRows === 0){
    echo "empty search";

}

?>
<div class='ps-5 pe-5'>
    <div class='ps-5 pe-5'>
        <h2 class="pt-3 pb-3">Delete Requests</h2>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Animal</th>
                <th scope="col">Name</th>
                <th scope="col">Breed</th>
            </tr>
            </thead>
            <tbody>
            <?php
            while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                echo "<div>";
                $animalId = $row['deleteId'];

                ?>

                <tr>
                    <td><?= $row['animalTableId'] ?></td>
                    <td><?= $row['deleteId'] ?></td>
                    <td><?= $row['name'] ?></td>
                    <td><?= $row['breed'] ?></td>
                    <td><a class='btn btn-primary col-6 mx-auto' href='animal.php?id=<?= $animalId ?>'>View</a>

                    </td>
                 <td>
                     <form method="post">
                         <input type="submit" name="deleteAccount" class='btn btn-primary col-6' value="Delete">
                     </form>
                 </td>
                </tr>


                <?php


            }
if (isset($_POST['deleteAccount'])){
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
                    <div class="modal-body">
                        <h5>Are you sure you want to delete this accout?</h5>

                    </div>
                    <div class="modal-footer">


                            <a href='deleteRequestsAction.php?id=<?= $animalId ?>' class='btn btn-danger'>Yes</a>
                            <a href='deleteRequests.php?' class='btn btn-success'>No</a>

                        </form>

                    </div>
                </div>
            </div>
        </div>
        <?php
}
            ?>
            <?php
            if (isset($_POST['deleteModalYes'])){
                header('location: deleteRequestsAction.php?id=' . $animalId);
            }
            if (isset($_POST['deleteModalNo'])){
                header('location: deleteRequests.php');
            }
            ?>
            </tbody>
        </table>
    </div>
</div>

<?php
include 'includes/footer.php';
?>
