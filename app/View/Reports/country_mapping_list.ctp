<?php
$this->Html->addCrumb('My City Mappings', 'javascript:void(0);', array('class' => 'breadcrumblast'));
?>    

<div class="row">
    <div class="col-sm-12">
        <div class="table-heading">
            <h4 class="table-heading-title"><span class="badge badge-circle badge-success"> <?php
                    echo $this->Paginator->counter(array('format' => '{:count}'));
                    ?></span> My Mapping Hotels</h4>
            
            <span class="search_panel_icon"><i class="icon-plus" id="toggle_search_panel"></i></span>
        </div>
        <div class="panel panel-default">
         <div class="panel_controls hideform">

                <?php
               echo $this->Form->create('Report', array('controller' => 'reports','action' => 'country_mapping_list','class' => 'quick_search', 'id' => 'SearchForm', 'type' => 'post', 'novalidate' => true, 'inputDefaults' => array(
                        'label' => false,
                        'div' => false,
                        'class' => 'form-control',
                )
                   
                    )
                        
                        );
                
                
                ?> 
                <div class="row spe-row">
                    <div class="col-sm-4 col-xs-8">

                        <?php echo $this->Form->input('search', array('value' => $search, 'placeholder' => 'Type country name', 'error' => array('class' => 'formerror'))); ?>
                    </div>
                    <div class="col-sm-3 col-xs-4">
                        <?php
                        echo $this->Form->submit('Search', array('div' => false, 'class' => 'btn btn-default btn-sm"'));
                        ?>

                    </div>
                </div>
                <div class="row" id="search_panel_controls">

                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Supplier:</label>
                        <?php echo $this->Form->input('TravelCountrySupplier.supplier_code', array('options' => $TravelSuppliers, 'empty' => '--Select--', 'value' => $supplier_code)); ?>
                    </div>
                   

                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Country:</label>
                        <?php echo $this->Form->input('TravelCountrySupplier.pf_country_code', array('options' => $TravelCountries, 'empty' => '--Select--', 'value' => $country_wtb_code)); ?>
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Province:</label>
                        <?php echo $this->Form->input('TravelCountrySupplier.province_id', array('options' => $Provinces, 'empty' => '--Select--', 'value' => $province_id)); ?>
                    </div>
                                    
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Status:</label>
                        <?php echo $this->Form->input('TravelCountrySupplier.country_suppliner_status', array('options' => $TravelActionItemTypes, 'empty' => '--Select--', 'value' => $status)); ?>
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">WTB Status:</label>
                        <?php echo $this->Form->input('TravelCountrySupplier.wtb_status', array('options' => array('1' => 'OK','2' => 'ERROR'), 'empty' => '--Select--', 'value' => $wtb_status)); ?>
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Active:</label>
                        <?php echo $this->Form->input('TravelCountrySupplier.active', array('options' => array('TRUE' => 'TRUE','FALSE' => 'FALSE'), 'empty' => '--Select--', 'value' => $active)); ?>
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Exclude:</label>
                        <?php echo $this->Form->input('TravelCountrySupplier.exclude', array('options' => array('1' => 'TRUE', '2' => 'FALSE'), 'empty' => '--Select--', 'value' => $exclude)); ?>
                    </div>


                    <div class="col-sm-3 col-xs-6">
                        <label>&nbsp;</label>
                        <?php
                        echo $this->Form->submit('Filter', array('div' => false, 'class' => 'btn btn-default btn-sm"'));
                        ?>
                    </div>
                </div>
                <?php echo $this->Form->end(); ?>
            </div>

           <?php
                echo $this->Form->create('Report', array('controller' => 'reports','action' => 'country_mapping_delete','onsubmit' => 'return ChkCheckbox()','class' => 'quick_search', 'id' => 'SearchForm', 'type' => 'post', 'novalidate' => true, 'inputDefaults' => array(
                        'label' => false,
                        'div' => false,
                        'class' => 'form-control',
                )
                   
                    )
                        
                        );
              ?>
            <div class="row" style="padding: 15px;">
        <div class="col-sm-12">
            <?php echo $this->Form->submit('Delete', array('class' => 'success btn', 'div' => false, 'id' => 'udate_unit')); ?><?php

?></div>
    </div> 
            
            <table border="0" cellpadding="0" cellspacing="0" id="resp_table" class="table toggle-square myclitb" data-filter="#table_search" data-page-size="500">
               
                <thead>
                          
                    <tr>
                        <th data-hide="phone" width="2%" data-sort-ignore="true"><input type="checkbox" class="mbox_select_all" name="msg_sel_all"></th>
                        <th data-toggle="phone" >Supplier Code</th>                        
                        <th data-hide="phone" >Mapping Status</th>                                                              
                        <th data-hide="phone" data-sort-ignore="true">Mapping Active?</th>
                        <th data-hide="phone" data-sort-ignore="true">WTB Status</th>
                        <th data-hide="phone" data-sort-ignore="true">Mapping Excluded?</th>
                        <th data-hide="phone" data-sort-ignore="true">Mapping Name</th>
                        <th data-hide="phone" data-sort-ignore="true">WTB</th> 
                        <th data-hide="phone" data-sort-ignore="true">Supplier</th>                        
                        <th data-hide="phone" data-sort-ignore="true" width="7%">Action</th> 

                    </tr>
                </thead>
                <tbody>
                    <?php
                   if (isset($TravelCountrySuppliers) && count($TravelCountrySuppliers) > 0):
                        foreach ($TravelCountrySuppliers as $TravelCountrySupplier):
                            $id = $TravelCountrySupplier['TravelCountrySupplier']['id'];
                            $status = $TravelCountrySupplier['TravelCountrySupplier']['country_suppliner_status'];
                            if ($status == '1')
                                $status_txt = 'Submitted For Approval';
                            elseif ($status == '2')
                                $status_txt = 'Approved';
                            elseif ($status == '3')
                                $status_txt = 'Returned';
                            elseif ($status == '4')
                                $status_txt = 'Change Submitted';
                            elseif ($status == '5')
                                $status_txt = 'Rejection';
                            elseif ($status == '6')
                                $status_txt = 'Request For Allocation';
                            else
                                $status_txt = 'Allocation';
                            
                           $wtb_status = ($TravelCountrySupplier['TravelCountrySupplier']['wtb_status']) ? "OK" : "ERROR";
                            ?>
                            <tr>
                                <td class="tablebody"><?php											
                                echo $this->Form->checkbox('check', array('name' => 'data[TravelCountrySupplier][check][]','class' => 'msg_select','readonly' => true,'hiddenField' => false,'value' => $id));
                                ?></td>
                                <td><?php echo $TravelCountrySupplier['TravelCountrySupplier']['supplier_code']; ?></td>
                                <td><?php echo $status_txt; ?></td>
                                <td><?php echo $TravelCountrySupplier['TravelCountrySupplier']['active']; ?></td>                                                          
                                <td><?php echo $wtb_status; ?></td>
                                <td><?php echo $TravelCountrySupplier['TravelCountrySupplier']['excluded']; ?></td>
                                <td><?php echo $TravelCountrySupplier['TravelCountrySupplier']['country_mapping_name']; ?></td>
                                <td><?php echo $TravelCountrySupplier['TravelCountrySupplier']['pf_country_code']; ?></td>
                                <td><?php echo $TravelCountrySupplier['TravelCountrySupplier']['supplier_country_code']; ?></td>
                                <td><?php                                    
                                    echo $this->Html->link('<span class="icon-pencil"></span>', array('controller' => 'reports', 'action' => 'country_mapping_edit/' . $id,), array('class' => 'act-ico', 'escape' => false));
                                    
                                    ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>

                        <?php
                        echo $this->element('paginate');
                    else:
                        echo '<tr><td colspan="9" class="norecords">No Records Found</td></tr>';

                    endif;
                    ?>
                </tbody>
            </table>           
            <?php echo $this->Form->end(); ?>
        </div> 
    </div>
</div>


<?php
$data = $this->Js->get('#SearchForm')->serializeForm(array('isForm' => true, 'inline' => true));          
              
         
          $this->Js->get('#TravelCountrySupplierPfCountryCode')->event('change', $this->Js->request(array(
                            'controller' => 'all_functions',
                            'action' => 'get_province_by_country_code/TravelCountrySupplie/pf_country_code'
                                ), array(
                            'update' => '#TravelCountrySupplierProvinceId',
                            'async' => true,
                            'before' => 'loading("TravelCountrySupplierProvinceId")',
                            'complete' => 'loaded("TravelCountrySupplierProvinceId")',
                            'method' => 'post',
                            'dataExpression' => true,
                            'data' => $data
                        ))
                );
          
                    
                    

?>
<script>
    
    $('.mbox_select_all').click(function () {
					var $this = $(this);
					
					$('#resp_table').find('.msg_select').filter(':visible').each(function() {
						if($this.is(':checked')) {
							$(this).prop('checked',true).closest('tr').addClass('active')
						} else {
							$(this).prop('checked',false).closest('tr').removeClass('active')
						}
					})
					
				});
                                
    function ChkCheckbox(){
	
		if ($("input:checked").length == 0){
			bootbox.alert('No check box are selected.');
			return false;
			}
                else{        
                    
                       var numberOfChecked = $('input:checkbox:checked').length;
                       //alert("WARNING! You are about to delete "+ numberOfChecked +" hotels. Are you sure?");
                        var agree=confirm("WARNING! You are about to delete "+ numberOfChecked +" city mappings. Are you sure?");
                         //bootbox.confirm("Are you sure?", function(result) {
                            if (agree)
                            return true ;
                        else
                            return false ;
					//bootbox.alert("Confirm result: "+result);
				//}); 
                                               
                }
		
		//return validation();
		
		
	}
    </script>