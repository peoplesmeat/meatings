
<div class="createForm">
<h2>Create a new Meating</h2>    
    <?php echo $form->create('Meating', 
    	array('action' => 'create', 'type'=>'file'));?>
        
        <?php echo $form->input('title'); ?>
        <?php echo $form->input('description'); ?>
        <div class="input">  
         <label for="Image/name1">Upload an image to be shown with your invitation</label>  
         <?php  
         echo $form->file('Image/name1', array('size' => '40'));  
         ?>  
	     </div>
        <?php echo $form->input('scheduled_for'); ?>
        <?php echo $form->input('host'); ?> 
        <?php echo $form->input('address'); ?>       
        
        <?php echo $form->submit('Next');?> 
    <?php echo $form->end(); ?>
</div> 
