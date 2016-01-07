<?php 
	require_once("functions.php");

	//kas kustutame
	//?delete = vastav id mida kustutada
	if(isset($_GET["delete"])){
	
		echo "Kustutame id".$_GET["delete"];
		deleteMenu($_GET["delete"]);
	
	}
	
	$keyword = "";
	if(isset($_GET["keyword"])){
		$keyword = $_GET["keyword"];
		$array_of_menus = getMenuData($_GET["keyword"]);
	}else{
	
	
	//k�ivitan funktsiooni
	$array_of_menus = getMenuData();
	}
	//tr�kin v�lja esimese auto
	//echo $array_of_menus[0]->id. " ".$array_of_menus[0]->plate;

?>

<h2>Tabel</h2>

<form action="table.php" method="get">

<input type="search" name="keyword" value="<?=$keyword;?>">
<input type="submit">

</form>


<table border=1>
	<tr>
		<th>id</th>
		<th>Title</th>
		<th>Price</th>
		<th>X</th>
		<th>edit</th>
		<th>O</th>
	</tr>
	<?php
		//tr�kime v�lja read
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
			echo "<td><a href='edit.php?edit_id=".$array_of_menus[$i]->id."'>edit.php</a></td>"; //enne ? tuleb kirjutada see kuhu me tahame et ta andme kirjutaks, siis suunab edasi teise faili
			echo "</tr>";
			}
		}
	?>