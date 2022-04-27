<?php
	include '../../Controller/AdherentC.php';
	$adherentC=new AdherentC();
	$adherentC->supprimer($_GET["id"]);
	header('Location:blog.php');
?>