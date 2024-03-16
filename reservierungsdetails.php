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
            <h4 style="text-align: center">Anbei die Auflistung der gesamten Reservierungen:</h4>
            <br>
            <?php
                include 'dbaccess.php';

                //change the status of chosen id and update db
                if ($_SERVER["REQUEST_METHOD"] == "POST")
                {
                    if(is_numeric($_POST['chooseId']) && isset($_POST['chooseId']))
                    {
                        $query = "UPDATE reservierungen SET `Status` = '{$_POST['selectStatus']}' WHERE Res_ID = '{$_POST['chooseId']}'";
                        mysqli_query($conn, $query);
                    }
                }
                //create table
                echo "<table class=\"container-fluid mb-3 table\">
                    <tr>
                        <th>Res_ID</th>
                        <th>Zimmerbezeichnung</th>
                        <th>Zimmernummer</th>
                        <th>Gastmail</th>
                        <th>Anreise</th>
                        <th>Abreise</th>
                        <th>Aufenthaltstage</th>
                        <th>Balkon</th>
                        <th>Parkplatz</th>
                        <th>Haustiere</th>
                        <th>Frühstück</th>
                        <th>Buchungsdatum</th>
                        <th>Status</th>
                    </tr>";

                $query = "SELECT Res_ID, Zimmerbezeichnung, Zimmernummer, Gastmail, Anreise, Abreise, Aufenthaltstage, Balkon, Parkplatz, Haustiere, Frühstück, Buchungsdatum, `Status` from reservierungen";
                $result = mysqli_query($conn, $query);
                //fill table 
                while($row = mysqli_fetch_assoc($result))
                {
                    echo "<tr>";
                    echo "  <th>".$row['Res_ID']."</th>
                            <td>".$row['Zimmerbezeichnung']."</td>
                            <td>".$row['Zimmernummer']."</td>
                            <td>".$row['Gastmail']."</td>
                            <td>".$row['Anreise']."</td>
                            <td>".$row['Abreise']."</td>
                            <td>".$row['Aufenthaltstage']."</td>
                            <td>".$row['Balkon']."</td>
                            <td>".$row['Parkplatz']."</td>
                            <td>".$row['Haustiere']."</td>
                            <td>".$row['Frühstück']."</td>
                            <td>".$row['Buchungsdatum']."</td>
                            <td>".$row['Status']."</td>";
                    echo "</tr>";
                }

                echo "</table>";
            ?>

            <!--confirm/decline reservations via status -->
            <form name="reservierStatus" class="container-fluid" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                <label for="chooseId">Geben Sie die ID der Reservierung ein, deren Status geändert werden soll:</label><br>
                <input class="mb-3" type="text" name="chooseId">
                <br>
                <label for="selectStatus">Auf welchen Status soll die Reservierung geändert werden?</label><br>
                <select id="selectStatus" name="selectStatus" class="mb-3">
                    <option value="bestätigt">Bestätigt</option>
                    <option value="storniert">Storniert</option>
                </select>
                <div class=" mb-3">
                    <button class="btn btn-secondary" type="submit">Submit</button>
                </div>
            </form>
        </main>
        <?php include 'footer.php';?>
    </body>
</html>