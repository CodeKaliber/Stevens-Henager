<?php

//======= Author Kevin Patterson 2012 =======

//========= Start Of Page Hit Counter Accessing The Page Hit Counter And Placing Count ===========
include("CallOut/page_hit_counter.php");
page_hit_counter('Hits08_Contact');
//========= End Of Page Hit Counter Accessing The Page Hit Counter And Placing Count ===========

session_start(); // Must start session first thing

//=============== Start Setting Links to NULL =================
$body = "";
$authors_id = "";
$post_date = "";
$control_date = "";
$new_post = "";
//=============== Start Setting Links to NULL =================


//======== Start Of User ID And Password Varification ==============
if (isset($_SESSION['id'])) {
	//============ Placing Stored Session Variables Into Local Variables ===========
	$user_id = $_SESSION['user_id'];
	$id = $_SESSION['id'];
	
//============== Connect to The Database to Varify Login User ================== 
require_once "dbase_interface.php";
//require_once "dbase_interface.php";

$user_id = ($_POST['user_id']);
$password = ereg_replace("[^!A-Za-z~0-9?]", "", $_POST['password']); // Filtering Out Everything But The Items Showing In The Brackets
$password = ($password);
$sql = mysql_query("SELECT * FROM admin_user WHERE user_id='$user_id' AND password='$password'"); 
$login_check = mysql_num_rows($sql);
if($login_check > 0)
	{ 
		while($row = mysql_fetch_array($sql)){ 
			//============== Putting Authors Id And Name Into Variables =================
		
			$id = $row["id"];
			$user_id = $row["user_id"];
			
			// ========== Setting Todates Date As Authors Last Login Date ====================
			mysql_query("UPDATE admin_user SET lastlogin_date=now() WHERE id='$id'");
		} // close while
	} else {
	// Print login failure message to the user and link them back to your login page
	$no_record = "Invalid Login Attempt. <br/> That Account Does Not Exist... <br/><br/>";
	}
} else {
	//header("location: ReturnToLoginPage.php");
}// close if isset
//======== End Of User ID And Password Varification ==============

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<title>Contact Us</title>

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
			<?php include("functions/birthdays.inc"); ?>	
		<div class="dropshadow_left" >
		<div class="dropshadow_right" >
		<div id="contact_upper_content"><!--- Upper Content start --->
        
        	<?php include("CallOut/TopPageMenuCntlr.php")?>
                
			<!---
            <div id="header_id">
          
          		<img src="images/ContactsUsSign.png" />
                
			</div>
            --->
            
		</div>
        
        <div id="contact_content"><!--- Contact Content start --->
        	
            <div id="Page_Indicator">
				<img src="images/HeaderBkgndSupportContact.jpg" alt="Indicates Which Page" />
			</div>
				
			<div id="contact_sharc">
			
                <div id="contact_layout">
                	
                    
                    <div id="longbar">
                    	
                        <?php //======= include("CallOut/ChangeLongbar.php") ======= ?>

					</div>
                    
					
                    <div id="row_one">
						
						<h1>SUPPORT STAFF</h1>
						<hr/>
						<br/>
                    	
                        <?php include("CallOut/Support.php")?>
						
						<?php include("CallOut/ExecutiveTeam.php")?>
						
						<?php include("CallOut/Registrar.php")?>
                        
					</div>
					
                    <div id="row_two">
                        
                        <?php include("CallOut/Student_Service.php")?>
                        
                        <?php include("CallOut/BusOffice.php")?>
						
						<?php include("CallOut/Career_Service.php")?>
                        
                    </div>
                    
                    <div id="row_three">
                    	
						<?php include("CallOut/Admissions.php")?>
						
						<?php include("CallOut/Staff.php")?>
						
						<?php include("CallOut/Clinical_Support.php")?>
						
					</div>
                    
                    <div id="row_four">
						
						<h1>ACADEMICS</h1>
						<hr/>
						<br/>
                    	
						<?php include("CallOut/Deans.php")?>
						
                        <?php include("CallOut/Business.php")?>
						
						<?php include("CallOut/CompScience.php")?>
						
					</div>
                    
                    <div id="row_five">
						
						<?php include("CallOut/GenEd.php")?>
						
						<?php include("CallOut/GraphicArts.php")?>
						
						<?php include("CallOut/Healthcare.php")?>
						
					</div>
					
					<div id="row_six">
						
						<?php include("CallOut/Faculty.php")?>
						
					</div>
					
					<table align="center" border="0" cellpadding="2">
						<tr>
							<td width="250px" height="25px" bgcolor="#003873" align="center"></td>
							<td width="250px" height="25px" bgcolor="#003873" align="center"></td>
							<td width="250px" height="25px" bgcolor="#003873" align="center"><a href="contactus_login_edit.php">Contact Admin Login</a></td>
						</tr>
					</table>
                        
				</div>
				
			</div>
            
            <div class="clear"></div>

		</div><!--- Contact Content start --->
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