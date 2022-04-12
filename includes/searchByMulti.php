<?php
//combine name with type, incomeing, outgoing(when incorporated),

$t = 0;
if (isset($_POST['search'])){
    $inputIncomingDate = $_POST['incomingDate'];
    if (!empty($inputIncomingDate)){
        $t++;
    }
    $inputName = $_POST['name'];
    if (!empty($inputName)){
        $t++;
    }
    $type = $_POST['type'];
    if (!empty($type)){
        $t++;
    }
    $status = $_POST['status'];
    if (!empty($status)){
        $t++;
    }
    //echo "clicked";

    header('location: multiInputSearchResult.php?name=' . $inputName . "&incomingDate=" . $inputIncomingDate . "&numCond=" . $t . "&typeOfAnimal=" . $type . "&status=" . $status);
}
?>
<form method="post" class="col-10">

<div class="form-floating mb-3 ">
    <input type="text" name="name" class="form-control" id="floatingInput" placeholder="name here">
        <label for="name">Search By Name</label>
</div>
    <div class="form-floating mb-3">
    <input type="date" name="incomingDate" class="form-control" id="floatingInput" value="<?php //echo date('Y-m-d'); ?>">
    <label for="incomingDate">Search By Incoming Date</label>
    </div>

    <div class="form-floating mb-3 "><?php include 'includes/typeSelectMenu.php'; ?></div>
    <div class="form-floating mb-3 "> <?php include 'includes/searchStausMenu.php'; ?></div>


    <input type="submit" name="search" value="Search" class="btn btn-primary col-12">
</form>