<?php
	require_once("../functions.php");
	//data
	//siia pääseb ligi sisseloginud kasutaja
	//kui kasutaja on sisse loginud
	//siis suunan data.php lehele

	
	$title = $price =  "";
	$title_error = $price_error = "";
	
	
	if(isset($_POST["addFood"])){
		echo "vajutati nuppu";
		if ( empty($_POST["title"]) ) {
				$title_error = "See väli on kohustuslik";
			}else{
				$title = cleanInput($_POST["title"]);
			}

			if ( empty($_POST["price"]) ) {
				$price_error = "See väli on kohustuslik";
			} else {
				
				$price = cleanInput($_POST["price"]);
				
			}
			
		if(	$title_error == "" && $price_error == "" ){
			
			echo "Sisestatud!";
				
				
				$add_response = $Food->addFood($title, $price);
				
		}
	}
	
	if(isset($_POST["createSchedule"])){
		if ( empty($_POST["name"]) ) {
					$name_error = "Field is empty";
				}else{
					$name = cleanInput($_POST["name"]);
				}
		if($name_error == ""){
			
			echo "Schedule created";
			
			$add_list_response = $Food->createSchedule($name);
		}
	}
	function cleanInput($data) {
  	$data = trim($data);
  	$data = stripslashes($data);
  	$data = htmlspecialchars($data);
  	return $data;
  }
	
	
	
?>
<?php require_once("../header.php"); ?>
<div class="container">
	<div class="row">

			
		

		<h2>Add new food</h2>
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" >
			<label for="title" >Name</label><br>
			<div class="form-group">
				<input name="title" id="title" type="text"  value="<?php echo $title; ?>"> <?php echo $title_error; ?><br><br>
			</div>
			<div class="form-group">
				<label for="price" >Price</label><br>
				<input name="price" type="text"  value="<?php echo $price; ?>"> <?php echo $price_error; ?><br><br>
			</div>
			
			<input type="submit" name="addSeries" value="Submit" class="btn btn-success">
		  </form>
	</div>
</div>
</br>
</br>
</br>
</br>

  <?php require_once("../footer.php"); ?>