<?php
	
	echo $this->Form->create( 'User' );
	
?>

 <table width="100%" border="0" cellspacing="0" cellpadding="6">
                              <tr>
                                <td align="center" valign="middle"><?php echo $this->Form->input('username',array('maxLength' => '100','label' => false, 'class'=>'inputformemail','wrap' => 'soft', 'placeholder' =>'email', 'div' => false));?></td>
                              </tr>
                              <tr>
                                <td align="center" valign="middle"><?php echo $this->Form->input('password',  array('div' =>true,'label' => false, 'placeholder' =>'password','class' => 'inputformpw', 'size' => '25', 'maxlength'=>'100'));?></td>
                              </tr>
                              <tr>
                               <td align="center" valign="middle" class="loginalert" ><?php echo $this->Session->flash();?></td>
                              </tr>
                              <tr>
                                <td align="left" valign="middle" class="forgotpw"><a href="#">Forgot password?</a></td>
                              </tr>
                              <tr>
                                <td align="center" valign="middle"><?php echo $this->Form->submit('Login',  array('class' => 'loginbutton', 'title' => '')); ?> </td>
                              </tr>
					</table>

                     


