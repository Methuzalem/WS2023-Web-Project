<!DOCTYPE html>
<?php
session_start();
include 'dbaccess.php';

$new = 0;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new = 1;
}
    
$query = "SELECT anrede, vorname, nachname, benutzername, email
          FROM user WHERE email = '{$_SESSION['email']}' and passwort = '{$_SESSION['passwort']}'";

$element = mysqli_fetch_assoc(mysqli_query($conn, $query));

$conn->close();

$anrede = $element['anrede'];
$vorname = $element['vorname'];
$nachname = $element['nachname'];
$benutzername = $element['benutzername'];
$email = $element['email'];

$anredeErr = $vornameErr = $nachnameErr = $emailErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //function to filter user input
    function check_data($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    
    //for each atribute check for errors and filter input
    if(!empty($_POST['anrede']))
    {
        $anrede = check_data($_POST["anrede"]);
    }

    if(!empty($_POST['vorname']))
    {
        $tempVorname = check_data($_POST["vorname"]);
        if (!preg_match("/^[a-zA-Z-äÄöÖüÜ' ]*$/",$tempVorname)) {
            $vornameErr = "Der Vorname darf nur aus Buchstaben und Leerzeichen bestehen.";
        }
        else
        {
            $vorname = check_data($_POST["vorname"]);
        }
    }
    
    if(!empty($_POST['nachname']))
    {
        $tempNachname = check_data($_POST["nachname"]);
        if (!preg_match("/^[a-zA-Z-äÄöÖüÜ' ]*$/",$tempNachname)) {
            $nachnameErr = "Der Nachname darf nur aus Buchstaben und Leerzeichen bestehen.";
        }
        else
        {
            $nachname = check_data($_POST["nachname"]);
        }
    }

    if(!empty($_POST['benutzername']))
    {
        $benutzername = check_data($_POST["benutzername"]);
    }

    if(!empty($_POST['email']))
    {
        $tempEmail = check_data($_POST["email"]);
        if (!filter_var($tempEmail, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Bitte verwenden Sie ein gültiges E-Mail Format.";
        }  
        else
        {
            $email = check_data($_POST["email"]);
        }
    }
}

if ($new) {
    include 'dbaccess.php';

    //update data to db
    $sql = "UPDATE user SET 
            anrede = '$anrede',
            vorname = '$vorname',
            nachname = '$nachname',
            benutzername = '$benutzername',
            email = '$email'
            WHERE email = '{$_SESSION['email']}' and passwort = '{$_SESSION['passwort']}'";
    
    $conn->query($sql);
    $conn->close();

    $_SESSION['email'] = $email;
}

//pull data from db again to see changes right after reload
include 'dbaccess.php';

$query = "SELECT anrede, vorname, nachname, benutzername, email
          FROM user WHERE email = '{$_SESSION['email']}' and passwort = '{$_SESSION['passwort']}'";
    
$element = mysqli_fetch_assoc(mysqli_query($conn, $query));

$conn->close();
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
                <div class="form-group row">
                    <span class="col-2 text-end">Anrede</span>
                    <div class="col-4">
                        <?php
                            echo $element['anrede'];
                        ?>
                    </div>
                    <span class="col-2 text-end">Vorname</span>
                    <div class="col-4">
                        <?php
                            echo $element['vorname'];
                        ?>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="anrede" class="col-2 text-end">Neue Anrede</label>
                    <div class="col-4">
                        <input name="anrede" type="text" class="form-control" id="anrede">
                        <span class="error"><?php echo $anredeErr;?></span>
                    </div>

                    <label for="vorname" class="col-2 text-end">Neuer Vorname</label>
                    <div class="col-4">
                        <input name="vorname" type="text" class="form-control" id="vorname">
                        <span class="error"><?php echo $vornameErr;?></span>
                    </div>
                </div>

                <div class="form-group row">
                <span class="col-2 text-lg-end">Nachname</span>
                    <div class="col-4">
                        <?php
                            echo $element['nachname'];
                        ?>
                    </div>
                    <span class="col-2 text-lg-end">Benutzername</span>
                    <div class="col-4">
                        <?php
                            echo $element['benutzername'];
                        ?>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="nachname" class="col-2 text-end">Neuer Nachname</label>
                    <div class="col-4">
                        <input name="nachname" type="text" class="form-control" id="nachname">
                        <span class="error"><?php echo $nachnameErr;?></span>
                    </div>

                    <label for="benutzername" class="col-2 text-end">Neuer Benutzername</label>
                    <div class="col-4">
                        <input name="benutzername" type="text" class="form-control" id="benutzername">
                    </div>
                </div>

                <div class="form-group row">
                <span class="col-2 text-lg-end">Email</span>
                    <div class="col-4">
                        <?php
                            echo $element['email'];
                        ?>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="email" class="col-2 text-end">Neue Email</label>
                    <div class="col-4">
                        <input name="email" type="text" class="form-control" id="email">
                        <span class="error"><?php echo $emailErr;?></span>
                    </div>
                </div>

                <br>
                <div class="col-3 text-md-end">
                    <button class="btn btn-secondary text-end" type="submit">Daten &auml;ndern</button>
                </div>
                <br>
            </form>
        </main>
        <?php include 'footer.php';?>
    </body>
</html>