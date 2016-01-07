<?php 
	
	// Loon AB'i ühenduse
	require_once("../config_global.php");
	$database = "if15_kar1ns";
	
	session_start();
	
	function getMenuData(){
	
		$mysqli = new mysqli($GLOBALS["servername"], $GLOBALS["server_username"], $GLOBALS["server_password"], $GLOBALS["database"]);
	
		$stmt = $mysqli->prepare("SELECT id, title, price from food_list WHERE deleted IS NULL");
		$stmt->bind_result($id, $title, $price);
		$stmt->execute();
		
		$array_of_menus=array();
		$row = 0;
		
		//tee midagi seni kuni saame ab'st ühe rea andmeid
		while($stmt->fetch()){
			//seda siin sees tehakse nii mitu korda kui on ridu
			$menu = new StdClass();
			$menu->id = $id;
			$menu->title = $title;
			$menu->price = $price;
			
			//lisan massiivi
			array_push($array_of_menus, $menu);
			
	}
	return $array_of_menus;
	
	$stmt->close();
	$mysqli->close();
}

	function deleteFood($id){
		$mysqli = new mysqli($GLOBALS["servername"], $GLOBALS["server_username"], $GLOBALS["server_password"], $GLOBALS["database"]);
		$stmt = $mysqli->prepare("UPDATE food_list SET deleted=NOW() WHERE id=?");
		$stmt->bind_param("i", $id);
	
		if($stmt->execute()){
			//sai kustutatud
			header("Location: table.php");
		}
		$stmt->close();
		$mysqli->close();
	
	}
	function updateFood($id, $title, $price){
	
		$mysqli = new mysqli($GLOBALS["servername"], $GLOBALS["server_username"], $GLOBALS["server_password"], $GLOBALS["database"]);
		$stmt = $mysqli->prepare("UPDATE food_list SET title=?, price=? WHERE id=?");
		
		$stmt->bind_param("ssi", $title, $price, $id);
		if($stmt->execute()){
			//sai kustutatud
			header("Location: table.php");
	
		}
		$stmt->close();
		$mysqli->close();
	}
	
	function addMenuPlate($title, $price) {
		
		$mysqli = new mysqli($GLOBALS["servername"], $GLOBALS["server_username"], $GLOBALS["server_password"], $GLOBALS["database"]);
		
		$stmt = $mysqli->prepare("INSERT INTO food_list ( title, price) VALUES (?,?)");
		$stmt->bind_param("ss", $title, $price);
		$stmt->execute();
		$stmt->close();
		
		$mysqli->close();
		
		
	}
	
	
	

?>
