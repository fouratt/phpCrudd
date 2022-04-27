<?php
	include '../../config.php';
	include_once '../../Model/Adherent.php';
	class AdherentC {
		function afficher(){
			$sql="SELECT * FROM blog11";
			$db = config::getConnexion();
			try{
				$liste = $db->query($sql);
				return $liste;
			}
			catch(Exception $e){
				die('Erreur:'. $e->getMeesage());
			}
		}
		function supprimer($id){
			$sql="DELETE FROM blog11 WHERE id=:id";
			$db = config::getConnexion();
			$req=$db->prepare($sql);
			$req->bindValue(':id', $id);
			try{
				$req->execute();
			}
			catch(Exception $e){
				die('Erreur:'. $e->getMeesage());
			}
		}
		function ajouter($adherent){
			$sql="INSERT INTO blog11 (id, titre, description,  Date , image) 
			VALUES ( :id , :titre, :description,  :Date , :image)";
			$db = config::getConnexion();
			try{
				$query = $db->prepare($sql);
				$query->execute([
					'id' => $adherent->getid(),
					'titre' => $adherent->gettitre(),
					'description' => $adherent->getdescription(),
					'Date' => $adherent->getdate(),
					'image' => $adherent->getImage()
				]);			
			}
			catch (Exception $e){
				echo 'Erreur: '.$e->getMessage();
			}			
		}
		function recuperer($id){
			$sql="SELECT * from blog11 where id=$id";
			$db = config::getConnexion();
			try{
				$query=$db->prepare($sql);
				$query->execute();

				$adherent=$query->fetch();
				return $adherent;
			}
			catch (Exception $e){
				die('Erreur: '.$e->getMessage());
			}
		}
		
		function modifier($adherent, $id){
			try {
				$db = config::getConnexion();
				$query = $db->prepare(
					'UPDATE blog11 SET
					   
						titre= :titre, 
						description= :description, 
						date= :date
					WHERE id= :id'
				);
				$query->execute([

					'titre' => $adherent->gettitre(),
					'description' => $adherent->getdescription(),
					'date' => $adherent-> getdate(),
					'id' => $id
				]);
				echo $query->rowCount() . " records UPDATED successfully <br>";
			} catch (PDOException $e) {
				$e->getMessage();
			}
		}

	}
?>