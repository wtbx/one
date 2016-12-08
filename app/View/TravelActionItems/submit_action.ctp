
<input type="hidden" id="hidden_site_baseurl" value="<?php echo $this->request->base . ((!is_null($this->params['language'])) ? '/' . $this->params['language'] : ''); ?>"  />




<?php
//echo $this->Form->create('Remark', array('enctype' => 'multipart/form-data'));
echo $this->Form->create('TravelActionItem', array('method' => 'post', 'id' => 'parsley_reg', 'novalidate' => true, 'onsubmit' => 'return validation()',
    'inputDefaults' => array(
        'label' => false,
        'div' => false,
        'class' => 'form-control',
    )
));
echo $this->Form->hidden('mapping_type',array('value' => $mapping_type));
App::import('Model', 'User');
$attr = new User();
$table_head = '';
if ($mapping_type == '1') { //country
    $style_country = 'block';
    $style_city = 'none';
    $style_hotel = 'none';
    $search_result = 'none';
    $table_head = 'Existing Mappings for this WTB COUNTRY';
} elseif ($mapping_type == '2') { //city
    $style_city = 'block';
    $style_country = 'none';
    $style_hotel = 'none';
    $search_result = 'block';
    $table_head = 'Existing Mappings for this WTB CITY';
} elseif ($mapping_type == '3') { //hotel
    $style_hotel = 'block';
    $search_result = 'block';
    $style_city = 'none';
    $style_country = 'none';
    $table_head = 'Existing Mappings for this WTB HOTEL';
} else {
    $style_city = 'none';
    $style_country = 'none';
    $style_hotel = 'none';
    $search_result = 'none';
    
}
//pr($TravelCitySuppliers);
echo $this->Form->hidden('SupplierHotel.supplier_hotel_id', array('value' => $SupplierHotels['SupplierHotel']['id'],'type' => 'text'));
echo $this->Form->hidden('TravelHotelRoomSupplier.hotel_room_supplier_id', array('value' => $TravelHotelRoomSuppliers['TravelHotelRoomSupplier']['id'],'type' => 'text'));
?>

<div class="col-sm-12" id="mycl-det">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">Add Action | <?php echo $headding; ?> | Waiting for Approval</h4>
        </div>

     
        <div class="col-sm-12" style="margin-top:10px;display: <?php echo $style_city;?>">
        <div class="col-sm-6">

            <div class="form-group">
                <label for="reg_input_name">Supplier</label>
                <span class="colon">:</span>
                <div class="col-sm-10">
                    <?php
                    echo $this->Form->input('TravelCitySupplier.supplier_code', array('id' => 'city_supplier_code', 'options' => $TravelSuppliers,'value' => $TravelCitySuppliers['TravelCitySupplier']['supplier_code'], 'empty' => '--Select--','disabled' => true));
                    ?></div>
            </div>
            <div class="form-group">
                <label for="reg_input_name">WTB Province</label>
                <span class="colon">:</span>
                <div class="col-sm-10">
                    <?php
                    echo $this->Form->input('TravelCitySupplier.province_id', array('options' => $Provinces, 'empty' => '--Select--','disabled' => true,'value' => $TravelCitySuppliers['TravelCitySupplier']['province_id']));
                    ?></div>
            </div>
           <div class="form-group">
                <label for="reg_input_name">Supplier Country Code</label>
                <span class="colon">:</span>
                <div class="col-sm-10">
                    <?php
                    echo $this->Form->input('TravelCitySupplier.supplier_country_code', array('readonly' => true,'value' => $TravelCitySuppliers['TravelCitySupplier']['supplier_coutry_code']));
                    ?></div>
            </div>
        

        </div>
        <div class="col-sm-6">

            <div class="form-group">
                <label for="reg_input_name">WTB Country</label>
                <span class="colon">:</span>
                <div class="col-sm-10">
                    <?php
                    echo $this->Form->input('TravelCitySupplier.city_country_code', array('id' => 'city_country_code', 'options' => $TravelCountries, 'empty' => '--Select--','disabled' => true,'value' => $TravelCitySuppliers['TravelCitySupplier']['city_country_code']));
                    ?></div>
            </div>
             <div class="form-group">
                <label for="reg_input_name">WTB City</label>
                <span class="colon">:</span>
                <div class="col-sm-10">
                    <?php
                    echo $this->Form->input('TravelCitySupplier.pf_city_code', array('id' => 'pf_city_code', 'options' => $TravelCities, 'empty' => '--Select--','disabled' => true,'value' => $TravelCitySuppliers['TravelCitySupplier']['pf_city_code']));
                    ?></div>
            </div>
            <div class="form-group">
                <label for="reg_input_name">Supplier City Code</label>
                <span class="colon">:</span>
                <div class="col-sm-10">
                    <?php
                    echo $this->Form->input('TravelCitySupplier.supplier_city_code', array('readonly' => true,'value' => $TravelCitySuppliers['TravelCitySupplier']['supplier_city_code']));
                    ?></div>
            </div>
        </div> 
             <div class="form-group">
                <label for="reg_input_name" style="margin-left:16px;">Mapping Name</label>
                <span class="colon">:</span>
                <div class="col-sm-10">
                    <?php
                    echo $this->Form->input('TravelCitySupplier.city_mapping_name', array('readonly' => true,'style' => 'width:122%','value' => $TravelCitySuppliers['TravelCitySupplier']['city_mapping_name']));
                    ?></div>
            </div>   
    </div>
        <div style="clear:both"></div>
        <div class="col-sm-12" style="margin-top:10px;display: <?php echo $style_hotel;?>">
            <div style="background-color: rgb(100, 233, 300);overflow:hidden;">
                <h4>Supplier Hotel: <?php echo $SupplierHotels['SupplierHotel']['hotel_name'];?></h4>
                <?php 
                
                //$this->Form->hidden('TravelActionItem.supplier_hotel_id',array('value' => $SupplierHotels['SupplierHotel']['id'],'type' => 'text')); ?>
         <div class="col-sm-6">
                      
                        <div class="form-group">
                            <label for="reg_input_name">Supplier</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $SupplierHotels['SupplierHotel']['supplier_code'].' - '.$SupplierHotels['SupplierHotel']['supplier_name'];
                                //echo $this->Form->input('TravelHotelRoomSupplier.supplier_code', array('id' => 'hotel_supplier_code','options' => $TravelSuppliers,'value' => $TravelHotelRoomSuppliers['TravelHotelRoomSupplier']['supplier_code'], 'empty' => '--Select--','disabled' => true));
                                ?></div>
                        </div>
             
                        <div class="form-group">
                            <label for="reg_input_name">Supp. City</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $SupplierHotels['SupplierHotel']['city_code'].' - '.$SupplierHotels['SupplierHotel']['city_name'];
                                //echo $this->Form->input('TravelHotelRoomSupplier.hotel_city_code', array('id' => 'hotel_city_code','options' => $TravelCities,'value' => $TravelHotelRoomSuppliers['TravelHotelRoomSupplier']['hotel_city_code'], 'empty' => '--Select--','disabled' => true));
                                ?></div>
                        </div>
                  
           

                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="reg_input_name">Supp. Country</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $SupplierHotels['SupplierHotel']['country_code'].' - '.$SupplierHotels['SupplierHotel']['country_name'];
                                //echo $this->Form->input('TravelHotelRoomSupplier.hotel_country_code', array('id' => 'hotel_country_code','options' => $TravelCountries,'value' => $TravelHotelRoomSuppliers['TravelHotelRoomSupplier']['hotel_country_code'], 'empty' => '--Select--','disabled' => true));
                                ?></div>
                        </div>
                       
                        <div class="form-group">
                            <label for="reg_input_name">Supp. Hotel Code</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $SupplierHotels['SupplierHotel']['hotel_code']
                                //echo $this->Form->input('TravelHotelRoomSupplier.hotel_code', array('id' => 'hotel_code','options' => $TravelHotelLookups, 'empty' => '--Select--','value' => $TravelHotelRoomSuppliers['TravelHotelRoomSupplier']['hotel_code'],'disabled' => true));
                                ?></div>
                        </div>
                        
                        
                        
                        
                    </div>
                <div class="form-group">
                            <label for="reg_input_name">Hotel Address</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $SupplierHotels['SupplierHotel']['address']
                                //echo $this->Form->input('TravelHotelRoomSupplier.hotel_code', array('id' => 'hotel_code','options' => $TravelHotelLookups, 'empty' => '--Select--','value' => $TravelHotelRoomSuppliers['TravelHotelRoomSupplier']['hotel_code'],'disabled' => true));
                                ?></div>
                        </div>
                
                
            </div>
            <div style="padding:10px"></div>
            <div class="clear" style="clear: both;"></div>
                    <div style="background-color: rgb(211, 233, 237);overflow:hidden;">
                        <h4>WTB Hotel: <?php echo $TravelHotelRoomSuppliers['TravelHotelRoomSupplier']['hotel_name'];?></h4>
                <div class="col-sm-6" style="margin-top:10px">
                    <div class="form-group">
                            <label for="reg_input_name">Hotel Id</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php echo $HotelUrl['TravelHotelLookup']['id'] ?></div>
                        </div>
                    <div class="form-group">
                    <label for="reg_input_name">Continent</label>
                    <span class="colon">:</span>
                    <div class="col-sm-10">
                        <?php
                        echo $this->Form->input('TravelHotelRoomSupplier.hotel_continent_id', array('id' => 'hotel_continent_id', 'options' => $TravelLookupContinents, 'value' => $TravelHotelRoomSuppliers['TravelHotelRoomSupplier']['hotel_continent_id'], 'empty' => '--Select--', 'disabled' => true));
                        ?></div>
                </div>
                    <div class="form-group">
                    <label for="reg_input_name">Province</label>
                    <span class="colon">:</span>
                    <div class="col-sm-10">
                        <?php
                        echo $this->Form->input('TravelHotelRoomSupplier.province_id', array('options' => $Provinces, 'value' => $TravelHotelRoomSuppliers['TravelHotelRoomSupplier']['province_id'], 'empty' => '--Select--', 'disabled' => true));
                        ?></div>
                </div>
                    <div class="form-group">
                            <label for="reg_input_name">Suburb</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('TravelHotelRoomSupplier.hotel_suburb_id', array('options' => $TravelSuburbs));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">Chain</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('TravelHotelRoomSupplier.hotel_chain_id', array('options' => $TravelChains));
                                ?></div>
                        </div>
                </div>
                <div class="col-sm-6" style="margin-top:10px">
                    <div class="form-group">
                            <label for="reg_input_name">Hotel Code</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php echo $HotelUrl['TravelHotelLookup']['hotel_code'] ?></div>
                        </div>
                    <div class="form-group">
                    <label for="reg_input_name">WTB Country</label>
                    <span class="colon">:</span>
                    <div class="col-sm-10">
                        <?php
                        echo $this->Form->input('TravelHotelRoomSupplier.hotel_country_code', array('id' => 'hotel_country_code', 'options' => $TravelCountries, 'value' => $TravelHotelRoomSuppliers['TravelHotelRoomSupplier']['hotel_country_code'], 'empty' => '--Select--', 'disabled' => true));
                        ?></div>
                </div>
                <div class="form-group">
                    <label for="reg_input_name">WTB City</label>
                    <span class="colon">:</span>
                    <div class="col-sm-10">
                        <?php
                        echo $this->Form->input('TravelHotelRoomSupplier.hotel_city_code', array('id' => 'hotel_city_code', 'options' => $TravelCities, 'value' => $TravelHotelRoomSuppliers['TravelHotelRoomSupplier']['hotel_city_code'], 'empty' => '--Select--', 'disabled' => true));
                        ?></div>
                </div>
                      <div class="form-group">
                            <label for="reg_input_name">Area</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('TravelHotelRoomSupplier.hotel_area_id', array('options' => $TravelAreas));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">Brand</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('TravelHotelRoomSupplier.hotel_brand_id', array('options' => $TravelBrands));
                                ?></div>
                        </div>
                </div>
                        <div class="form-group">
                            <label for="reg_input_name" style="margin-left:15px;">Hotel Address</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10" id="MappingWebsiteUrl">
                                <?php echo $HotelUrl['TravelHotelLookup']['address'] ?>
                            </div>
                        </div>
            <div class="form-group">
                            <label for="reg_input_name" style="margin-left:15px;">Website Url</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10" id="MappingWebsiteUrl">
                                <?php echo $this->Html->link($HotelUrl['TravelHotelLookup']['url_hotel'], $HotelUrl['TravelHotelLookup']['url_hotel'], array('target' => '_blank')); ?>
                            </div>
                        </div>
              <div class="form-group">
                            <label for="reg_input_name" style="margin-left:16px;">Mapping Name</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('TravelHotelRoomSupplier.hotel_mapping_name',array('readonly' => true,'style' => 'width:122%','value' => $TravelHotelRoomSuppliers['TravelHotelRoomSupplier']['hotel_mapping_name']));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" style="margin-left:16px;">Check City Mapping</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                               echo $this->Html->link('Click here', '/travel_hotel_lookups/view_city_mapping/'.$SupplierHotels['SupplierHotel']['supplier_id'].'/'.$TravelHotelRoomSuppliers['TravelHotelRoomSupplier']['hotel_city_id'], array('class' => 'act-ico open-popup-link add-btn', 'escape' => false));
                                ?></div>
                        </div>
                
            </div>
            
        
     
    </div>

        <div class="col-sm-12" style="display:<?php echo $search_result ?>; margin-top:30px;">
              <?php if($mapping_type == '3'){ ?>
              <table border="0" cellpadding="0" cellspacing="0" id="resp_table" class="table toggle-square myclitb" data-filter="#table_search" data-page-size="3000">
                        <thead>         
                            <tr class="footable-group-row">
                                <th data-group="group1" colspan="10" class="nodis">Hotel Information</th>

                                <th data-group="group2" colspan="3">Hotel Information</th>

                                <th data-group="group4" class="nodis">Hotel Action</th>
                            </tr>
                            <tr>
                                <th data-toggle="true" data-group="group1" width="5%">Id</th>  
                                <th data-hide="phone" data-group="group1" width="7%"  data-sort-ignore="true">Continent Name</th> 
                                <th data-hide="phone" data-group="group1" width="7%">Country Name</th> 
                                <th data-hide="phone" data-group="group1" width="5%">Country Code</th>
                                <th data-hide="phone" data-group="group1" width="10%" data-sort-ignore="true">City Name</th>
                                <th data-hide="phone" data-group="group1" width="5%" data-sort-ignore="true">City Code</th>
                                <th data-hide="phone" data-group="group1" width="15%" data-sort-ignore="true">Hotel Name</th>
                                <th data-hide="phone" data-group="group1" width="10%" data-sort-ignore="true">Hotel Code</th>
                                <th data-hide="phone" data-group="group1" width="7%" data-sort-ignore="true">No. Of Mapping</th>
                                <th data-hide="phone" data-group="group1" width="10%" data-sort-ignore="true">Check City Mapping</th>
                                <th data-hide="all" data-group="group2" data-sort-ignore="true">Suburb</th>
                                <th data-hide="all" data-group="group2" data-sort-ignore="true">Area</th>
                                <th data-hide="all" data-group="group2" data-sort-ignore="true">Chain</th>
                                <th data-hide="all" data-group="group2" data-sort-ignore="true">Brand</th>
                                <th data-hide="all" data-group="group2" data-sort-ignore="true">Address</th>
                                <th data-group="group4" data-hide="phone" data-sort-ignore="true" width="3%">Action</th>        
                            </tr>
                        </thead>
                        <tbody>
<?php

if (isset($DuplicateHotels) && count($DuplicateHotels) > 0):
    foreach ($DuplicateHotels as $TravelHotelLookup):
        $id = $TravelHotelLookup['TravelHotelLookup']['id'];
        
        if($id)
            $tr_style = 'style="background-color:#5DD0ED"';
        else
            $tr_style = 'style="background-color:#FFFFFF"';
        ?>
                            <tr>
                                <td class="tablebody"><?php echo $id; ?></td>
                                <td class="tablebody"><?php echo $TravelHotelLookup['TravelHotelLookup']['continent_name']; ?></td> 
                                <td class="tablebody"><?php echo $TravelHotelLookup['TravelHotelLookup']['country_name']; ?></td>                                                                                            
                                <td class="tablebody"><?php echo $TravelHotelLookup['TravelHotelLookup']['country_code']; ?></td>                                                                                            
                                <td class="tablebody"><?php echo $TravelHotelLookup['TravelHotelLookup']['city_name']; ?></td>
                                <td class="tablebody"><?php echo $TravelHotelLookup['TravelHotelLookup']['city_code']; ?></td>
                                <td class="tablebody"><?php echo $TravelHotelLookup['TravelHotelLookup']['hotel_name']; ?></td>
                                <td class="tablebody"><?php echo $TravelHotelLookup['TravelHotelLookup']['hotel_code']; ?></td>
                                <td class="tablebody"><?php if(count($TravelHotelLookup['TravelHotelRoomSupplier']) > 0) echo $this->Html->link(count($TravelHotelLookup['TravelHotelRoomSupplier']), array('controller' => 'travel_hotel_lookups', 'action' => 'view_mapping/' . $id), array('class' => 'act-ico open-popup-link add-btn', 'escape' => false)); else echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;0'; ?></td>
                                
                                <td class="tablebody"><?php echo $this->Html->link('Click here', '/travel_hotel_lookups/view_city_mapping/'.$SupplierHotels['SupplierHotel']['supplier_id'].'/'.$TravelHotelLookup['TravelHotelLookup']['city_id'], array('class' => 'act-ico open-popup-link add-btn', 'escape' => false));?></td>
                                <td class="sub-tablebody"><?php echo $TravelHotelLookup['TravelHotelLookup']['suburb_name']; ?></td>
                                <td class="sub-tablebody"><?php echo $TravelHotelLookup['TravelHotelLookup']['area_name']; ?></td>
                                <td class="sub-tablebody"><?php echo $TravelHotelLookup['TravelHotelLookup']['chain_name']; ?></td>
                                <td class="sub-tablebody"><?php echo $TravelHotelLookup['TravelHotelLookup']['brand_name']; ?></td>
                                <td class="sub-tablebody"><?php echo $TravelHotelLookup['TravelHotelLookup']['address']; ?></td>
                                <td width="10%" valign="middle" align="center">
                                    <?php 
                                        $options=array($id=>'');
                                        $attributes=array('legend'=>false, 'hiddenField' => false,'label' => false,'div' => false,'class' => 'attrInputs');
                                        echo $this->Form->radio('TravelHotelLookup.hotel_id',$options,$attributes);
                                        ?>                                
                                </td>
                            </tr>
        <?php endforeach; ?>

                        <?php
                        //echo $this->element('paginate');
                    else:
                        echo '<tr><td colspan="7" class="norecords">No Records Found</td></tr>';

                    endif;
                    ?>
                        </tbody>
                    </table>   
              <?php }?>
            <h4><?php echo $table_head;?></h4>
            <table border="0" cellpadding="0" cellspacing="0" id="resp_table" class="table toggle-square myclitb" data-filter="#table_search" data-page-size="3000">
                <thead>
                    <tr class="footable-group-row">
                        <th data-group="group1" colspan="4" class="nodis">Mapping Information</th>                       
                        <th data-group="group2" colspan="2">Mapping City Code</th>
                        <th data-group="group3" colspan="2">Mapping Hotel Code</th>
                        <th data-group="group4" colspan="2">Mapping Logistics </th>                       

                    </tr>
                    <tr>
                        <th data-toggle="true" data-group="group1" width="20%">Mapping Name</th>                       
                        <th data-hide="phone" data-group="group1" width="8s%">Mapping Status</th>
                        <th data-hide="phone" data-group="group1" width="5%" data-sort-ignore="true">Mapping Active?</th>
                        <th data-hide="phone" data-group="group1" width="5%"  data-sort-ignore="true">Mapping Excluded?</th>    

                        <th data-hide="phone" data-group="group2" width="5%" data-sort-ignore="true">WTB</th>
                        <th data-hide="phone" data-group="group2" width="8%" data-sort-ignore="true">Supplier</th>

                        <th data-hide="phone" data-group="group3" width="5%" data-sort-ignore="true">WTB</th>
                        <th data-hide="phone" data-group="group3" width="8%" data-sort-ignore="true">Supplier</th>

                        <th data-hide="phone" data-group="group4" width="12%" data-sort-ignore="true">Created By</th>
                        <th data-hide="phone" data-group="group4" width="12%" data-sort-ignore="true">Approved By</th>


                    </tr>
                </thead>
                <tbody>
<?php
//pr($Mappinges);
$id = '';
$status = '';
$mapping_name = '';
$city_wtb = '';
$city_supplier = '';
$approve = '';
$excluded = '';
$created_by = '';
$approve_by = '';
$hotel_wtb = '';
$hotel_supplier = '';

if (isset($Mappinges) && count($Mappinges) > 0):
    foreach ($Mappinges as $Mappinge):

        if ($mapping_type == '2') {
            $id = $Mappinge['TravelCitySupplier']['id'];
            $status = $Mappinge['TravelCitySupplier']['city_supplier_status'];
            $mapping_name = $Mappinge['TravelCitySupplier']['city_mapping_name'];
            $city_wtb = $Mappinge['TravelCitySupplier']['pf_city_code'];
            $city_supplier = $Mappinge['TravelCitySupplier']['supplier_city_code'];
            $approve = $Mappinge['TravelCitySupplier']['active'];
            $excluded = $Mappinge['TravelCitySupplier']['excluded'];
            $created_by = $attr->Username($Mappinge['TravelCitySupplier']['created_by']) . ' ' . $Mappinge['TravelCitySupplier']['created'];
            if ($Mappinge['TravelCitySupplier']['approved_by'])
                $approve_by = $attr->Username($Mappinge['TravelCitySupplier']['approved_by']) . ' ' . $Mappinge['TravelCitySupplier']['approved_date'];
        }
        elseif ($mapping_type == '3') {
            $id = $Mappinge['TravelHotelRoomSupplier']['id'];
            $status = $Mappinge['TravelHotelRoomSupplier']['hotel_supplier_status'];
            $approve = $Mappinge['TravelHotelRoomSupplier']['active'];
            $mapping_name = $Mappinge['TravelHotelRoomSupplier']['hotel_mapping_name'];
            $hotel_wtb = $Mappinge['TravelHotelRoomSupplier']['hotel_code'];
            $hotel_supplier = $Mappinge['TravelHotelRoomSupplier']['supplier_item_code1'];
            $city_wtb = $Mappinge['TravelHotelRoomSupplier']['hotel_city_code'];
            $excluded = $Mappinge['TravelHotelRoomSupplier']['excluded'];
            $city_supplier = $Mappinge['TravelHotelRoomSupplier']['supplier_item_code3'];
            $created_by = $attr->Username($Mappinge['TravelHotelRoomSupplier']['created_by']) . ' ' . $Mappinge['TravelHotelRoomSupplier']['created'];
            if ($Mappinge['TravelHotelRoomSupplier']['approved_by'])
                $approve_by = $attr->Username($Mappinge['TravelHotelRoomSupplier']['approved_by']) . ' ' . $Mappinge['TravelHotelRoomSupplier']['approved_date'];
        }


        // table of travel_action_item_types

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



        ?>
                            <tr>
                                <td class="tablebody"><?php echo $mapping_name; ?></td>

                                <td class="tablebody"><?php echo $status_txt; ?></td>
                                <td class="tablebody"><?php echo $approve; ?></td>
                                <td class="tablebody"><?php echo $excluded; ?></td>


                                <td class="sub-tablebody"><?php echo $city_wtb; ?></td>
                                <td class="sub-tablebody"><?php echo $city_supplier; ?></td>

                                <td class="sub-tablebody"><?php echo $hotel_wtb; ?></td>
                                <td class="sub-tablebody"><?php echo $hotel_supplier; ?></td>

                                <td class="sub-tablebody"><?php echo $created_by; ?></td>
                                <td class="sub-tablebody"><?php echo $approve_by; ?></td> 



                            </tr>
    <?php endforeach; ?>

    <?php
//echo $this->element('paginate');
else:
    echo '<tr><td colspan="11" class="norecords">No Records Found</td></tr>';

endif;
?>
                </tbody>
            </table>

        </div>
        <div style="clear:both"></div>
         <div class="col-sm-12" style="margin-top:10px;">

            <div class="col-sm-6">


                <div class="form-group">
                    <label class="req">Choose Action Type</label>
                    <span class="colon">:</span>
                    <div class="col-sm-10"><?php
echo $this->Form->input('type_id', array('id' => 'type_id','class'=> "form-control", 'options' => $type, 'empty' => '--Select--', 'data-required' => 'true'));
?>
                    </div>
                </div>
            </div>  

            <div class="col-sm-6">     
                <div class="form-group" id="return" style="display: none;">
                    <label>Reason for Return</label>
                    <span class="colon">:</span>
                    <div class="col-sm-10">	<?php
echo $this->Form->input('lookup_return_id', array('id' => 'return_id', 'options' => $returns, 'empty' => '--Select--'));
?></div>
                </div>
                <div class="form-group" id="rejection" style="display: none;">
                    <label class="bgr">Reason for Rejection</label>
                    <span class="colon">:</span>
                    <div class="col-sm-10">	<?php echo $this->Form->input('lookup_rejection_id', array('id' => 'rejections_id', 'options' => $rejections, 'empty' => '--Select--')); ?>
                    </div>
                </div>
            </div>
        </div>
        <div style="clear:both"></div>
        <div class="col-sm-12">
            
             <div class="form-group">
                 
<?php
echo $this->Form->input('SupplierHotel.comment', array('div' => array('id' => 'support_comment', 'style' => 'display:none; width:79%;margin-left: 16.5%;'), 'type' => 'textarea'));
echo $this->Form->input('other_return', array('div' => array('id' => 'other_return', 'style' => 'display:none; width:79%;margin-left: 16.5%;'), 'type' => 'textarea'));
echo $this->Form->input('other_rejection', array('div' => array('id' => 'other_rejection', 'style' => 'display:none; width:79%;margin-left: 16.5%;'), 'label' => false, 'type' => 'textarea'));
?>
            </div>
        </div>
        <div style="clear:both"></div>
        <div class="col-sm-12" style="margin-bottom:10px;">
            <div class="row">

            <div class="col-sm-2" style="width:10.666667%;">
<?php echo $this->Form->submit('Add Action', array('class' => 'btn btn-success sticky_success', 'div' => false, 'id' => 'udate_unit','style' => 'width:100%')); ?><?php
// echo $this->Form->button('Reset', array('type' => 'reset', 'class' => 'reset btn'));
?>
            </div>
            <div class="col-sm-1">
<?php echo $this->Form->button('Reset', array('type' => 'reset', 'class' => 'btn btn-danger sticky_important')); ?>
            </div>

        </div>
            </div>

    
                

    </div>
</div>
<?php echo $this->Form->end();
                ?>
<!----------------------------end add project block------------------------------>

<script>

    $('#type_id').change(function() {
        var type = $(this).val();
        if (type == 3) {

            $('#return').css('display', 'block');
            $('#other_return').css('display', 'block');
            $('#rejection').css('display', 'none');
            $('#other_rejection').css('display', 'none');
            $('#support_comment').css('display', 'none');
        }
        else if (type == 5) {
            $('#rejection').css('display', 'block');
            $('#other_rejection').css('display', 'block');
            $('#other_return').css('display', 'none');
            $('#return').css('display', 'none');
            $('#support_comment').css('display', 'none');

        }
        else if (type == 9) {
            $('#support_comment').css('display', 'block');
            $('#rejection').css('display', 'none');
            $('#other_rejection').css('display', 'none');
            $('#other_return').css('display', 'none');
            $('#return').css('display', 'none');

        }
        else {
            $('#return').css('display', 'none');
            $('#other_return').css('display', 'none');
            $('#rejection').css('display', 'none');
            $('#other_rejection').css('display', 'none');
            $('#support_comment').css('display', 'none');
        }
    });

    function validation() {

        var return_id = $('#return_id').val();
        var rejections_id = $('#rejections_id').val();
        var type_id = $('#type_id').val();
        var mapping_type = $('#TravelActionItemMappingType').val();
        

        if (type_id == '3') {
            if (return_id == '') {
                alert('Please select reason return');
                return false;
            }
            else {
                if ($('#TravelActionItemOtherReturn').val() == '')
                {
                    alert('Please type return description');
                    return false;
                }
            }
        }
        else if (type_id == '5') {
            if (rejections_id == '') {
                alert('Please select reason rejection');
                return false;
            }
            else {
                if ($('#TravelActionItemOtherRejection').val() == '')
                {
                    alert('Please type rejection description');
                    return false;
                }
            }
        }
        else if (type_id == '2') {
            //$('#ClickRadioMandatory').click(function(){
           
                if($('.attrInputs:checked').length>0)
                    {
                        bootbox.alert('Please Unchecked radio button.');
                        return false;
                    }
               
        }
        //alert($('#TravelHotelRoomSupplierHotelBrandId').val());
       /*
        if(mapping_type == '3'){
            if($('#hotel_continent_id').val() == '' || $('#hotel_continent_id').val() == null){
                alert('Please select continent');
                return false;
            }
            if($('#hotel_country_code').val() == '' || $('#hotel_country_code').val() == null){
                alert('Please select country');
                return false;
            }
            if($('#TravelHotelRoomSupplierProvinceId').val() == '' || $('#TravelHotelRoomSupplierProvinceId').val() == null){
                alert('Please select province');
                return false;
            }
            if($('#hotel_city_code').val() == '' || $('#hotel_city_code').val() == null){
                alert('Please select city');
                return false;
            }
            if($('#hotel_code').val() == '' || $('#hotel_code').val() == null){
                alert('Please select hotel');
                return false;
            }
            if($('#TravelHotelRoomSupplierHotelSuburbId').val() == '' || $('#TravelHotelRoomSupplierHotelSuburbId').val() == null){
                alert('Please select suburb');
                return false;
            }
            if($('#TravelHotelRoomSupplierHotelAreaId').val() == '' || $('#TravelHotelRoomSupplierHotelAreaId').val() == null){
                alert('Please select area');
                return false;
            }
            if($('#TravelHotelRoomSupplierHotelChainId').val() == '' || $('#TravelHotelRoomSupplierHotelChainId').val() == null){
                alert('Please select chain');
                return false;
            }
            if($('#TravelHotelRoomSupplierHotelBrandId').val() == '' || $('#TravelHotelRoomSupplierHotelBrandId').val() == null){
                alert('Please select brand');
                return false;
            }
        }
        */

    }
</script>
