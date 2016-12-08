<?php
$this->Html->addCrumb('My Supplier Countries', 'javascript:void(0);', array('class' => 'breadcrumblast'));
echo $this->element('FetchAreas/top_menu');
?>
<div class="row">
    <div class="col-sm-12">
        <div class="table-heading">
            <h4 class="table-heading-title"><span class="badge badge-circle badge-success"> <?php
                    echo $this->Paginator->counter(array('format' => '{:count}'));
                    ?></span> My  Supplier Countries</h4>
          <span class="badge badge-circle add-client nomrgn"><i class="icon-plus"></i> <?php echo $this->Html->link('Add Supplier Country', '/admin/add_country') ?></span>
            <span class="search_panel_icon"><i class="icon-plus" id="toggle_search_panel"></i></span>
        </div>
        <div class="panel panel-default">
		<div class="panel_controls hideform">

                <?php
                echo $this->Form->create('SupplierCountry', array('paramType' => 'querystring',  'class' => 'quick_search', 'id' => 'SearchForm', 'type' => 'post', 'novalidate' => true, 'inputDefaults' => array(
                        'label' => false,
                        'div' => false,
                        'class' => 'form-control',
                )));
               
                ?> 
                
                <div class="row" id="search_panel_controls">
                   
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Supplier:</label>
                        <?php echo $this->Form->input('supplier_id', array('options' => $TravelSuppliers, 'empty' => '--Select--')); ?>
                    </div>          
                    
                    <div class="col-sm-3 col-xs-6">
                        <label>&nbsp;</label>
                        <?php
                        echo $this->Form->submit('Filter', array('div' => false, 'class' => 'btn btn-default btn-sm"'));
                        // echo $this->Form->button('Reset', array('type' => 'reset', 'class' => 'btn btn-default btn-sm"'));
                        ?>
                    </div>
                </div>
                <?php echo $this->Form->end(); ?>
            </div>
		
		
            <table border="0" cellpadding="0" cellspacing="0" id="resp_table" class="table toggle-square myclitb" data-filter="#table_search" data-page-size="500">
                <thead>
              
                    <tr>
                        <th data-toggle="true" data-sort-ignore="true" width="3%" data-group="group1"><?php echo $this->Paginator->sort('id', 'Id');
                echo ($sort == 'id') ? ($direction == 'asc') ? " <i class='icon-caret-up'></i>" : " <i class='icon-caret-down'></i>"  : " <i class='icon-sort'></i>"; ?></th>
                        <th data-toggle="phone" data-sort-ignore="true" width="20%" data-group="group1"><?php echo $this->Paginator->sort('name', 'Suppler Country Name');
                echo ($sort == 'name') ? ($direction == 'asc') ? " <i class='icon-caret-up'></i>" : " <i class='icon-caret-down'></i>"  : " <i class='icon-sort'></i>"; ?></th>
                         <th data-toggle="phone" data-sort-ignore="true" width="10%" data-group="group1"><?php echo $this->Paginator->sort('item', 'Suppler Country ID');
                echo ($sort == 'item') ? ($direction == 'asc') ? " <i class='icon-caret-up'></i>" : " <i class='icon-caret-down'></i>"  : " <i class='icon-sort'></i>"; ?></th>
                        <th data-toggle="phone" data-group="group1" width="10%" data-sort-ignore="true"><?php echo $this->Paginator->sort('hotel_code', 'Supplier Country Code');
                echo ($sort == 'code') ? ($direction == 'asc') ? " <i class='icon-caret-up'></i>" : " <i class='icon-caret-down'></i>"  : " <i class='icon-sort'></i>"; ?></th>                    
                        <th data-toggle="phone" data-group="group1" width="15%" data-sort-ignore="true">Status</th>
                        <th data-toggle="phone" data-group="group1" width="7%" data-sort-ignore="true">No. Of Mapping</th>
                        <th data-hide="phone" data-sort-ignore="true">Action</th>
                     
                        
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
	//pr($SupplierCountries);
                    $secondary_city = '';

                    if (isset($SupplierCountries) && count($SupplierCountries) > 0):
                        foreach ($SupplierCountries as $SupplierCountry):
                            $id = $SupplierCountry['SupplierCountry']['id'];
                 
                            ?>
                            <tr>
                                <td class="tablebody"><?php echo $id; ?></td>
                                <td class="tablebody"><?php echo $SupplierCountry['SupplierCountry']['name']; ?></td>
                                <td class="tablebody"><?php echo $SupplierCountry['SupplierCountry']['item']; ?></td>
                                <td class="tablebody"><?php echo $SupplierCountry['SupplierCountry']['code']; ?></td>
                                
                                <td class="tablebody"><?php echo $SupplierCountry['TravelSupplierStatus']['value']; ?></td>
                                <td class="tablebody"><?php echo count($SupplierCountry['TravelCountrySupplier']);?></td>
                                <td width="10%" valign="middle" align="center"><?php
                                if($SupplierCountry['SupplierCountry']['status'] == '1' || $SupplierCountry['SupplierCountry']['status'] == '5')
                                    echo $this->Html->link('<span class="icon-list"></span>', array('controller' => 'admin', 'action' => 'country_mapping/' . $id), array('class' => 'act-ico','target' => '_blank', 'escape' => false));
                                ?></td>
                            </tr>
                        <?php endforeach; ?>

                        <?php
                        echo $this->element('paginate');
                    else:
                        echo '<tr><td colspan="3" class="norecords">No Records Found</td></tr>';

                    endif;
                    ?>
                </tbody>
            </table>     
            <span class="badge badge-circle add-client"><i class="icon-plus"></i> <?php echo $this->Html->link('Add Supplier Country', '/admin/add_country') ?></span>


        </div>
    </div>
</div>
