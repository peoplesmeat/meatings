<div class="Register">
<h2>Login</h2>    
    <?php echo $form->create('User', array('action' => 'register'));?>
        <?php echo $form->input('username');?>
        <?php echo $form->input('password');?>
        <?php echo $form->input('password_confirm', array('type' => 'password')); ?>
        <?php echo $form->input('email');?>
        <?php echo $form->submit();?>
    <?php echo $form->end(); ?>
</div> 