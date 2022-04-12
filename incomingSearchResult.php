<?php
$pageTitle = 'incomming Search result';
include 'includes/header.php';
$date = $_GET['date'] ?? "";

$query = "SELECT `name`, `id`, `dateArrived` FROM `RS_animals` WHERE dateArrived = '$date'";
$result = mysqli_query($db, $query)
or die('Error in query: ' . mysqli_error($db));
//find number of rows then if it equals 0 return no results.
$numRows =  mysqli_num_rows($result);
if ($numRows === 0){
    echo "empty search";
}
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
    echo "<div>";
    echo $row['name'];
    $id = $row['id'];
    echo "<a href='animal.php?id=$id'>$id</a>";
    echo $row['dateArrived'];

}

?>

<?php
include 'includes/footer.php';
?>