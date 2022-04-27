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
            $adherent = new Adherent(
                $_POST['id'],
				$_POST['titre'],
                $_POST['description'], 
                $_POST['date']
            );
            $adherentC->modifier($adherent, $_POST["id"]);
            header('Location:blog.php');
        }
        else
            $error = "Missing information";
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
			
		<?php
			if (isset($_POST['id'])){
				$adherent = $adherentC->recuperer($_POST['id']);
				
		?>
        
        <form action="" method="POST">
            <table border="1" align="center">
                <tr>
                    <td>
                        <label for="id">id:
                        </label>
                    </td>
                    <td><input type="text" name="id" id="id" value="<?php echo $adherent['id']; ?>" maxlength="20"readonly></td>
                </tr>
				<tr>
                    <td>
                        <label for="titre">titre:
                        </label>
                    </td>
                    <td><input type="text" name="titre" id="titre" value="<?php echo $adherent['titre']; ?>" maxlength="20"></td>
                </tr>
                <tr>
                    <td>
                        <label for="description">description:
                        </label>
                    </td>
                    <td><input type="text" name="description" id="description" value="<?php echo $adherent['description']; ?>" maxlength="20"></td>
                </tr>
                <tr>
                    <td>
                        <label for="date">Date :
                        </label>
                    </td>
                    <td>
                        <input type="date" name="date" id="date" value="<?php echo $adherent['date']; ?>">
                    </td>
                </tr>              
                <tr>
                    <td></td>
                    <td>
                        <input type="submit" value="Modifier"> 
                    </td>
                    <td>
                        <input type="reset" value="Annuler" >
                    </td>
                </tr>
            </table>
        </form>
		<?php
		}
		?>
    </body>
</html>