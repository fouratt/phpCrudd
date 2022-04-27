<?php
	class Adherent{
		private $id=null;
		private $titre=null;
		private $description=null;
		private $date;
		private $image;
		
		function __construct($id, $titre, $description,  $date ){
			$this->id=$id;
			$this->titre=$titre;
			$this->description=$description;
			$this->date=$date;

		}
		function getid(){
			return $this->id;
		}
		function gettitre(){
			return $this->titre;
		}
		function getdescription(){
			return $this->description;
		}
		function getdate(){
			return $this->date;
		}
		function settitre(string $titre){
			$this->titre=$titre;
		}
		function setdescription(string $description){
			$this->description=$description;
		}
		function setdate(string $date){
			$this->date=$date;
		}
		function setImage(string $image){
			$this->image=$image;
		}
		function getImage(){
			return $this->image;
		}

		
	}


?>