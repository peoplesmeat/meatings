<?php
class InviteeResponsesController extends AppController 
{
	//var $scaffold;
	var $uses = array('InviteeResponse','Invitee','Meating'); 
	
	//var $uses = array('Meating','Invitee','InviteeResponse'); 
	function respond() 
	{ 
		if (empty($this->data) == false)
		{
			
			$invitee = $this->Invitee->find('first',array(
				'conditions'=>array('Invitee.secret'=>$this->data['InviteeResponse']['identifier'])
			));
			$r = array('InviteeResponse'=> $this->data['InviteeResponse']); 
			if (!$invitee['InviteeResponse']['id'])
			{
				$r['InviteeResponse']['invitee_id']=$invitee['Invitee']['id']; 			
			} else {
				$this->InviteeResponse->id = $invitee['InviteeResponse']['id'];
			}

			$r['InviteeResponse']['num_attending']=1; 
			$this->InviteeResponse->save($r);  
		}
		 	
		$this->redirect('/meatings/respond/'.$this->data['InviteeResponse']['identifier']);
	}
}
?>