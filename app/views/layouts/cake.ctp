<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $html->charset(); ?>
	<title>
		<?php __('Meatings:'); ?>
		<?php echo $title_for_layout; ?>
	</title>

</head>

<body>
<?php
if ($session->check('Message.flash')):
	$session->flash();
endif;
?>
		
<?php echo $content_for_layout; ?>

</body>

</html>
