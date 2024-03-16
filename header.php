<header>
    <nav class="navbar navbar-expand-lg navbar-light container-fluid">
        <!-- Überschrift-->
        <a class="navbar-brand" href='home.php' style="font-family: Copperplate, Papyrus, fantasy; font-size: 30px;">Löhtner Hotelgewerbe</a>
        <!-- Burger Menu button-->
        <button class="navbar-toggler second-button" type="button" data-bs-toggle="collapse"
        data-bs-target="#navbarToggleExternalContent9"
        aria-controls="navbarToggleExternalContent9" aria-expanded="false"
        aria-label="Toggle navigation">
            <div class="animated-icon2">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </div>
        </button> 
        <!-- Links für Navbar und Burger.-->
        <div class="collapse navbar-collapse" id="navbarToggleExternalContent9">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0" id="navbarlinks">
                <?php
                if($_SESSION['rolle'] == "admin")
                {
                    echo "<li class=\"nav-brand\">
                            <a class=\"nav-link borderz\" href=\"reservieren.php\" style=\"border-right: solid;  border-color: rgb(104, 104, 104); border-width: 1px;\">Reservieren</a>
                          </li>
                          <li class=\"nav-brand\">
                            <a class=\"nav-link borderz\" href=\"meinereservierung.php\" style=\"border-right: solid;  border-color: rgb(104, 104, 104); border-width: 1px;\">Meine Reservierungen</a>
                          </li>
                          <li class=\"nav-brand\">
                            <a class=\"nav-link borderz\" href=\"upload.php\" style=\"border-right: solid;  border-color: rgb(104, 104, 104); border-width: 1px;\">News upload</a>
                          </li>
                          <li class=\"nav-brand\">
                            <a class=\"nav-link borderz\" href=\"manage_user.php\" style=\"border-right: solid;  border-color: rgb(104, 104, 104); border-width: 1px;\">Users</a>
                          </li>
                          <li class=\"nav-brand\">
                            <a class=\"nav-link borderz\" href=\"reservierungsdetails.php\">Reservierungen</a>
                          </li>
                          </ul>
                          <ul class=\"navbar-nav\" style = \"float: right;\" id=\"profiprofil\">
                          <li class=\"nav-brand d-flex\">
                          <a class=\"nav-link\" style=\"padding-right: 4px\" href=\"profil.php\"><img src=\"images/profileicon.png\" alt=\"Profilbild\" id=\"profilfoto\"></a>
                          <a class=\"nav-link\" style=\"padding-left: 4px\"  href=\"profil.php\">Profil</a>
                          <a class=\"nav-link\" href=\"logout.php\">(logout)</a>
                          </li>
                          </ul>";
                }else if($_SESSION['rolle']  == "registriert" && $_SESSION['rolle'] != "admin")
                {
                    echo "<li class=\"nav-brand\">
                            <a class=\"nav-link\" href=\"reservieren.php\" style=\"border-right: solid;  border-color: rgb(104, 104, 104); border-width: 1px;\">Reservieren</a>
                          </li>
                          <li class=\"nav-brand\">
                            <a class=\"nav-link\" href=\"meinereservierung.php\">Meine Reservierungen</a>
                          </li>
                          </ul>
                          <ul class=\"navbar-nav\" style = \"float: right;\" id=\"profiprofil\">
                          <li class=\"nav-brand d-flex\">
                          <a class=\"nav-link\" style=\"padding-right: 4px\" href=\"profil.php\"><img src=\"images/profileicon.png\" alt=\"Profilbild\" id=\"profilfoto\"></a>
                          <a class=\"nav-link\" style=\"padding-left: 4px\"  href=\"profil.php\">Profil</a>
                          <a class=\"nav-link\" href=\"logout.php\">(logout)</a>
                          </li>
                          </ul>";

                }else
                {
                    echo "<li class=\"nav-brand\">
                            <a class=\"nav-link\" href=\"login.php\" style=\"border-right: solid;  border-color: rgb(104, 104, 104); border-width: 1px;\">Login</a>
                          </li>
                          <li class=\"nav-brand\">
                            <a class=\"nav-link\" href=\"registrieren.php\">Registrieren</a>
                          </li>";
                }
                ?>
            </ul>
        </div>
    </nav>
</header>
