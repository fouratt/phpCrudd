<?php
	include '../Controller/AdherentC.php';
	$adherentC=new AdherentC();
	$listeAdherents=$adherentC->afficher(); 
?>
<html>
	<head></head>
	<body>
	    <button><a href="ajouterAdherent.php">Ajouter un blog</a></button>
		<center><h1>Liste des blogs</h1></center>
		<table border="1" align="center">
			<tr>
				<th>id</th>
				<th>titre</th>
				<th>description</th>
				
				<th>Date</th>
				<th>Modifier</th>
				<th>Supprimer</th>
			</tr>
			<?php
				foreach($listeAdherents as $adherent){
			?>
			<tr>
				<td><?php echo $adherent['id']; ?></td>
				<td><?php echo $adherent['titre']; ?></td>
				<td><?php echo $adherent['description']; ?></td>
				
				<td><?php echo $adherent['date']; ?></td>
				<td>
					<form method="POST" action="modifieradherent.php">
						<input type="submit" name="Modifier" value="Modifier">
						<input type="hidden" value=<?PHP echo $adherent['id']; ?> name="id">
					</form>
				</td>
				<td>
					<a href="supprimeradherent.php?id=<?php echo $adherent['id']; ?>">Supprimer</a>
				</td>
			</tr>
			<?php
				}
			?>
		</table>
	</body>
</html>
