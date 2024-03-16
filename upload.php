<!DOCTYPE html>
<?php
session_start();
$errMsg = "";
$uploaded = 0;  

include 'dbaccess.php';

if($_SERVER["REQUEST_METHOD"] == "POST")
{
  //start upload process if file is selected
  if($_FILES['fileToUpload']['size'] > 0)
  {
    $target_dir = "uploads\\";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    //limit file to be uploaded and error checks
    if(isset($_POST["submit"])) {
      $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
      if($check !== false) {
        $uploadOk = 1;
      } 
      else {
        $typeErr = "File is not an image.";
        $uploadOk = 0;
      }
    }

    if (file_exists($target_file)) {
      $errMsg = "Sorry, file already exists.";
      $uploadOk = 0;
    }

    if ($_FILES["fileToUpload"]["size"] > 3700000) {
      $errMsg = "Sorry, your file is too large.";
      $uploadOk = 0;
    }

    if($imageFileType != "jpg") {
      $errMsg = "Sorry, only JPG files are allowed.";
      $uploadOk = 0;
    }

    if ($uploadOk == 0) {
      $errMsg = "Sorry, your file was not uploaded.";
    } 
    
    else {
      //upload file to uploads folder and create entry in news table with filepath in text
      if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        $errMsg = "The file ". htmlspecialchars( basename($_FILES["fileToUpload"]["name"])). " has been uploaded.";
        $sql = "INSERT INTO news (`text`, `date`) VALUES 
                ('" . mysqli_real_escape_string($conn, $target_dir . $_FILES["fileToUpload"]["name"]) . "', now())";
        $conn->query($sql);
      } 
      else {
        $errMsg = "Sorry, there was an error uploading your file.";
      }
    }
  }
  //if text is to be uploaded
  if(!empty($_POST['textUpload']))
  {
    function check_data($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }
    //text filtered and uploaded into news table with raw text in text
    $text = check_data($_POST['textUpload']);
    $sql = "INSERT INTO news (`text`, `date`) VALUES 
            ('$text', now())";
    $conn->query($sql);
  }
}  

$conn->close();
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
          
            <br>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                      <label for="fileToUpload" class="form-label">Bild hochladen:</label>
                      <input class="form-label" type="file" name="fileToUpload" id="fileToUpload" accept="image/jpeg">
                    </div>
                    <div class="mb-3">
                      <label for="textUpload" class="form-label">Text hochladen:</label>
                      <textarea class="form-control" rows="3" type="text" name="textUpload" id="textUpload"></textarea>
                    </div>
                    <input class="mb-3" type="submit" value="Submit" name="submit">
                </form>
                <span class="error mb-3"><?php echo $errMsg;?></span>
          
          <div class="container-fluid mb-3">
              Aktuelle Newsbeiträge:
          </div>
          <div>
                <?php
                    //php section to list each datasets text atribute for easy overview over uploaded data
                    include 'dbaccess.php';

                    echo "<ul>";

                    $query = "SELECT `text` from news";
                    $result = mysqli_query($conn, $query);

                    define('IMAGEPATH', 'uploads\\');
                    
                    //for each data set loop once
                    while($row = mysqli_fetch_assoc($result))
                    {
                        $directoryfile = $row['text'];

                        //post images as raw filepath
                        if(strcmp($directoryfile, "upload\\") == 0)
                        {
                            $handle = opendir(IMAGEPATH);
                            $files = array();
                            $count = 0;
                            while (($file = readdir($handle)) !== false) {
                                if($count > 1)
                                {
                                    $files[] = $file;
                                }
                                $count++;
                            }
                            
                            foreach($files as $file)
                            {
                                $imagePath = IMAGEPATH . $file;
                                echo "<li><img class=\"newImage\" src=\"$imagePath\" style=\"max-width: 800px;\"  alt=\"" . basename($file) . "\"></li>";
                            }

                            closedir($handle); 
                        }
                        else
                        {
                            echo "<li>".$row['text']."</li>";
                        }
                    }

                    echo "</ul>";
                ?>
            </div>
        </main>
        <?php include 'footer.php';?>
    </body>
</html>