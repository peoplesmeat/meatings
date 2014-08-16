<?php
class MeatingsController extends AppController
{
	//var $scaffold;
	var $uses = array('Meating','Invitee');
	var $components = array('Email','Image');

	function _grabRespondArray($meating_id) {
		$coming = $this->Invitee->find('all',
		array('conditions'=>array('InviteeResponse.attending_status'=>0, 
								  'Invitee.meating_id'=>$meating_id)
		));

		$notcoming = $this->Invitee->find('all',
		array('conditions'=>array('InviteeResponse.attending_status'=>1, 
								  'Invitee.meating_id'=>$meating_id)
		));

		$unsure = $this->Invitee->find('all',
		array('conditions'=>array('InviteeResponse.attending_status'=>2, 
								  'Invitee.meating_id'=>$meating_id)
		));

		$unresponded  = $this->Invitee->find('all',
		array('conditions'=>array('InviteeResponse.id'=>null, 
								  'Invitee.meating_id'=>$meating_id)
		));

		return array(
				'coming'=>$coming, 
				'notcoming'=>$notcoming,
				'unsure'=>$unsure, 
				'unresponded'=>$unresponded); 
	}

	function _invite($invites, $meating_id){
		$k='';
		foreach ($invites as $line)
		{
			$splits=preg_split("/[\s,]+/", $line);
			$email = $splits[0];
			$name = implode(' ',array_slice($splits, 1));
			if (empty($name)){
				$e = explode("@", $email);
				$name = $e[0];
			}
			$this->Invitee->create(array(
					'meating_id'=>$meating_id, 
					'name'=>$name, 
					'email'=>$email
			));
			if ($this->Invitee->save()) {
				$i = $this->Invitee->findById($this->Invitee->id);
				$this->Email->reset();
				//$this->Email->delivery = 'debug';
				$this->Email->from = $i['Meating']['host'].' <meat@meat.peoplesmeat.com>';
				$this->Email->to = $i['Invitee']['email'];
				$this->Email->subject = $i['Meating']['host'].' has sent you an invitation!';
				$this->Email->sendAs = 'text';
				$this->Email->template = 'invite';
				$this->set('meating',$i['Meating']);
				$this->set('invitee',$i['Invitee']);
				$k.$this->Email->send();
			}
		}
		//$this->Session->setFlash($k);
	}

	function create()
	{
		// But you only want authenticated users to access this action.
		$this->checkSession();
		if (empty($this->data)==false)
		{
			$this->data['Meating']['user_id']=
			$this->Session->read('User.id');
			if ($this->data['Image'])
			{
				//$this->data['Image']['name1']['name']=$this->data['Meating']['user_id']."_".$this->data['Image']['name1']['name'];
				$this->data['Meating']['img_name'] = $this->Image->upload_image_and_thumbnail($this->data,"name1",573,80,"sets",true);

			}
			if ($this->Meating->save($this->data))
			{
				$invites =
				split("\r\n",$this->data['Meating']['inviteList']);
				//$this->_invite($invites,$this->Meating->id);
				$this->redirect(array('controller' => 'meatings', 'action' => 'show/'.$this->Meating->id ));
			}
		}

	}
	function message($args=null) 
	{
		$this->checkSession(); 
		if ($args) { 
			$invitees = $this->Invitee->find('all',
				array('conditions'=>array('Invitee.meating_id'=>$args)));	
			foreach($invitees as $i) 
			{
				$this->Email->reset();
				//$this->Email->delivery = 'debug';
				$this->Email->from = $i['Meating']['host'].' <meat@meat.peoplesmeat.com>';
				$this->Email->to = $i['Invitee']['email'];
				$this->Email->subject = $i['Meating']['host'].' has sent you a reminder!';
				$this->Email->sendAs = 'text';
				$this->Email->template = 'message';
				$this->set('meating',$i['Meating']);
				$this->set('invitee',$i['Invitee']);
				$this->set('message', $this->data['Meating']['message']); 
				$k.$this->Email->send();
				print $i['Invitee']; 						
			}
		}
		$this->redirect(array('controller' => 'meatings', 'action' => 'show/'.$args, ));
	}
	
	function invite($args=null)
	{
		//But you only want authenticated users to access this action.
		$this->checkSession();

		if ($args) {
			if(empty($this->data) == false)
			{
				$invites =
				split("\r\n",$this->data['Meating']['inviteList']);
				$this->_invite($invites, $args);
			}

			$this->redirect(array('controller' => 'meatings', 'action' => 'show/'.$args, ));
		}
	}

	function show($args='invalid')
	{
		//But you only want authenticated users to access this action.
		$this->checkSession();

		$meating = $this->Meating->find('first', array(
			'conditions'=>array('Meating.id'=>$args) 
		));

		if ($meating['User']['id'] == $this->Session->read('User.id'))
		{
			$this->set('meating',$meating);
			
			$invitees = $this->_grabRespondArray($args); 

			$this->set('invitees', $invitees);
			
		}
	}

	function respond($args)
	{
		$invitee = $this->Invitee->find('first',array(
			'conditions'=>array('Invitee.secret'=>$args)
		));

		if ($invitee)
		{
			$invitee['Invitee']['last_visit'] = date( 'Y-m-d H:i:s');
			$this->Invitee->save($invitee);

			$meating = $this->Meating->find('first', array(
				'conditions'=>array('Meating.id'=>$invitee['Invitee']['meating_id']) 
			));
			//echo "<pre>".Debugger::exportVar($invitee,2)."</pre>";
			$this->set('meating',$meating);
			$this->set('invitee',$invitee['Invitee']);
			$this->set('invitees',$this->_grabRespondArray($invitee['Invitee']['meating_id'])); 
		} else {
			$this->redirect(array('controller' => 'pages', 'action' => 'error' ));
		}
	}
}
?>