<?php
class User extends AppModel {
	var $displayField = 'username'; 
	var $validate = array( 	
		'username' => array(
			'rule' => 'isUnique',
				'required' => true, 'allowEmpty' => false,
				'message' => 'Such alias already exists'),
	    'email' => array('rule'=>'email', 'message'=>'Must enter a valid email')
		);
	
	function validateLogin($data) 
	{
        $user = $this->find(
    		array('username' => $data['username'], 
              'password' => sha1($data['password'].$data['username'])),
    		array('id', 'username'));
        if(empty($user) == false)
            return $user['User'];
        return false; 		
	}
	
	function hashPassword($username, $password) 
	{
		return sha1($password.$username);
		
	}
	
	function unique($data, $name)
	{
		$this->recursive = -1;
		$found = $this->find(array("{$this->name}.$name" => $data));
		$same = isset($this->id) && $found[$this->name][$this->primaryKey] == $this->id;
		return !$found || $found && $same;
	}
}
?>