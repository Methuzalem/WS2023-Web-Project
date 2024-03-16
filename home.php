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
        <title>Home</title>
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

        <main>

        <div class="container-fluid">
            <div class="form-group row">
                <div class="col-lg-5">
                <br>
                <h2>Willkommen im Luxus!</h2>
                <h3>Erkunden Sie unsere Lobby und exklusiven Hotelzimmer.</h3>
                <br>
                <p style="text-align: center">Zu Beginn dürfen wir Ihnen unsere einladende Lobby, das pulsierende Herzstück unseres Hotels vorstellen. Hier erleben Sie die warme Atmosphäre und die aufmerksame Gastfreundschaft, die Ihren Aufenthalt unvergesslich machen wird. Genießen Sie die stilvolle Einrichtung und lassen Sie sich von unserem freundlichen Personal willkommen heißen.</p>
                </div>
                <div class="col-lg-7"><image class="homefotosLeft img-fluid" src="images/lobby2.jpg"></div>
            </div>

            <div class="form-group row">
                <div class="col-lg-7"><image class="homefotosRight img-fluid" src="images/hotelzimmer3.jpg"></div>

                <div class="col-lg-5">
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <p style="text-align: center">Tauchen Sie ein in den Komfort und die Eleganz unserer erstklassigen Hotelzimmer. Jedes Detail wurde sorgfältig durchdacht, um Ihnen einen erholsamen und luxuriösen Rückzugsort zu bieten. Von der geschmackvollen Einrichtung bis hin zu den modernen Annehmlichkeiten – hier erleben Sie Entspannung in einem Ambiente, das höchsten Ansprüchen gerecht wird.</p>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-lg-5">
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <p>Erleben Sie einen Hauch von Luxus in unserem zweiten Hotelzimmer, das eine harmonische Mischung aus Stil und Funktionalität bietet. Mit einem atemberaubenden Ausblick und einer gemütlichen Atmosphäre lädt dieses Zimmer dazu ein, sich zu entspannen und den Alltagsstress hinter sich zu lassen. Genießen Sie Ihren Aufenthalt in einem Raum, der Komfort und Eleganz perfekt vereint.</p>
                </div>
                <div class="col-lg-7"><image class="homefotosLeft img-fluid" src="images/hotelzimmer2.jpg"></div>
            </div>

<!-- Hier könnte der code hinzugefügt werden, der beim hochladen das neue Bild echot -->
            <div class="row">
                <div class="col-md-8"><image class="" src=""></div>

                <div class="col-md-4">
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <p></p>
                </div>
            </div>
            <div class="container-fluid">
                Aktuelle Newsbeiträge:
            </div>
            <br>
            <div>
            <?php
                include 'dbaccess.php';

                echo "<ul class=\"list-group list-group-flush\">";

                    $query = "SELECT `text` from news";
                    $result = mysqli_query($conn, $query);

                define('IMAGEPATH', 'uploads\\');

                while ($row = mysqli_fetch_assoc($result)) {
                    $directoryfile = $row['text'];

                if (strpos($directoryfile, "uploads\\") === 0) {
                    $filename = basename($directoryfile);
                    $imagePath = IMAGEPATH . $filename;

                    echo "<li class=\"list-group-item mb-3\"><img class=\"newImage mb-3\" src=\"$imagePath\" style=\"max-width: 800px;\"  alt=\"$filename\"></li>";

                }else {
                    
                    echo "<li class=\"mb-3 list-group-item\">".$row['text']."</li>";
                }
                }

echo "</ul>";
?>
            </div>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
        </main>

        <?php include 'footer.php';?>
    </body>
</html>