<?php
if (isset($_POST['searchByMicro'])){
    $inputID = $_POST['microSearch'];
    //echo "clicked";
    header('location: animal.php?microchip=' . $inputID);
}
?>
<form method="post" class="col-10">
    <div class="form-floating mb-3 ">


    <input type="text" name="microSearch" class="form-control" id="floatingInput" placeholder="microchip here">
        <label for="microSearch">Search by microchip</label>
    </div>
    <input type="submit" name="searchByMicro" value="Search" class="btn btn-primary col-12">
</form>
