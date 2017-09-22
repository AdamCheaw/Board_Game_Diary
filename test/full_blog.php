<?php
	require "dbconnect.php";
	$BID = $_GET["BID"];
	$sql = "select * from boardgame_info where BID ='".$BID."'";
	$result = mysqli_query($db,$sql)or die("search ing error");
	$row = mysqli_fetch_array($result);
	$json_string = json_encode($row);
	$json_string = json_decode($json_string);
	$num_files = count(glob("./upload/*.jpg"));//計算總共有多少jpg檔案在此目錄裡頭
	if($num_files > 0)
	{
		$filename = glob('./upload/*.jpg');//抓出所有的jpg檔,
		for($i = 0;$i < $num_files;$i++)
		{
			$old_filename = "./upload/".basename($filename[$i]);
			unlink($old_filename);//刪除存在暫存檔裡的檔案
		}
	}
	
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="Xenon Boostrap Admin Panel" />
	<meta name="author" content="" />
	
	<title>...</title>
	
	
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Arimo:400,700,400italic">
	
	<link rel="stylesheet" href="XENON/assets/css/fonts/linecons/css/linecons.css">
	<link rel="stylesheet" href="XENON/assets/css/fonts/fontawesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="XENON/assets/css/bootstrap.css">
	<link rel="stylesheet" href="XENON/assets/css/xenon-core.css">
	<link rel="stylesheet" href="XENON/assets/css/xenon-forms.css">
	<link rel="stylesheet" href="XENON/assets/css/xenon-components.css">
	<link rel="stylesheet" href="XENON/assets/css/xenon-skins.css">
	<link rel="stylesheet" href="XENON/assets/css/custom.css">
	
	<link rel="stylesheet" href="slider/css/flickity-docs.css" media="screen" />
	<script src="XENON/assets/js/jquery-1.11.1.min.js"></script>
	<link href="sweetalert/css/sweetalert.css" rel="stylesheet">
	<script >
	
	</script>
	<script language="javascript">
		function upload_images()
		{
			var BID = "<?php echo $BID;?>";
			var name = "<?php echo $json_string->name;?>";
			
			$.ajax({
				url: "upload_images.php",
				dataType: 'html',
				type: 'POST',
				data:{
					name : name,
					BID : BID
				},
				error: function(respond) {
					swal({
						title: "upload_insertdb failed",
						type: "warning"
					});
				},
				success: function(txt) { //the call back function when ajax call succeed
					location.reload();
					/*$('.modal-body').html('');
					$('.modal-body').append(txt);
					jQuery('#modal-6').modal('show', {backdrop: 'static'});	*/
				}
			})
		}
	</script>
	<script type="text/javascript">
	$(document).ready(function(){
    Dropzone.options.myDropzone = {
    	// 文件提交頁面
    	url: "dropzone/upload.php",	

    	// 限制檔案上傳數量
    	maxFiles: 10,

    	// 限制檔案上傳大小，單位是 MB
        maxFilesize: 5,

        // 允許上傳的檔案類型
		acceptedFiles: 'image/jpeg',

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
	<style type="text/css">
		body{background:#ffffff}
		.img_cell{
		  border:10px solid black;
		 }
		.main-content{font-family:monospace,Microsoft JhengHei;}
		.description-info
		{
			font-family:monospace,Microsoft JhengHei;
			margin-top:-20px;
		}
		.description-info h1{color:#4e2376;font-weight:bold;}
		.xe{margin-top:0;color:#666666; }
		.xe-icon{float: left;font-size:15px;margin-right:8px;margin-top:2px;}
		
		.xe-label p{font-size:20px;font-weight:lighter;color:#666666;line-height:20px;}
		.description-info2{margin-bottom:20px;}
		.description-info2 p{font-size:18px}
		.dl-horizontal 
		{
			*zoom: 1;
			font-size:18px;
			color:#404040;
			margin:0px;
		}
		.dl-horizontal span{font-weight:lighter;color:#737373}
		.dl-horizontal:before,
		.dl-horizontal:after 
		{
			display: table;
			line-height: 0;
			content: "";
		}
		.dl-horizontal:after 
		{
			clear: both;
		}

		.dl-horizontal dt {
			float: left;
			width:500px;
			overflow: hidden;
			clear: left;
			text-align: left;
			text-overflow: ellipsis;
			white-space: nowrap;
		}

		.dl-horizontal dd {
			margin-left: 180px;
		}
	</style>
</head>
<body class="page-body horizontal-menu-skin-white" >
	
	<nav class="navbar horizontal-menu navbar-fixed-top"><!-- set fixed position by adding class "navbar-fixed-top" -->
		<div class="navbar-inner">
		
			<!-- Navbar Brand -->
			<div class="navbar-brand">
				<a href="dashboard-1.html" class="logo">
					<img src="img/logo.png" width="90"  alt="" class="hidden-xs" />
					<img src="img/logo.png" width="70" height="25" alt="" class="visible-xs" />
				</a>
				<a href="#" data-toggle="settings-pane" data-animate="true">
					<i class="linecons-cog"></i>
				</a>
			</div>
				
			<!-- Mobile Toggles Links -->
			<div class="nav navbar-mobile">
			
				<!-- This will toggle the mobile menu and will be visible only on mobile devices -->
				<div class="mobile-menu-toggle">
					<!-- This will open the popup with user profile settings, you can use for any purpose, just be creative -->
					<a href="#" data-toggle="settings-pane" data-animate="true">
						<i class="linecons-cog"></i>
					</a>
					
					<a href="#" data-toggle="user-info-menu-horizontal">
						<i class="fa-bell-o"></i>
						<span class="badge badge-success">7</span>
					</a>
					
					<!-- data-toggle="mobile-menu-horizontal" will show horizontal menu links only -->
					<!-- data-toggle="mobile-menu" will show sidebar menu links only -->
					<!-- data-toggle="mobile-menu-both" will show sidebar and horizontal menu links -->
					<a href="#" data-toggle="mobile-menu-horizontal">
						<i class="fa-bars"></i>
					</a>
				</div>
				
			</div>
			
			<div class="navbar-mobile-clear"></div>
			<!-- main menu -->
					
			<ul class="navbar-nav">
				<li>
					<a href="">
						<i class="linecons-diamond"></i>
						<span class="title">Other</span>
					</a>
					<ul>
						<li>
							<a href="ui-widgets.html">
								<i class="linecons-star"></i>
								<span class="title">Widgets</span>
							</a>
						</li>
						<li>
							<a href="mailbox-main.html">
								<i class="linecons-mail"></i>
								<span class="title">Mailbox</span>
								<span class="label label-success pull-right">5</span>
							</a>
							<ul>
								<li>
									<a href="mailbox-main.html">
										<span class="title">Inbox</span>
									</a>
								</li>
								<li>
									<a href="mailbox-compose.html">
										<span class="title">Compose Message</span>
									</a>
								</li>
								<li>
									<a href="mailbox-message.html">
										<span class="title">View Message</span>
									</a>
								</li>
							</ul>
						</li>
						<li>
							<a href="tables-basic.html">
								<i class="linecons-database"></i>
								<span class="title">Tables</span>
							</a>
							<ul>
								<li>
									<a href="tables-basic.html">
										<span class="title">Basic Tables</span>
									</a>
								</li>
								<li>
									<a href="tables-responsive.html">
										<span class="title">Responsive Table</span>
									</a>
								</li>
								<li>
									<a href="tables-datatables.html">
										<span class="title">Data Tables</span>
									</a>
								</li>
							</ul>
						</li>
						<li>
							<a href="extra-gallery.html">
								<i class="linecons-beaker"></i>
								<span class="title">Extra</span>
								<span class="label label-purple pull-right hidden-collapsed">New Items</span>
							</a>
							<ul>
								<li>
									<a href="extra-icons-fontawesome.html">
										<span class="title">Icons</span>
										<span class="label label-warning pull-right">4</span>
									</a>
									<ul>
										<li>
											<a href="extra-icons-fontawesome.html">
												<span class="title">Font Awesome</span>
											</a>
										</li>
										<li>
											<a href="extra-icons-linecons.html">
												<span class="title">Linecons</span>
											</a>
										</li>
										<li>
											<a href="extra-icons-elusive.html">
												<span class="title">Elusive</span>
											</a>
										</li>
										<li>
											<a href="extra-icons-meteocons.html">
												<span class="title">Meteocons</span>
											</a>
										</li>
									</ul>
								</li>
								<li>
									<a href="extra-maps-google.html">
										<span class="title">Maps</span>
									</a>
									<ul>
										<li>
											<a href="extra-maps-google.html">
												<span class="title">Google Maps</span>
											</a>
										</li>
										<li>
											<a href="extra-maps-advanced.html">
												<span class="title">Advanced Map</span>
											</a>
										</li>
										<li>
											<a href="extra-maps-vector.html">
												<span class="title">Vector Map</span>
											</a>
										</li>
									</ul>
								</li>
								<li>
									<a href="extra-gallery.html">
										<span class="title">Gallery</span>
									</a>
								</li>
								<li>
									<a href="extra-calendar.html">
										<span class="title">Calendar</span>
									</a>
								</li>
								<li>
									<a href="extra-profile.html">
										<span class="title">Profile</span>
									</a>
								</li>
								<li>
									<a href="extra-login.html">
										<span class="title">Login</span>
									</a>
								</li>
								<li>
									<a href="extra-lockscreen.html">
										<span class="title">Lockscreen</span>
									</a>
								</li>
								<li>
									<a href="extra-login-light.html">
										<span class="title">Login Light</span>
									</a>
								</li>
								<li>
									<a href="extra-timeline.html">
										<span class="title">Timeline</span>
									</a>
								</li>
								<li>
									<a href="extra-timeline-center.html">
										<span class="title">Timeline Centerd</span>
									</a>
								</li>
								<li>
									<a href="extra-notes.html">
										<span class="title">Notes</span>
									</a>
								</li>
								<li>
									<a href="extra-image-crop.html">
										<span class="title">Image Crop</span>
									</a>
								</li>
								<li>
									<a href="extra-portlets.html">
										<span class="title">Portlets</span>
									</a>
								</li>
								<li>
									<a href="blank-sidebar.html">
										<span class="title">Blank Page</span>
									</a>
								</li>
								<li>
									<a href="extra-search.html">
										<span class="title">Search</span>
									</a>
								</li>
								<li>
									<a href="extra-invoice.html">
										<span class="title">Invoice</span>
									</a>
								</li>
								<li>
									<a href="extra-not-found.html">
										<span class="title">404 Page</span>
									</a>
								</li>
								<li>
									<a href="extra-tocify.html">
										<span class="title">Tocify</span>
									</a>
								</li>
								<li>
									<a href="extra-loader.html">
										<span class="title">Loading Progress</span>
									</a>
								</li>
								<li>
									<a href="extra-page-loading-ol.html">
										<span class="title">Page Loading Overlay</span>
									</a>
								</li>
								<li>
									<a href="extra-notifications.html">
										<span class="title">Notifications</span>
									</a>
								</li>
								<li>
									<a href="extra-nestable-lists.html">
										<span class="title">Nestable Lists</span>
									</a>
								</li>
								<li>
									<a href="extra-scrollable.html">
										<span class="title">Scrollable</span>
									</a>
								</li>
							</ul>
						</li>
						<li>
							<a href="charts-main.html">
								<i class="linecons-globe"></i>
								<span class="title">Charts</span>
							</a>
							<ul>
								<li>
									<a href="charts-main.html">
										<span class="title">Chart Variants</span>
									</a>
								</li>
								<li>
									<a href="charts-range.html">
										<span class="title">Range Selector</span>
									</a>
								</li>
								<li>
									<a href="charts-sparklines.html">
										<span class="title">Sparklines</span>
									</a>
								</li>
								<li>
									<a href="charts-map.html">
										<span class="title">Map Charts</span>
									</a>
								</li>
								<li>
									<a href="charts-gauges.html">
										<span class="title">Circular Gauges</span>
									</a>
								</li>
								<li>
									<a href="charts-bar-gauges.html">
										<span class="title">Bar Gauges</span>
									</a>
								</li>
							</ul>
						</li>
						<li>
							<a href="#">
								<i class="linecons-cloud"></i>
								<span class="title">Menu Levels</span>
							</a>
							<ul>
								<li>
									<a href="#">
										<i class="entypo-flow-line"></i>
										<span class="title">Menu Level 1.1</span>
									</a>
									<ul>
										<li>
											<a href="#">
												<i class="entypo-flow-parallel"></i>
												<span class="title">Menu Level 2.1</span>
											</a>
										</li>
										<li>
											<a href="#">
												<i class="entypo-flow-parallel"></i>
												<span class="title">Menu Level 2.2</span>
											</a>
											<ul>
												<li>
													<a href="#">
														<i class="entypo-flow-cascade"></i>
														<span class="title">Menu Level 3.1</span>
													</a>
												</li>
												<li>
													<a href="#">
														<i class="entypo-flow-cascade"></i>
														<span class="title">Menu Level 3.2</span>
													</a>
													<ul>
														<li>
															<a href="#">
																<i class="entypo-flow-branch"></i>
																<span class="title">Menu Level 4.1</span>
															</a>
														</li>
													</ul>
												</li>
											</ul>
										</li>
										<li>
											<a href="#">
												<i class="entypo-flow-parallel"></i>
												<span class="title">Menu Level 2.3</span>
											</a>
										</li>
									</ul>
								</li>
								<li>
									<a href="#">
										<i class="entypo-flow-line"></i>
										<span class="title">Menu Level 1.2</span>
									</a>
								</li>
								<li>
									<a href="#">
										<i class="entypo-flow-line"></i>
										<span class="title">Menu Level 1.3</span>
									</a>
								</li>
							</ul>
						</li>
					</ul>
				</li>
			</ul>
					
			
			<!-- notifications and other links -->
			<ul class="nav nav-userinfo navbar-right">
				
				<li class="search-form"><!-- You can add "always-visible" to show make the search input visible -->
			
					<form method="get" action="extra-search.html">
						<input type="text" name="s" class="form-control search-field" placeholder="Type to search..." />
						
						<button type="submit" class="btn btn-link">
							<i class="linecons-search"></i>
						</button>
					</form>
					
				</li>
				
				<li class="dropdown xs-left">
					
					<a href="#" data-toggle="dropdown" class="notification-icon">
						<i class="fa-envelope-o"></i>
						<span class="badge badge-green">15</span>
					</a>
						
					<ul class="dropdown-menu messages">
										<li>
							
						<ul class="dropdown-menu-list list-unstyled ps-scrollbar">
						
							<li class="active"><!-- "active" class means message is unread -->
								<a href="#">
									<span class="line">
										<strong>Luc Chartier</strong>
										<span class="light small">- yesterday</span>
									</span>
									
									<span class="line desc small">
										This ain’t our first item, it is the best of the rest.
									</span>
								</a>
							</li>
							
							<li class="active">
								<a href="#">
									<span class="line">
										<strong>Salma Nyberg</strong>
										<span class="light small">- 2 days ago</span>
									</span>
									
									<span class="line desc small">
										Oh he decisively impression attachment friendship so if everything. 
									</span>
								</a>
							</li>
							
							<li>
								<a href="#">
									<span class="line">
										Hayden Cartwright
										<span class="light small">- a week ago</span>
									</span>
									
									<span class="line desc small">
										Whose her enjoy chief new young. Felicity if ye required likewise so doubtful.
									</span>
								</a>
							</li>
							
							<li>
								<a href="#">
									<span class="line">
										Sandra Eberhardt
										<span class="light small">- 16 days ago</span>
									</span>
									
									<span class="line desc small">
										On so attention necessary at by provision otherwise existence direction.
									</span>
								</a>
							</li>
							
							<!-- Repeated -->
							
							<li class="active"><!-- "active" class means message is unread -->
								<a href="#">
									<span class="line">
										<strong>Luc Chartier</strong>
										<span class="light small">- yesterday</span>
									</span>
									
									<span class="line desc small">
										This ain’t our first item, it is the best of the rest.
									</span>
								</a>
							</li>
							
							<li class="active">
								<a href="#">
									<span class="line">
										<strong>Salma Nyberg</strong>
										<span class="light small">- 2 days ago</span>
									</span>
									
									<span class="line desc small">
										Oh he decisively impression attachment friendship so if everything. 
									</span>
								</a>
							</li>
							
							<li>
								<a href="#">
									<span class="line">
										Hayden Cartwright
										<span class="light small">- a week ago</span>
									</span>
									
									<span class="line desc small">
										Whose her enjoy chief new young. Felicity if ye required likewise so doubtful.
									</span>
								</a>
							</li>
							
							<li>
								<a href="#">
									<span class="line">
										Sandra Eberhardt
										<span class="light small">- 16 days ago</span>
									</span>
									
									<span class="line desc small">
										On so attention necessary at by provision otherwise existence direction.
									</span>
								</a>
							</li>
							
						</ul>
						
					</li>
					
					<li class="external">
						<a href="blank-sidebar.html">
							<span>All Messages</span>
							<i class="fa-link-ext"></i>
						</a>
					</li>
					</ul>
					
				</li>
				
				<li class="dropdown xs-left">
					<a href="#" data-toggle="dropdown" class="notification-icon notification-icon-messages">
						<i class="fa-bell-o"></i>
						<span class="badge badge-purple">7</span>
					</a>
						
					<ul class="dropdown-menu notifications">
										<li class="top">
						<p class="small">
							<a href="#" class="pull-right">Mark all Read</a>
							You have <strong>3</strong> new notifications.
						</p>
					</li>
					
					<li>
						<ul class="dropdown-menu-list list-unstyled ps-scrollbar">
							<li class="active notification-success">
								<a href="#">
									<i class="fa-user"></i>
									
									<span class="line">
										<strong>New user registered</strong>
									</span>
									
									<span class="line small time">
										30 seconds ago
									</span>
								</a>
							</li>
							
							<li class="active notification-secondary">
								<a href="#">
									<i class="fa-lock"></i>
									
									<span class="line">
										<strong>Privacy settings have been changed</strong>
									</span>
									
									<span class="line small time">
										3 hours ago
									</span>
								</a>
							</li>
							
							<li class="notification-primary">
								<a href="#">
									<i class="fa-thumbs-up"></i>
									
									<span class="line">
										<strong>Someone special liked this</strong>
									</span>
									
									<span class="line small time">
										2 minutes ago
									</span>
								</a>
							</li>
							
							<li class="notification-danger">
								<a href="#">
									<i class="fa-calendar"></i>
									
									<span class="line">
										John cancelled the event
									</span>
									
									<span class="line small time">
										9 hours ago
									</span>
								</a>
							</li>
							
							<li class="notification-info">
								<a href="#">
									<i class="fa-database"></i>
									
									<span class="line">
										The server is status is stable
									</span>
									
									<span class="line small time">
										yesterday at 10:30am
									</span>
								</a>
							</li>
							
							<li class="notification-warning">
								<a href="#">
									<i class="fa-envelope-o"></i>
									
									<span class="line">
										New comments waiting approval
									</span>
									
									<span class="line small time">
										last week
									</span>
								</a>
							</li>
						</ul>
					</li>
					
					<li class="external">
						<a href="#">
							<span>View all notifications</span>
							<i class="fa-link-ext"></i>
						</a>
					</li>
					</ul>
				</li>
		
				<li class="dropdown user-profile">
					<a href="#" data-toggle="dropdown">
						<img src="assets/images/user-1.png" alt="user-image" class="img-circle img-inline userpic-32" width="28" />
						<span>
							Arlind Nushi
							<i class="fa-angle-down"></i>
						</span>
					</a>
					
					<ul class="dropdown-menu user-profile-menu list-unstyled">
						<li>
							<a href="#edit-profile">
								<i class="fa-edit"></i>
								New Post
							</a>
						</li>
						<li>
							<a href="#settings">
								<i class="fa-wrench"></i>
								Settings
							</a>
						</li>
						<li>
							<a href="#profile">
								<i class="fa-user"></i>
								Profile
							</a>
						</li>
						<li>
							<a href="#help">
								<i class="fa-info"></i>
								Help
							</a>
						</li>
						<li class="last">
							<a href="extra-lockscreen.html">
								<i class="fa-lock"></i>
								Logout
							</a>
						</li>
					</ul>
				</li>
				
				<li>
					<a href="#" data-toggle="chat">
						<i class="fa-comments-o"></i>
					</a>
				</li>
				
			</ul>
	
		</div>
	</nav>
	<div class="page-container container">
		<div class="main-content" >
			<div class="page-title ">
				<div class="title-env">
					<h1 class="title">Boardgame's overview</h1>
					<p class="description">About <?php echo $json_string->name?></p>
				</div>				
				<div class="breadcrumb-env">
					<ol class="breadcrumb bc-1">
						<li>
							<a href="index.html"><i class="fa-home"></i>Home</a>
						</li>
						<li>						
							<a href="open.php" >Boardgames</a>
						</li>
						<li class="active">
							<strong>Advanced Detail</strong>
						</li>
					</ol>								
				</div>					
			</div>
			<div class="col-md-2">
			</div>
			<div class="col-md-8 col-sm-12">
			
			<div class="gallery gallery--images-demo half-width-margin js-flickity"
						data-flickity-options='{ "imagesLoaded": true, "percentPosition": false ,
						"wrapAround": true,"freeScroll": true, "autoPlay":true, "pageDots": false}'>
				<?php
					//判斷是否會有空圖的情況
					if($json_string->images == null||$json_string->images == "")
					{
						if($json_string->main_img == null||$json_string->main_img == "")
						{
							echo "<img src='img/no-image.gif'/>";
						}
						else	
						{
							echo "<img src='".$json_string->main_img."'/>";
						}
						echo "<img src='img/no-image.gif'/>";
						echo "<img src='img/no-image.gif'/>";
						echo "<img src='img/no-image.gif'/>";
					}
					else
					{
						if($json_string->main_img == null||$json_string->main_img == "")
						{
							echo "<img src='img/no-image.gif'/>";
						}
						else	
						{
							echo "<img src='".$json_string->main_img."'/>";
						}
						$images = explode("~", $json_string->images);//分割記錄圖片的字串放到array
						$num = count($images);//計算陣列多大
						for($i = 0; $i < $num;$i++)
						{
							if($images[$i]!= "")
							{
								echo "<img src='".$json_string->img_path."/".$images[$i]."'/>";//設好路徑並印出圖片名字
							}
						}
					}
				?>
				
			</div>
			<div class="description-info">
			<div class="row">
			
				<div class="col-lg-12 col-sm-12">
					<?php echo "<h1>".$json_string->name."<small> (2017)</small></h1>";?>
					
				</div>
				
				<div class="col-lg-3 col-sm-3">
					<div class="xe" >
						<div class="xe-icon" >
							<i class="fa-user"></i>
						</div>
						<div class="xe-label">
							<p><?php echo $json_string->people_num?></p>
							<p>(Players)</p>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-sm-3">
					<div class="xe">
						<div class="xe-icon" >
							<i class="fa-bell" ></i>
						</div>
						<div class="xe-label">
							<p><?php echo $json_string->game_time?> Min</p>
							<p>(Play Time)</p>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-sm-3">
					<div class="xe">
						<div class="xe-icon" >
							<i class="fa-star" ></i>
						</div>
						<div class="xe-label">
							<p><?php echo $json_string->weight ?></p>
							<p>(Complexity)</p>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-sm-3 ">
					<a href="javascript:;" onclick="jQuery('#modal-6').modal('show', {backdrop: 'static'});" >
						<button class=" btn btn-purple btn-icon ">
							<i class="fa-upload" style="margin-right:4px;"></i>
							<span>Upload Img</span>
						</button>
					</a>
					<a href='edit.php?BID=<?php echo $BID ?>'><button class=" btn btn-purple btn-icon "><i class="fa-edit" style="margin-right:4px;"></i><span>Edit</span></button></a>
				</div>
			</div>
			<hr style="margin:0px;margin-bottom:15px;height:1px;border:1px;background-color:#cccccc;color:#cccccc;"/>
			<div class="row">
				<div class="col-lg-12 description-info2">
				
					<dl class="dl-horizontal">
						<dt>Designer : <span>Use Rosebern</span></dt>
						<dt>Artist : <span>Use Rosebern</span></dt>
						<dt>Artwork/Presentation : <span>美術不錯。。。。</span></dt>
					
					</dl>
					<hr style="margin:15px 0px;height:1px;border:1px;background-color:#cccccc;color:#cccccc;"/>
					<h4 style="font-weight:bold;color:#404040;">Description</h4>
					<p>
						Lorem ipsum dolor sit amet, no vix sint solet, et ius utinam deseruisse intellegam, ne pro modus vitae tation. Vis ex soluta tritani. Ne pro esse facete expetendis, laudem eirmod minimum nec in. Est quidam urbanitas gloriatur no, eu unum suscipit disputando eam, nam bonorum facilisi ut. 
						Putent efficiantur et pri, eu primis laoreet eum, ut malis everti mel.
					</p>
					<p>
						Ne utroque prodesset mei, mea no aliquam utroque. Has ne tation argumentum. Vis ex insolens reformidans, mea semper impetus argumentum ad. Sea erroribus sadipscing in. Mel cu dolore admodum accumsan, mea timeam perpetua disputationi ne, urbanitas prodesset ex vel.
	
						Ei nostro molestiae moderatius cum. Adhuc persius dolores ut sed, quis vidisse vituperata duo in. Quot signiferumque eos cu, ad dissentiet theophrastus has, eum tota utroque nusquam te. Ei elit eirmod delicata pri. Solet affert theophrastus pro ei, ius enim homero deleniti te.
					</p>
					<hr style="margin:10px 0px;height:1px;border:1px;background-color:#cccccc;color:#cccccc;"/>
				</div>
			</div>
			</div>
		</div>
		</div>
	</div>
	<div class="page-loading-overlay">
		<div class="loader-2"></div>
	</div>
	<!-- Modal 6 (Long Modal)-->
	<div class="modal fade" id="modal-5">
		<div class="modal-dialog">
			<div class="modal-content">
				
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Modal Content is Responsive</h4>
				</div>
				
				<div class="modal-body">
					測試。。。
				</div>
				
				<div class="modal-footer">
					<a href="javascript:;" onclick="jQuery('#modal-5').modal('show', {backdrop: 'static'});"><button type="button" class="btn btn-purple" >Upload</button></a>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="modal-6">
		<div class="modal-dialog">
			<div class="modal-content">
				
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Modal Content is Responsive</h4>
				</div>
				
				<div class="modal-body">
					<form id="my-dropzone" action="dropzone/upload.php" class="dropzone form-horizontal"></form>
				</div>
				
				<div class="modal-footer">
					<a href="javascript:;" onclick="upload_images()"><button type="button" class="btn btn-purple" >Upload</button></a>
				</div>
			</div>
		</div>
	</div>
	<!-- Imported styles on this page -->
	<link rel="stylesheet" href="XENON/assets/css/fonts/elusive/css/elusive.css">
	<link rel="stylesheet" href="XENON/assets/js/dropzone/css/dropzone.css">
	<!-- Bottom Scripts -->
	<script src="XENON/assets/js/bootstrap.min.js"></script>
	<script src="XENON/assets/js/TweenMax.min.js"></script>
	<script src="XENON/assets/js/resizeable.js"></script>
	<script src="XENON/assets/js/joinable.js"></script>
	<script src="XENON/assets/js/xenon-api.js"></script>
	<script src="XENON/assets/js/xenon-toggles.js"></script>


	<!-- Imported scripts on this page -->
	<script src="XENON/assets/js/dropzone/dropzone.min.js"></script>
	<script src="sweetalert/js/sweetalert.min.js"></script>
	<script src="XENON/assets/js/xenon-widgets.js"></script>
	<script src="XENON/assets/js/devexpress-web-14.1/js/globalize.min.js"></script>
	<script src="XENON/assets/js/devexpress-web-14.1/js/dx.chartjs.js"></script>
	<!-- JavaScripts initializations and stuff -->
	<script src="XENON/assets/js/xenon-custom.js"></script>
	<script src="slider/js/flickity-docs.min.js"></script>
</body>
</html>