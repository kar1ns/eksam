<?php 

	require_once("../config_global.php");
	$database = "if15_kar1ns";

	function getEditData($edit_id){
		$mysqli = new mysqli($GLOBALS["servername"], $GLOBALS["server_username"], $GLOBALS["server_password"], $GLOBALS["database"]);
		$stmt = $mysqli->prepare("SELECT title, price FROM food_list WHERE id=? AND deleted IS NULL");
		$stmt->bind_param("i", $edit_id); //bind_param asendab k�sim�rgid (hetkel id)
		$stmt->bind_result($title, $price); //v�tab tabeli tlemused, () tuleb panna k�ik mis on selecti j�rgi
		$stmt->execute();
		
		//object
		$menu = new StdClass();
		
		if($stmt->fetch()){ //fetcf annab �he re andmed
			$menu->title = $title;
			$menu->price = $price;
		}else{
			//ei saanud, id ei ole olemas
			//dlited ei ole 0
			header("Location: table.php");
		}
		return $menu;
		
		$stmt->close();
		$mysqli->close();
	}

	function updateMenu($id, $title, $price){
	
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
	
?>