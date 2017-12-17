<?php

//======= Author Kevin Patterson 2012 =======


//========= Start Of Page Hit Counter Accessing The Page Hit Counter And Placing Count ===========
include("CallOut/page_hit_counter.php");
page_hit_counter('Hits12_PAC');
//========= End Of Page Hit Counter Accessing The Page Hit Counter And Placing Count ===========


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<title>PAC Support</title>

<link rel="SHORTCUT ICON" href="favicon.ico"/>
<link href="style.css" rel="stylesheet" type="text/css"/>

<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	//hide the all of the element with class msg_body
	$(".msg_body").hide();
	//toggle the componenet with class msg_body
	$(".msg_head").click(function(){
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
					LETTER FROM DR. ALAN D. HANSEN, EXECUTIVE DIRECTOR OF ONLINE
				</p>
                
                <br/><br/>
                
				<p>
					Dear PAC Members:<br/><br/>
							
					Thank you for your contributions as a member of our Program Advisory Committee.  Your assistance has been of tremendous help.
					From our last meeting in March, the Committees identified a number of opportunities for improvement for our programs and curriculum.
					Your assistance is helping make a difference.<br/><br/>
					
					A few of the improvements we are examining and/or have implemented already include:<br/><br/>
					
					&emsp;&emsp;&bull;&emsp;Implementation of a new learning platform.  We have moved from the rather out-of-date Angel platform to what is considered<br/>
					<span style="padding:43px">by many to be the best LMS in the country, LearningStudio (previously known as e-College.</span><br/>
					&emsp;&emsp;&bull;&emsp;We are expanding the use of the MyFoundationsLab tutorial materials for students who struggle with reading, writing, and math.<br/>
					&emsp;&emsp;&bull;&emsp;We are developing a multimedia study guide program.  The first of these, for History 220 will roll out in August. We plan to share<br/>
					<span style="padding:43px">a demonstration of this innovation at the next PAC meeting.</span><br/>
					&emsp;&emsp;&bull;&emsp;We have submitted our application for NLNAC program accreditation for our nursing programs.<br/>
					&emsp;&emsp;&bull;&emsp;We added a pre-Algebra course to our remediation package that is available to all students with no increase in tuition.<br/>
					&emsp;&emsp;&bull;&emsp;We have new program emphases approved and moving forward in all programs.<br/><br/> 
					
					We have several other initiatives derived from our last PAC meeting that are in various stages of development.
					Many of these initiatives would not be underway if not for your insights.<br/><br/>
					
					Again, I would like to express my appreciation for your willingness to take time from your busy schedule to help us improve Stevens-Henager College Online.<br/><br/>
					
					Sincerely,<br/><br/><br/>
					
					<span style="color:#002c5f; font-size:1.8em; font-family:Zapfino, Mistral; line-height:14px;">Alan D. Hansen, PhD, MBA</span>
					<br/>
					<span style="color:#002c5f; font-size:1.0em; font-family:Zapfino, Mistral;">Executive Director Online Division</span>
					<br/><br/>
					<img src="images/SH_Online_Header.png" alt="Stevens Henager Logo"/><img src="images/IUSho_Logo.png" alt="Independence University Logo"/>

				</p>
                    
				<br/><br/>
				
				<hr/><br/>
								
				<?php include("CallOut/PAC_BridgeLongbar.php")?>
            
            </div>
				
			<div id="PAC_Logos">
				
				<div id="PAC_BridgeBar">
				
					PAC BRIDGE LOGIN
							
					<br/><hr width="50%"s/><br/>
						
					<form action="PAC_Login.php" method="post" enctype="multipart/form-data" name="logform" id="logform" onsubmit="return validate_form ( );">
						<strong>User ID:</strong>
						<input name="pac_id" type="text" id="pac_id" onclick="activate" size="30" maxlength="64"
						style="width:215px; height:auto; text-align:left; color:#FFF; font-size:14px; background-color:#09F;" />
					
					&emsp;
					
						<strong>Password:</strong>
						<input name="password" type="password" id="password" size="30" maxlength="24"
						style="width:215px; height:auto; text-align:left; color:#FFF; font-size:14px; background-color:#09F;" />
					
					<br/><br/>
					
						<input type="submit" name="submit" value="Login">
						
					</form>
				
				</div>
				
				<?php include("CallOut/PAC_BridgeLogos.php")?>
									  
			</div>
                                
			<p style="width:900px; height:auto; text-align:center;"><a href="PAC_Support.php">Top</a>&emsp;<a href="index.php">Home</a><br/><br/></p>
                        
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