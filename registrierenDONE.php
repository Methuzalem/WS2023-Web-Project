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
            <div class="container" style="text-align: center">Danke, dass sie sich auf unserer Website registriert haben.</div>
            <br>
            <div class="container" style="text-align: center">Sie können sich nun mit ihren Benutzernamen und Passwort anmelden!</div>
            <br>
            <div class="container" id="loginregdone"><a href="login.php">Login</a></div>
        </main>
        <?php include 'footer.php';?>
    </body>
</html>