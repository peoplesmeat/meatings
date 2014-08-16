<?php
function outputInviteeList($header, $html,$list, $isUser) {
	if (count($list)==0){
		return; 
	}
	echo '<div style="clear:both; padding-top:20px;">'; 
	echo '<h2 style="color:#104C68 	;">'.$header.'</h2>';
	echo "<ul>"; 
	foreach ($list as $i)
	{		
		$dt = strtotime($i['InviteeResponse']['modified']);
		echo "<li>";
		echo '<div class="inviteeInfo">';
		echo '<div class="inviteeName">'.$i['Invitee']['name'].'</div>';		
		echo '</div>'; 
		echo $html->div('inviteeListMessage', $i['InviteeResponse']['message']);
		if ($dt) {
			echo $html->div('inviteeListDate', 
				date('jS F',$dt).' at '. date('g:i a',$dt));
		}
		
		if ($isUser) {
			echo '<div style="clear:both; padding:8px;">';
			if ($i['Invitee']['last_visit']!=null) {
				echo 'Last Checked on '.$i['Invitee']['last_visit'].' | '; 
			}
			echo $i['Invitee']['email'];
			echo '</div>';
		}
		
		echo "</li>";
	}
	echo "</ul>"; 
	echo '</div>';
}
?>

<div id="inviteeList">

<?php
outputInviteeList('I\'ll be there!', $html, $invitees['coming'], $isUser);
?>

<?php
outputInviteeList('No thank you!', $html, $invitees['notcoming'],$isUser);
?>

<?php
outputInviteeList('Maybe Yes/Maybe No', $html, $invitees['unsure'],$isUser);
?>

<?php
outputInviteeList('Not (yet) responded', $html, $invitees['unresponded'],$isUser);
?>


</div>
