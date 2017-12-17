<?php

//======= Author Kevin Patterson 2012 =======

session_start(); // Must start session first thing




//========= Start Of Cleaning Bad Words From Input Text ===========
include("CallOut/badwordfilter.php");
//========= End Of Cleaning Bad Words From Input Text ===========




//======== Start Of User ID And Password Varification ==============
if (isset($_SESSION['PAC_Access']))
	{
		//======= Connecting To The Database =======
		require_once "dbase_interface.php";
		
		//======= Calling Data From The Database To Using In Display =======
		$query = mysql_query("SELECT * FROM pac_pages WHERE id='9' ");
		$entry_count = mysql_num_rows($query);
		if($entry_count > 0)
			{
			while($row = mysql_fetch_array($query))
				{
					$id = $row['id'];  
					$_SESSION['id'] = $id;
					
					$pac_id = $row['pac_id'];  
					$_SESSION['pac_id'] = $pac_id;
					
					$header_text = $row['header_text'];  
					$_SESSION['header_text'] = $header_text;
					
					$lower_text = $row['lower_text'];
					$_SESSION['lower_text'] = $lower_text;
					
					$name = $row['name'];
					$_SESSION['name'] = $name;
					
					$admin_title = $row['admin_title'];
					$_SESSION['admin_title'] = $admin_title;
					
					$pac_header_id = $row['pac_header_id'];
					$_SESSION['pac_header_id'] = $pac_header_id;
					
					$last_edit_date = $row['last_edit_date'];
					$_SESSION['last_edit_date'] = $last_edit_date;
					
					$member = 'PAC Members';
					$_SESSION['member'] = $member;
					
				}
			}
		
		$id = $_SESSION['id'];
		$pac_id = $_SESSION['pac_id'];
		$header_text = $_SESSION['header_text'];
		$lower_text = $_SESSION['lower_text'];
		$name = $_SESSION['name'];
		$admin_title = $_SESSION['admin_title'];
		$pac_header_id = $_SESSION['pac_header_id'];
		$last_edit_date = $_SESSION['last_edit_date'];
		$member = $_SESSION['member'];
		
	} else if (isset($_SESSION['pac_home_page'])) {
		
		//======= Connecting To The Database =======
		require_once "dbase_interface.php";
		
		//======= Calling Data From The Database To Using In Display =======
		$query = mysql_query("SELECT * FROM pac_pages WHERE id='9' ");
		$entry_count = mysql_num_rows($query);
		if($entry_count > 0)
			{
			while($row = mysql_fetch_array($query))
				{
					$id = $row['id'];  
					$_SESSION['id'] = $id;
					
					$pac_id = $row['pac_id'];  
					$_SESSION['pac_id'] = $pac_id;
					
					$header_text = $row['header_text'];  
					$_SESSION['header_text'] = $header_text;
					
					$lower_text = $row['lower_text'];
					$_SESSION['lower_text'] = $lower_text;
					
					$name = $row['name'];
					$_SESSION['name'] = $name;
					
					$admin_title = $row['admin_title'];
					$_SESSION['admin_title'] = $admin_title;
					
					$pac_header_id = $row['pac_header_id'];
					$_SESSION['pac_header_id'] = $pac_header_id;
					
					$last_edit_date = $row['last_edit_date'];
					$_SESSION['last_edit_date'] = $last_edit_date;
					
					$member = 'Administrator';
					$_SESSION['member'] = $member;
					
					$edit_page = 'edit_page';
					$_SESSION['edit_page'] = $edit_page;
					
				}
			}
		
		$id = $_SESSION['id'];
		$pac_id = $_SESSION['pac_id'];
		$header_text = $_SESSION['header_text'];
		$lower_text = $_SESSION['lower_text'];
		$name = $_SESSION['name'];
		$admin_title = $_SESSION['admin_title'];
		$pac_header_id = $_SESSION['pac_header_id'];
		$last_edit_date = $_SESSION['last_edit_date'];
		$member = $_SESSION['member'];
		$edit_page = $_SESSION['edit_page'];
		
	} else {
		
		// Print login failure message to the user and link them back to your login page
		header('location: PAC_Login.php');
	}

$edit_page = $_SESSION['edit_page'];

//======= Start Of Update =======
if (isset($_POST['header_text']))
	{
	
		//============== Connecting to The Database ==================
		require_once "dbase_interface.php";

		$header_text = ($_POST['header_text']);//===== Pulling In Post From Form ===========
		$header_text = nl2br(htmlspecialchars($header_text));//===== Filtering Comments Leaving <> In Callouts ===========
		$header_text = badWordFilter($header_text);
			if (!$header_text)
				{
					$header_text_error = '<span style="color:#F00; font-size:12px; font-weight:bold;">&emsp;Required&emsp;</span>';
				}
		
		$name = ($_POST['name']);//===== Pulling In Post From Form ===========
		$name = nl2br(htmlspecialchars($name));//===== Filtering Comments Leaving <> In Callouts ===========
		$name = badWordFilter($name);
			if (!$name)
				{
					$name_error = '<span style="color:#F00; font-size:12px; font-weight:bold;">&emsp;Required&emsp;</span>';
				}
		
		$admin_title = ($_POST['admin_title']);//===== Pulling In Post From Form ===========
		$admin_title = nl2br(htmlspecialchars($admin_title));//===== Filtering Comments Leaving <> In Callouts ===========
		$admin_title = badWordFilter($admin_title);
			if (!$admin_title)
				{
					$admin_title_error = '<span style="color:#F00; font-size:12px; font-weight:bold;">&emsp;Required&emsp;</span>';
				}
		
		if ((!$header_text) || (!$name) || (!$admin_title))
		{
			//====== Nothing Is Run So That The Errors Aboue Can Be Sent To There Respective Locations ============
		} else {
			mysql_query("UPDATE pac_pages SET header_text='$header_text', name='$name', admin_title='$admin_title', last_edit_date=now() WHERE id='9'");
			
			header("location:PAC_BridgeNursing.php");
		}
	
	}//========= Closing if (isset($_GET['edit_this_id'])) Statement ==============

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<title>PAC Bridge Nursing Dept</title>

<link rel="SHORTCUT ICON" href="favicon.ico"/>
<link href="style.css" rel="stylesheet" type="text/css"/>

<script type="text/javascript" src="jquery.js"></script>

<script type="text/javascript">
$(document).ready(function(){
	//hide the all of the element with class msg_body
	$(".msg_body").hide();
	//toggle the componenet with class msg_body
	$(".msg_head").click(function(){
		if ($(".msg_body").is(":visible")) { $(".msg_body").hide(2000); }
		$(this).next(".msg_body").slideToggle(600);
	});
});
</script>

<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-20614110-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

</head>

<body>
<div id="wrapper" ><!------------------------------------------- wrapper start ------------------------------------------>
	
	<div style="position:absolute; z-index:0;"><!-- Placing Lower Half Of Page Solid So Header Menu Can Roll Down Without Colliding -->

	<div id="common_header"><!--- header start --->
    	
        <?php include("CallOut/TopHeader.php")?>
        
	</div><!--- header end --->

		<div class="dropshadow_left" >
		<div class="dropshadow_right" >
		<div id="PAC_upper_content"><!--- Upper Content start --->
        
        	<?php include("CallOut/TopPageMenuCntlr.php")?>
            
            <!---
            <div id="header_id">
          
				<img src="" /><!--- images/PAC_Sign.png
                
			</div>
            --->
            
		</div>
        
        <div id="PAC_content"><!--- Contact Content start --->
			
			<div id="Page_Indicator">
				<img src="images/HeaderBkgndSupportPAC.jpg" alt="Indicates Which Page" />
			</div>
        	
            <div id="PAC_info">
            	
                <br/><br/>
                <p style="color:#000; font-size:16px; text-align:center; font-weight:bold;">
					WELCOME <?php echo $pac_header_id; ?> <?php echo $member; ?>
					<br/>
					<span style="font-size:12px;">
						<a href="PAC_Logout.php">LOG-OUT</a>&ensp;or&ensp;<a href="PAC_BridgeMinutes.php">BACK TO THE PAC BRIDGE</a>
					</span>
				</p>
                
                <br/>
				
				<?php
					if($edit_page)
						{
							echo
								'
								<form action="PAC_BridgeNursing.php" method="post" enctype="multipart/form-data">
									<textarea cols="55" rows="10" maxlength="10000" name="header_text"
									style="width:835px; height:200px; text-align:left; color:#FFF; font-size:14px; background-color:#09F;" />'.$header_text.'</textarea>
									<br/><br/>
									Your Last Update Was <span style="color:#F00">' .$last_edit_date.'</span>
								';
						} else {
							echo $header_text;
						}
				?>
                    
				<br/><br/><br/>
				
				<hr/><br/>
				
				<div id="PAC_Bars">
					
					<div id="PAC_row_one">
					
						<div id="prior_minutes" onclick="<?php $meeting_minutes = 'meeting minutes' ?>" >
						
							<div class="msg_list">
									
								<p class="msg_head"><!-- Nursing General Tutoring -->
									PRIOR MEETING MINUTES
								</p>
								
								<div class="msg_body">
								
									<div id="pri_meet_minutes">
										
										<?php
										
										//======== Start Of Creating A Search Data Criteria For A "Where" Array To Support MySQL Select ============
										if ($meeting_minutes === 'meeting minutes')
											{
											
											require_once "dbase_interface.php";
															
											//======= Start Of Clearing Variables For Use In Code ========
											$which_pac = "";
											$display_text = "";
											$where = "";
											//======= End Of Clearing Variables For Use In Code ========
											
											
											//======= Start Of Setting $where To Control Display Of Database
											$where .= "id >=0";
											$where .= " AND ";
											$where .= "pac_id  LIKE 'Nursing'";
											//======= End Of Setting $where To Control Display Of Database
											
											
											//====== Creating A New Count For "total_employees" To Use In Search ==========
											$count_query = mysql_query("SELECT * FROM pac_minutes WHERE $where");
											$total_employees = mysql_num_rows($count_query);
											
											$per_page = 10;
											
											$pages_query = mysql_query("SELECT COUNT(*) FROM pac_minutes WHERE $where");
											$pages = ceil(mysql_result($pages_query, 0) / $per_page);
											
											$page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
											$start = ($page - 1) * $per_page;
											
											
											//=========== Start Placing Jobs Listings For Display =======================
										
											$query = mysql_query("SELECT * FROM pac_minutes WHERE $where ORDER BY last_edit_date DESC LIMIT $start, $per_page");
											$jobs_count = mysql_num_rows($query);
											if($jobs_count > 0)
												{
												while($row = mysql_fetch_array($query))
													{
													$id = $row['id'];
													$pac_min = 'pac_minutes';
													$display_text = $row['display_text'];
													$display_text = "<a href='DisplayPDFStuff.php?display_page=$id $pac_min'>$display_text</a>"."<br/>";
													
													
													//======== Start Of ECHO Placement Of Data ============
													
													echo $display_text;
													
													}//======== Ending "While Loop" Above ==========
												
												}
											}//======= End of if ($meeting_minutes === 'meeting minutes') Statement Aboue =======
										?>
										
									</div>
									
								</div>
														
							</div>
						
						</div>
						
						<div id="course_syllabi" onclick="<?php $course_syllabi = 'course syllabi' ?>" >
						
							<div class="msg_list">
									
								<p class="msg_head"><!-- Nursing General Tutoring -->
									COURSE SYLLABI
								</p>
								
								<div id="course_syl" class="msg_body">
								
									<div id="syll_meet_minutes">
									
										<form action="PAC_BridgeNursing.php" method="post" enctype="multipart/form-data" >
											Search By Course: &emsp;
											<select name="course_id"
												style="width:50px; height:auto; margin: 0 5px 6px 0; text-align:left; color:#FFF; font-size:14px; background-color:#09F;"/>
												<option value=" "> </option>
												<option value="<?php echo $course_code; ?>"><?php echo $course_code; ?></option>
													<?php include("1A_OOP/PAC_OOP_CourseID.php"); ?>
											</select>
											&emsp;
											<input type="submit" name="submit" value="Submit Search" onclick=".msg_head()" />
										</form>
										
										<br/>
									
										<?php
											
										if (isset($_POST['course_id']) && !isset($_GET['page']))
											{
											
											echo
											'
											<script type="text/javascript" src="jquery.js"></script>
											
											<script type="text/javascript">
											$(document).ready(function(){
												//hide the all of the element with class msg_body
												$(".msg_body").hide();
												$("#course_syl").show();
											});
											</script>
											';
											
											require_once "dbase_interface.php";
															
											//======= Start Of Clearing Variables For Use In Code ========
											$course_syllabi = NULL;
											$display_text = "";
											$where = "";
											//======= End Of Clearing Variables For Use In Code ========
											
											
											//======= Start Of Setting $where To Control Display Of Database
											$where .= "id >=0";
											$where .= " AND ";
											$where .= "pac_id  LIKE 'Nursing'";
											//======= End Of Setting $where To Control Display Of Database
											
											
											$course_id = mysql_real_escape_string(htmlentities(trim($_POST['course_id'])));
											if($course_id === 'ALL')
												{
													//======= Adds Nothing To course_id So Search Will Access ALL Of Database =======
												} else {
													$where .= " AND ";
													$where .= "course_id LIKE '%$course_id%'";
												}
											//======= End Of Setting $where To Control Display Of Database
											
											
											session_start();
											//====== Putting "Where Into A Session For Call Back ==========
											$_SESSION['where'] = $where;
											
											//====== Recalling "where" From SESSION To Use In Search ==========
											$where = $_SESSION['where'];
											
											
											//====== Creating A New Count For "total_employees" To Use In Search ==========
											$count_query = mysql_query("SELECT * FROM pac_syllabi WHERE $where");
											$total_course_syllabi = mysql_num_rows($count_query);
											
											session_start();
											//====== Putting "total_job_posts" Into A Session For Call Back ==========
											$_SESSION['total_course_syllabi'] = $total_course_syllabi;
											
											$per_page = 10;
											
											$pages_query = mysql_query("SELECT COUNT(*) FROM pac_syllabi WHERE $where");
											$pages = ceil(mysql_result($pages_query, 0) / $per_page);
											
											$page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
											$start = ($page - 1) * $per_page;
											
											
											//=========== Start Placing pac_syllabi Listings For Display =======================
											$query = mysql_query("SELECT * FROM pac_syllabi WHERE $where ORDER BY display_text ASC LIMIT $start, $per_page");
											$syllabi_count = mysql_num_rows($query);
											if($syllabi_count > 0)
												{
												while($row = mysql_fetch_array($query))
													{
													$id = $row['id'];
													$pac_syl = 'pac_syllabi';
													$course_id = $row['course_id'];
													$display_text = $row['display_text'];
													$display_text = "<a href='DisplayPDFStuff.php?display_page=$id $pac_syl'>$display_text</a>"."<br/>";
													
													
													//======== Start Of ECHO Placement Of Data ============
													
													echo $display_text;
													
													}//======== Ending "While Loop" Above ==========
												
												} else if ($syllabi_count == 0) {//========= End Or Close Of "if($jobs_count > 0)" Statement Above =========
													$course_syllabi_error = '<span style="color:#F00; font-size:12px;"><br/> No COURSE SYLLABI Found Using Your Search Criteria <br/></span>';
												}//========= End Or Close Of "if($jobs_count > 0)" Statement Above ========
											
											
												//=========== Start Of Pagination Numbering At The Bottom Of The Page ==============
												if ($pages >= 1 && $page <= $pages)
													{
														for($x = 1; $x <= $pages; $x++)
															{
																$page_lineup .= ($x == $page) ?
																	'<span style="margin:0px 15px 0px 15px; font-size:14px; font-weight:bold; color:#F00;">Page ' .$x. '</span>' : '
																		<span style="margin:0px 2px 0px 2px; font-size:14px; font-weight:bold; color:#F00;">
																			<a href="PAC_BridgeNursing.php?page=' .$x. '" >' .$x. '</a></span> ';
															}
													}
												//=========== End Of Pagination Numbering At The Bottom Of The Page ==============
												
												echo '
													'.$course_syllabi_error.'
													<div id="syllabi_box">
														' .$page_lineup. ' <span style="color:#F00; font-size:14px; font-weight:bold;"> Total of ' .$total_course_syllabi. ' Syllabi</span>
													</div>
													';					
											
											}//======== End Of Creating A Search Data Criteria For "if (isset($_POST['course_id']))" Above ================================================
										
										
										
										//=================================== Start Of Pagination Continuation ========================================
										if (isset($_GET['page']))
											{
											
											echo
											'
											<script type="text/javascript" src="jquery.js"></script>
											
											<script type="text/javascript">
											$(document).ready(function(){
												//hide the all of the element with class msg_body
												$(".msg_body").hide();
												$("#course_syl").show();
											});
											</script>
											';
											
											require_once "dbase_interface.php";
															
											//====== Recalling "where" From SESSION To Use In Search ==========
											$course_syllabi = NULL;
											$where = $_SESSION['where'];
											//====== Recalling "total_job_posts" From SESSION To Use In Pagination ==========
											$total_course_syllabi = $_SESSION['total_course_syllabi'];
											
											$per_page = 10;
											
											$pages_query = mysql_query("SELECT COUNT(*) FROM pac_syllabi WHERE $where");
											$pages = ceil(mysql_result($pages_query, 0) / $per_page);
											
											$page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
											$start = ($page - 1) * $per_page;
											
											
											//=========== Start Placing Jobs Listings For Display =======================
										
											$query = mysql_query("SELECT * FROM pac_syllabi WHERE $where ORDER BY display_text ASC LIMIT $start, $per_page");
											$syllabi_count = mysql_num_rows($query);
											if($syllabi_count > 0)
												{
												while($row = mysql_fetch_array($query))
													{
													$id = $row['id'];
													$pac_syl = 'pac_syllabi';
													$course_id = $row['course_id'];
													$display_text = $row['display_text'];
													$display_text = "<a href='DisplayPDFStuff.php?display_page=$id $pac_syl'>$display_text</a>"."<br/>";
													
													
													//======== Start Of ECHO Placement Of Data ============
													
													echo $display_text;
													
													}//======== Ending "While Loop" Above ==========
												
												} else if ($syllabi_count == 0) {//========= End Or Close Of "if($jobs_count > 0)" Statement Above =========
													$course_syllabi_error = '<span style="color:#F00; font-size:12px;"><br/> No COURSE SYLLABI Found Using Your Search Criteria <br/></span>';
												}//========= End Or Close Of "if($jobs_count > 0)" Statement Above ========
											
											
												//=========== Start Of Pagination Numbering At The Bottom Of The Page ==============
												if ($pages >= 1 && $page <= $pages)
													{
														for($x = 1; $x <= $pages; $x++)
															{
																$page_lineup .= ($x == $page) ?
																	'<span style="margin:0px 15px 0px 15px; font-size:14px; font-weight:bold; color:#F00;">Page ' .$x. '</span>' : '
																		<span style="margin:0px 2px 0px 2px; font-size:14px; font-weight:bold; color:#F00;">
																			<a href="PAC_BridgeNursing.php?page=' .$x. '" >' .$x. '</a></span> ';
															}
													}
												//=========== End Of Pagination Numbering At The Bottom Of The Page ==============
												
												echo '
													'.$course_syllabi_error.'
													<div id="syllabi_box">
									' .$page_lineup. ' <span style="color:#F00; font-size:14px; font-weight:bold;"> Total of ' .$total_course_syllabi. ' Syllabi</span>
													</div>
													';					
											
											}//======== End Of Creating A Search Data Criteria For "(isset($_POST['department']))" Above ================================================
										
										
										if ($course_syllabi === 'course syllabi')
											{
											echo 'Course Syllabi Start<br/>';
											require_once "dbase_interface.php";
															
											//======= Start Of Clearing Variables For Use In Code ========
											$display_text = "";
											$where = "";
											//======= End Of Clearing Variables For Use In Code ========
											
											
											//======= Start Of Setting $where To Control Display Of Database
											$where .= "id >=0";
											$where .= " AND ";
											$where .= "pac_id  LIKE 'Nursing'";
											//======= End Of Setting $where To Control Display Of Database
											
											
											session_start();
											//====== Putting "Where Into A Session For Call Back ==========
											$_SESSION['where'] = $where;
											
											//====== Recalling "where" From SESSION To Use In Search ==========
											$where = $_SESSION['where'];
											
											
											//====== Creating A New Count For "total_employees" To Use In Search ==========
											$count_query = mysql_query("SELECT * FROM pac_syllabi WHERE $where");
											$total_course_syllabi = mysql_num_rows($count_query);
											
											session_start();
											//====== Putting "total_job_posts" Into A Session For Call Back ==========
											$_SESSION['total_course_syllabi'] = $total_course_syllabi;
											
											$per_page = 10;
											
											$pages_query = mysql_query("SELECT COUNT(*) FROM pac_syllabi WHERE $where");
											$pages = ceil(mysql_result($pages_query, 0) / $per_page);
											
											$page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
											$start = ($page - 1) * $per_page;
											
											
											//=========== Start Placing Jobs Listings For Display =======================
										
											$query = mysql_query("SELECT * FROM pac_syllabi WHERE $where ORDER BY display_text ASC LIMIT $start, $per_page");
											$syllabi_count = mysql_num_rows($query);
											if($syllabi_count > 0)
												{
												while($row = mysql_fetch_array($query))
													{
													$id = $row['id'];
													$pac_syl = 'pac_syllabi';
													$course_id = $row['course_id'];
													$display_text = $row['display_text'];
													$display_text = "<a href='DisplayPDFStuff.php?display_page=$id $pac_syl'>$display_text</a>"."<br/>";
													
													
													//======== Start Of ECHO Placement Of Data ============
													
													echo $display_text;
													
													}//======== Ending "While Loop" Above ==========
												
												} else if ($syllabi_count == 0) {//========= End Or Close Of "if($jobs_count > 0)" Statement Above =========
													$course_syllabi_error = '<span style="color:#F00; font-size:12px;"><br/> No COURSE SYLLABI Found Using Your Search Criteria <br/></span>';
												}//========= End Or Close Of "if($jobs_count > 0)" Statement Above ========
											
											
												//=========== Start Of Pagination Numbering At The Bottom Of The Page ==============
												if ($pages >= 1 && $page <= $pages)
													{
														for($x = 1; $x <= $pages; $x++)
															{
																$page_lineup .= ($x == $page) ?
																	'<span style="margin:0px 15px 0px 15px; font-size:14px; font-weight:bold; color:#F00;">Page ' .$x. '</span>' : '
																		<span style="margin:0px 2px 0px 2px; font-size:14px; font-weight:bold; color:#F00;">
																			<a href="PAC_BridgeNursing.php?page=' .$x. '" >' .$x. '</a></span> ';
															}
													}
												//=========== End Of Pagination Numbering At The Bottom Of The Page ==============
												
												echo '
													'.$course_syllabi_error.'
													<div id="syllabi_box">
									' .$page_lineup. ' <span style="color:#F00; font-size:14px; font-weight:bold;"> Total of ' .$total_course_syllabi. ' Syllabi</span>
													</div>
													';					
											
											}//======== End Of Creating A Search Data Criteria For "if (isset($_POST['course_id']))" Above ================================================
										
										?>
										
									</div>
									
								</div>
														
							</div>
							
						</div>
					
					</div>
					
					<div id="PAC_row_two">
							
						<div id="course_description" onclick="<?php $pac_course_start = 'pac_course_start' ?>">
						
							<div class="msg_list">
									
								<p class="msg_head">
									COURSE DESCRIPTIONS
								</p>
								
								<div id="course_desc" class="msg_body">
								
									<div id="disc_meet_minutes">
										
										<table width="800px" align="left">
											<tr>
												<td width="10%" height="auto" align="left" style="color:#000; font-size:12px; padding:2px;" ></td>
												<td width="10%" height="auto" align="left" style="color:#000; font-size:12px; padding:2px;" >
													<span style="text-align:left; color:#FFF; font-size:14px;"/>
														Code:
													</span>
												</td>
												<td width="10%" height="auto" align="left" style="color:#000; font-size:12px; padding:2px;" >
													<span style="text-align:left; color:#FFF; font-size:14px;"/>
														Course #:
													</span>
												</td>
												<td width="12%" height="auto" align="left" style="color:#000; font-size:12px; padding:2px;" >
													<span style="text-align:left; color:#FFF; font-size:14px;"/>
														Course Title:
													</span>
												</td>
												<td width="15%" height="auto" align="left" style="color:#000; font-size:12px; padding:2px;" >
													<span style="text-align:left; color:#FFF; font-size:14px;"/>
														Any Text Within Course Description:
													</span>
												</td>
												<td width="15%" height="auto" align="left" style="color:#000; font-size:12px; padding:2px;" >
													<span style="text-align:left; color:#FFF; font-size:14px;"/>
														Degree:
													</span>
												</td>
												<td width="60%" height="auto" align="left" style="color:#000; font-size:12px; padding:2px;" ></td>
											</tr>
										
											<form action="PAC_BridgeNursing.php" method="post" enctype="multipart/form-data" >
												<tr>
													<td width="10%" height="auto" align="left" style="color:#000; font-size:12px; padding:2px;" ></td>
													<td width="10%" height="auto" align="left" style="color:#000; font-size:12px; padding:2px;" >
													<select name="which_course_code"
														style="width:70px; height:auto; text-align:left; color:#FFF; font-size:14px; background-color:#09F;"/>
														<option value=" "> </option>
														<option value="<?php echo $course_id; ?>"><?php echo $course_id; ?></option>
														<?php include("1A_OOP/PAC_OOP_CourseID.php"); ?>
													</select>
													</td>
													<td width="10%" height="auto" align="left" style="color:#000; font-size:12px; padding:2px;" >
													<input type="text" name="which_course_num" size="100" maxlength="200"
														style="width:70px; height:auto; text-align:left; color:#FFF; font-size:14px; background-color:#09F;"  />
													</td>
													<td width="7%" height="auto" align="left" style="color:#000; font-size:12px; padding:2px;" >
													<input type="text" name="which_course_title" size="100" maxlength="200"
														style="width:200px; height:auto; text-align:left; color:#FFF; font-size:14px; background-color:#09F;"  />
													</td>
													<td width="10%" height="auto" align="left" style="color:#000; font-size:12px; padding:2px;" >
													<input type="text" name="desc_text" size="100" maxlength="200"
														style="width:250px; height:auto; text-align:left; color:#FFF; font-size:14px; background-color:#09F;"  />
													</td>
													<td width="10%" height="auto" align="left" style="color:#000; font-size:12px; padding:2px;" >
													<select name="which_degree"
														style="width:100px; height:auto; text-align:left; color:#FFF; font-size:14px; background-color:#09F;"/>
														<option value=" "> </option>
														<option value="nur_adminM">Master Nursing Administration</option>
														<option value="nursing_edM">Master Nursing Education</option>
														<option value="nurs_complete_B">Bachelor Nursing Completion</option>
														<option value="nur_emph_clinicB">Bachelor Nursing Administration Emph Clinical Nurse Educator</option>
														<option value="nur_emph_comuntyB">Bachelor Nursing Administration Emph Community Health Nurse</option>
														<option value="nur_emph_case_manaB">Bachelor Nursing Administration Emph Nurse Case Manager</option>
														<option value="nur_emph_informatB">Bachelor Nursing Administration Emph Nursing Informatics</option>
													</select>
													</td>
													<td width="60%" height="auto" align="left" style="color:#000; font-size:12px; padding:2px;" >
													<input type="submit" name="submit" value="Search" />
													</td>
												</tr>
											</form>
										</table>
										
										<table width="800px" align="left">
											<tr>
												<td><br/><hr style="height:2px; border-style:solid; color:#de7008; background-color:#df7109; border:none;" /><br/><br/></td>
											</tr>
										</table>
										
										<br/>
									
										<?php
										
				if (isset($_POST['which_course_code']) || isset($_POST['which_course_num']) || isset($_POST['which_course_title']) || isset($_POST['desc_text']) || isset($_POST['which_degree']))
											{
											
											echo
											'
											<script type="text/javascript" src="jquery.js"></script>
											
											<script type="text/javascript">
											$(document).ready(function(){
												//hide the all of the element with class msg_body
												$(".msg_body").hide();
												$("#course_desc").show();
											});
											</script>
											';
											
											require_once "dbase_interface.php";
											
											$pac_course_start = NULL;
															
											//======= Start Of Clearing Variables For Use In Code ========
											$id = "";
											$course_code = "";
											$course_name = "";
											$course_num = "";
											$credits = "";
											$course_num_title = "";
											$course_desc = "";
											$last_edit_date = "";
											$which_course = "";
											//======= End Of Clearing Variables For Use In Code ========
											
											
											//======= Start Of Setting $which_course To Control Display Of Database =======
											$which_course .= "id >=0";
											$which_course .= " AND ";
											$which_course .= "pac_nursing LIKE 'x'";
											
											$which_course_code = mysql_real_escape_string(htmlentities(trim($_POST['which_course_code'])));
											if($which_course_code === 'ALL')
												{
													//======= Adds Nothing To course_code So Search Will Access ALL Of The Database =======
												} else if ($which_course_code) {
													$which_course .= " AND ";
													$which_course .= "course_code LIKE '%$which_course_code%'";
												}
											$which_course_num = mysql_real_escape_string(htmlentities(trim($_POST['which_course_num'])));
											if($which_course_num)
												{
												$which_course .= " AND ";
												$which_course .= "course_num LIKE '%$which_course_num%'";
												}
											$which_course_title = mysql_real_escape_string(htmlentities(trim($_POST['which_course_title'])));
											if($which_course_title)
												{
												$which_course .= " AND ";
												$which_course .= "course_num_title LIKE '%$which_course_title%'";
												}
											$desc_text = mysql_real_escape_string(htmlentities(trim($_POST['desc_text'])));
											if($desc_text)
												{
												$which_course .= " AND ";
												$which_course .= "course_desc LIKE '%$desc_text%'";
												}
											$which_degree = mysql_real_escape_string(htmlentities(trim($_POST['which_degree'])));
											if($which_degree)
												{
												$which_course .= " AND ";
												$which_course .= "$which_degree LIKE 'x'";
												}
											//======= End Of Setting $which_course To Control Display Of Database =======
											
																	
											//====== Creating A New Count For Total of Books To Use In Search ==========
											$count_query = mysql_query("SELECT * FROM pac_course_desc WHERE $which_course");
											$total_courses = mysql_num_rows($count_query);
											
											session_start();
											//====== Putting "which_course Into A Session For Call Back ==========
											$_SESSION['which_course'] = $which_course;
											
											//====== Recalling "which_course" From SESSION To Use In Search ==========
											$which_course = $_SESSION['which_course'];
											
											session_start();
											//====== Putting "total_courses" Into A Session For Call Back ==========
											$_SESSION['total_courses'] = $total_courses;
											
											$per_page = 9;
											
											$pages_query = mysql_query("SELECT COUNT(*) FROM pac_course_desc WHERE $which_course");
											$pages = ceil(mysql_result($pages_query, 0) / $per_page);
											
											$course_page = (isset($_GET['course_page'])) ? (int)$_GET['course_page'] : 1;
											$start = ($course_page - 1) * $per_page;
											
											//=========== Start Placing Book Listings For Display =======================
										
											$query = mysql_query("SELECT * FROM pac_course_desc WHERE $which_course ORDER BY course_num ASC LIMIT $start, $per_page");
											$course_desc_count = mysql_num_rows($query);
											if($course_desc_count > 0)
												{
												while($row = mysql_fetch_array($query))
													{
													$id = $row['id'];
													$pac_course_desc = 'pac_course_desc';
													$course_code = $row['course_code'];
													$course_name = $row['course_name'];
													$course_num = $row['course_num'];
													$credits = $row['credits'];
													$course_num_title = $row['course_num_title'];
													$course_desc = $row['course_desc'];
													$last_edit_date = $row['last_edit_date'];
													
													//======== Start Of ECHO Placement Of Data ============
													echo
													'
													<div class="disc_course_desc">
													
														<table style="width:245px;" align="left" border="0" cellpadding="2">
															<tr>
																<td width="60%" height="auto" align="left" style="color:#000; font-size:12px; padding:2px;" >'.$course_num.'</td>
																<td width="40%" height="auto" align="right" style="color:#000; font-size:12px; padding:2px;" >'.$credits.' Credits</td>
															</tr>
														</table>
														<table style="width:245px;" align="left" border="0" cellpadding="2">	
															<tr>	
																<td width="100%" height="auto" align="left" style="color:#000; font-size:12px; padding:2px;" >'.$course_num_title.'</td>
															</tr>
															
															<tr>	
																<td width="100%" height="auto" align="left" style="color:#000; font-size:12px; padding:2px;" >'.$course_desc.'</td>
															</tr>
															
														</table>
														
													</div>
													';
													
													}//======== Ending "While Loop" Above ==========
												
												} else if ($course_desc_count == 0) {//========= End Or Close Of "if($jobs_count > 0)" Statement Above =========
													$course_desc_count_error = '<span style="color:#F00; font-size:12px;"><br/> No COURSES Were Found Using Your Search Criteria <br/></span>';
												}//========= End Or Close Of "if($jobs_count > 0)" Statement Above ========
												
												//=========== Start Of Pagination Numbering At The Bottom Of The Page ==============
												if ($pages >= 1 && $course_page <= $pages)
													{
														for($x = 1; $x <= $pages; $x++)
															{
																$course_page_lineup .= ($x == $course_page) ?
																	'<span style="margin:0px 15px 0px 15px; font-size:14px; font-weight:bold; color:#F00;">Page ' .$x. '</span>' : '
																		<span style="margin:0px 2px 0px 2px; font-size:14px; font-weight:bold; color:#F00;">
																			<a href="PAC_BridgeNursing.php?course_page=' .$x. '">' .$x. '</a></span> ';
															}
													}
												//=========== End Of Pagination Numbering At The Bottom Of The Page ==============
												
												echo '
													'.$course_desc_count_error.'
													<div id="course_box">
													<br/><br/>
									' .$course_page_lineup. ' <span style="color:#F00; font-size:14px; font-weight:bold;"> Total of ' .$total_courses. ' Courses</span>
													</div>
													';
										
											}//======== End Of Creating A Search Data Criteria For "if (isset($_GET['page']))" Above ================================================
										
										
										//=================================== Start Of Pagination Continuation ========================================
										if (isset($_GET['course_page']))
											{
											
											echo
											'
											<script type="text/javascript" src="jquery.js"></script>
											
											<script type="text/javascript">
											$(document).ready(function(){
												//hide the all of the element with class msg_body
												$(".msg_body").hide();
												$("#course_desc").show();
											});
											</script>
											';
											
											require_once "dbase_interface.php";
											
											$pac_course_start = NULL;
															
											//====== Recalling "which_course" and "total_courses" From SESSION To Use In Search ==========
											$which_course = $_SESSION['which_course'];
											$total_courses = $_SESSION['total_courses'];
											
											$per_page = 9;
											
											$pages_query = mysql_query("SELECT COUNT(*) FROM pac_course_desc WHERE $which_course");
											$pages = ceil(mysql_result($pages_query, 0) / $per_page);
											
											$course_page = (isset($_GET['course_page'])) ? (int)$_GET['course_page'] : 1;
											$start = ($course_page - 1) * $per_page;
											
											//=========== Start Placing Book Listings For Display =======================
										
											$query = mysql_query("SELECT * FROM pac_course_desc WHERE $which_course ORDER BY course_num ASC LIMIT $start, $per_page");
											$course_desc_count = mysql_num_rows($query);
											if($course_desc_count > 0)
												{
												while($row = mysql_fetch_array($query))
													{
													$id = $row['id'];
													$pac_course_desc = 'pac_course_desc';
													$course_code = $row['course_code'];
													$course_name = $row['course_name'];
													$course_num = $row['course_num'];
													$credits = $row['credits'];
													$course_num_title = $row['course_num_title'];
													$course_desc = $row['course_desc'];
													$last_edit_date = $row['last_edit_date'];
													
													//======== Start Of ECHO Placement Of Data ============
													echo
													'
													<div class="disc_course_desc">
													
														<table style="width:245px;" align="left" border="0" cellpadding="2">
															<tr>
																<td width="60%" height="auto" align="left" style="color:#000; font-size:12px; padding:2px;" >'.$course_num.'</td>
																<td width="40%" height="auto" align="right" style="color:#000; font-size:12px; padding:2px;" >'.$credits.' Credits</td>
															</tr>
														</table>
														<table style="width:245px;" align="left" border="0" cellpadding="2">	
															<tr>	
																<td width="100%" height="auto" align="left" style="color:#000; font-size:12px; padding:2px;" >'.$course_num_title.'</td>
															</tr>
															
															<tr>	
																<td width="100%" height="auto" align="left" style="color:#000; font-size:12px; padding:2px;" >'.$course_desc.'</td>
															</tr>
															
														</table>
														
													</div>
													';
													
													}//======== Ending "While Loop" Above ==========
												
												} else if ($course_desc_count == 0) {//========= End Or Close Of "if($jobs_count > 0)" Statement Above =========
													$course_desc_count_error = '<span style="color:#F00; font-size:12px;"><br/> No COURSES Were Found Using Your Search Criteria <br/></span>';
												}//========= End Or Close Of "if($jobs_count > 0)" Statement Above ========
												
												//=========== Start Of Pagination Numbering At The Bottom Of The Page ==============
												if ($pages >= 1 && $course_page <= $pages)
													{
														for($x = 1; $x <= $pages; $x++)
															{
																$course_page_lineup .= ($x == $course_page) ?
																	'<span style="margin:0px 15px 0px 15px; font-size:14px; font-weight:bold; color:#F00;">Page ' .$x. '</span>' : '
																		<span style="margin:0px 2px 0px 2px; font-size:14px; font-weight:bold; color:#F00;">
																			<a href="PAC_BridgeNursing.php?course_page=' .$x. '">' .$x. '</a></span> ';
															}
													}
												//=========== End Of Pagination Numbering At The Bottom Of The Page ==============
												
												echo '
													'.$course_desc_count_error.'
													<div id="course_box">
													<br/><br/>
									' .$course_page_lineup. ' <span style="color:#F00; font-size:14px; font-weight:bold;"> Total of ' .$total_courses. ' Courses</span>
													</div>
													';
										
											}//======== End Of Creating A Search Data Criteria For "if (isset($_GET['page']))" Above ================================================
										
										
										
										//=================================== Start Of Course Information Display ========================================
										if ($pac_course_start == 'pac_course_start')
											{
											
											require_once "dbase_interface.php";
															
											//======= Start Of Clearing Variables For Use In Code ========
											$id = "";
											$course_code = "";
											$course_name = "";
											$course_num = "";
											$credits = "";
											$course_num_title = "";
											$course_desc = "";
											$last_edit_date = "";
											$which_course = "";
											//======= End Of Clearing Variables For Use In Code ========
											
											
											//======= Start Of Setting $which_course To Control Display Of Database =======
											$which_course .= "id >=0";
											$which_course .= " AND ";
											$which_course .= "pac_nursing LIKE 'x'";
											
											session_start();
											//====== Putting "Where Into A Session For Call Back ==========
											$_SESSION['which_course'] = $which_course;
											
											//====== Recalling "where" From SESSION To Use In Search ==========
											$which_course = $_SESSION['which_course'];
											
											//====== Creating A New Count For Total of Books To Use In Search ==========
											$count_query = mysql_query("SELECT * FROM pac_course_desc WHERE $which_course");
											$total_courses = mysql_num_rows($count_query);
											
											session_start();
											//====== Putting "Where Into A Session For Call Back ==========
											$_SESSION['total_courses'] = $total_courses;
											
											//====== Recalling "where" From SESSION To Use In Search ==========
											$total_courses = $_SESSION['total_courses'];
											
											$per_page = 9;
											
											$pages_query = mysql_query("SELECT COUNT(*) FROM pac_course_desc WHERE $which_course");
											$pages = ceil(mysql_result($pages_query, 0) / $per_page);
											
											$course_page = (isset($_GET['course_page'])) ? (int)$_GET['course_page'] : 1;
											$start = ($course_page - 1) * $per_page;
											
											//=========== Start Placing Book Listings For Display =======================
										
											$query = mysql_query("SELECT * FROM pac_course_desc WHERE $which_course ORDER BY course_num ASC LIMIT $start, $per_page");
											$course_desc_count = mysql_num_rows($query);
											if($course_desc_count > 0)
												{
												while($row = mysql_fetch_array($query))
													{
													$id = $row['id'];
													$pac_course_desc = 'pac_course_desc';
													$course_code = $row['course_code'];
													$course_name = $row['course_name'];
													$course_num = $row['course_num'];
													$credits = $row['credits'];
													$course_num_title = $row['course_num_title'];
													$course_desc = $row['course_desc'];
													$last_edit_date = $row['last_edit_date'];
													
													//======== Start Of ECHO Placement Of Data ============
													echo
													'
													<div class="disc_course_desc">
													
														<table style="width:245px;" align="left" border="0" cellpadding="2">
															<tr>
																<td width="60%" height="auto" align="left" style="color:#000; font-size:12px; padding:2px;" >'.$course_num.'</td>
																<td width="40%" height="auto" align="right" style="color:#000; font-size:12px; padding:2px;" >'.$credits.' Credits</td>
															</tr>
														</table>
														<table style="width:245px;" align="left" border="0" cellpadding="2">	
															<tr>	
																<td width="100%" height="auto" align="left" style="color:#000; font-size:12px; padding:2px;" >'.$course_num_title.'</td>
															</tr>
															
															<tr>	
																<td width="100%" height="auto" align="left" style="color:#000; font-size:12px; padding:2px;" >'.$course_desc.'</td>
															</tr>
															
														</table>
														
													</div>
													';
													
													}//======== Ending "While Loop" Above ==========
												
												} else if ($course_desc_count == 0) {//========= End Or Close Of "if($jobs_count > 0)" Statement Above =========
													$course_desc_count_error = '<span style="color:#F00; font-size:12px;"><br/> No COURSES Were Found Using Your Search Criteria <br/></span>';
												}//========= End Or Close Of "if($jobs_count > 0)" Statement Above ========
												
												
												//=========== Start Of Pagination Numbering At The Bottom Of The Page ==============
												if ($pages >= 1 && $course_page <= $pages)
													{
														for($x = 1; $x <= $pages; $x++)
															{
																$course_page_lineup .= ($x == $course_page) ?
																	'<span style="margin:0px 15px 0px 15px; font-size:14px; font-weight:bold; color:#F00;">Page ' .$x. '</span>' : '
																		<span style="margin:0px 2px 0px 2px; font-size:14px; font-weight:bold; color:#F00;">
																			<a href="PAC_BridgeNursing.php?course_page=' .$x. '">' .$x. '</a></span> ';
															}
													}
												//=========== End Of Pagination Numbering At The Bottom Of The Page ==============
												
												echo '
													'.$course_desc_count_error.'
													<div id="course_box">
													<br/><br/>
									' .$course_page_lineup. ' <span style="color:#F00; font-size:14px; font-weight:bold;"> Total of ' .$total_courses. ' Courses</span>
													</div>
													';
										
											}//======== End Of Creating A Search Data Criteria For "if (isset($_GET['page']))" Above ================================================
									
										?>
										
										<table width="795px" align="left">
											<tr>
												<td colspan="2"><br/><br/></td>
											</tr>
										</table>
										
									</div>
									
								</div>
														
							</div>
						
						</div>
						
						<div id="book_list" onclick="<?php $pac_book_start = 'pac_book_start' ?>" >
							
							<div class="msg_list">
									
								<p class="msg_head">
									PROGRAM BOOKLIST
								</p>
								
								<div id="booklist_open" class="msg_body">
								
									<div id="books_meet_minutes_one">
										
										<table width="800px" align="left">
											<tr>
												<td width="10%" height="auto" align="left" style="color:#000; font-size:12px; padding:2px;" >
													<span style="text-align:left; color:#FFF; font-size:14px;"/>
														Code:
													</span>
												</td>
												<td width="10%" height="auto" align="left" style="color:#000; font-size:12px; padding:2px;" >
													<span style="text-align:left; color:#FFF; font-size:14px;"/>
														Course #:
													</span>
												</td>
												<td width="10%" height="auto" align="left" style="color:#000; font-size:12px; padding:2px;" >
													<span style="text-align:left; color:#FFF; font-size:14px;"/>
														Course Title:
													</span>
												</td>
												<td width="10%" height="auto" align="left" style="color:#000; font-size:12px; padding:2px;" >
													<span style="text-align:left; color:#FFF; font-size:14px;"/>
														Book Title:
													</span>
												</td>
												<td width="10%" height="auto" align="left" style="color:#000; font-size:12px; padding:2px;" >
													<span style="text-align:left; color:#FFF; font-size:14px;"/>
														Author:
													</span>
												</td>
												<td width="10%" height="auto" align="left" style="color:#000; font-size:12px; padding:2px;" >
													<span style="text-align:left; color:#FFF; font-size:14px;"/>
														ISBN:
													</span>
												</td>
												<td width="10%" height="auto" align="left" style="color:#000; font-size:12px; padding:2px;" >
													<span style="text-align:left; color:#FFF; font-size:14px;"/>
														Publisher:
													</span>
												</td>
												<td width="10%" height="auto" align="left" style="color:#000; font-size:12px; padding:2px;" >
													<span style="text-align:left; color:#FFF; font-size:14px;"/>
														Degree:
													</span>
												</td>
												<td width="30%" height="auto" align="left" style="color:#000; font-size:12px; padding:2px;" ></td>
											</tr>
										
											<form action="PAC_BridgeNursing.php" method="post" enctype="multipart/form-data" >
												<tr>
													<td width="5%" height="auto" align="left" style="color:#000; font-size:12px; padding:2px;" >
													<select name="which_book_code"
														style="width:50px; height:auto; text-align:left; color:#FFF; font-size:14px; background-color:#09F;"/>
														<option value=" "> </option>
														<option value="<?php echo $course_id; ?>"><?php echo $course_id; ?></option>
														<?php include("1A_OOP/PAC_OOP_CourseID.php"); ?>
													</select>
													</td>
													<td width="5%" height="auto" align="left" style="color:#000; font-size:12px; padding:2px;" >
													<input type="text" name="which_book_course_num" size="100" maxlength="200"
														style="width:60px; height:auto; text-align:left; color:#FFF; font-size:14px; background-color:#09F;"  />
													</td>
													<td width="5%" height="auto" align="left" style="color:#000; font-size:12px; padding:2px;" >
													<input type="text" name="which_book_course_title" size="100" maxlength="200"
														style="width:100px; height:auto; text-align:left; color:#FFF; font-size:14px; background-color:#09F;"  />
													</td>
													<td width="10%" height="auto" align="left" style="color:#000; font-size:12px; padding:2px;" >
													<input type="text" name="which_book_title" size="100" maxlength="200"
														style="width:100px; height:auto; text-align:left; color:#FFF; font-size:14px; background-color:#09F;"  />
													</td>
													<td width="5%" height="auto" align="left" style="color:#000; font-size:12px; padding:2px;" >
													<input type="text" name="which_book_author" size="100" maxlength="200"
														style="width:100px; height:auto; text-align:left; color:#FFF; font-size:14px; background-color:#09F;"  />
													</td>
													<td width="10%" height="auto" align="left" style="color:#000; font-size:12px; padding:2px;" >
													<input type="text" name="which_book_ISBN" size="100" maxlength="200"
														style="width:80px; height:auto; text-align:left; color:#FFF; font-size:14px; background-color:#09F;"  />
													</td>
													<td width="10%" height="auto" align="left" style="color:#000; font-size:12px; padding:2px;" >
													<input type="text" name="which_book_publisher" size="100" maxlength="200"
														style="width:80px; height:auto; text-align:left; color:#FFF; font-size:14px; background-color:#09F;"  />
													</td>
													<td width="10%" height="auto" align="left" style="color:#000; font-size:12px; padding:2px;" >
													<select name="which_book_degree"
														style="width:100px; height:auto; text-align:left; color:#FFF; font-size:14px; background-color:#09F;"/>
														<option value=" "> </option>
														<option value="nur_adminM">Master Nursing Administration</option>
														<option value="nursing_edM">Master Nursing Education</option>
														<option value="nurs_complete_B">Bachelor Nursing Completion</option>
														<option value="nur_emph_clinicB">Bachelor Nursing Administration Emph Clinical Nurse Educator</option>
														<option value="nur_emph_comuntyB">Bachelor Nursing Administration Emph Community Health Nurse</option>
														<option value="nur_emph_case_manaB">Bachelor Nursing Administration Emph Nurse Case Manager</option>
														<option value="nur_emph_informatB">Bachelor Nursing Administration Emph Nursing Informatics</option>
													</select>
													</td>
													<td width="30%" height="auto" align="left" style="color:#000; font-size:12px; padding:2px;" >
													<input type="submit" name="submit" value="Search" />
													</td>
												</tr>
											</form>
										</table>
										
										<table width="800px" align="left">
											<tr>
												<td><br/><hr style="height:2px; border-style:solid; color:#de7008; background-color:#df7109; border:none;" /><br/></td>
											</tr>
										</table>
										
										<br/>
					
										<table style="width:800px;" align="left" border="0" cellpadding="2">
											<tr>
												<td width="50px" height="auto" style="color:#000; font-weight:bold; font-size:12px; padding:2px;" align="left">Course Number</td>
												<td width="100px" height="auto" style="color:#000; font-weight:bold; font-size:12px; padding:2px;" align="left">Course Title</td>
												<td width="100px" height="auto" style="color:#000; font-weight:bold; font-size:12px; padding:2px;" align="left">Book Title</td>
												<td width="150px" height="auto" style="color:#000; font-weight:bold; font-size:12px; padding:2px;" align="left">Authors</td>
												<td width="30px" height="auto" style="color:#000; font-weight:bold; font-size:12px; padding:2px;" align="left">Edition</td>
												<td width="50px" height="auto" style="color:#000; font-weight:bold; font-size:12px; padding:2px;" align="left">Publish Date</td>
												<td width="150px" height="auto" style="color:#000; font-weight:bold; font-size:12px; padding:2px;" align="left">ISBN</td>
												<td width="40px" height="auto" style="color:#000; font-weight:bold; font-size:12px; padding:2px;" align="left">Publisher</td>
											</tr>
											<tr>
												<td width="50px" height="2px" bgcolor="#003873" align="center"></td>
												<td width="100px" height="2px" bgcolor="#003873" align="center"></td>
												<td width="100px" height="2px" bgcolor="#003873" align="center"></td>
												<td width="150px" height="2px" bgcolor="#003873" align="center"></td>
												<td width="30px" height="2px" bgcolor="#003873" align="center"></td>
												<td width="50px" height="2px" bgcolor="#003873" align="center"></td>
												<td width="150px" height="2px" bgcolor="#003873" align="center"></td>
												<td width="40px" height="2px" bgcolor="#003873" align="center"></td>
											</tr>
											
										<?php
					
										if (isset($_POST['which_book_code'])
											|| isset($_POST['which_book_course_num']) || isset($_POST['which_book_course_title']) || isset($_POST['which_book_title'])
											|| isset($_POST['which_book_author']) || isset($_POST['which_book_ISBN']) || isset($_POST['which_book_publisher']) || isset($_POST['which_book_degree']))
											{
											
											echo
											'
											<script type="text/javascript" src="jquery.js"></script>
											
											<script type="text/javascript">
											$(document).ready(function(){
												//hide the all of the element with class msg_body
												$(".msg_body").hide();
												$("#booklist_open").show();
											});
											</script>
											';
											
											require_once "dbase_interface.php";
											
											$pac_book_start = NULL;
															
											//======= Start Of Clearing Variables For Use In Code ========
											$which_book_code = "";
											$which_book_course_num = "";
											$which_book_course_title = "";
											$which_book_title = "";
											$which_book_author = "";
											$which_book_ISBN = "";
											$which_book_publisher = "";
											$which_book_degree = "";
											$where = "";
											//======= End Of Clearing Variables For Use In Code ========
											
											$which_book .= "id >=0";
											
											$which_book_code = mysql_real_escape_string(htmlentities(trim($_POST['which_book_code'])));
											if($which_book_code === 'ALL')
												{
													$which_book .= " AND ";
													$which_book .= "db_end_marker LIKE 'x'";
													
												} else if ($which_book_code) {
													
													$which_book .= " AND ";
													$which_book .= "course_number LIKE '%$which_book_code%'";
												}
											$which_book_course_num = mysql_real_escape_string(htmlentities(trim($_POST['which_book_course_num'])));
											if($which_book_course_num)
												{
												$which_book_course_num = str_replace(' ', '', $which_book_course_num);
												$count = strlen($which_book_course_num);
												if($count > 3) { $which_book_course_num = chunk_split($which_book_course_num, 3, " "); }
												$which_book .= " AND ";
												$which_book_course_num = trim($which_book_course_num, " ");
												$which_book .= "course_number LIKE '%$which_book_course_num%'";
												}
											$which_book_course_title = mysql_real_escape_string(htmlentities(trim($_POST['which_book_course_title'])));
											if($which_book_course_title)
												{
												$which_book .= " AND ";
												$which_book .= "course_name LIKE '%$which_book_course_title%'";
												}
											$which_book_title = mysql_real_escape_string(htmlentities(trim($_POST['which_book_title'])));
											if($which_book_title)
												{
												$which_book .= " AND ";
												$which_book .= "book_title LIKE '%$which_book_title%'";
												}
											$which_book_author = mysql_real_escape_string(htmlentities(trim($_POST['which_book_author'])));
											if($which_book_author)
												{
												$which_book .= " AND ";
												$which_book .= "authors LIKE '%$which_book_author%'";
												}
											$which_book_ISBN = mysql_real_escape_string(htmlentities(trim($_POST['which_book_ISBN'])));
											if($which_book_ISBN)
												{
												$which_book .= " AND ";
												$which_book .= "isbn LIKE '%$which_book_ISBN%'";
												}
											$which_book_publisher = mysql_real_escape_string(htmlentities(trim($_POST['which_book_publisher'])));
											if($which_book_publisher)
												{
												$which_book .= " AND ";
												$which_book .= "publisher LIKE '%$which_book_publisher%'";
												}
											$which_book_degree = mysql_real_escape_string(htmlentities(trim($_POST['which_book_degree'])));
											if($which_book_degree)
												{
												$which_book = NULL;
												$get_course_numbers .= "$which_book_degree LIKE 'x'";
												}
											//======= End Of Setting $which_course To Control Display Of Database =======
											
											
											
											//======= Start Of Collecting Course Numbers From 'pac_course_desc' That Support A Specific Degree =======
											$place_the_OR = 1;
											$query = mysql_query("SELECT course_num FROM pac_course_desc WHERE $get_course_numbers AND pac_nursing LIKE 'x'");
												$course_num_count = mysql_num_rows($query);
												if($course_num_count > 0)
													{
													while($row = mysql_fetch_array($query))
														{
														$course_num = $row['course_num'];
														$build_book_search .= "course_number='$course_num'";
															if($course_num_count == $place_the_OR)
																{
																	//======= Does Nothing To Elliminate The OR On The End Of The Array =======
																} else {
																	
																	$build_book_search .= " OR ";
																	$place_the_OR++;
																}
														}
													}
											$which_book .= $build_book_search;
											//======= End Of Collecting Course Numbers From 'pac_course_desc' That Support A Specific Degree =======
											
											
											
											//====== Creating A New Count For Total of Books To Use In Search ==========
											$count_query = mysql_query("SELECT * FROM pac_booklist WHERE $which_book");
											$total_books = mysql_num_rows($count_query);
											
											session_start();
											//====== Putting "which_book Into A Session For Call Back ==========
											$_SESSION['which_book'] = $which_book;
											
											//====== Recalling "which_book" From SESSION To Use In Search ==========
											$which_book = $_SESSION['which_book'];
											
											session_start();
											//====== Putting "total_books" Into A Session For Call Back ==========
											$_SESSION['total_books'] = $total_books;
											
											//====== Recalling "total_books" From SESSION To Use In Display ==========
											$total_books = $_SESSION['total_books'];
										
											$per_page = 10;
											
											$pages_query = mysql_query("SELECT COUNT(*) FROM pac_booklist WHERE $which_book");
											$pages = ceil(mysql_result($pages_query, 0) / $per_page);
											
											$book_page = (isset($_GET['book_page'])) ? (int)$_GET['book_page'] : 1;
											$start = ($book_page - 1) * $per_page;
											
											
											//=========== Start Placing Book Listings For Display =======================
											$query = mysql_query("SELECT * FROM pac_booklist WHERE $which_book ORDER BY course_number ASC LIMIT $start, $per_page");
											$jobs_count = mysql_num_rows($query);
											if($jobs_count > 0)
												{
												while($row = mysql_fetch_array($query))
													{
													$course_number = $row['course_number'];
													$course_name = $row['course_name'];
													$book_title = $row['book_title'];
													$authors = $row['authors'];
													$edition = $row['edition'];
													$publish_date = $row['publish_date'];
													$isbn = $row['isbn'];
													$publisher = $row['publisher'];
													
													//======== Start Of ECHO Placement Of Data ============
													echo
													'
														<tr bgcolor="#fff">
															<td width="50px" height="auto" style="color:#000; font-size:12px; padding:2px;" align="left">',$course_number,'</td>
															<td width="100px" height="auto" style="color:#000; font-size:12px; padding:2px;" align="left">',$course_name,'</td>
															<td width="100px" height="auto" style="color:#000; font-size:12px; padding:2px;" align="left">',$book_title,'</td>
															<td width="150px" height="auto" style="color:#000; font-size:12px; padding:2px;" align="left">',$authors,'</td>
															<td width="30px" height="auto" style="color:#000; font-size:12px; padding:2px;" align="left">',$edition,'</td>
															<td width="50px" height="auto" style="color:#000; font-size:12px; padding:2px;" align="left">',$publish_date,'</td>
															<td width="150px" height="auto" style="color:#000; font-size:12px; padding:2px;" align="left">',$isbn,'</td>
															<td width="40px" height="auto" style="color:#000; font-size:12px; padding:2px;" align="left">',$publisher,'</td>
														</tr>
														
													';
													
													}//======== Ending "While Loop" Above ==========
												
												} else if ($total_books == 0) {//========= End Or Close Of "if($jobs_count > 0)" Statement Above =========
													$total_books_error = '<span style="color:#F00; font-size:12px;"><br/> No BOOKS Were Found Using Your Search Criteria <br/></span>';
												}//========= End Or Close Of "if($jobs_count > 0)" Statement Above ========
												
												echo '</table>';
												
												//=========== Start Of Pagination Numbering At The Bottom Of The Page ==============
												if ($pages >= 1 && $book_page <= $pages)
													{
														for($p = 1; $p <= $pages; $p++)
															{
																$book_page_lineup .= ($p == $book_page) ?
																	'<span style="margin:0px 15px 0px 15px; font-size:14px; font-weight:bold; color:#F00;">Page ' .$p. '</span>' : '
																		<span style="margin:0px 2px 0px 2px; font-size:14px; font-weight:bold; color:#F00;">
																			<a href="PAC_BridgeNursing.php?book_page=' .$p. '">' .$p. '</a></span> ';
															}
													}
												//=========== End Of Pagination Numbering At The Bottom Of The Page ==============
												
												echo '
													'.$total_books_error.'
													<div id="book_box">
													' .$book_page_lineup. ' <span style="color:#F00; font-size:14px; font-weight:bold;"> Total of ' .$total_books. ' Courses</span>
													</div>
													';
										
											}//======== End Of Creating A Search Data Criteria For "if (isset($_GET['page']))" Above ================================================
											
										if (isset($_GET['book_page']))
											{
											
											echo
											'
											<script type="text/javascript" src="jquery.js"></script>
											
											<script type="text/javascript">
											$(document).ready(function(){
												//hide the all of the element with class msg_body
												$(".msg_body").hide();
												$("#booklist_open").show();
											});
											</script>
											';
											
											require_once "dbase_interface.php";
											
											$pac_book_start = NULL;
											
											//====== Recalling "which_book" And "total_books" From SESSION To Use In Search ==========
											$which_book = $_SESSION['which_book'];
											$total_books = $_SESSION['total_books'];
										
											$per_page = 10;
											
											$pages_query = mysql_query("SELECT COUNT(*) FROM pac_booklist WHERE $which_book");
											$pages = ceil(mysql_result($pages_query, 0) / $per_page);
											
											$book_page = (isset($_GET['book_page'])) ? (int)$_GET['book_page'] : 1;
											$start = ($book_page - 1) * $per_page;
											
											//=========== Start Placing Book Listings For Display =======================
										
											$query = mysql_query("SELECT * FROM pac_booklist WHERE $which_book ORDER BY course_number ASC LIMIT $start, $per_page");
											$jobs_count = mysql_num_rows($query);
											if($jobs_count > 0)
												{
												while($row = mysql_fetch_array($query))
													{
													$course_number = $row['course_number'];
													$course_name = $row['course_name'];
													$book_title = $row['book_title'];
													$authors = $row['authors'];
													$edition = $row['edition'];
													$publish_date = $row['publish_date'];
													$isbn = $row['isbn'];
													$publisher = $row['publisher'];
													
													//======== Start Of ECHO Placement Of Data ============
													echo
													'
														<tr bgcolor="#fff">
															<td width="50px" height="auto" style="color:#000; font-size:12px; padding:2px;" align="left">',$course_number,'</td>
															<td width="100px" height="auto" style="color:#000; font-size:12px; padding:2px;" align="left">',$course_name,'</td>
															<td width="100px" height="auto" style="color:#000; font-size:12px; padding:2px;" align="left">',$book_title,'</td>
															<td width="150px" height="auto" style="color:#000; font-size:12px; padding:2px;" align="left">',$authors,'</td>
															<td width="30px" height="auto" style="color:#000; font-size:12px; padding:2px;" align="left">',$edition,'</td>
															<td width="50px" height="auto" style="color:#000; font-size:12px; padding:2px;" align="left">',$publish_date,'</td>
															<td width="150px" height="auto" style="color:#000; font-size:12px; padding:2px;" align="left">',$isbn,'</td>
															<td width="40px" height="auto" style="color:#000; font-size:12px; padding:2px;" align="left">',$publisher,'</td>
														</tr>
														
													';
													
													}//======== Ending "While Loop" Above ==========
												
												} else if ($total_books == 0) {//========= End Or Close Of "if($jobs_count > 0)" Statement Above =========
													$total_books_error = '<span style="color:#F00; font-size:12px;"><br/> No BOOKS Were Found Using Your Search Criteria <br/></span>';
												}//========= End Or Close Of "if($jobs_count > 0)" Statement Above ========
												
												echo '</table>';
												
												//=========== Start Of Pagination Numbering At The Bottom Of The Page ==============
												if ($pages >= 1 && $book_page <= $pages)
													{
														for($p = 1; $p <= $pages; $p++)
															{
																$book_page_lineup .= ($p == $book_page) ?
																	'<span style="margin:0px 15px 0px 15px; font-size:14px; font-weight:bold; color:#F00;">Page ' .$p. '</span>' : '
																		<span style="margin:0px 2px 0px 2px; font-size:14px; font-weight:bold; color:#F00;">
																			<a href="PAC_BridgeNursing.php?book_page=' .$p. '">' .$p. '</a></span> ';
															}
													}
												//=========== End Of Pagination Numbering At The Bottom Of The Page ==============
												
												echo '
													'.$total_books_error.'
													<div id="book_box">
													' .$book_page_lineup. ' <span style="color:#F00; font-size:14px; font-weight:bold;"> Total of ' .$total_books. ' Courses</span>
													</div>
													';
										
											}//======== End Of Creating A Search Data Criteria For "if (isset($_GET['page']))" Above ================================================
											
										if ($pac_book_start == 'pac_book_start')
											{
											
											require_once "dbase_interface.php";
															
											//======= Start Of Clearing Variables For Use In Code ========
											$which_book_code = "";
											$which_book_course_num = "";
											$which_book_course_title = "";
											$which_book_title = "";
											$which_book_author = "";
											$which_book_ISBN = "";
											$which_book_publisher = "";
											$which_book_degree = "";
											$which_book = "";
											//======= End Of Clearing Variables For Use In Code ========
											
											$which_book .= "id >=0";
											$which_book .= " AND ";
											
											//======= Start Of Collecting Course Numbers From 'pac_course_desc' That Support A Specific Degree =======
											$place_the_OR = 1;
											$query = mysql_query("SELECT course_num FROM pac_course_desc WHERE pac_nursing LIKE 'x'");
												$course_num_count = mysql_num_rows($query);
												if($course_num_count > 0)
													{
													while($row = mysql_fetch_array($query))
														{
														$course_num = $row['course_num'];
														$build_book_search .= "course_number='$course_num'";
															if($course_num_count == $place_the_OR)
																{
																	//======= Does Nothing To Elliminate The OR On The End Of The Array =======
																} else {
																	
																	$build_book_search .= " OR ";
																	$place_the_OR++;
																}
														}
													}
											$which_book .= $build_book_search;
											//======= End Of Collecting Course Numbers From 'pac_course_desc' That Support A Specific Degree =======
											
											
																	
											//====== Creating A New Count For Total of Books To Use In Search ==========
											$count_query = mysql_query("SELECT * FROM pac_booklist WHERE $which_book");
											$total_books = mysql_num_rows($count_query);
											
											session_start();
											//====== Putting "which_book Into A Session For Call Back ==========
											$_SESSION['which_book'] = $which_book;
											
											//====== Recalling "which_book" From SESSION To Use In Search ==========
											$which_book = $_SESSION['which_book'];
											
											session_start();
											//====== Putting "total_books" Into A Session For Call Back ==========
											$_SESSION['total_books'] = $total_books;
											
											//====== Recalling "total_books" From SESSION To Use In Display ==========
											$total_books = $_SESSION['total_books'];
										
											$per_page = 10;
											
											$pages_query = mysql_query("SELECT COUNT(*) FROM pac_booklist WHERE $which_book");
											$pages = ceil(mysql_result($pages_query, 0) / $per_page);
											
											$book_page = (isset($_GET['book_page'])) ? (int)$_GET['book_page'] : 1;
											$start = ($book_page - 1) * $per_page;
											
											//=========== Start Placing Book Listings For Display =======================
										
											$query = mysql_query("SELECT * FROM pac_booklist WHERE $which_book ORDER BY course_number ASC LIMIT $start, $per_page");
											$jobs_count = mysql_num_rows($query);
											if($jobs_count > 0)
												{
												while($row = mysql_fetch_array($query))
													{
													$course_number = $row['course_number'];
													$course_name = $row['course_name'];
													$book_title = $row['book_title'];
													$authors = $row['authors'];
													$edition = $row['edition'];
													$publish_date = $row['publish_date'];
													$isbn = $row['isbn'];
													$publisher = $row['publisher'];
													
													//======== Start Of ECHO Placement Of Data ============
													echo
													'
														<tr bgcolor="#fff">
															<td width="50px" height="auto" style="color:#000; font-size:12px; padding:2px;" align="left">',$course_number,'</td>
															<td width="100px" height="auto" style="color:#000; font-size:12px; padding:2px;" align="left">',$course_name,'</td>
															<td width="100px" height="auto" style="color:#000; font-size:12px; padding:2px;" align="left">',$book_title,'</td>
															<td width="150px" height="auto" style="color:#000; font-size:12px; padding:2px;" align="left">',$authors,'</td>
															<td width="30px" height="auto" style="color:#000; font-size:12px; padding:2px;" align="left">',$edition,'</td>
															<td width="50px" height="auto" style="color:#000; font-size:12px; padding:2px;" align="left">',$publish_date,'</td>
															<td width="150px" height="auto" style="color:#000; font-size:12px; padding:2px;" align="left">',$isbn,'</td>
															<td width="40px" height="auto" style="color:#000; font-size:12px; padding:2px;" align="left">',$publisher,'</td>
														</tr>
														
													';
													
													}//======== Ending "While Loop" Above ==========
												
												} else if ($total_books == 0) {//========= End Or Close Of "if($jobs_count > 0)" Statement Above =========
													$total_books_error = '<span style="color:#F00; font-size:12px;"><br/> No BOOKS Were Found Using Your Search Criteria <br/></span>';
												}//========= End Or Close Of "if($jobs_count > 0)" Statement Above ========
												
												echo '</table>';
												
												//=========== Start Of Pagination Numbering At The Bottom Of The Page ==============
												if ($pages >= 1 && $book_page <= $pages)
													{
														for($p = 1; $p <= $pages; $p++)
															{
																$book_page_lineup .= ($p == $book_page) ?
																	'<span style="margin:0px 15px 0px 15px; font-size:14px; font-weight:bold; color:#F00;">Page ' .$p. '</span>' : '
																		<span style="margin:0px 2px 0px 2px; font-size:14px; font-weight:bold; color:#F00;">
																			<a href="PAC_BridgeNursing.php?book_page=' .$p. '">' .$p. '</a></span> ';
															}
													}
												//=========== End Of Pagination Numbering At The Bottom Of The Page ==============
												
												echo '
													'.$total_books_error.'
													<div id="book_box">
													' .$book_page_lineup. ' <span style="color:#F00; font-size:14px; font-weight:bold;"> Total of ' .$total_books. ' Courses</span>
													</div>
													';
										
											}//======== End Of Creating A Search Data Criteria For "if (isset($_GET['page']))" Above ================================================
										
										?>
										
									</div>
									
								</div>
														
							</div>
						
						</div>
					
					</div>
					
				</div>
				
				<br/><br/><br/><br/><br/><br/>
				
				<?php
					if($edit_page)
						{
							echo
								'
									<input type="text" name="name" maxlength="64" size="30" value="'.$name.'"
									style="width:215px; height:auto; text-align:left; color:#FFF; font-size:14px; background-color:#09F;" />
									<br/><br/>
									<input type="text" name="admin_title" maxlength="64" size="30" value="'.$admin_title.'"
									style="width:215px; height:auto; text-align:left; color:#FFF; font-size:14px; background-color:#09F;" />
									<br/><br/>
									Your Last Update Was <span style="color:#F00">' .$last_edit_date.'</span>
									<br/><br/>
									<input type="submit" name="submit" value="Update Edit">
								</form>
								';
						} else {
							echo
								'
								'.$lower_text.'
							
								<br/><br/><br/><br/><br/>
						
								<span style="color:#002c5f; font-size:1.8em; font-family:Helvetica, Mistral; line-height:14px;">'.$name.'</span>
								<br/>
								<span style="color:#002c5f; font-size:1.0em; font-family:Zapfino, Mistral;">'.$admin_title,'</span>
								<br/><br/>
								';
						}
					?>
				
				<table border="0" cellspacing="3" cellpadding="3" width="840" height="5px" align="left">
					<tr>
						<td width="100%" align="center"><a href="PAC_BridgeMinutes.php">&emsp;BACK TO THE PAC BRIDGE</a>&emsp;&emsp;</td>
					</tr>
				</table>
				
				<br/><br/>
            
            </div>
                        
            <div class="clear"></div>

		</div><!--- Contact Content Ends --->
		</div>
		</div>

	<div class="dropshadow_left" >
	<div id="footer" class="dropshadow_right"><!--- footer start --->
		<?php include("CallOut/Footer.php")?>
	</div><!--- footer end --->
	</div>
    
    <div class="clear"></div>

</div><!--- wrapper end --->

</div>

</body>
</html>