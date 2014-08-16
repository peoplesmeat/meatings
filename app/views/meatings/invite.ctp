<div class="login">
<h2>Login</h2>    
    <?php echo $form->create('Meating', array('action' => 'invite'));?>
        <?php echo $form->textarea('inviteList'); ?>
        <?php echo $form->submit('Login');?> 
    <?php echo $form->end(); ?>
</div> 