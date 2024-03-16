<!DOCTYPE html>
<?php
session_start();
if(empty($_SESSION['rolle']))
{
    $_SESSION['rolle'] = "anonym";
}
?>
<html>
    <head>
        <title>Zimmer</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="style.css" type="text/css">
        <script src="./myScript.js" defer></script>
    </head>

    <body>
        <?php include 'header.php';?> 
        
        <main class = "container-lg">
            <br>
            <div class="row reselements" >                                               
                <a class="col-5" style="padding: 0px" href="buchungen.php?id=Einzelzimmer"><img src="images/hotelzimmer3.jpg" alt="Einzelzimmer" class="stockphoto image1"></a>
                <div class="col-1"></div>
                <a class="col-5" style="padding: 0px" href="buchungen.php?id=Doppelzimmer"><img src="images/hotelzimmer2.jpg" alt="Doppelzimmer" class="stockphoto image2"></a>
            </div>
            <div class="row reselements">
                <a class="col-5" style="text-decoration: none" href="buchungen.php?id=Einzelzimmer"><div style="text-align:center">Einzelzimmer</div></a>
                <div class="col-1"></div>
                <a class="col-5" style="text-decoration: none" href="buchungen.php?id=Doppelzimmer"><div style="text-align:center">Doppelzimmer</div></a>
                <br>
            </div>
                <br>
            <div class="row reselements">
                <a class="col-5" style="padding: 0px" href="buchungen.php?id=Familienzimmer"><img src="images/Familienzimmer.jpg" alt="Familienzimmer" class="stockphoto image3"></a>
                <div class="col-1"></div>
                <a class="col-5" style="padding: 0px" href="buchungen.php?id=Apartment"><img src="images/apartment.jpg" alt="Apartment" class="stockphoto image4"></a>
            </div>

            <div class="row reselements">
                <a class="col-5" style="text-decoration: none" href="buchungen.php?id=Familienzimmer"><div style="text-align:center">Familienzimmer</div></a>
                <div class="col-1"></div>
                <a class="col-5" style="text-decoration: none" href="buchungen.php?id=Apartment"><div style="text-align:center">Apartment</div></a>
            </div>
            <br>
            <br>
        </main>

        <?php include 'footer.php';?>
    </body>
</html>