<?php
echo "<div class='d-flex justify-content-between p-3 align-items-center bg-198754'>";


echo "<div class='svgLogoHeader'><a href='homePage.php'><svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 576 512'><!--! Font Awesome Pro 6.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d='M332.7 19.85C334.6 8.395 344.5 0 356.1 0C363.6 0 370.6 3.52 375.1 9.502L392 32H444.1C456.8 32 469.1 37.06 478.1 46.06L496 64H552C565.3 64 576 74.75 576 88V112C576 156.2 540.2 192 496 192H426.7L421.6 222.5L309.6 158.5L332.7 19.85zM448 64C439.2 64 432 71.16 432 80C432 88.84 439.2 96 448 96C456.8 96 464 88.84 464 80C464 71.16 456.8 64 448 64zM416 256.1V480C416 497.7 401.7 512 384 512H352C334.3 512 320 497.7 320 480V364.8C295.1 377.1 268.8 384 240 384C211.2 384 184 377.1 160 364.8V480C160 497.7 145.7 512 128 512H96C78.33 512 64 497.7 64 480V249.8C35.23 238.9 12.64 214.5 4.836 183.3L.9558 167.8C-3.331 150.6 7.094 133.2 24.24 128.1C41.38 124.7 58.76 135.1 63.05 152.2L66.93 167.8C70.49 182 83.29 191.1 97.97 191.1H303.8L416 256.1z'/></svg>
    </a>
</div>";

if (isset($_SESSION['users']) && $_SESSION['users']) {
    echo '<div id="logInfo" class="noprint textF8F4E3">User: ' . $_SESSION['users']['email'] .
        '</div>';
    $userRole = $_SESSION['users']['role'];

    echo "<div class='noprint text-white'>(<a href='index.php?logout' class='actionHoverMain textF8F4E3'> Logout </a>)</div>";
    echo "</div>";
    ?>

    <?php
    if($userRole === "admin"){

        echo "<div class='noprint accordion accordion-flush adminBar textF8F4E3 border-black' id=''>
    <div class='accordion-item adminBar textF8F4E3'>
        <h2 class='accordion-header textF8F4E3' id='flush-headingOne'>
            <button class=' actionHoverMain accordion-button collapsed adminBar border-none textF8F4E3' type='button' data-bs-toggle='collapse' data-bs-target='#flush-collapseOne' aria-expanded='false' aria-controls='flush-collapseOne'>
                Admin Panel
            </button>
        </h2>
        <div id='flush-collapseOne'class='accordion-collapse collapse adminBar'  aria-labelledby='flush-headingOne'data-bs-parent='#accordionFlushExample'>
            <div class='accordion-body' <div><a href='adminPage.php' class='textF8F4E3 text-decoration-none'><div class='p-2 textF8F4E3 actionHoverMain'>Create An Account</div></a></div></div>
        </div>
        <div id='flush-collapseOne' class='accordion-collapse collapse' aria-labelledby='flush-headingOne'data-bs-parent='#accordionFlushExample'>
            <div class='accordion-body'> <div><a href='deleteRequests.php' class='text-black text-decoration-none'><div class='p-2 textF8F4E3 actionHoverMain'>Account Delete Requests</div></a></div></div>
        </div>
    </div>";
    }
}
echo "<nav class='noprint navbar navbar-expand-lg navbar-light navColor'>
        <div class='container-fluid'>
            <div class='collapse navbar-collapse' id='navbarNav'>
                <ul class='navbar-nav'>
                    <li class='nav-item actionHoverMain'>
                        <a class='nav-link active' aria-current='page' href='homePage.php'>Home</a>
                    </li>
                    <li class='nav-item actionHoverMain'>
                        <a class='nav-link' href='addAnimal.php'>Add Animal</a>
                    </li>
                    <li class='nav-item actionHoverMain'>
                        <a class='nav-link' href='vetTreatmentReport.php'>Generate Daily Vet Treatments</a>
                    </li>
                    <li class='nav-item actionHoverMain'>
                        <a class='nav-link' href='vetRequestReport.php'>Generate Daily Vet Requests</a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>";
echo "</div>";