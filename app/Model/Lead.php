<?php
	App::uses('AppModel', 'Model');
	
	class Lead extends AppModel 
	{
		public $name = 'Lead';
		
		var $virtualFields = array(  
		   'fullname' => "CONCAT(Lead.lead_fname,' ',Lead.lead_lname)",  
		   'clientfullname' => "CONCAT(Lead.lead_fname,Lead.lead_lname)", 
		 );  
		var $displayField = 'fullname';
		
		public $validate = array(
			'city_id' => array(
					'rule' => array('notempty'),
					'message' => 'Select city'
			),
			'lead_primaryphonenumber' => array(
				'required' =>false,
				'allowEmpty' => true,
				'rule' => array('numeric'),
					'message' => 'Enter a valid phone number'
				
			),
			/*
			'lead_primaryphonenumber' =>array(
				'rule'=>array('custom','/([0-9]{1}[0-9]{9})/'),
				'allowEmpty'=>true, 
				'message'=>'Invalid mobile number! mobile number format: eg 0755434434'
				 ),
			*/
			'lead_category' => array(
					'rule' => array('notempty'),
					'message' => 'Select category'
			),
			'lead_source' => array(
					'rule' => array('notempty'),
					'message' => 'Select source'
			),
			'lead_segment' => array(
					'rule' => array('notempty'),
					'message' => 'Select segment'
			),
						
			
			'lead_secondaryphonenumber' => array(
				'required' =>false,
				'allowEmpty' => true,
				'rule' => array('numeric'),
					'message' => 'Enter a valid phone number'
				
			),
			
			'lead_emailid' => array(													
			'validEmail' => array(												
				'rule' => array('email'),								
				'message' => 'Please enter a valid email address',
				'allowEmpty' => true,
				'required' => false,
				
				)
			)

			
		);
		
		public $belongsTo = array(
					'Project' => array(
						'fields' => array('project_name'),
						'className'    => 'Project',
						'foreignKey'   => 'proj_id1'
					),
					'Project2' => array(
						'fields' => array('project_name'),
						'className'    => 'Project',
						'foreignKey'   => 'proj_id2'
					),
					'Project3' => array(
						'fields' => array('project_name'),
						'className'    => 'Project',
						'foreignKey'   => 'proj_id3'
					),
					
					'Builder' => array(
						'fields' => 'builder_name',
						'className'    => 'Builder',
						'foreignKey'   => 'builder_id1'
					),
					'Builder2' => array(
						'fields' => 'builder_name',
						'className'    => 'Builder',
						'foreignKey'   => 'builder_id2'
					),
					'Builder3' => array(
						'fields' => 'builder_name',
						'className'    => 'Builder',
						'foreignKey'   => 'builder_id3'
					),
					
					
					'City' => array(
						'className'    => 'City',
						'foreignKey'   => 'city_id'
					),
					
					'Unit' => array(
					'className'    => 'LookupValueProjectUnitPreference',
					'foreignKey'   => 'lead_unit_id_1'				
					),
					'Unit2' => array(
					'className'    => 'LookupValueProjectUnitPreference',
					'foreignKey'   => 'lead_unit_id_2'				
					),
					'Unit3' => array(
					'className'    => 'LookupValueProjectUnitPreference',
					'foreignKey'   => 'lead_unit_id_3'				
					),
					
					'AreaPreference' => array(
					'fields' => array('AreaPreference.area_name'),
					'className'    => 'Area',
					'foreignKey'   => 'lead_areapreference1'				
					),
					
					'AreaPreference2' => array(
					'fields' => array('AreaPreference2.area_name'),
					'className'    => 'Area',
					'foreignKey'   => 'lead_areapreference2'				
					),
					
					'AreaPreference3' => array(
					'fields' => array('AreaPreference3.area_name'),
					'className'    => 'Area',
					'foreignKey'   => 'lead_areapreference3'				
					),
					
					'Suburb' => array(
						'fields' => array('Suburb.suburb_name'),
						'className'    => 'Suburb',
						'foreignKey'   => 'lead_suburb1'				
					),
					
					'Suburb2' => array(
					'fields' => array('Suburb2.suburb_name'),
					'className'    => 'Suburb',
					'foreignKey'   => 'lead_suburb2'				
					),
					
					'Suburb3' => array(
					'fields' => array('Suburb3.suburb_name'),
					'className'    => 'Suburb',
					'foreignKey'   => 'lead_suburb3'				
					),
					
					'ProjectType' => array(
					'className'    => 'LookupValueProjectPhase',
					'foreignKey'   => 'lead_typeofprojectpreference1'				
					),
					
					'ProjectType2' => array(
						'className'    => 'LookupValueProjectPhase',
						'foreignKey'   => 'lead_typeofprojectpreference2'				
					),
					
					'ProjectType3' => array(
						'className'    => 'LookupValueProjectPhase',
						'foreignKey'   => 'lead_typeofprojectpreference3'				
					),
					'Status' => array(
						'className'    => 'LeadStatus',
						'foreignKey'   => 'lead_status'			
					),
					
					'Importance' => array(
					'className'    => 'LookupValueLeadsImportance',
					'foreignKey'   => 'lead_importance'		
					),
					
					'Country' => array(
					'className'    => 'LookupValueLeadsCountry',
					'foreignKey'   => 'lead_country'
					),
					
					'PrimaryCode' => array(
						'className'    => 'LookupValueLeadsCountry',
						'foreignKey'   => 'lead_primary_phone_country_code'
					),
					
					'SecondaryCode' => array(
						'className'    => 'LookupValueLeadsCountry',
						'foreignKey'   => 'lead_secondary_phone_country_code'
					),
					
					'Urgency' => array(
						'className'    => 'LookupValueLeadsUrgency',
						'foreignKey'   => 'lead_urgency'
					),
										
					'User' => array(
						'className'    => 'User',
						'fields' => array('User.fname','User.lname'),
						'foreignKey'   => 'created_by'
					),
					'Channel' => array(
							   'className' => 'Channel',
							   'fields' => array('channel_name'),
							   'foreignKey' => 'lead_channel'
							   ),
					'PrimaryManage' => array(
							'className'    => 'User',
							'fields' => array('PrimaryManage.fname','PrimaryManage.lname'),
							'foreignKey'   => 'lead_managerprimary'
							),
					'SecondaryManage' => array(
							'className'    => 'User',
							'fields' => array('SecondaryManage.fname','SecondaryManage.lname'),
							'foreignKey'   => 'lead_managersecondary'
							),
					
					'PhoneOfficer' => array(
							'className'    => 'User',
							'fields' => array('PhoneOfficer.fname','PhoneOfficer.mname','PhoneOfficer.lname'),
							'foreignKey'   => 'lead_phoneofficer'                                           
							),
					
					'category' => array(
							    'className' => 'LookupValueLeadsCategory',
							    'foreignKey' => 'lead_category'
							    ),
					'industry' => array(
							    'className' => 'LookupValueLeadsIndustry',
							    'foreignKey' => 'lead_industry'
							    ),
					
					'courrency' => array(
							    'className' => 'LookupValueLeadsCurrency',
							    'foreignKey' => 'lead_budget_unit'
							    ),
					
					'CreationType' => array(
							    'className' => 'LookupValueLeadsCreationType',
							    'foreignKey' => 'lead_creation_type'
							    ),
					
					'Type' => array(
							    'className' => 'LookupValueLeadsType',
							    'foreignKey' => 'lead_type'
							    ),
					
					'Source' => array(
							    'className' => 'LookupValueLeadsSource',
							    'foreignKey' => 'lead_source'
							    ),
					
					'Segment' => array(
							    'className' => 'LookupValueLeadsSegment',
							    'foreignKey' => 'lead_segment'
							    ),
					
					'ClosurProbability' => array(
							    'className' => 'LookupValueLeadsClosureProbability',
							    'foreignKey' => 'lead_closureprobabilityinnext1Month'
							    ),
					'Progress' => array(
							    'className' => 'LookupValueLeadsProgress',
							    'foreignKey' => 'lead_progress'
							    ),	
					'Special' => array(
							    'className' => 'LookupValueStatus',
							    'foreignKey' => 'lead_special_client_status'
							    ),	
					'Associate' => array(
							    'className' => 'User',
								'fields' => array('fname','mname','lname'),
							    'foreignKey' => 'lead_associate'
							    ),								
					/*
					'ActionLevel' =>  array(
						'className'    => 'ActionItemLevel',
						'fields' => array('ActionLevel.level'),
						'foreignKey' => false,
						'conditions' => 'ActionItem.action_item_level_id = ActionLevel.id',

					),
					*/
					
							
		);
		
		public $hasMany = array(
					'Activity' => array(
						'className' => 'Activity',
						'foreignKey'   => 'lead_id',
						'conditions' => array('Activity.activity_level' => '1')  // 1 for client table of  lookup_value_activity_levels
					),
					'Remark' => array(
						'className' => 'Remark',
						'foreignKey' => 'lead_id',
						'conditions' => array('Remark.remarks_level' => '3','Remark.lead_id' => 'Lead.id') // 3 for client table of  lookup_value_remarks_levels
					),
					'Action' => array(
						'className' => 'ActionItem',
						'foreignKey' => 'lead_id',
						'conditions' => array('Action.action_item_level_id' => '1', 'Action.lead_id' => 'Lead.id') // 1 for client table of  action_item_levels
					)
					);

		
	}
?>