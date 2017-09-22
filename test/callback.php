<?php
	require "dbconnect.php";
	$command = $_POST["command"];
	$type = $_POST["c_value"];
	if($command == "show board")
	{
		if($type == "all")
		{
			$sql = "select * from boardgame_info ";
			$result = mysqli_query($db,$sql);
			$arr = array();
			while($row = mysqli_fetch_assoc($result));
			{
				$arr = $row;
			}
			echo json_encode($arr);
		}
	}
	
?>