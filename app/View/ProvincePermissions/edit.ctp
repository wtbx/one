<?php
$this->Html->addCrumb('Add Province Permissions', 'javascript:void(0);', array('class' => 'breadcrumblast'));
echo $this->Form->create('ProvincePermission', array('method' => 'post',
    'id' => 'parsley_reg',
    'novalidate' => true,
    'inputDefaults' => array(
        'label' => false,
        'div' => false,
        'class' => 'form-control',
    )
));
?>
<div class="col-sm-12" id="mycl-det">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">Add Permission</h4>
        </div>
        <div class="panel-body">
            <fieldset>
                <legend><span>Add Province Permissions</span></legend>
            </fieldset>
            <div class="row">

                <div class="col-sm-12">

                    <div class="row form-wrap">

                        <div class="col-sm-12">
                            <div class="col-sm-6">
                                <div class="form-group ">
                                    <label>Continent</label>
                                    <span class="colon">:</span>
                                    <div class="col-sm-10">
                                        <?php
                                        echo $this->Form->input('continent_id', array('options' => $TravelLookupContinents, 'disabled' => true));
                                        ?></div>
                                </div>
                                <div class="form-group ">
                                    <label>User</label>
                                    <span class="colon">:</span>
                                    <div class="col-sm-10">
                                        <?php
                                        echo $this->Form->input('user_id', array('options' => $Users, 'disabled' => true));
                                        ?></div>
                                </div>

                                <div class="form-group ">
                                    <label>Mapping Approver</label>
                                    <span class="colon">:</span>
                                    <div class="col-sm-10">
                                        <?php
                                        echo $this->Form->input('maaping_approval_id', array('options' => $MappingApproved, 'empty' => '--Select--', 'value' => $maaping_approval_id));
                                        ?></div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group ">
                                    <label>Country</label>
                                    <span class="colon">:</span>
                                    <div class="col-sm-10">
                                        <?php
                                        echo $this->Form->input('country_id', array('options' => $TravelCountries, 'disabled' => true));
                                        ?></div>
                                </div>   
                                <div class="form-group ">
                                    <label>Approver</label>
                                    <span class="colon">:</span>
                                    <div class="col-sm-10">
                                        <?php
                                        echo $this->Form->input('approval_id', array('options' => $Approved, 'empty' => '--Select--', 'value' => $approval_id));
                                        ?></div>
                                </div>
                            </div>
                            

                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <div class="checkbox three-column">

                                    <?php
                                    /*
                                      echo $this->Form->input('province_id', array(
                                      'label' => false,
                                      'div' => array('class' => 'list-checkbox checkboxBlank'),
                                      'type' => 'select',
                                      'multiple' => 'checkbox',
                                      'options' => $Provinces,
                                      'selected' => $selected,
                                      'hiddenField' => false
                                      ));
                                     * 
                                     */
                                    ?>
                                    <div class="list-checkbox checkboxBlank">

                                        <?php
                       //pr($mapping_selected);
                                        foreach ($Provinces as $key => $val) {
                                            ?>
                                            <div class="form-control">
                                                <input name="data[ProvincePermission][province_id][]" value="<?php echo $key; ?>" id="ProvincePermissionProvinceId<?php echo $key; ?>" <?php if (in_array($key, $selected)) echo 'checked=checked'; ?> type="checkbox">
                                                <label for="ProvincePermissionProvinceId<?php echo $key; ?>" style="margin-right:15px"><?php echo $val; ?></label>
                                                <input name="data[ProvincePermission][mapping_edit][<?php echo $key; ?>]" value="Yes" type="checkbox" <?php
                                                if (in_array($key, $mapping_selected)) {
                                                    echo 'checked=checked';
                                                }
                                                
                                                ?>>
                                                <label>Mapping Edit?</label>
                                            </div>
<?php }
?>
                                    </div>
                                </div>
                            </div>
                        </div>



                    </div>
                    <div class="form_submit clearfix">
                        <div class="row">
                            <div class="col-sm-1">
                                <?php
                                echo $this->Form->submit('Update', array('class' => 'btn btn-success sticky_success', 'name' => 'add', 'value' => 'add'));
                                ?>
                            </div>                   
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
echo $this->Form->end();

$this->Js->get('#ProvincePermissionContinentId')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_travel_country_by_continent_id/ProvincePermission/continent_id'
                ), array(
            'update' => '#ProvincePermissionCountryId',
            'async' => true,
            'before' => 'loading("ProvincePermissionCountryId")',
            'complete' => 'loaded("ProvincePermissionCountryId")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $this->Js->serializeForm(array(
                'isForm' => true,
                'inline' => true
            ))
        ))
);
?>
