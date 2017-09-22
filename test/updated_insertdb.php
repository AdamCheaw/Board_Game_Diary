<?php
	require "dbconnect.php";
	$name = $_POST["name"];
	$people_num = $_POST["people_num"];
	$game_time = $_POST["game_time"];
	$weight = $_POST["weight"];
	$description = $_POST["description"];
	$mechanism = $_POST["my_select"];
	$collection = $_POST["collection"];
	$own = $_POST["own"];
	$wishlist = $_POST["wishlist"];
	$designer = $_POST["designer"];
	$BID = $_POST["BID"];
	//判斷有是否有select被選
	if($mechanism != "")
	{
		$mechanism = implode(",", $mechanism);
		$mechanism = " ".$mechanism;//加入空號讓自己以後可以尋找
	}
	//判斷有哪些是否有checkbox被選
	$status = " ";
	if($collection == "true")
	{
		$status = $status."collection,";
	}
	if($own == "true")
	{
		$status = $status."own,";
	}
	if($wishlist == "true")
	{
		$status = $status."wishlist,";
	}
	//檢查是否有一樣的名字
	$sql_total = "select count(*) from boardgame_info where name ='".$name."' and BID != '".$BID."'";
	$result_total = mysqli_query($db,$sql_total);
	$total = mysqli_fetch_row($result_total);
	$total = ceil($total[0]);
	if($total > 0)
	{	
		//傳回值
		$result = "same name";
	}
	else
	{
		
		$sql = "update boardgame_info set name='$name', people_num='$people_num', game_time='$game_time', weight='$weight',
		        description='$description', mechanism='$mechanism', status='$status', designer='$designer' where BID = '".$BID."'";
		$result = mysqli_query($db,$sql) or die("update ing error");
	}
	echo $result;
?>




