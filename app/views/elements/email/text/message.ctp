Hello <?php echo $invitee['name']; ?>!
This is a message about <?php echo $meating['title']; ?> which
is to be held 
<?php
$dt = strtotime($meating['scheduled_for']);   
echo date('jS F',$dt).' at '. date('g:i a',$dt);
?>

<?php
echo $message; 
?>

Remember you can update your current attending status at 
http://meat.peoplesmeat.com/meatings/respond/<?php echo $invitee['secret']?>
