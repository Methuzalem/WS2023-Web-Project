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
        <title>Impressum</title>
        <link rel="icon" type="image/x-icon" href="favicon.ico">
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

        <main class="container">
            <!--headline-->
            <h1>Impressum</h1>

            <article>
                <p> Informationspflicht laut §5 E-Commerce Gesetz, §14 Unternehmensgesetzbuch, §63 Gewerbeordnung und Offenlegungspflicht laut §25 Mediengesetz</p>
                <p> <a href="https://www.ris.bka.gv.at/GeltendeFassung.wxe?Abfrage=Bundesnormen&Gesetzesnummer=10007517" target="_blank">Gewerbeordnung Österreich</a></p><br>
            </article>

            <!--company name and photos-->
            <article class="row">
                <div class="col-md-8">
                    <h3>L&ouml;htner Hotelgewerbe GmbH</h3>
                    <p>Wir bedanken uns bei Ihnen daf&uuml;r, dass Sie unsere Website aufgerufen haben und freuen uns darauf Ihnen einen schönen Aufenthalt zu ermöglichen.<br></p>
                    Wir hei&szlig;en Sie im Namen des Projektteams <b>"Herzlich Willkommen!"</b>
                </div>
                <div class="col-md-2 d-none d-md-block" class="photo"> <img src="images/imgppl.png" alt="Christoph Gartner" id="gartner" > </div>
                <div class="col-md-2 d-none d-md-block" class="photo"> <img src="images/imgppl.png" alt="Marvin Löhlein" id="loehlein"></div>
            </article>

            <!--adress-->
            <article class="abstandUnten">
                <h3>Sitz laut Firmenbuch</h3>
                <address>   
                    <b>L&ouml;htner Hotelgewerbe GmbH</b><br>
                    Hotelgewerbestra&szlig;e 1 <br> 
                    1210 Wien <br>
                    &Ouml;sterreich <br> 
                    <b><abbr title="Umsatzsteuer-Identifikationsnummer">UID-Nr:</abbr></b>
                    ATU12345678 <br>
                    <b><abbr title="Firmenbuchnummer">FN:</abbr></b>
                    121022F<br>
                </address>
            </article>

            <!--contact-->
            <article>
                <h3>Kontaktdaten</h3>
                <i class="fab fa-android"></i>
                <p>Wir freuen uns darauf Ihnen auf Ihre speziellen Fragen pers&ouml;nlich Auskunft zu geben!</p>
                <p><b>Kundenhotline 24/7:</b> 056 100 1210 1220</p>
                <p><b>E-Mail Kontakt: </b><a href="mailto:löhtner@hotelvienna.at">l&ouml;htner@hotelvienna.at</a></p> 
            </article>

            <!--goverment stuff-->
            <article>
                <h3>Zust&auml;ndige Aufsichtsbeh&ouml;rden</h3>
                <p><b>Firmenbuchgericht:</b> <br>
                    Handelsgericht Wien <br>
                    <i>Marxergasse 1a </i> <br>
                    <i>1030 Wien</i> <br> <br>
                    
                    <b>Aufsichtsbeh&ouml;rde:</b> <br>
                    Magstrat der Stadt Wien <br>
                    <i>Meiereistra&szlig;e 7, Sektor B </i> <br>
                    <i>1020 Wien</i> <br> </p>
            </article>

            <!--memberships-->
            <article>
                <h3>Mitgliedschaften der L&ouml;htner GmbH</h3>
                <p>     <b>Hotellerie, Fachverband Wirtschaftskammer &ouml;sterreich</b> <br>
                        Bundessparte Tourismus und Freizeitwirtschaft<br>
                        <i>Wiedner Hauptstra&szlig;e 63<br>
                        1045 Wien <br>
                        &Ouml;sterreich<br></i></p>
            </article>
            
            <article>
                <h4>Informationen zur DSGVO</h4>
                <p>Insofern wir f&uuml;r die Verarbeitung der personenbezogenen Daten eine Einwilligung der betroffenen Person eingeholt haben, gilt Artikel 6 Absatz 1 Unterabsatz 1a der DSGVO als rechtliche Grundlage.
                    Ist die Verarbeitung personenbezogener Daten f&uuml;r die Erf&uuml;llung eines Vertrags mit der betroffenen Person oder f&uuml;r vorvertragliche Ma&szlig;nahmen erforderlich, die durch die betroffene Person veranlasst wurden, dient Artikel 6 Absatz 1 Unterabsatz 1b (DSGVO) als Rechtsgrundlage.
                    Ist die Datenverarbeitung das Resultat einer rechtlichen Verpflichtung, der wir unterliegen, berufen wir uns auf Artikel 6 Absatz 1 Unterabsatz 1c der DSGVO als rechtliche Basis.
                    Erfolgt die Verarbeitung personenbezogener Daten, um lebenswichtige Interessen der betroffenen Person oder einer anderen nat&uuml;rlichen Person zu sch&uuml;tzen, dient Artikel 6 Absatz 1 Unterabsatz 1d (DSGVO) als Rechtsgrundlage.
                    Dient die Datenverarbeitung einer Aufgabe, die im &ouml;ffentlichen Interesse liegt oder in Aus&uuml;bung &ouml;ffentlicher Gewalt erfolgt, berufen wir uns auf Artikel 6 Absatz 1 Unterabsatz 1e der DSGVO.
                    Insofern die Verarbeitung personenbezogener Daten erforderlich ist, um berechtigte Interessen des Verantwortlichen oder eines Dritten zu wahren – ohne dabei die Interessen, Grundrechte oder Grundfreiheiten der betroffenen Person zu gef&auml;hrden –, gilt Artikel 6 Absatz 1 Unterabsatz 1f (DSGVO) als Rechtsgrundlage.</p>
            </article>

        </main>
        <?php include 'footer.php';?>
    </body>
</html>
