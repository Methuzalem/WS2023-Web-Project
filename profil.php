<!DOCTYPE html>
<?php
session_start();

include 'dbaccess.php';

//pull data matching session to list on website
$query = "SELECT anrede, vorname, nachname, benutzername, email
          FROM user WHERE email = '{$_SESSION['email']}' and passwort = '{$_SESSION['passwort']}'";

$result = $conn->query($query);
$rows = array();
while($element = $result->fetch_row())
{
    $rows[] = $element;
}

$result->close();
$conn->close();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    header("location:profil_change.php");
}
?>

<html>
    <head>
        <title>Profil</title>
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
            <div class="row">
                <div style="text-align: center">
                    Hier sehen Sie Ihre Stammdaten.
                </div>
            </div>  
            <br>

            <form name="regdata" class="container" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                
                <div class="text-right text-box form-goup row">
                    <span class="col-2 text-lg-end text-left">Anrede:</span>
                    <div class="col-4 text-right">
                        <?php
                            echo $rows[0][0];
                        ?>
                    </div>
                </div>
                <hr>
                <div class="text-right text-box form-goup row">
                    <span class="col-2 text-lg-end text-left">Vorname:</span>
                    <div class="col-4 text-right">
                        <?php
                            echo $rows[0][1];
                        ?>
                    </div>
                </div>
                <hr>
                <div class="text-right text-box form-goup row">
                    <span class="col-2 text-lg-end text-left">Nachname:</span>
                    <div class="col-4 text-right">
                        <?php
                            echo $rows[0][2];
                        ?>
                    </div>
                </div>
                <hr>
                <div class="text-right text-box form-goup row">
                    <span class="col-2 text-lg-end text-left">Benutzername:</span>
                    <div class="col-4 text-right">
                        <?php
                            echo $rows[0][3];
                        ?>
                    </div>
                </div>
                <hr>
                <div class="text-right text-box form-goup row">
                    <span class="col-2 text-lg-end text-left">Email:</span>
                    <div class="col-4 text-right">
                        <?php
                            echo $rows[0][4];
                        ?>
                    </div>
                </div>
                <hr>
                <br>
                <div class="text-left text-box form-goup">
                    <button class="btn btn-secondary text-end" type="submit"><?php ?>Daten &auml;ndern</button>
                </div>
                <br>
            </form>
        </main>
        <?php include 'footer.php';?>
    </body>
</html>