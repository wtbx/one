<?php
echo $this->Form->input($model.'.reimbursement_type_2',array('type'=>'select','label' => false,'options'=>$reimbursement_type2,'empty'=>'--Select--',  'class' => 'inputformpop inputformsmall', 'div' => array('id' => 'ajax_type')));
?>