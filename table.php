<?php 
	require_once("functions.php");

	//kas kustutame
	//?delete = vastav id mida kustutada
	if(isset($_GET["delete"])){
	
		echo "Kustutame id".$_GET["delete"];
		deleteFood($_GET["delete"]);
	
	}
	
	$array_of_menus = getMenuData();
	//trükin välja esimese auto
	//echo $array_of_menus[0]->id. " ".$array_of_menus[0]->plate;

?>

<h2>Tabel</h2>




<table border=1>
	<tr>
		<th>id</th>
		<th>Title</th>
		<th>Price</th>
		<th>X</th>
		<th>edit</th>
		<th>Lisa menüüsse</th>
	</tr>
	<?php
		//trükime välja read
		//
		for($i = 0; $i < count($array_of_menus); $i++){
			//echo $array_of_menus[$i]->id;
			
			if(isset($_GET["edit"]) && $array_of_menus[$i]->id == $_GET["edit"]){
			
				echo "<tr>";
				echo "<form action='table.php' method='post'>";
				echo "<input type='hidden' name='id' value='".$array_of_menus[$i]->id."'>";
				echo "<td>".$array_of_menus[$i]->id."</td>";
				echo "<td><input name='title' value='".$array_of_menus[$i]->title."'></td>";
				echo "<td><input name='price' value='".$array_of_menus[$i]->price."'></td>";
				echo "<td><a href='table.php'>candel</a></td>";
				echo "<td><input type='submit' name='save'></td>";
				
				echo "</tr>";
			
			}else{
			
			echo "<tr>";
			echo "<td>".$array_of_menus[$i]->id."</td>";
			echo "<td>".$array_of_menus[$i]->title."</td>";
			echo "<td>".$array_of_menus[$i]->price."</td>";
			echo "<td><a href='?delete=".$array_of_menus[$i]->id."'>X</a></td>";
			echo "<td><a href='?edit=".$array_of_menus[$i]->id."'>edit</a></td>";
			
			echo "<td><a href='?add=".$array_of_menus[$i]->id."'>Lisa</a></td>";
					
					if(isset($_GET["add"]) && $array_of_menus[$i]->id == $_GET["add"]){
						echo "<td>"; ?>
							
							<form method="post">
								<input type="hidden" name="add" value="<?=$_GET["add"];?>" type="text">
								<?php echo dropdown($_GET["add"]); ?>
								<input type="submit" name="createList" value="Submit">
							</form>

						<?php echo "</td>";
					} 
			
			echo "</tr>";
			}
		}
	?>