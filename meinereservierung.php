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

        <main>
            <br>
            <h4 style="text-align: center">Hier sehen Sie Ihre bestehenden Buchungen:</h4>
            <br>

            <?php
            include 'dbaccess.php';

            //create table
            echo "<table class=\"container-fluid mb-3 table\">
                <tr scope=\"row\">
                    <th scope=\"col\">Zimmerbezeichnung</th>
                    <th scope=\"col\">Zimmernummer</th>
                    <th scope=\"col\">Anreise</th>
                    <th scope=\"col\">Abreise</th>
                    <th scope=\"col\">Tage ges.</th>
                    <th scope=\"col\">Balkon</th>
                    <th scope=\"col\">Parkplatz</th>
                    <th scope=\"col\">Haustiere</th>
                    <th scope=\"col\">Frühstück</th>
                    <th scope=\"col\">Status</th>
                </tr>";

            $query = "SELECT Zimmerbezeichnung, Zimmernummer, Anreise, Abreise, Aufenthaltstage, Balkon, Parkplatz, Haustiere, Frühstück, Buchungsdatum, `Status` from reservierungen WHERE Gastmail = '{$_SESSION['email']}'";
            $result = mysqli_query($conn, $query);

            //fill table
            while($row = mysqli_fetch_assoc($result))
            {
                echo "<tr scope=\"row\">";
                echo " 
                        <td style=\"text-align: center;\">".$row['Zimmerbezeichnung']."</td>
                        <td style=\"text-align: center;\">".$row['Zimmernummer']."</td>
                        <td style=\"text-align: center;\">".$row['Anreise']."</td>
                        <td style=\"text-align: center;\">".$row['Abreise']."</td>
                        <td style=\"text-align: center;\">".$row['Aufenthaltstage']."</td>
                        <td style=\"text-align: center;\">".$row['Balkon']."</td>
                        <td style=\"text-align: center;\">".$row['Parkplatz']."</td>
                        <td style=\"text-align: center;\">".$row['Haustiere']."</td>
                        <td style=\"text-align: center;\">".$row['Frühstück']."</td>
                        <td style=\"text-align: center;\">".$row['Status']."</td>";
                echo "</tr>";
            }

            echo "</table>";
            ?>
            
        </main>

        <?php include 'footer.php';?>
    </body>

</html>