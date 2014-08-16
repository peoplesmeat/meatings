<?php
class UsersController extends AppController {
	//var $scaffold;
	
	
    function logout()
    {
        $this->Session->destroy('user');
        $this->Session->setFlash('You\'ve successfully logged out.');
        $this->redirect(array('controller' => 'home', 'action' => 'index'));
    } 
    
    function __validateLoginStatus()
    {
        if($this->action != 'login' && $this->action != 'logout')
        {
            if($this->Session->check('User') == false)
            {
                $this->redirect('login');
                $this->Session->setFlash('The URL you\'ve followed requires you login.');
            }
        }
    } 
    
    function register()
    { 
    	if($this->Session->check('User') == true) 
    	{
    		$this->Session->setFlash('No Register For You!');
    		$this->redirect('index');
    	}
    	if(empty($this->data) == false)
        {        	
        	if ($this->data['User']['password'] == 
        	    $this->data['User']['password_confirm']) 
        	{
                $this->data['User']['password'] =
                    $this->User->hashPassword(
                            $this->data['User']['username'],
                             $this->data['User']['password']); 
                $this->data['User']['last_login'] = date("Y-m-d H:i:s");            
                $this->User->create($this->data);
				if ($this->User->save())
                {
                    $this->Session->setFlash('You\'ve registered!.');
                    $this->Session->write('User', $user);
                    $user = $this->User->validateLogin(array('username'=>$this->data['User']['username'],
                             'password'=>$this->data['User']['password_confirm']));
                    $this->Session->write('User', $user);
                    $this->redirect('/');
                } else
                {
                    
                }                   		    
        	} 
        	else
        	{
                $this->Session->setFlash('Password and Password Confirm must match!');  
        	}
        	
        }
        $this->data['User']['password'] = '';
        $this->data['User']['password_confirm'] = ''; 
    }
	
	function login() 
	{
	$this->Session->write('loginReferer', $this->referer('index')); 
        if(empty($this->data) == false)
        {
            if(($user = $this->User->validateLogin($this->data['User'])) == true)
            {
            	$this->User->id = $user['id']; 
            	$this->User->saveField('last_login',date("Y-m-d H:i:s") );
                $this->Session->write('User', $user);
                $this->Session->setFlash('You\'ve successfully logged in.');		
                $this->redirect(array('controller' => 'home', 'action' => 'index'));
                exit();
            }
            else
            {
                $this->Session->setFlash('Sorry, the information you\'ve entered is incorrect.');
                
            }
        } 	
	 
	}
}
?>