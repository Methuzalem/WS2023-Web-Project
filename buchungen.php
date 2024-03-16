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
        <?php   
        include 'header.php';
        include 'dbaccess.php';

        //variables
        $zimmertyp = $_GET['id'];
        $terminerror = $imagePath = $terminbestätigung = "";
        $parkplatz = $haustier = $breakfast = $accessCount = $balkon = 0;
        $buchungsdatum = date("Y-m-d");
        $einzelzimmer = "Einzelzimmer";
        $doppelzimmer = "Doppelzimmer";
        $familienzimmer = "Familienzimmer";
        $apartmert = "Apartment";

        //choose img pic
        if($zimmertyp == $einzelzimmer){
            $imagePath = "images/hotelzimmer3.jpg";
        }else if($zimmertyp == $doppelzimmer){
            $imagePath = "images/hotelzimmer2.jpg";
        }else if($zimmertyp == $familienzimmer){
            $imagePath = "images/familienzimmer.jpg";
        }else if($zimmertyp == $apartmert){
            $imagePath = "images/apartment.jpg";
        }

        //check reservation data via db connection 
        if ($_SERVER["REQUEST_METHOD"] == "POST") 
        {
            $anreise = date('Y-m-d', strtotime($_POST['anreise']));
            $abreise = date('Y-m-d', strtotime($_POST['abreise']));

            $sql = "SELECT Zimmerbezeichnung, Anreise, Abreise from reservierungen";
            $result = $conn->query($sql);
            $accessCount = '1';

            //check typ of room and date of new reservations
            while($row = $result->fetch_row()){

                if($row[0] == $zimmertyp){
                    if($anreise >= $row[1] && $abreise <= $row[2]){
                        $terminerror = "Leider ist dieses Zimmer für den von Ihnen ausgewählten Zeitraum schon gebucht. Bitte wählen Sie ein anderes Datum.";
                        $accessCount = 0;
                        break;
                    }else if($anreise <= $row[1] && $abreise >= $row[1]){
                        $terminerror = "Leider ist dieses Zimmer für den von Ihnen ausgewählten Zeitraum schon gebucht. Bitte wählen Sie ein anderes Datum.";
                        $accessCount = 0;
                        break;
                    }else if($anreise <= $row[2] && $abreise >= $row[2]){
                        $terminerror = "Leider ist dieses Zimmer für den von Ihnen ausgewählten Zeitraum schon gebucht. Bitte wählen Sie ein anderes Datum.";
                        $accessCount = 0;
                        break;
                    }else if($anreise == $row[2]){
                        $terminerror = "Leider ist dieses Zimmer für den von Ihnen ausgewählten Zeitraum schon gebucht. Bitte wählen Sie ein anderes Datum.";
                        $accessCount = 0;
                        break;
                    }else if($anreise <= $row[1] && $abreise >= $row[2]){
                        $terminerror = "Leider ist dieses Zimmer für den von Ihnen ausgewählten Zeitraum schon gebucht. Bitte wählen Sie ein anderes Datum.";
                        $accessCount = 0;
                        break;
                    }else if($abreise == $row[1]){
                        $terminerror = "Leider ist dieses Zimmer für den von Ihnen ausgewählten Zeitraum schon gebucht. Bitte wählen Sie ein anderes Datum.";
                        $accessCount = 0;
                        break;
                    }
                }
            }
            //date error message
            if($anreise >= $abreise){
                $terminerror = "Das Anreisedatum muss vor dem Abreisedatum liegen!";
                $accessCount = 0;
            }
            //booking conformation
            if($accessCount == 1){
                $terminbestätigung = "Gerne haben wir das Zimmer inkl. Services für den von Ihnen angegebenen Zeitraum reserviert.";
            }
        }
        ?> 
        
    <main class="container-fluid">
        <br>
        <h4 style="text-align: center">Sie haben sich für unser <?php echo $zimmertyp;?> entschieden!</h4>
        <br>
        <div id="bookingpic"><img src= "<?php echo $imagePath; ?>" alt="roompicture" class="buchungsfoto col-md-6"/></div>

        <form name="resdata" class="container" action="<?php echo htmlspecialchars($_SERVER["REQUEST_URI"]);?>" method="post">
            <br>
            <div>Bitte tragen sie das gewünschte Anreise- und Abreisedatum ein, damit wir die Verfügbarkeit überprüfen können.</div>
            <br>
            <div class="row">
                <div class="col-md-5 anreise">Tag der Anreise:       <input type="date" name="anreise"></div>
                <br>
                <div class="col-md-5">Tag der Abreise:       <input type="date" name="abreise"></div>
            </div>
            <br>
            <br>
            <div>Bitte kreuzen Sie die von Ihnen gewünschten Services an, um Ihren Aufenthalt zu verschönern:</div>
            <br>
            <div class="row">
                <div class="col-md-5"><input type="checkbox" name="balkon" id="myCheck" onclick="myFunction()">Zimmer mit Balkon</div>
                <span id="text" style="display:none" class="col-md-5">Ohne Aufpreis</span>
            </div>
            <div class="row">
                <div class="col-md-5"><input type="checkbox" name="haustier" id="myCheck1" onclick="myFunction1()">Haustiere</div>
                <span id="text1" style="display:none" class="col-md-5">9.99€ pro Nacht</span>
            </div>
            <div class="row">
                <div class="col-md-5"><input type="checkbox" name="parkplatz" id="myCheck2" onclick="myFunction2()">Parkplatz</div>
                <span id="text2" style="display:none" class="col-md-5">15,99€ pro Tag</span>
            </div>
            <div class="row">
                <div class="col-md-5"><input type="checkbox" name="breakfast" id="myCheck3" onclick="myFunction3()">Frühstück</div>
                <span id="text3" style="display:none" class="col-md-5">18.90€ pro Person</span>
            </div>
            <br>
            <br>
            <span class="error"><?php echo $terminerror;?></span>
            <span class="validation"><?php if($accessCount >= 1){echo $terminbestätigung;}?></span>
            <br>
            <br>
            <br>
            <button class="btn btn-secondary text-end" type="submit">Buchung überprüfen</button>
        </form>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>

    <?php       
        //save reservation data if check was passed
        if ($_SERVER["REQUEST_METHOD"] == "POST" && $accessCount != '0') {
            $anreise = date('Y-m-d', strtotime($_POST['anreise']));
            $abreise = date('Y-m-d', strtotime($_POST['abreise']));
            
            //count days of reservation
            function berechneAufenthaltstage($anreise, $abreise) {
                
                $anreiseDatum = new DateTime($anreise);
                $abreiseDatum = new DateTime($abreise);
        
                $differenz = $anreiseDatum->diff($abreiseDatum);
        
                return (int)$differenz->format('%a');
             }   

            $aufenthaltstage = berechneAufenthaltstage($anreise, $abreise);

            if(isset($_POST['balkon'])){
                $balkon = 1;
            }
            if(isset($_POST['parkplatz'])){
                $parkplatz = 1;
            }
            if(isset($_POST['haustier'])){
                $haustier = 1;
            }
            if(isset($_POST['breakfast'])){
                $breakfast = 1;
            }

            $sql = "INSERT INTO reservierungen (Zimmerbezeichnung, Gastmail, Anreise, Abreise, Balkon, Parkplatz, Haustiere, Frühstück, Buchungsdatum, Aufenthaltstage, `Status`)
                    VALUES ('$zimmertyp', '{$_SESSION['email']}','$anreise', '$abreise', '$balkon', '$parkplatz', '$haustier', '$breakfast', '$buchungsdatum', '$aufenthaltstage', 'neu')";
            
            $conn->query($sql);
            $accessCount = 0;
        }
        $conn->close();
    ?>
    </main>

    <!--script to show/hide prices for extra service checkboxes -->
    <script>
        function myFunction() {
        var checkBox = document.getElementById("myCheck");
        var text = document.getElementById("text");
        if (checkBox.checked == true){
            text.style.display = "block";
        } else {
            text.style.display = "none";
        }
        }
        function myFunction1() {
        var checkBox = document.getElementById("myCheck1");
        var text = document.getElementById("text1");
        if (checkBox.checked == true){
            text.style.display = "block";
        } else {
            text.style.display = "none";
        }
        }
        function myFunction2() {
        var checkBox = document.getElementById("myCheck2");
        var text = document.getElementById("text2");
        if (checkBox.checked == true){
            text.style.display = "block";
        } else {
            text.style.display = "none";
        }
        }
        function myFunction3() { 
        var checkBox = document.getElementById("myCheck3");
        var text = document.getElementById("text3");
        if (checkBox.checked == true){
            text.style.display = "block";
        } else {
            text.style.display = "none";
        }
        }
    </script>
        
        <?php include 'footer.php';?>
    </body>
</html>