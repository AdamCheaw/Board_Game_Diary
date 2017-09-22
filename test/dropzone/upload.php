<?php
include_once 'database.php';

// 檔案存放路徑
$ds          = DIRECTORY_SEPARATOR;
$storeFolder = '../upload';
$targetPath = dirname( __FILE__ ) . $ds. $storeFolder . $ds;

// 如果檔案不為空，則上傳
if (!empty($_FILES)) {
	// 處理檔案原始名稱
	$nameFile    = $_FILES['file']['name'];
	$splitName   = explode(".", $nameFile);				// 產生檔案陣列
	$nameNewFile = $splitName[0];
	// $nameExe     = end( $splitName );					// 檔案副檔名

	// 處理暫存檔名稱
	$tempFile    = $_FILES['file']['tmp_name'];			// 暫存檔資料夾位置
	// $splitName   = explode("\\", $tempFile);		    // 暫存檔陣列
	// $tempNewFile = $splitName[4];
	// $splitName   = explode(".", $tempNewFile);			// 暫存檔陣列
	// $tempNewFile = $splitName[0].".".$nameExe;			// 暫存檔名稱

	// 新檔名上傳
	$targetFile = $targetPath. $nameFile;
	if ( move_uploaded_file($tempFile, iconv("UTF-8", "big5", $targetFile) ) ) {
	    // 寫入資料庫
	    try{
	    	$sql = "INSERT INTO `myproducts` (product_name, filename)
					VALUES ('".$nameNewFile."', '".$nameFile."')";
			// Prepare statement
			$db->exec($sql);
		}
		catch(PDOException $e)
		{
			echo $sql . "<br>" . $e->getMessage();
		}
	}

	//echo "Here is some more debugging info:\n";
    //echo '<pre>';
    //print_r($_FILES);
    //echo '</pre>';
}
?> 