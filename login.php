<!DOCTYPE html>
<?php
session_start();
if(empty($_SESSION['rolle']))
{
    $_SESSION['rolle'] = "anonym";
}

$error = 0;

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    include 'dbaccess.php';

    $email = htmlspecialchars(trim($_POST['email']));
    $passwort = hash('sha256', $_POST['passwort']);
    $query = "SELECT email, passwort, rolle, `status` FROM user WHERE email = '$email' and passwort = '$passwort'";

    $result = mysqli_query($conn, $query);
    $element = mysqli_fetch_assoc($result);

    //if there is no user on db that matches entered email and passwort, output error message
    if($element != null) {
        //if account was set to deactivated(status == 1), put out error message
        if($element['status'] != '1')
        {
            //if no error occured, set session variables
            $_SESSION['rolle'] = $element['rolle'];
            $_SESSION['email'] = $email;
            $_SESSION['passwort'] = $passwort;
        }
        else
        {
            $error = 2;
        }
    }
    else
    {
        $error = 1;
    }

    $result->close();
    $conn->close();
}

?>
<html lang="de">
    <head>
        <title>Login</title>
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
            <div class="container">Bitte melden sie sich hier mir Ihren Daten an.</div>
            <br>
            <form name="logdata" class="container" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                <div class="row">
                    <label for="email" class="col-2 text-md-end col-form-label col-auto text-left">Email</label>
                    <div class="col-10">
                        <input name="email" type="text" class="form-control text-right" id="email" placeholder="Email">
                    </div>
                </div>
                <div class="row">
                    <label for="passwort" class="col-2 text-md-end col-form-label col-auto text-left">Passwort</label>
                    <div class="col-10 col-auto">
                        <input name="passwort" type="password" class="form-control text-right" id="passwort" placeholder="Passwort">
                    </div>
                </div>
                <br>
                <div class="col-2 text-md-end">
                    <button class="btn btn-secondary text-end" type="submit">Login</button>
                </div>
                <?php
                    if($error == 1)
                    {
                        echo "<br>
                              <span class=\"error\">Email oder Passwort ist nicht korrekt.</span>";
                    }
                    if($error == 2)
                    {
                        echo "<br>
                              <span class=\"error\">Dieser Account ist deaktiviert.</span>";
                    }
                ?>
                <br>
            </form>
        </main>
        <?php include 'footer.php';?>
    </body>
</html>