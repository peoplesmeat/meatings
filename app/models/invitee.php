<?php
class Invitee extends AppModel
{
	var $belongsTo = 'Meating';
	var $hasOne = 'InviteeResponse';

	var $validate = array(
		'email'=>array('rule'=>'email') 

	);

	function beforeSave()
	{
		if (!$this->id)
		{
			$this->data['Invitee']['secret'] = $this->generatePassword(16); 
		}
		return true;
	}

	function generatePassword ($length = 8)
	{

		// start with a blank password
		$password = "";

		// define possible characters
		$possible = "0123456789bcdfghjkmnpqrstvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";

		// set up a counter
		$i = 0;

		// add random characters to $password until $length is reached
		while ($i < $length) {

			// pick a random character from the possible ones
			$char = substr($possible, mt_rand(0, strlen($possible)-1), 1);

			// we don't want this character if it's already in the password
			if (!strstr($password, $char)) {
				$password .= $char;
				$i++;
			}

		}

		// done!
		return $password;

	}

}
?>