<?php 
	include_once 'database.php';
    
    $result = array();
	try {
     	$results = $db->prepare("
			SELECT pid, product_name, filename
			FROM `myproducts`
			WHERE isStop = ?");
     	$results->bindValue(1, 0);
		$results->execute();
	} catch (Exception $e) {
		echo "Data could not be retrieved from the database.";
		exit;
	}

	$arrValues = $results->fetchAll(PDO::FETCH_ASSOC);
	foreach ($arrValues as $row){
        if($row['filename'] != ''){
			$str = "".$row['filename']."";
			$str = rtrim($str,',');
			$arr = explode(",",$str);
			// print_r($arr);

			foreach($arr as $file){ //get an array which has the names of all the files and loop through it 
		        $obj['name'] = $file; //get the filename in array
		        $obj['size'] = filesize(iconv("UTF-8", "big5","uploads/".$file)); //get the flesize in array
		        $result[]    = $obj; // copy it to another array
		    }
		}
	}

	// print_r($result);
	
	header('Content-Type: application/json');
	echo json_encode($result);
?>