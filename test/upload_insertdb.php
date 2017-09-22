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
	
	
	//**存多圖的範例**//
	//$num_files = count(glob("./upload/*.jpg"));//計算總共有多少jpg檔案在此目錄裡頭
	/*for($i = 0;$i < $num_files;$i++)
	{
		$filname_string = $filname_string.basename($filename[$i])."~";//把所有檔案串成字串
		$old_filename = "./upload/".basename($filename[$i]);
		$new_filename = $img_path."/".basename($filename[$i]);
		copy("$old_filename" , "$new_filename");//複製檔案
		unlink($old_filename);//刪除存在暫存檔裡的檔案
	}*/
	
	
	//檢查是否有一樣的名字
	$sql_total = "select count(*) from boardgame_info where name ='".$name."'";
	$result_total = mysqli_query($db,$sql_total);
	$total = mysqli_fetch_row($result_total);
	$total = ceil($total[0]);
	if($total > 0)
	{	
		//傳回值
		echo "same name";
	}
	else
	{
		$name_replace = str_replace([':', '\\', '/', '*',' '],"_",$name);//取代字元
		//建立資料夾
		$img_path = "./img/".$name_replace;
		if(!is_dir($img_path) && !is_link($img_path))
		{
			if(!is_file($img_path))
			{
				mkdir($img_path);//建立資料夾
			}
		}		
		else
		{
			echo "already got file ";
		}
		//判斷有哪些jpg檔,複製與刪除	
		$filname_string = "";
		$num_files = count(glob("./upload/*.jpg"));//計算總共有多少jpg檔案在此目錄裡頭
		if($num_files > 0)
		{
			$filename = glob('./upload/*.jpg');//判斷有哪些jpg檔		
			$old_filename = "./upload/".basename($filename[0]);
			$new_filename = $img_path."/main_img.jpg";//新檔名路徑，也是存入資料庫的檔名路徑
			copy("$old_filename" , "$new_filename");//複製檔案
			unlink($old_filename);//刪除存在暫存檔裡的檔案
		}
		else
		{
			$new_filename = "";
		}
		
		$sql = "insert into boardgame_info(name, people_num, game_time, weight, description, main_img, mechanism, status, designer,img_path) 
				values ('$name', '$people_num', '$game_time', '$weight', '$description', '$new_filename', '$mechanism', '$status', '$designer','$img_path')";
		if(mysqli_query($db,$sql))
		{
			//傳回值
			echo "sucess!!";
		}
		else
		{
			//傳回值
			echo "insert boardgame_info failed";
		}
	}
?>
