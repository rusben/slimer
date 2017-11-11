<?php

namespace App\Service;

class PreStudentService
{
// https://stackoverflow.com/questions/32365258/access-app-in-class-in-slim-framework-3
	private $db;
    
    function __construct($db) {
        $this->db = $db;
    }

	function createPreStudent($params) {

		$sql = "INSERT INTO prestudent (dni_nie, name, surnames, address, studies, born, nim) VALUES (:dni_nie, :name, :surnames, :address, :studies, :born, :nim)";

		$dni_nie = $params['dni_nie'];
	    $name = $params['name'];
	    $surnames = $params['surnames'];
	    $address = $params['address'];
	    $studies = $params['studies'];
	    $born = $params['born'];
	 
	    try {
	        $stmt =  $this->db->prepare($sql);  
	        $stmt->bindParam("dni_nie", $dni_nie);
	        $stmt->bindParam("name", $name);
	        $stmt->bindParam("surnames", $surnames);
	        $stmt->bindParam("address", $address);
	        $stmt->bindParam("studies", $studies);
	        $stmt->bindParam("born", $born);

	        $nim = $dni_nie.date("YmdHms");
	        $stmt->bindParam("nim", $nim);

	        $stmt->execute();

	        return $nim;
			
	    } catch(PDOException $e) {
	        $error = array("error"=> array("text"=>$e->getMessage()));
	        return $error;
	    }
	}

	function getPreStudent($params) {

	    $sql = "SELECT * FROM prestudent WHERE dni_nie = :dni_nie AND born = :born AND nim = :nim LIMIT 1";
	 
		$dni_nie = $params['dni_nie'];
		$born = $params['born'];

	    try {
	 		$stmt =  $this->db->prepare($sql);  
		    $stmt->bindParam("dni_nie", $dni_nie);
		    $stmt->bindParam("born", $born);
	        $stmt->execute();
	        $prestudent = $stmt->fetchObject();
	        
	        return $prestudent;
	    } catch(PDOException $e) {
	        $error = array("error"=> array("text"=>$e->getMessage()));
	        return $error;
	    }
	}
}