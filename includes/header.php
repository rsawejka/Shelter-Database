<?php

include 'database.php';
session_name('RyanShelterBuddy');
session_start();
if(!isset($_SESSION['csrf_token'])){
    $_SESSION['csrf_token'] = uniqid();
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $pageTitle ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="styles/print.css" type="text/css" media="print">
    <link rel="stylesheet" href="styles/css.css" type="text/css" media="screen">
    <script src="https://kit.fontawesome.com/ff20b154db.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body id="<?= $bodyId ?>">


<?php
if ($pageTitle === 'index' || $pageTitle === 'input form page test' || $pageTitle === 'receipt' || $pageTitle === 'Animal Recipt'){
    echo "";
}else{
    include 'includes/nav.php';
}

?>
<div id="realMain">
<div id="main">