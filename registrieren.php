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
        <title>Registrieren</title>
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
            <div style="text-align: center">Bitte registrieren Sie sich mit Ihren Daten um vollen Zugriff auf unsere Website zu erhalten.</div>
            </div>  
            <br>
            
            <?php
            // define variables and set to empty values
            $anrede = $vorname = $nachname = $benutzername = $email = $passwort = $passwortCheck = $check = "";
            $anredeErr = $vornameErr = $nachnameErr = $benutzernameErr = $emailErr = $passwortErr = $passwortCheckErr = "";
            $countcheck = 0;

            //for each atribute check for errors and filter data before saving to variable
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (empty($_POST["anrede"])) {
                    $anredeErr = "Anrede ist erforderlich!";
                  } else {
                    $anrede = check_data($_POST["anrede"]);
                    $countcheck++;
                  }

                if (empty($_POST["vname"])) {
                    $vornameErr = "Vorname ist erforderlich!";
                  } else {
                    $vorname = check_data($_POST["vname"]);
                    if (!preg_match("/^[a-zA-Z-äÄöÖüÜ' ]*$/",$vorname)) {
                      $vornameErr = "Der Vorname darf nur aus Buchstaben und Leerzeichen bestehen.";
                      --$countcheck;
                    }
                    $countcheck++;
                  }
                
                if (empty($_POST["nname"])) {
                    $nachnameErr = "Nachname ist erforderlich!";
                  } else {
                    $nachname = check_data($_POST["nname"]);
                    if (!preg_match("/^[a-zA-Z-äÄöÖüÜ' ]*$/",$nachname)) {
                      $nachnameErr = "Der Nachname darf nur aus Buchstaben und Leerzeichen bestehen.";
                      --$countcheck;
                    }
                    $countcheck++;
                  }

                if (empty($_POST["bname"])) {
                    $benutzernameErr = "Benutzername ist erforderlich!";
                  } else {
                    $benutzername = check_data($_POST["bname"]);
                    $countcheck++;
                  }

                if (empty($_POST["email"])) {
                    $emailErr = "E-Mail ist erforderlich!";
                  } else {
                    $email = check_data($_POST["email"]);
                    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                      $emailErr = "Bitte verwenden Sie ein gültiges E-Mail Format.";
                      --$countcheck;
                    }
                    $countcheck++;
                  }

                if (empty($_POST["passwort"])) {
                    $passwortErr = "Passwort ist erforderlich!";
                  } else {
                    $passwort = hash('sha256', $_POST["passwort"]);
                    $countcheck++;
                  }

                if (empty($_POST["passwortCheck"])) {
                    $passwortCheckErr = "Bitte wiederholen sie das Passwort!";
                  } else {
                    $passwortCheck = hash('sha256', $_POST["passwortCheck"]);
                    $check = confirmpasswort($passwort, $passwortCheck);
                    if(is_string($check)){
                      $countcheck++;
                    }else{
                      $passwortCheckErr = "Passwörter stimmen nicht überein!";
                    }
                }
            }

            //upload to db if every error check failed
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
              if($countcheck == 7)
              {
                include 'dbaccess.php';
                                
                $sql = "INSERT INTO user (anrede, vorname, nachname, benutzername, email, passwort)
                        VALUES ('$anrede', '$vorname', '$nachname', '$benutzername', '$email', '$passwort')";
                
                $conn->query($sql);
                $conn->close();
                header('Location: registrierenDONE.php'); 
              }
            }

            //function to filter data from input
            function check_data($data) {
              $data = trim($data);
              $data = stripslashes($data);
              $data = htmlspecialchars($data);
              return $data;
            }

            function confirmpasswort($passwort,$passwortCheck){
              $passwortOK = 0;
                if($passwort == $passwortCheck){
                  $passwortOK = $passwort;
                }
            return $passwortOK;
            }  
            ?>

            <form name="regdata" class="container" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                <div class="form-group row">
                    <label for="anrede" class="col-lg-2 col-form-label text-lg-end">Anrede *</label>
                    <div class="col-lg-4">
                        <input name="anrede" type="text" class="form-control" id="anrede" placeholder="Anrede" value="<?php echo $anrede;?>">
                        <span class="error"><?php echo $anredeErr;?></span>
                    </div>
                    <label for="vorname" class="col-lg-2 col-form-label text-lg-end">Vorname *</label>
                    <div class="col-lg-4">
                        <input name="vname" type="text" class="form-control" id="vorname" placeholder="Vorname" value="<?php echo $vorname;?>">
                        <span class="error"><?php echo $vornameErr;?></span>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="nachname" class="col-lg-2 col-form-label text-lg-end">Nachname *</label>
                    <div class="col-lg-4">
                        <input name="nname" type="text" class="form-control" id="nachname" placeholder="Nachname" value="<?php echo $nachname;?>">
                        <span class="error"><?php echo $nachnameErr;?></span>
                    </div>
                    <label for="email" class="col-lg-2 col-form-label text-lg-end">Benutzername *</label>
                    <div class="col-lg-4">
                        <input name="bname" type="text" class="form-control" id="username" placeholder="Benutzername" value="<?php echo $benutzername;?>">
                        <span class="error"><?php echo $benutzernameErr;?></span>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="username" class="col-lg-2 col-form-label text-lg-end">E-Mail *</label>
                    <div class="col-lg-4">
                        <input name="email" type="text" class="form-control" id="email" placeholder="E-Mail" value="<?php echo $email;?>">
                        <span class="error"><?php echo $emailErr;?></span>
                    </div>
                    <label for="passwort" class="col-lg-2 col-form-label text-lg-end">Passwort *</label>
                    <div class="col-lg-4">
                        <input name="passwort" type="password" class="form-control" id="passwort" placeholder="Passwort">
                        <span class="error"><?php echo $passwortErr;?></span>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-lg-6">
                        
                    </div>
                    <label for="passwortCheck" class="col-lg-2 col-form-label text-lg-end">Passwort<br>wiederholen *</label>
                    <div class="col-lg-4">
                        <input name="passwortCheck" type="password" class="form-control" id="passwortCheck" placeholder="Passwort wiederholen">
                        <span class="error"><?php echo $passwortCheckErr;?></span>
                    </div>
                </div>

                <br>
                <div class="col-md-3 text-md-end">
                    <button class="btn btn-secondary text-end" type="submit">Registrieren</button>
                </div>
                <br>
            </form>
        </main>
        <?php include 'footer.php';?>
    </body>
</html>