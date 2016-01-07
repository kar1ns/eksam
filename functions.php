<?php 
	
	// Loon AB'i ühenduse
	require_once("../config_global.php");
	$database = "if15_kar1ns";
	
	function getMenuData($keyword=""){
	
		if($keyword ==""){
			echo "Ei otsi";
		}else{
			echo "Otsin ".$keyword;
			$search = "%".$keyword."%";
		}
	
		$mysqli = new mysqli($GLOBALS["servername"], $GLOBALS["server_username"], $GLOBALS["server_password"], $GLOBALS["database"]);
	
		$stmt = $mysqli->prepare("SELECT id, title, price from food_list WHERE deleted IS NULL AND (price LIKE ? OR title LIKE ?)");
		$stmt->bind_param("ss", $search, $search);
		$stmt->bind_result($id, $title, $price);
		$stmt->execute();
		
		$menu_array=array();
		$row = 0;
		
		//tee midagi seni kuni saame ab'st ühe rea andmeid
		while($stmt->fetch()){
			//seda siin sees tehakse nii mitu korda kui on ridu
			$menu = new StdClass();
			$menu->id = $id;
			$menu->title = $title;
			$menu->price = $price;
			
			//lisan massiivi
			array_push($menu_array, $menu);

	}
	return $menu_array;
	
	$stmt->close();
	$mysqli->close();
}

	function deleteMenu($id){
		$mysqli = new mysqli($GLOBALS["servername"], $GLOBALS["server_username"], $GLOBALS["server_password"], $GLOBALS["database"]);
		$stmt = $mysqli->prepare("UPDATE food_list SET deleted=NOW() WHERE id=?");
		
		$stmt->bind_param("i", $id);
		if($stmt->execute()){
			//sai kustutatud
			header("Location: table.php");
		}
	
	}
	function updateMenu($id, $title, $price){
	
		$mysqli = new mysqli($GLOBALS["servername"], $GLOBALS["server_username"], $GLOBALS["server_password"], $GLOBALS["database"]);
		$stmt = $mysqli->prepare("UPDATE food_list SET title=?, price=? WHERE id=?");
		
		$stmt->bind_param("ssi", $title, $price, $id);
		if($stmt->execute()){
			//sai kustutatud
			header("Location: table.php");
	
		}
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
