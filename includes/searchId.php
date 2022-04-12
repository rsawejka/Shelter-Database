<?php
if (isset($_POST['searchById'])){
    $inputID = $_POST['idSearch'];
    //echo "clicked";
    header('location: animal.php?id=' . $inputID);
}
?>
<form method="post" class="col-10">
    <div class="form-floating mb-3 ">

    <input  type="text" name="idSearch" class="form-control" id="floatingInput" placeholder="ID here">
        <label for="idSearch" >Search by ID</label>
    </div>
    <input type="submit" name="searchById" value="Search" class="btn btn-primary col-12">

</form>
