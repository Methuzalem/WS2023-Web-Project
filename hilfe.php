<!DOCTYPE html>
<?php
session_start();
if(empty($_SESSION['rolle']))
{
    $_SESSION['rolle'] = "anonym";
}
?>
<html lang="de">
    <head>
        <title>Hilfe</title>
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
            <article class="container">
                <h2>Registrierung und Login</h2>
                <p>
                    Um einen Urlaub bei uns zu buchen ben&ouml;tigen Sie einen Account, welchen sie unter "Registrieren"
                    im Hauptmen&uuml; erstellen k&ouml;nnen. Sie werden daraufhin sofort in Ihren Account eingeloggt und k&ouml;nnen
                    nun die Buchung starten. Wenn Sie sp&auml;ter auf Ihren Account zugreifen wollen, k&ouml;nnen Sie dies unter
                    "Login" machen.
                </p>
                <p>
                    Informationen &uuml;ber Ihre Buchung erfahren Sie von uns per Email, wof&uuml;r die f&uuml;r Ihren Account verwendete
                    benutzt wird.
                </p>
            </article>

            <article class="container">
                <h2>Reservieren von Zimmern</h2>
                <p>
                    Sobald Sie eingeloggt sind, k&ouml;nnen Sie eine Vorschau unsere Zimmer besichtigen. Ihnen wird angezeigt,
                    ob ein Zimmer verf&uuml;gbar ist, oder nicht. Sollte Ihnen ein Zimmer gefallen k&ouml;nnen Sie mit der Buchung
                    sofort beginnen. Daf&uuml;r dr&uuml;cken Sie einfach auf "Buchen" und f&uuml;llen alle weiteren Informationen aus.
                    Sie erhalten die Rechnung dann per Email.
                </p>
            </article>

            <article class="container">
                <h2>News</h2>
                <p>Sie k&ouml;nnen mithilfe unserer News jederzeit die neuesten Informationen erfahren, 
                    welche unser Hotel, Service und Umgebung betreffen.</p>
                <p>Wir aktualisieren diese t&auml;glich.</p>
            </article>

            <article class="container">
                <h2>FAQs</h2>
                <ul>
                    <li>Question 1</li>
                    <li>Question 2</li>
                    <li>Question 3</li>
                </ul>
            </article>
        </main>
        <?php include 'footer.php';?>
    </body>
</html>