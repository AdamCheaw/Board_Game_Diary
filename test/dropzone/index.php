<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />
<title>Demo Page</title>
<!-- Mainly css -->
<link rel="stylesheet" href="css/bootstrap.min.css" />
<!-- DROPZONE -->
<link rel="stylesheet" href="css/dropzone.css" />
</head>
<body>
<div class="container">
	<div id="my-dropzone" class="dropzone"></div>
</div>

<!-- Mainly scripts -->
<script src="js/jquery_2.1.4.min.js"></script>
<!-- DROPZONE -->
<script src="js/dropzone.js"></script>
<script>
$(document).ready(function(){
    Dropzone.options.myDropzone = {
    	// 文件提交頁面
    	url: "upload.php",	

    	// 限制檔案上傳數量
    	maxFiles: 10,

    	// 限制檔案上傳大小，單位是 MB
        maxFilesize: 1,

        // 允許上傳的檔案類型
		acceptedFiles: 'image/jpeg, image/png',

		// 翻譯選項
        dictDefaultMessage          : "將檔案拖放到這裡 (或這裡點擊)",
        dictFallbackMessage         : "您的瀏覽器不支援拖放檔案上傳",
        dictFallbackText            : "您的瀏覽器不支援拖放檔案上傳",
        dictFileTooBig              : "檔案大小限制：{{maxFilesize}}MB, 檔案太大 ({{filesize}}MB)",
        dictInvalidFileType         : "您可以上傳 jpg, jpeg, png 圖檔",
        dictCancelUpload            : "取消上傳",
        dictCancelUploadConfirmation: "您確定取消上傳這張圖檔嗎？",
        dictRemoveFile              : "刪除檔案",
        dictRemoveFileConfirmation  : "您確定刪除這張圖檔嗎？",
        dictMaxFilesExceeded        : "檔案個數限制：10",

        init: function() {
            var myDropzone = this;

            // Delete files
            this.on('removedfile', function(file) {
                var file_name = file.name;
                $.ajax({
                    type: 'POST',
                    url: 'delete.php',
                    data: { 'filename': file_name },
                    success: function(report) {
                        console.log(report);
                    },
                    error: function(report) {
                        console.log(report);
                    }
                });
            });
            //End Delete files

            //Added Code
            $.getJSON('upload_get.php', function(data) { // get the json response

                $.each(data, function(key,value){ //loop through it
                    // here we get the file name and size as response 
                    var mockFile = { name: value.name, size: value.size };

                    myDropzone.options.addedfile.call(myDropzone, mockFile);

                    //uploadsfolder is the folder where you have all those uploaded files
                    myDropzone.options.thumbnail.call(myDropzone, mockFile, "upload/"+value.name);
                });
            });
            //End added code

        }
    }
});
</script>
</body>
</html>