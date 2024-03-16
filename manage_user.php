<!DOCTYPE html>
<?php
session_start();
?>

<html>
    <head>
        <title>Upload</title>
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
            <div class="container-fluid mb-3 mt-3">
                Vorhandene User:
            </div>
            <form name="userdata" class="container-fluid" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                <div>
                    <?php
                        include 'dbaccess.php';


                        //check if chosen id is a number, then update status or enter user_change.php page
                        if ($_SERVER["REQUEST_METHOD"] == "POST")
                        {
                            if(is_numeric($_POST['deaktivieren']) && isset($_POST['deaktivieren']))
                            {
                                $query = "UPDATE user SET `status` = '1' WHERE id = '{$_POST['deaktivieren']}'";
                                mysqli_query($conn, $query);
                            }
                            if(is_numeric($_POST['aktivieren']) && isset($_POST['aktivieren']))
                            {
                                $query = "UPDATE user SET `status` = '0' WHERE id = '{$_POST['aktivieren']}'";
                                mysqli_query($conn, $query);
                            }
                            if(is_numeric($_POST['bearbeiten']) && isset($_POST['bearbeiten']))
                            {
                                $_SESSION['id'] = $_POST['bearbeiten'];
                                header("location:user_change.php");
                            }
                        }

                        //table to simulate db directly on website
                        echo "<table class=\"container-fluid mb-3 table\">
                                <tr>
                                    <th>ID</th>
                                    <th>Vorname</td>
                                    <th>Nachname</th>
                                    <th>Benutzername</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                </tr>";

                        $query = "SELECT id, vorname, nachname, benutzername, email, `status` from user";
                        $result = mysqli_query($conn, $query);

                        while($row = mysqli_fetch_assoc($result))
                        {
                            echo "<tr>";
                            echo "  <th>".$row['id']."</th>
                                    <td>".$row['vorname']."</td>
                                    <td>".$row['nachname']."</td>
                                    <td>".$row['benutzername']."</td>
                                    <td>".$row['email']."</td>
                                    <td>".$row['status']."</td>";
                            echo "</tr>";
                        }

                        echo "</table>";
                    ?>
                </div>
                <label for="deaktiveren">Geben Sie die ID des Benutzers aus, der deaktivert werden soll:</label><br>
                <input class="mb-3" type="text" name="deaktivieren">
                <br>

                <label for="aktiveren">Geben Sie die ID des Benutzers aus, der aktivert werden soll:</label><br>
                <input class="mb-3" type="text" name="aktivieren">
                <br>

                <label for="bearbeiten">Geben Sie die ID des Benutzers aus, der bearbeitet werden soll:</label><br>
                <input class="mb-3" type="text" name="bearbeiten">
            
                <div class=" mb-3">
                    <button class="btn btn-secondary" type="submit">Submit</button>
                </div>
            </form>
        </main>
        <?php include 'footer.php';?>
    </body>
</html>