<?php
$pageTitle = 'Forgot Password';
include 'includes/header.php';


?>
    <div class='ps-5 pe-5'>
        <div class='ps-5 pe-5'>
    <form method="post">
        <h2 class="pt-3 pb-3">Enter Email</h2>
        <div class="form-floating mb-3 col">

            <input type="text" class="form-control" id="floatingInput" placeholder="img" name="email" placeholder="Your Email *" value="">
            <label for="email">Email:</label>
        </div>
        <input type="submit" class="btn btn-primary col-12 mx-auto " name="continue" value="Continue">
    </form>


<?php
if(isset($_POST['continue'])){

    $email = $_POST['email'];

    $query = "SELECT userId, email, password, role, timesLogged FROM authDemoUsers WHERE email = '$email'";

    $result = mysqli_query($db, $query)
    or die('Error in query: ' . mysqli_error($db));
    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){


        $to = $row['email'];
        echo "<h5 class='pt-3'>Password Link Sent To $to</h5></div></div>";
        $hashedPass = $row['password'];
        $subject = "forgot password";
        $message = '<html>
                    <body>
                    <head>
                    <title>title</title>
                    </head>
                    <div>                    
                    <a href="https://rsawejka.bitlampsites.com/portfolio/Final/resetPass.php?forgotpassword=' . $hashedPass . '">click here to change your password</a>
                    </div>
                    </body>
                    </html>';
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers .= 'From: Ryans Shelter Buddy <rsawejka@bitlamp.wctc.edu>' . "\r\n";

        mail($to, $subject, $message, $headers);
    }

}
?>
        </div>
        </div>
<?php
include 'includes/footer.php';
?>