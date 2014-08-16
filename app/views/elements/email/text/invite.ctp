Congratulations lucky person!
<?php 
echo $meating['host'].' has invited you to '.$meating['title'];
$dt = strtotime($meating['scheduled_for']);  
?>

This super special event has been scheduled for <?php echo date('jS F',$dt).' at '. date('g:i a',$dt);?>

For more information about who else is invited to <?php echo $meating['title']; ?>
 and to let <?php echo $meating['host']?> know if you can attend visit

http://meat.peoplesmeat.com/meatings/respond/<?php echo $invitee['secret']?>

Thank You!
