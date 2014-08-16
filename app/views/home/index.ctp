<?php
	echo $html->image("banner.jpg");
if (isset($q)) 
{
						 
	/*echo Debugger::exportVar($q, 4);*/

	
	echo '<div style="padding-bottom:15px">';
	echo $html->link('Create a New Meating', 
						array('controller'=>'meatings', 'action'=>'create'));
	echo "</div>"; 
	
	foreach ($q as $i)
	{
		echo '<div class="meatingList">';
		echo $html->image('sets/small/'.$i['Meating']['img_name'], array('alt' => 'CakePHP')); 
		echo $html->link($i['Meating']['title'], 
						array('controller'=>'meatings', 'action'=>'show/'.$i['Meating']['id']));
		echo '</div>'; 
		//echo 	Debugger::exportVar($i,1); 
	}
}


?>
<div style="clear:both;"></div>