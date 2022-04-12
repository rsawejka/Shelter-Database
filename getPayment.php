<?php
ob_start();
$pageTitle = 'get payment';
include 'includes/header.php';
$animalId = $_GET['animalId'];
$firstName = $_GET['firstName'];
$lastName = $_GET['lastName'];
$cardNumber  = "";
$cvc  = "";
$xpDate  = "";
$exDateBool = false;
$cvcBool = false;
$cardBool = false;
$lastNameBool = false;
$firstNameBool = false;

//echo $animalId . $firstName . $lastName;
?>

<div class='ps-5 pe-5'>
    <div class='ps-5 pe-5'>
        <h2 class="pt-3 pb-3">Add Payment Method</h2>
<form method="post">
<div class='form-floating mb-3 '>
    <input type="text" name="firstName" class='form-control' id='floatingInput' placeholder='name' value="<?= $firstName ?>">
    <label for="firstName">First Name</label>
    <?php
    if (isset($_POST['reviewOrder'])){
        if (empty($_POST['firstName'])){
            echo "<div class='error'>you need to enter a first name</div>";
            $firstNameBool = false;
        }else{
            $firstNameBool = true;
        }}
    ?>
</div>
    <div class='form-floating mb-3 '>
    <input type="text" name="lastName" class='form-control' id='floatingInput' placeholder='lastname' value="<?= $lastName ?>">
    <label for="lastName">Last Name</label>
    <?php
    if (isset($_POST['reviewOrder'])){
        if (empty($_POST['lastName'])){
            echo "<div class='error'>you need to enter a last name</div>";
            $lastNameBool = false;
        }else{
            $lastNameBool = true;
        }}
    ?>
    </div>
<div class='form-floating mb-3 '>
    <input type="text" name="card" class='form-control' id='floatingInput' placeholder='card' value="">
    <label for="card">Card Number</label>
    <?php
    if (isset($_POST['reviewOrder'])){
    if (empty($_POST['card'])){
        echo "<div class='error'>you need to enter a card number</div>";
        $cardBool = false;

    }else{
        $cardBool = true;
    }}
    ?>
</div>
    <div class='form-floating mb-3 '>
    <input type="text" name="cvc" class='form-control' id='floatingInput' placeholder='cvc' value="">
    <label for="cvc">CVC:</label>
    <?php
    if (isset($_POST['reviewOrder'])){
        if (empty($_POST['cvc'])){
            echo "<div class='error'>you need to enter a cvc number</div>";
        }else{
            $cvcBool = true;
        }}
    ?>
    </div>
    <div class='form-floating mb-3 '>
    <input type="month" name="xpDate" class='form-control' id='floatingInput' placeholder='xpdate' value="">
    <label for="xpDate">Exporation Date:</label>
    <?php
    if (isset($_POST['reviewOrder'])){
        if (empty($_POST['xpDate'])){
            echo "<div class='error'>you need to enter a xp date</div>";
            $exDateBool = false;
        }else{
            $exDateBool = true;
        }}
    ?>
    </div>
    <div >
    <input type="submit" name="reviewOrder" id="reviewOrder" value="reviewOrder"  class='btn btn-primary col-12 mb-2'>
    </div>

</form>

<?php
if (isset($_POST['reviewOrder'])){
    $firstName  = $_POST['firstName'];
    $lastName  = $_POST['lastName'];
    $cardNumber  = $_POST['card'];
    $cvc  = $_POST['cvc'];
    $xpDate  = $_POST['xpDate'];

   // echo $firstName . $lastName . $cardNumber . $cvc . $xpDate;
    //echo date('Y-m');
    //           convert date
    //$newDate = date("m-Y", strtotime($xpDate));
    //echo $newDate;
    //    regE    EX:
   // $passBool = preg_match($passRegX, $password);
    $cvcRegX = "^[0-9]{3,4}$^";
    $cardNumberRegX = "^(?:4[0-9]{12}(?:[0-9]{3})?|[25][1-7][0-9]{14}|6(?:011|5[0-9][0-9])[0-9]{12}|3[47][0-9]{13}|3(?:0[0-5]|[68][0-9])[0-9]{11}|(?:2131|1800|35\d{3})\d{11})$^";

    $cardNumberRegXBool = preg_match($cardNumberRegX, $cardNumber);
    $cvcRegXBool = preg_match($cvcRegX, $cvc);
    if ($exDateBool && $cvcBool && $cardBool && $lastNameBool && $firstNameBool == true){
    if ($cardNumberRegXBool && $cvcRegXBool == true){
        header('Location: reviewOrder.php?animalId=' . $animalId . '&firstName=' . $firstName . '&lastName=' . $lastName . '&hashedCard=' . $cardNumber);
    }
    if ($cardNumberRegXBool == false){
        echo "<div class='error'>card number is not valid</div>";
    }
        if ($cvcRegXBool == false){
        echo "<div class='error'>cvc number is not valid</div>";
    }}



}

echo '</div>';
echo '</div>';
include 'includes/footer.php';
?>
