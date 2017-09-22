<?php 
include_once 'database.php';

// 刪除
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$filename = $_POST['filename'];

	// 檔案存放路徑
	$upload_dir = 'upload';
	$targetPath = dirname( __FILE__ ) . DIRECTORY_SEPARATOR . $upload_dir . DIRECTORY_SEPARATOR;
	$targetFile = $targetPath. $filename;

	// 更新資料庫
	try{
		$sql = "UPDATE `myproducts` SET `isStop`=1 WHERE `filename`='".$filename."'";

		// Prepare statement
		$stmt = $db->prepare($sql);
		
		// execute the query
		$stmt->execute();
	}
	catch(PDOException $e)
	{
		echo $sql . "<br>" . $e->getMessage();
	}

	// 刪除檔案
	unlink( iconv("UTF-8", "big5", $targetFile) );
	//print_r("Successfully deleted.");
}
?>