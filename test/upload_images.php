<?php
	require "dbconnect.php";
	$name = $_POST["name"];
	$BID = $_POST["BID"];
	//先抓出原有哪些圖片
	$sql = "select images from boardgame_info where BID ='".$BID."'";
	$result = mysqli_query($db,$sql);
	$row = mysqli_fetch_array($result);
	if($row['images'] == null || $row['images'] == "")
	{
		$filename_string = "";
	}
	else
	{
		$filename_string = $row['images'];
	}
	$img_path = "./img/".$name."/";//設定要存放的路徑
	//判斷有哪些jpg檔,複製與刪除
	$num_files = count(glob("./upload/*.jpg"));//計算總共有多少jpg檔案在此目錄裡頭
	if($num_files > 0)
	{
		$filename = glob('./upload/*.jpg');//判斷有哪些jpg檔
		for($i = 0;$i < $num_files;$i++)
		{
			$old_filename = "./upload/".basename($filename[$i]);
			$new_filename = $img_path.basename($filename[$i]);//新檔名路徑，也是存入資料庫的檔名路徑
			copy("$old_filename" , "$new_filename");//複製檔案
			unlink($old_filename);//刪除存在暫存檔裡的檔案
			$filename_string = $filename_string."~".basename($filename[$i]);
		}
		$sql = "update boardgame_info set images = '$filename_string' where BID = '$BID'";
		$result=mysqli_query($db,$sql) or die("update ing error");
		echo $result;
	}
	
?>