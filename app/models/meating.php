<?php
class Meating extends AppModel 
{
	var $hasMany = 'Invitee';	
	var $belongsTo = 'User';
	var $recursive = 2;  
}
?>