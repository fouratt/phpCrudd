<?php
    include_once '../../Model/Adherent.php';
    include_once '../../Controller/AdherentC.php';

    $error = "";

    // create adherent
    $adherent = null;

    // create an instance of the controller
    $adherentC = new AdherentC();
    if (
        isset($_POST["id"]) &&
		isset($_POST["titre"]) &&		
        isset($_POST["description"]) &&
        isset($_POST["date"])
    ) {
        if (
            !empty($_POST["id"]) && 
			!empty($_POST['titre']) &&
            !empty($_POST["description"]) && 
			
            !empty($_POST["date"])
        ) {
            $target_dir = "../../uploads/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
   // echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
   // echo "File is not an image.";
    $uploadOk = 0;
  }

  
// Check if file already exists
if (file_exists($target_file)) {
  //  echo "Sorry, file already exists.";
    $uploadOk = 0;
  }
  
  // Check file size
  if ($_FILES["fileToUpload"]["size"] > 500000) {
  //  echo "Sorry, your file is too large.";
    $uploadOk = 0;
  }
  
  // Allow certain file formats
  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
  && $imageFileType != "gif" ) {
  //  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
  }
  if ($uploadOk == 0) {
    header('Location:blog.php?error=1');
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {


            $adherent = new Adherent(
                $_POST['id'],
				$_POST['titre'],
                $_POST['description'], 
                $_POST['date']
            );
            $adherent->setImage($target_file);
            $adherentC->ajouter($adherent);
            header('Location:blog.php');
        }else {
            echo 'error upload';
        header('Location:blog.php'); 
           }
        }
       // else
         //   $error = "Missing information";
    }
}

    
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Display</title>
</head>
    <body>
        <button><a href="blog.php">Retour à la liste des blogs</a></button>
        <hr>
        
        <div id="error">
            <?php echo $error; ?>
        </div>
        
        <form action="" method="POST"  enctype="multipart/form-data">
            <table border="1" align="center">
                <tr>
                    <td>
                        <label for="id">id:
                        </label>
                    </td>
                    <td><input type="text" name="id" id="id" maxlength="20"></td>
                </tr>
				<tr>
                    <td>
                        <label for="titre">titre:
                        </label>
                    </td>
                    <td><input type="text" name="titre" id="titre" maxlength="20"></td>
                </tr>
                <tr>
                    <td>
                        <label for="description">description:
                        </label>
                    </td>
                    <td><input type="description" name="description" id="description" maxlength="20"></td>
                </tr>
                <tr>
                    <td>
                        <label for="date">date:
                        </label>
                    </td>
                    <td>
                        <input type="date" name="date" id="date" >
                    </td>
                </tr>              
                <tr>
                    <td></td>
                    <td>
                        <input type="submit" value="Envoyer"> 
                    </td>
                    <td>
                        <input type="reset" value="Annuler" >
                    </td>
                </tr>
                <div class="mb-3">
                                <label for="image" class="form-label">upload image</label>
                                <input class="form-control" type="file" name="fileToUpload" id="fileToUpload">
                </div>
            </table>
        </form>
    </body>
</html>