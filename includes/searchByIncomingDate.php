<?php
//create way to adopt out animals and then set an out going date
if (isset($_POST['searchByIncomingDate'])){

    //echo "clicked";
    header('location: incomingSearchResult.php?date=' . $inputID);
}
?>
<form method="post">
    <label for="incomingDateSearch">searchByIncomingDate</label>
    <input type="date" name="incomingDateSearch" id="incomingDateSearch" value="<?php echo date('Y-m-d'); ?>">
    <input type="submit" name="searchByIncomingDate" value="Search">
</form>
