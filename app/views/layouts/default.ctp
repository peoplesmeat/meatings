<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $html->charset(); ?>
	<title>
		<?php __('Meatings:'); ?>
		<?php echo $title_for_layout; ?>
	</title>
	<?php echo $html->css('meat'); ?>
	

     
</head>

<body>

<div id="wrapper">

<div id="header">
	<div style="float:left; padding-top:50px;">
	<?php 
	if ($session->check('User')) {
		echo $session->read('User.username')." | ".$html->link('Logout',array('controller'=>'users', 'action'=>'logout'));
	} else {
		echo $html->link('Login', array('controller'=>'users', 'action'=>'login'));
		echo " | ";
		echo $html->link('Register', array('controller'=>'users', 'action'=>'register')); 
		echo " a new account";
	}
	?> 
	</div>

	<div style="text-align: right;">
		<?php echo $html->link(
		$html->image("logo.jpg", array("alt" => "Brownies")),
		array('controller'=>'home', 'action'=>'index'),
		array(),
		false,
		false
		); ?>		
	</div>		
</div>

<div id="content">
<?php
if ($session->check('Message.flash')):
	$session->flash();
endif;
?>
		
<?php echo $content_for_layout; ?>
</div>




</div> <!-- End Wrapper -->

<div id="footer">
meat.peoplesmeat.com | For all your online meeting needs | <a href="mailto:davis@maraudertech.com?subject=Meatings">Contact</a>
</div>

<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
var pageTracker = _gat._getTracker("UA-5559102-1");
pageTracker._trackPageview();
</script>
	
</body>

</html>
