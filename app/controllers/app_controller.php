<?php
class AppController extends Controller {
	function checkSession()
	{
		// If the session info hasn't been set...
		if (!$this->Session->check('User'))
		{
			// Force the user to login
			$this->Session->setFlash('You are required to login to access this page'); 
			$this->redirect('/users/login');
			exit();
		}
	}
}
?>