<?php
class HomeController extends AppController 
{
	var $uses = array('User','Meating'); 
	
	function index() 
	{
		if ($this->Session->check('User')) {
			$q = $this->Meating->find('all', 
				array(
					'conditions'=>array('User.username'=>$this->Session->read('User.username'))
				)
			); 	
			$this->set('q',$q);
		} 	
	}
}
?>