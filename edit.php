<?php 
	require_once("edit_functions.php");

	if(isset($_POST["update"])){
		
		updateMenu($_POST["id"], $_POST["title"], $_POST["price"]);
		
	}else{
		
	}
	
	
	
	if(!isset($_GET["edit"])){
		
		header("location: tabel.php");
		
		
	}else{
		// küsime andmebaasisit andmed id-levenshtein
		$car_object = getEditDeta($_GET["edit"]);
		var_dump($menu_object);
	}
?>

<h2>Muuda autonumbrimärkki</h2>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" >
	<label type="hidden" name="id" value="<?=$_GET["edit_id"];?>>
	<label for="title" >Toit</label><br>
	<input id="title" name="title" type="text" value="<?=$menu->title;?>"> <br><br>
	<label for="price">Hind</label><br>
	<input id="price" name="price" type="text" value=""> <br><br>
	<input type="submit" name="update_menu" value="Salvesta">
</form>