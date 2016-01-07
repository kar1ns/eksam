<?php
	require_once("functions.php");
	
	

	
	$title = $price = "";
	$title_error = $price_error = "";
	
	// keegi vajutas nuppu numbrim�rgi lisamiseks
	if(isset($_POST["add_food"])){
		
		//echo $_SESSION["logged_in_user_id"];
		
		// valideerite v�ljad
		if ( empty($_POST["title"]) ) {
			$title_error = "See v�li on kohustuslik";
		}else{
			$title = cleanInput($_POST["title"]);
		}
		
		if ( empty($_POST["price"]) ) {
			$price_error = "See v�li on kohustuslik";
		}else{
			$price = cleanInput($_POST["price"]);
		}
		
		// m�lemad on kohustuslikud
		if($price_error == "" && $title_error == ""){
			//salvestate ab'i fn kaudu addCarPlate
			$msg = addMenuPlate($title, $price);
			
			if($msg != ""){
				//�nnestus
				$title = "";
				$price = "";
				
				echo $msg;
			}
		}
		
	}
	
	function cleanInput($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
	

?>



<h2>Lisa toit</h2>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" >
	<label for="title" >Toit</label><br>
	<input id="title" name="title" type="text" value="<?php echo $title; ?>"> <?php echo $title_error; ?><br><br>
	<label for="price">Hind</label><br>
	<input id="price" name="price" type="text" value="<?php echo $price; ?>"> <?php echo $price_error; ?><br><br>
	<input type="submit" name="add_food" value="Salvesta">
</form>