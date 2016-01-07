<?php 
	
	require_once("../config_global.php");
	$database = "if15_kar1ns";
	
	session_start();
	
	$mysqli = new mysqli($servername, $server_username, $server_password, $database);
	
	
	function dropdown($episode_id){
		
		$html = "";
		
		$html .= '<select name="new_dd_selection">';
		//$html .= '<option>1</option>';
		//$html .= '<option>2</option>';
		//$html .= '<option>3</option>';
		//$html .= '<option selected>3</option>';
		$mysqli = new mysqli($GLOBALS["servername"], $GLOBALS["server_username"], $GLOBALS["server_password"], $GLOBALS["database"]);
		$stmt = $mysqli->prepare("SELECT id, name FROM user_list where user_id=?");
		// SELECT user_list.id, user_list.name FROM user_list RIGHT JOIN series_list on user_list.id = series_list.list_id WHERE series_list.episode_id IS NULL AND  user_list.user_id=6
		$stmt->bind_param("i", $_SESSION["logged_in_user_id"]);
		$stmt->bind_result($id, $name);
		$stmt->execute();
		
		while($stmt->fetch()){
			$html .= '<option value="'.$id.'">'.$name.'</option>';
			
		}
		
		
		$html .= '</select>';
		
		return $html;
	}
	

	
?>