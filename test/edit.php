<?php
	require "dbconnect.php";
	$BID = $_GET["BID"];
	$sql = "select * from boardgame_info where BID ='".$BID."'";
	$result = mysqli_query($db,$sql)or die("search ing error");
	$row = mysqli_fetch_array($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="Xenon Boostrap Admin Panel" />
	<meta name="author" content="" />
	
	<title>。</title>
	
	
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Arimo:400,700,400italic">
	
	<link rel="stylesheet" href="XENON/assets/css/fonts/linecons/css/linecons.css">
	<link rel="stylesheet" href="XENON/assets/css/fonts/fontawesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="XENON/assets/css/bootstrap.css">
	<link rel="stylesheet" href="XENON/assets/css/xenon-core.css">
	<link rel="stylesheet" href="XENON/assets/css/xenon-forms.css">
	<link rel="stylesheet" href="XENON/assets/css/xenon-components.css">
	<link rel="stylesheet" href="XENON/assets/css/xenon-skins.css">
	<link rel="stylesheet" href="XENON/assets/css/custom.css">
	
	<link href="sweetalert/css/sweetalert.css" rel="stylesheet">
	<script src="XENON/assets/js/jquery-1.11.1.min.js"></script>
	<script type="text/javascript">
	jQuery(document).ready(function($)
	{
		$('input.icheck-11').iCheck({
			checkboxClass: 'icheckbox_square-purple',
			radioClass: 'iradio_square-yellow'
		});
	});
	</script>
	<script language="javascript">
		function updated()
		{
			
			$.ajax({
				url: "updated_insertdb.php",
				dataType: 'html',
				type: 'POST',
				data: {
					name : $('#name').val(),
					people_num : $('#people_num').val(),
					game_time : $('#game_time').val(),
					weight : $('#weight').val(),
					description : $('#description').val(),
					my_select : $('#multi-select').val(),
					designer : $('#designer').val(),
					collection : $('#collection').prop('checked'),
					own : $('#own').prop('checked'),
					wishlist : $('#wishlist').prop('checked'),
					BID : <?php echo $BID; ?>
					
					//$('#collection').val()+", "+$('#own').val()+", "+$('#wishlist').val()
				},
				error: function(respond) {
					
					swal({
						title: "upload_insertdb failed",
						type: "warning"
					});
				},
				success: function(txt) { //the call back function when ajax call succeed
					/*swal({
						title: "upload_insertdb failed",
						type: "success"
					});*/
					if(txt != 1)
					{
						swal({
							title: txt,
							type: "error"
						});
					}
					else
					{
						swal({
							title: "Success!",
							type: "success"
						});
					}
					
				}				
			})	
		}
		
		
		
	</script>
	<style>
		/*body{background-color:#ffffff};*/
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
			<div class="col-sm-1">
			</div>
			<div class="col-sm-11" >
				<a href="full_blog.php?BID=<?php echo $BID ?>" class="btn btn-white btn-single " style="margin-bottom:10px;">Back</a>
			</div>
			<div class="col-sm-1">
			</div>
			<div class="col-sm-10">
				<div class="panel panel-default " >
					<div class="panel-heading">
						<h3 class="panel-title">Edit - <?php echo $row['name']; ?></h3>
						
						<div class="panel-options">
							<a href="#" data-toggle="panel">
								
								<span class="collapse-icon">&ndash;</span>
								<span class="expand-icon">+</span>
							</a>
							<a href="#" data-toggle="remove">
								&times;
							</a>
						</div>
					</div>
				<div class="panel-body ">
					<form role="form" class="form-horizontal ">
						<div class="form-group ">
							<label class="col-sm-2 control-label " for="name">Name</label>		
							<div class="col-sm-9">
								<input type="text" class="form-control" id="name" placeholder="" data-validate="required" value="<?php echo $row['name']; ?>">
							</div>
						</div>
						<div class="form-group-separator"></div>
						<div class="form-group">
							<label class="col-sm-2 control-label" for="people_num">People</label>		
							<div class="col-sm-9">
								<input type="text" class="form-control" id="people_num" placeholder="ex: 2-4" value="<?php echo $row['people_num']; ?>">
							</div>
						</div>
						<div class="form-group-separator"></div>
						<div class="form-group">
							<label class="col-sm-2 control-label" for="game_time">Playing Time</label>		
							<div class="col-sm-9">
								<input type="text" class="form-control" id="game_time" placeholder="ex: 40-60" value="<?php echo $row['game_time']; ?>">
							</div>
						</div>
						<div class="form-group-separator"></div>
						<div class="form-group">
							<label class="col-sm-2 control-label" for="designer">Designer</label>		
							<div class="col-sm-9">
								<input type="text" class="form-control" id="designer" placeholder="<?php echo $row['designer']; ?>">
							</div>
						</div>
						<div class="form-group-separator"></div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Complexity</label>
							<div class="col-sm-9">
								<select id="weight"class="form-control">
								<?php
									//選取之前選過的值
									$option_value = array('1 (light)','2 (medium light)','3 (medium)','4 (medium heavy)','5 (heavy)');
									$num = count($option_value);
									for($i = 0;$i < $num;$i++)
									{
										if($row['weight'] == $option_value[$i])
										{
											echo "<option selected>".$option_value[$i]."</option>";
										}
										else
										{
											echo "<option>".$option_value[$i]."</option>";
										}
								
									}
								?>
								</select>
							</div>
						</div>
						
						<div class="form-group-separator"></div>
						<div class="form-group">
							<label class="col-sm-2 control-label" for="tagsinput-1">Mechanism</label>
							<div class="col-sm-9">
								<script type="text/javascript">
									jQuery(document).ready(function($)
									{
										$("#multi-select").multiSelect({
											afterInit: function()
											{
												// Add alternative scrollbar to list
												this.$selectableContainer.add(this.$selectionContainer).find('.ms-list').perfectScrollbar();
											},
											afterSelect: function()
											{
												// Update scrollbar size
												this.$selectableContainer.add(this.$selectionContainer).find('.ms-list').perfectScrollbar('update');
											}
										});
									});
								</script>
								<select class="form-control" multiple="multiple" id="multi-select" name="my_select[]">
									<?php
										$option_value = array('Area Control / Area Influence','Auction/Bidding','Card Drafting','Co-operative Play',
															  'Deck / Pool Building','Dice Rolling','Grid Movement','Hand Management','Pick-up and Deliver',
															  'Point to Point Movement','Press Your Luck','Role Playing','Set Collection',
															  'Storytelling','Tile Placement','Variable Player Powers','Worker Placement',);
										$num = count($option_value);
										for($i = 0;$i < $num;$i++)
										{
											if(strpos($row['mechanism'], $option_value[$i] ))
											{
												echo "<option selected>".$option_value[$i]."</option>";
												
											}
											else
											{
												echo "<option>".$option_value[$i]."</option>";
											}
										}
										
									?>
									<!--<option value="Area Control / Area Influence">Area Control / Area Influence</option>
									<option value="Auction/Bidding">Auction/Bidding</option>
									<option value="Card Drafting">Card Drafting</option>
									<option value="Co-operative Play">Co-operative Play</option>
									<option value="Deck / Pool Building">Deck / Pool Building</option>
									<option value="Dice Rolling">Dice Rolling</option>
									<option value="Grid Movement">Grid Movement</option>
									<option value="Hand Management">Hand Management</option>
									<option value="Pick-up and Deliver">Pick-up and Deliver</option>
									<option value="Point to Point Movement">Point to Point Movement</option>
									<option value="Press Your Luck">Press Your Luck</option>								
									<option value="Role Playing">Role Playing</option>
									<option value="Set Collection">Set Collection</option>
									<option value="Storytelling">Storytelling</option>
									<option value="Tile Placement">Tile Placement</option>
									<option value="Variable Player Powers" >Variable Player Powers</option>
									<option value="Worker Placement">Worker Placement</option>
									<!--<option value="19" selected>Healing in the Silence</option>-->
											
								</select>
										
							</div>
						</div>
						<div class="form-group-separator"></div>
						<div class="form-group">
							<label class="col-sm-2 control-label" for="tagsinput-1">Status</label>
							<div class="col-sm-9">
								<ul class="icheck-list">
								<?php
									$checked_value = array(' ',' ',' ');
									if(strpos($row['status'], "collection" ))
									{
										$checked_value[0] = "checked";	
									}
									if(strpos($row['status'], "own" ))
									{
										$checked_value[1] = "checked";
									}
									if(strpos($row['status'], "wishlist" ))
									{
										$checked_value[2] = "checked";
									}
									
								?>
									<li>
									    <input tabindex="5" type="checkbox" class="icheck-11" name="status[]" value="collection" id="collection" <?php echo $checked_value[0]; ?>>
									    <label for="collection">Add to My Collection</label>
									</li>
									<li>
									    <input tabindex="6" type="checkbox" class="icheck-11" name="status[]" value="own" id="own" <?php echo $checked_value[1]; ?>>
									    <label for="own">Own</label>
									</li>
									<li>
									    <input tabindex="7" type="checkbox" class="icheck-11" name="status[]" value="wishlist" id="wishlist" <?php echo $checked_value[2]; ?>>
									    <label for="wishlist">Wishlist</label>
									</li>
								</ul>
							</div>			
						</div>
						<div class="form-group-separator"></div>
						<div class="form-group">
							<label class="col-sm-2 control-label" for="description">Description</label>
								<div class="col-sm-9">
									<textarea class="form-control" cols="5" id="description" style="height:120px" value="<?php echo $row['game_time']; ?>"></textarea>
								</div>
						</div>
						<div class="form-group-separator"></div>
						<!--<a href="javascript:;" onclick="jQuery('#modal-6').modal('show', {backdrop: 'static'});" class="btn btn-primary btn-single btn-sm">Show Me</a>-->
					</form>
					
					<div class="col-sm-11">
						
						<a href="javascript:;" onclick="updated()" class="btn btn-purple btn-single pull-right " style="margin:10px 5px;">Save</a>
						
					</div>
					
				</div>
				</div>
				
				</div>
		</div>
	</div>
	<div class="page-loading-overlay">
		<div class="loader-2"></div>
	</div>
	
	<!-- Imported styles on this page -->
	<link rel="stylesheet" href="XENON/assets/js/multiselect/css/multi-select.css">
	<link rel="stylesheet" href="XENON/assets/js/icheck/skins/all.css">
	
	<!-- Bottom Scripts -->
	<script src="XENON/assets/js/bootstrap.min.js"></script>
	<script src="XENON/assets/js/TweenMax.min.js"></script>
	<script src="XENON/assets/js/resizeable.js"></script>
	<script src="XENON/assets/js/joinable.js"></script>
	<script src="XENON/assets/js/xenon-api.js"></script>
	<script src="XENON/assets/js/xenon-toggles.js"></script>


	<!-- Imported scripts on this page -->
	<script src="XENON/assets/js/xenon-widgets.js"></script>
	<script src="XENON/assets/js/devexpress-web-14.1/js/globalize.min.js"></script>
	<script src="XENON/assets/js/devexpress-web-14.1/js/dx.chartjs.js"></script>
	
	<!-- JavaScripts initializations and stuff -->
	<script src="XENON/assets/js/xenon-custom.js"></script>
	<script src="XENON/assets/js/multiselect/js/jquery.multi-select.js"></script>
	<script src="XENON/assets/js/icheck/icheck.min.js"></script>
	<script src="sweetalert/js/sweetalert.min.js"></script>
</body>
</html>