<?php







/**



 * Allfunctions controller.



 *



 * This file will render views from views/departments/



 *



 * PHP 5



 *



 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)get_area_by_suburb



 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)



 *



 * Licensed under The MIT License



 * For full copyright and license information, please see the LICENSE.txt



 * Redistributions of files must retain the above copyright notice.



 *



 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)



 * @link          http://cakephp.org CakePHP(tm) Project



 * @package       app.Controller



 * @since         CakePHP(tm) v 0.2.9



 * @license       http://www.opensource.org/licenses/mit-license.php MIT License



 */



App::uses('AppController', 'Controller');







/**



 * AllFunctions controller contains the list of the commons function through out the site.



 *



 *



 * @package       app.Controller



 */



class AllFunctionsController extends AppController {







    var $uses = array('Project', 'City', 'Builder', 'User', 'LookupPropCategory', 'CwrState', 'LookupValueProjectAttache', 'LookupValueLeadsCountry', 'LookupUnitCommissionBasedOn', 'LookupUnitCommissionEvent', 'Channel', 'LookupValueAmenitie', 'Suburb', 'Area', 'LookupValueReimbursementType_2', 'Event', 'BuilderContact', 'LookupValueActivityDetail', 'LookupCompany', 'Lead', 'ProjectUnit', 'BuilderLegalName', 'ProjectLegalName',



        'TravelCountry', 'TravelCity', 'TravelCitySupplier', 'TravelHotelLookup', 'TravelHotelRoomSupplier', 'TravelSuburb', 'TravelBrand', 'TravelArea',



        'DigMediaProduct', 'DigPerson', 'DigTopic', 'TravelChain', 'DigStructure', 'DigLevel','SightSeeingElement','TransferElement','Province',



        'LookupQuestion','TravelLookupContinent','SupplierCity','Common','TravelLookupSequence','ProvincePermission');





public function beforeFilter() {

        parent::beforeFilter();

       

        $this->Auth->allow('get_image_province_by_continent_country');

      

    }

    /**



     * Get DeparmentUniversity ID and Department NAME using AJAX POST method



     *



     * @param integer $unv_id This is the university id



     * @param string $model This is the Name of the Model



     * @return null    This method does not return any data.



     * @access public 



     */



    public function get_project() {



        $this->layout = 'ajax';



        $city_id = $this->data['city_id'];



        $model = $this->data['model'];



        $conditions = array('Project.city_id' => $city_id);



        $projects = $this->Project->find('list', array(



            'fields' => array('Project.id', 'Project.project_name'),



            'joins' => array(



                array(



                    'table' => 'cities',



                    'alias' => 'City',



                    'conditions' => array(



                        'City.id = Project.city_id'



                    )



                )



            ),



            'conditions' => $conditions,



            'order' => 'Project.project_name ASC'



        ));







        $this->set(compact('projects'));



        $this->set('model', $model);



    }







    public function get_project_by_city($model = null) {



        $this->layout = 'ajax';



        $dummy_status = $this->Auth->user('dummy_status');



        $city_id = $this->data[$model]['city_id'];



        $projects = $this->Project->find('list', array('conditions' => array('Project.city_id' => $city_id, 'Project.dummy_status' => $dummy_status),



            'fields' => 'Project.id, Project.project_name',



            'order' => 'Project.project_name ASC'



        ));



        $this->set(compact('projects'));



    }







    public function get_prmember_by_channel_id() {



        $this->layout = 'ajax';







        $dummy_status = $this->Auth->user('dummy_status');



        $channel_id = $this->data['channel_id'];



        $lead_id = $this->data['lead_id'];



        $model = $this->data['model'];



        $clientArry = $this->Lead->findById($lead_id);



        $users = $this->User->find('all', array('fields' => array('User.id', 'User.fname', 'User.mname', 'User.lname', 'User.company_email_id', 'User.primary_mobile_number'),



            'conditions' => array('User.exu_channel_id' => $channel_id, 'User.exu_role_id' => '7', 'User.dummy_status' => $dummy_status)));







        //$channels = Set::combine($users, '{n}.User.id',array('%s %s %s','{n}.User.fname','{n}.User.mname','{n}.User.lname'));



        //pr($users);











        $this->set(compact('clientArry'));



        $this->set(compact('users'));







        $this->set('model', $model);



    }







    public function get_amenity_by_groupId() {



        $this->layout = 'ajax';



        $group_id = $this->data['group_id'];



        $model = $this->data['model'];







        $groups = $this->LookupValueAmenitie->find('list', array('fields' => array('LookupValueAmenitie.id', 'LookupValueAmenitie.amenity_name'),



            'conditions' => 'LookupValueAmenitie.group_id =' . $group_id,



            'order' => 'LookupValueAmenitie.amenity_name ASC'));



        $this->set(compact('groups'));



        $this->set('model', $model);



    }







    public function get_suburb_by_city($model = null, $field_name = null) {







        $this->layout = 'ajax';



        $dummy_status = $this->Auth->user('dummy_status');



        $city_id = $this->data[$model][$field_name];







        $suburbs = $this->Suburb->find('list', array(



            'conditions' => array(



                'Suburb.city_id' => $city_id,



                'Suburb.dummy_status' => $dummy_status,



                'Suburb.suburb_status' => '1'



            ),



            'fields' => 'Suburb.id, Suburb.suburb_name',



            'order' => 'Suburb.suburb_name ASC'



        ));



        $this->set(compact('suburbs'));



    }







    public function get_area_by_city($model = null) {







        $this->layout = 'ajax';



        $dummy_status = $this->Auth->user('dummy_status');



        if ($model)



            $city_id = $this->data[$model]['city_id'];



        else



            $city_id = $this->data['Lead']['city_id'];















        $areas = $this->Area->find('list', array(



            'conditions' => array(



                'Area.city_id' => $city_id,



                'Area.dummy_status' => $dummy_status,



                'Area.area_status' => '1'



            ),



            'fields' => 'Area.id, Area.area_name',



            'order' => 'Area.area_name ASC'



        ));



        $this->set(compact('areas'));



    }







    public function get_area_by_suburb($model = null, $field_name = null) {







        $this->layout = 'ajax';



        $dummy_status = $this->Auth->user('dummy_status');



        $suburb_id = $this->data[$model][$field_name];







        if ($suburb_id) {



            $areas = $this->Area->find('list', array(



                'conditions' => array(



                    'Area.suburb_id' => $suburb_id,



                    'Area.dummy_status' => $dummy_status,



                    'Area.area_status' => '1'



                ),



                'fields' => 'Area.id, Area.area_name',



                'order' => 'Area.area_name ASC'



            ));



        }







        $this->set(compact('areas'));



    }







    public function get_phone_office_by_cityid() {



        $this->layout = 'ajax';



        $city_id = $this->data['Lead']['city_id'];



        $dummy_status = $this->Auth->user('dummy_status');



        $Channels = $this->Channel->find('all', array(



            'conditions' => array(



                'Channel.city_id' => $city_id,



                'Channel.channel_role' => 3, // 3 for phone office of groups_users



                'Channel.dummy_status' => $dummy_status



            ),



            'fields' => 'Channel.id, Channel.channel_name',



            'order' => 'Channel.channel_name ASC'



        ));







        foreach ($Channels as $val) {



            $channel_id[] = $val['Channel']['id'];



        }











        $phone_officer = $this->User->find('all', array('fields' => array('User.id', 'User.fname', 'User.mname', 'User.lname'), 'conditions' => array(



                'User.phone_role_id' => 14, // 14 for phone office of roles table



                'User.phone_channel_id' => $channel_id,



                'User.dummy_status' => $dummy_status



            ),));







        $phone_officer = Set::combine($phone_officer, '{n}.User.id', array('%s %s %s', '{n}.User.fname', '{n}.User.mname', '{n}.User.lname'));







        $this->set(compact('phone_officer'));



    }







    public function get_builder_by_cityid($model = null) {



        $this->layout = 'ajax';



        $dummy_status = $this->Auth->user('dummy_status');



        if ($model == 'Project')



            $city_id = $this->data['Project']['city_id'];



        else



            $city_id = $this->data['Lead']['city_id'];







        $builders = $this->Builder->find('list', array(



            'conditions' => array('OR' => array(



                    'Builder.builder_primarycity' => $city_id,



                    'Builder.builder_secondarycity' => $city_id,



                    'Builder.builder_tertiarycity' => $city_id,



                    'Builder.city_4' => $city_id,



                    'Builder.city_5' => $city_id,



                ),



                'Builder.builder_approved' => '1',



                'Builder.dummy_status' => $dummy_status,



            ),



            'fields' => 'Builder.id, Builder.builder_name',



            'order' => 'Builder.builder_name ASC'



        ));



        $this->set(compact('builders'));



    }







    public function get_pribuilder_by_cityid() {



        $this->layout = 'ajax';







        $city_id = $this->data['Project']['city_id'];







        $builders = $this->Builder->find('list', array(



            'conditions' => array('OR' => array(



                    'Builder.builder_primarycity' => $city_id,



                    'Builder.builder_secondarycity' => $city_id,



                    'Builder.builder_tertiarycity' => $city_id,



                    'Builder.city_4' => $city_id,



                    'Builder.city_5' => $city_id,



                ),



                'Builder.builder_approved' => '1'



            ),



            'fields' => 'Builder.id, Builder.builder_name',



            'order' => 'Builder.builder_name ASC'



        ));



        $this->set(compact('builders'));



    }







    public function get_contactbuilder_by_builderid($model = null) {



        $this->layout = 'ajax';







        if ($model)



            $builder_id = $this->data['ProjectContact']['project_contact_builder_id'];



        else



            $builder_id = $this->data['builder_id'];







        $builder_contacts = $this->BuilderContact->find('list', array(



            'conditions' => array(



                'BuilderContact.builder_contact_builder_id' => $builder_id),



            'fields' => 'BuilderContact.id, BuilderContact.builder_contact_name',



            'order' => 'BuilderContact.builder_contact_name ASC'



        ));



        $this->set(compact('builder_contacts'));



    }







    public function get_secobuilder_by_cityid() {



        $this->layout = 'ajax';







        $city_id = $this->data['Project']['city_id'];







        $builders = $this->Builder->find('list', array(



            'conditions' => array('OR' => array(



                    'Builder.builder_primarycity' => $city_id,



                    'Builder.builder_secondarycity' => $city_id,



                    'Builder.builder_tertiarycity' => $city_id,



                    'Builder.city_4' => $city_id,



                    'Builder.city_5' => $city_id,



                ),



                'Builder.builder_approved' => '1'



            ),



            'fields' => 'Builder.id, Builder.builder_name',



            'order' => 'Builder.builder_name ASC'



        ));



        $this->set(compact('builders'));



    }







    public function get_tertibuilder_by_cityid() {



        $this->layout = 'ajax';







        $city_id = $this->data['Project']['city_id'];







        $builders = $this->Builder->find('list', array(



            'conditions' => array('OR' => array(



                    'Builder.builder_primarycity' => $city_id,



                    'Builder.builder_secondarycity' => $city_id,



                    'Builder.builder_tertiarycity' => $city_id,



                    'Builder.city_4' => $city_id,



                    'Builder.city_5' => $city_id,



                ),



                'Builder.builder_approved' => '1'



            ),



            'fields' => 'Builder.id, Builder.builder_name',



            'order' => 'Builder.builder_name ASC'



        ));



        $this->set(compact('builders'));



    }







    public function get_type_2_by_type1_id() {







        $this->layout = '';



        $type_id = $this->data['type_id'];



        $model = $this->data['model'];







        $reimbursement_type2 = $this->LookupValueReimbursementType_2->find('list', array(



            'conditions' => array(



                'type_id' => $type_id,



            ),



            'fields' => 'id, value',



            'order' => 'value ASC'



        ));



        //pr($reimbursement_type2);







        $this->set(compact('reimbursement_type2'));



        $this->set(compact('model'));



    }







    public function get_activity_with_by_activity_level() {







        $this->layout = '';



        $level_id = $this->data['level_id'];



        $model = $this->data['model'];



        $self_id = $this->Auth->user("id");



        $channels = $this->Channel->findById($channel_id);



        $channel_role = $channels['Channel']['channel_role'];



        $city_id = $channels['Channel']['city_id'];







        if ($level_id == '3')



            $array_with = $this->Project->find('list', array('fields' => array('id', 'project_name'), 'conditions' => array('city_id' => $city_id), 'order' => 'project_name ASC'));







        else if ($level_id == '2')



            $array_with = $this->Builder->find('list', array('fields' => 'Builder.id, Builder.builder_name', 'conditions' => array('OR' => array('builder_primarycity' => $city_id, 'builder_secondarycity' => $city_id, 'builder_tertiarycity' => $city_id, 'city_4' => $city_id, 'city_5' => $city_id)), 'order' => 'Builder.builder_name ASC'));







        else if ($level_id == '4')



            $array_with = array('1' => 'Stationary Store', '2' => 'Electronics Shop', '3' => 'Courier Agency', '4' => 'Utility / Electricity', '5' => 'Maid Services', '6' => 'Other');











        else if ($level_id == '5')



            $array_with = array('1' => 'Idea', '2' => 'Vodafone', '3' => 'Reliance', '4' => 'Airtel', '5' => 'Tikona', '6' => 'Tata', '7' => 'Docomo', '8' => 'Other');















        else if ($level_id == '1') {



            $clients = $this->Lead->find('all', array('fields' => array('Lead.id', 'Lead.lead_fname', 'Lead.lead_lname'), 'conditions' => array('OR' => array('Lead.lead_managerprimary' => $self_id, 'Lead.lead_managersecondary' => $self_id), 'Lead.lead_fname !=""', 'Lead.lead_status' => array('4', '7', '8')), 'order' => 'Lead.lead_fname ASC'));



            $array_with = Set::combine($clients, '{n}.Lead.id', array('%s %s', '{n}.Lead.lead_fname', '{n}.Lead.lead_lname'));



        } else if ($level_id == '7')



            $array_with = $this->LookupCompany->find('list', array('fields' => 'id,value', 'order' => 'value ASC'));















        $this->set(compact('array_with'));



        $this->set(compact('model'));



    }







    public function get_channel_by_city_id() {



        $this->layout = '';



        $city_id = $this->data['User']['city_id'];







        $channels = $this->Channel->find('list', array(



            'conditions' => array(



                'city_id' => $city_id,



            ),



            'fields' => 'id, channel_name',



            'order' => 'channel_name ASC'



        ));



        //pr($reimbursement_type2);







        $this->set(compact('channels'));



    }







    public function get_phoneofficer_by_city_id() {



        $this->layout = 'ajax';



        $city_id = $this->data['Lead']['city_id'];



        $dummy_status = $this->Auth->user('dummy_status');



        $phone_officer = $this->Channel->find('first', array(



            'conditions' => array(



                'Channel.city_id' => $city_id,



                'Channel.channel_role' => 3, // 3 for phone officer of groups_users



                'Channel.dummy_status' => $dummy_status



            ),



            'fields' => 'Channel.channel_name',



            'order' => 'Channel.channel_name ASC'



        ));







        $this->set(compact('phone_officer'));



    }







    public function get_project_by_level() {



        $this->layout = 'ajax';



        $level_id = $this->data['level_id'];



        $builder_id = $this->data['builder_id'];



        $dummy_status = $this->Auth->user('dummy_status');



        if ($level_id == '2')



            $contact_city = $this->data['contact_city'];











        $projects = array();



        if ($level_id == '1') {







            $projects = $this->Project->find('list', array('fields' => array('Project.id', 'Project.project_name'), 'conditions' => array('Project.builder_id' => $builder_id)));



            //	$global_project = Set::combine($projects, '{n}.Project.id',array('%s, %s, %s','{n}.Project.project_name','{n}.City.city_name','{n}.Area.area_name'));



        } elseif ($level_id == '2') {







            $projects = $this->Project->find('list', array('fields' => array('Project.id', 'Project.project_name'), 'conditions' =>



                array('Project.city_id' => $contact_city, 'OR' => array('Project.builder_id' => $builder_id, 'Project.tertiary_builder_id' => $builder_id, 'Project.builder_agreement_id' => $builder_id))));



            //$global_project = Set::combine($projects, '{n}.Project.id',array('%s, %s, %s','{n}.Project.project_name','{n}.City.city_name','{n}.Area.area_name'));



        } elseif ($level_id == '3' || $level_id == '4' || $level_id == '5') {



            $projects = $this->Project->find('list', array('fields' => array('Project.id', 'Project.project_name'), 'conditions' =>



                array('OR' => array('Project.builder_id' => $builder_id, 'Project.tertiary_builder_id' => $builder_id, 'Project.builder_agreement_id' => $builder_id))));



            //	$global_project = Set::combine($projects, '{n}.Project.id',array('%s, %s, %s','{n}.Project.project_name','{n}.City.city_name','{n}.Area.area_name'));	



        }















        $this->set('projects', $projects);



    }







    public function get_associate_by_cityid() {



        $this->layout = 'ajax';



        $city_id = $this->data['Lead']['city_id'];



        $dummy_status = $this->Auth->user('dummy_status');







        $associate = $this->User->find('all', array('fields' => array('User.id', 'User.fname', 'User.lname'),



            'conditions' => array('User.distributor_role_id' => 5, 'User.dummy_status' => $dummy_status, 'User.city_id' => $city_id)));







        $associate = Set::combine($associate, '{n}.User.id', array('%s %s', '{n}.User.fname', '{n}.User.lname'));







        $this->set(compact('associate'));



    }







    public function getAllEventRecords() {



        $this->layout = 'ajax';







        $user_id = $this->Auth->user("id");







        $allRecords = $this->Event->find('all', array('conditions' => array('Event.user_id' => $user_id, 'OR' => array('Event.event_type' => array('1', '4')))));











        $jsonArray = array();



        $data = array();



        //	$data['admin_id']	= $this->session->userdata('admin_id');



        //	$data['accessibility']	= 0;







        foreach ($allRecords as $value) {







            $data['id'] = $value['Event']['id'];



            $data['name'] = stripslashes($value['Event']['description']);



            $data['event_date'] = $value['Event']['end_date'];



            $data['start_date'] = $value['Event']['start_date'];











            //$toltip				= $this->load->view('calendar/edit_delete_icon',$data,TRUE);



            $currentDate = date('Y-m-d');



            $editable = FALSE;







            if (strtotime($currentDate) > strtotime($data['event_date'])) {



                $editable = TRUE;



                $toltip = '';



            }











            $background_color = '#0892CD';











            $buildjson = array(



                'id' => $data['id'],



                'title' => $data['name'],



                'start' => $data['start_date'],



                'end' => $data['event_date'],



                'backgroundColor' => $background_color,



                'textColor' => '#FFF',



                'borderColor' => '#000',



                'editable' => $editable,



                //'tooltip'		=> $toltip,



                'className' => 'bookedEvnt'



            );







            array_push($jsonArray, $buildjson);



        }







        echo json_encode($jsonArray);



        die();



    }







    public function countDetailRecord() {



        $this->layout = 'ajax';







        $record_id = $this->data['recordId'];



        $details = $this->Event->find('count', array('conditions' => array('Event.id' => $record_id, 'Event.active' => 1)));



        echo $details;



        exit;



    }







    public function get_list_initiated_by_city() {



        $this->layout = 'ajax';



        $city_id = $this->data['Builder']['builder_primarycity'];



        $dummy_status = $this->Auth->user('dummy_status');



        $initiated_by = $this->User->find('all', array(



            'conditions' => array(



                'User.city_id' => $city_id,



                'User.dummy_status' => $dummy_status,



                'OR' => array('User.business_role_id' => array('11', '12'),



                    'User.exu_role_id' => array('7', '8'),



                    'User.finance_role_id' => array('15', '16'),



                    'User.legal_role_id' => array('21', '22')



                ),



            ),



            'fields' => array('User.id', 'User.fname', 'User.mname', 'User.lname'),



            'order' => 'User.fname ASC'



        ));



        $initiated_by = Set::combine($initiated_by, '{n}.User.id', array('%s %s %s', '{n}.User.fname', '{n}.User.mname', '{n}.User.lname'));







        $this->set(compact('initiated_by'));



    }







    public function get_list_managed_by_city() {



        $this->layout = 'ajax';



        $city_id = $this->data['Builder']['builder_primarycity'];



        $dummy_status = $this->Auth->user('dummy_status');



        $managed_by = $this->User->find('all', array(



            'conditions' => array(



                'User.city_id' => $city_id,



                'User.dummy_status' => $dummy_status,



                'OR' => array('User.business_role_id' => array('11', '12'),



                    'User.exu_role_id' => array('7', '8'),



                    'User.finance_role_id' => array('15', '16'),



                    'User.legal_role_id' => array('21', '22')



                ),



            ),



            'fields' => array('User.id', 'User.fname', 'User.mname', 'User.lname'),



            'order' => 'User.fname ASC'



        ));



        $managed_by = Set::combine($managed_by, '{n}.User.id', array('%s %s %s', '{n}.User.fname', '{n}.User.mname', '{n}.User.lname'));







        $this->set(compact('managed_by'));



    }







    public function get_builder_contact_details() {



        $this->layout = 'ajax';



        $contact_id = $this->data['contact_id'];











        $contact_details = $this->BuilderContact->find('all', array('conditions' => array('BuilderContact.id' => $contact_id)));



        $this->set(compact('contact_details'));



    }







    public function get_list_projectmanaged_by_city() {



        $this->layout = 'ajax';



        $city_id = $this->data['Project']['city_id'];



        $dummy_status = $this->Auth->user('dummy_status');



        $managed_by = $this->User->find('all', array(



            'conditions' => array(



                'User.city_id' => $city_id,



                'User.dummy_status' => $dummy_status,



                'OR' => array('User.business_role_id' => array('11', '12'),



                    'User.exu_role_id' => array('7', '8'),



                    'User.finance_role_id' => array('15', '16'),



                    'User.legal_role_id' => array('21', '22')



                ),



            ),



            'fields' => array('User.id', 'User.fname', 'User.mname', 'User.lname'),



            'order' => 'User.fname ASC'



        ));



        $managed_by = Set::combine($managed_by, '{n}.User.id', array('%s %s %s', '{n}.User.fname', '{n}.User.mname', '{n}.User.lname'));







        $this->set(compact('managed_by'));



    }







    public function get_list_by_country_code() {



        $this->layout = 'ajax';



        $country_id = $this->data['Lead']['lead_country'];







        $codes = $this->LookupValueLeadsCountry->find('list', array(



            'conditions' => array(



                'LookupValueLeadsCountry.id' => $country_id



            ),



            'fields' => 'LookupValueLeadsCountry.id, LookupValueLeadsCountry.code',



            'order' => 'LookupValueLeadsCountry.code ASC'



        ));



        /// $log = $this->LookupValueLeadsCountry->getDataSource()->getLog(false, false);       



//debug($log);







        $this->set('codes', $codes);



    }







    public function get_activity_desc_by_typeId($model = null) {







        $this->layout = 'ajax';



        $type_id = $this->data['type_id'];



        $type_arr = array('type_id' => array($type_id, '0'));



        $types = $this->LookupValueActivityDetail->find('list', array(



            'conditions' => $type_arr,



            'fields' => 'id, value',



            'order' => 'value ASC'



        ));







        $this->set(compact('types'));



    }







    public function get_client_phone_email() {







        $this->layout = 'ajax';



        $lead_id = $this->data['lead_id'];











        $clients = $this->Lead->find('first', array('conditions' => array('Lead.id' => $lead_id),



            'fields' => 'Lead.lead_primaryphonenumber, Lead.lead_emailid',



        ));



        $this->set(compact('clients'));



    }







    public function get_activity_info_by_id() {







        $this->layout = 'ajax';



        $activity_id = $this->data['activity_id'];



        $activities = $this->Event->findById($activity_id);







        $reimbursement_type2 = $this->LookupValueReimbursementType_2->find('list', array(



            'conditions' => array(



                'type_id' => $activities['Event']['activity_type'],



            ),



            'fields' => 'id, value',



            'order' => 'value ASC'



        ));











        $this->set(compact('reimbursement_type2'));







        $this->set(compact('activities'));



    }







    public function get_project_by_builder_id($model = null) {







        $this->layout = 'ajax';



        $dummy_status = $this->Auth->user('dummy_status');



        $builder_id = $this->data[$model]['deal_builder_id'];







        $projects = $this->Project->find('list', array(



            'conditions' => array(



                'Project.builder_id' => $builder_id,



                'Project.dummy_status' => $dummy_status,



                'Project.proj_approved' => '1'



            ),



            'fields' => 'Project.id, Project.project_name',



            'order' => 'Project.project_name ASC'



        ));



        $this->set(compact('projects'));



    }







    public function get_unit_by_project_id($model = null) {







        $this->layout = 'ajax';



        $dummy_status = $this->Auth->user('dummy_status');



        $project_id = $this->data[$model]['deal_project_id'];







        $project_units = $this->ProjectUnit->find('list', array(



            'conditions' => array(



                'ProjectUnit.project_id' => $project_id,



                'ProjectUnit.dummy_status' => $dummy_status,



                'ProjectUnit.unit_status' => '1',



                'ProjectUnit.unit_approved' => '1',



            ),



            'fields' => 'ProjectUnit.id, ProjectUnit.unit_name',



            'order' => 'ProjectUnit.unit_name ASC'



        ));



        $this->set(compact('project_units'));



    }







    public function get_project_unit_details_by_unit_id($model = null) {







        $this->layout = 'ajax';



        $dummy_status = $this->Auth->user('dummy_status');



        $unit_id = $this->data[$model]['deal_project_unit_id'];



        $project_units = $this->ProjectUnit->findById($unit_id);



        $attach_to = $this->LookupValueProjectAttache->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));



        $this->set(compact('attach_to'));



        $commission_event = $this->LookupUnitCommissionEvent->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));



        $based_on = $this->LookupUnitCommissionBasedOn->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));



        $this->set(compact('based_on'));



        $this->set(compact('commission_event'));



        $this->set(compact('project_units'));



    }







    public function get_client_details_by_client_id($model = null) {







        $this->layout = 'ajax';



        $dummy_status = $this->Auth->user('dummy_status');



        $lead_id = $this->data[$model]['deal_client_id'];



        $leads = $this->Lead->findById($lead_id);



        $this->set(compact('leads'));



    }







    public function get_list_builder_by_project_id($model = null) {







        $this->layout = 'ajax';



        if ($model)



            $project_id = $this->data[$model]['deal_project_id'];



        else



            $project_id = $this->data['project_id'];







        $projects = $this->Project->findById($project_id);



        // pr($projects);



        //  die;



        $builders = $this->Builder->find('list', array('conditions' => array('Builder.id' => array($projects['Project']['builder_id'], $projects['Project']['secondary_builder_id'], $projects['Project']['tertiary_builder_id'])),



            'fields' => 'Builder.id, Builder.builder_name',



            'order' => 'Builder.builder_name ASC'



        ));







        $this->set(compact('builders'));



    }







    public function get_builder_legal_name_by_builder_id($model = null) {



        $this->layout = 'ajax';







        if ($model)



            $builder_id = $this->data[$model]['builder_id'];



        else



            $builder_id = $this->data['builder_id'];







        $legal_names = $this->BuilderLegalName->find('list', array('conditions' => array('BuilderLegalName.builder_legal_names_builder_id' => $builder_id, 'BuilderLegalName.builder_legal_name_approved' => 1, 'BuilderLegalName.builder_legal_names_status' => 1), 'fields' => array('BuilderLegalName.id', 'BuilderLegalName.builder_legal_names_name'), 'order' => 'BuilderLegalName.builder_legal_names_name ASC'));







        $this->set(compact('legal_names'));



    }







    public function get_builder_builder_legal_name_details_by_legal_id($model = null) {



        $this->layout = 'ajax';







        if ($model)



            $legal_name_id = $this->data[$model]['legal_name_id'];



        else



            $legal_name_id = $this->data['legal_name_id'];







        $legal_names = $this->BuilderLegalName->findById($legal_name_id);











        $this->set(compact('legal_names'));



    }







    public function get_project_legal_list_by_project_id($model = null) {







        $this->layout = 'ajax';



        $dummy_status = $this->Auth->user('dummy_status');







        if ($model) {



            $project_id = $this->data[$model]['deal_project_id'];



            $builder_id = $this->data[$model]['deal_builder_id'];



        }



        else



            $project_id = $this->data['project_id'];











        $ProjectLegalNames = $this->ProjectLegalName->find('all', array(



            'conditions' => array(



                'ProjectLegalName.project_legal_names_project_id' => $project_id,



                'ProjectLegalName.project_legal_names_builder_id' => $builder_id,



                'ProjectLegalName.dummy_status' => $dummy_status,



                'ProjectLegalName.project_legal_names_status' => '1',



                'ProjectLegalName.project_legal_names_approved' => '1',



            ),



            'order' => 'ProjectLegalName.id ASC'



        ));







        $ProjectLegalNames = Set::combine($ProjectLegalNames, '{n}.ProjectLegalName.id', array('%s', '{n}.BuilderLegalName.builder_legal_names_name'));







        $this->set(compact('ProjectLegalNames'));



    }







    public function get_project_legal_details_by_prolegal_id($model = null) {







        $this->layout = 'ajax';



        if ($model)



            $project_legal_id = $this->data[$model]['deal_project_legal_name_id'];



        else



            $project_legal_id = $this->data['project_legal_name_id'];







        $ProjectLegalNames = $this->ProjectLegalName->findById($project_legal_id);



        $this->set(compact('ProjectLegalNames'));







        $codes = $this->LookupValueLeadsCountry->find('all', array('fields' => array('LookupValueLeadsCountry.id', 'LookupValueLeadsCountry.value', 'LookupValueLeadsCountry.code')));



        $codes = Set::combine($codes, '{n}.LookupValueLeadsCountry.id', array('%s: %s', '{n}.LookupValueLeadsCountry.value', '{n}.LookupValueLeadsCountry.code'));



        $this->set(compact('codes'));



    }







    public function get_city_by_county_id($model = null) {







        $this->layout = 'ajax';



        $country_id = $this->data[$model]['agent_incorporated_in_country'];







        $staets = $this->CwrState->find('list', array(



            'conditions' => array(



                'CwrState.cnt_id' => $country_id,



            ),



            'fields' => 'CwrState.id, CwrState.st_name',



            'order' => 'CwrState.st_name ASC'



        ));



        $this->set(compact('staets'));



    }







    public function get_property_category_by_type_id($model = null, $field_name = null) {







        $this->layout = 'ajax';



        $dummy_status = $this->Auth->user('dummy_status');



        $type_id = $this->data[$model][$field_name];



        $categories = array();







        if ($type_id) {







            $categories = $this->LookupPropCategory->find('list', array(



                'conditions' => array(



                    'LookupPropCategory.prop_type_id' => $type_id,



                ),



                'fields' => 'LookupPropCategory.id, LookupPropCategory.value',



                'order' => 'LookupPropCategory.value ASC'



            ));



        }







        $this->set(compact('categories'));



    }







    public function get_supplier_by_country($model = null, $field_name = null) {







        $this->layout = 'ajax';



        $ConValue = $this->data[$model][$field_name];



        if ($ConValue == '')



            $ConValue = $this->data['supplier_code'];



        $DataArray = array();







        if ($ConValue) {











            $DataArray = $this->TravelCountry->find



                    (



                    'all', array



                (



                'fields' => array('TravelCountry.country_code', 'TravelCountry.country_name'),



                'conditions' => array



                    (



                    'TravelCountry.country_code NOT IN (SELECT pf_country_code FROM travel_country_suppliers WHERE supplier_code = "' . $ConValue . '")',



                    'TravelCountry.country_status' => '1','TravelCountry.active' => 'TRUE','TravelCountry.wtb_status' => '1'



                ),



                'order' => 'TravelCountry.country_name ASC'



                    )



            );











            $DataArray = Set::combine($DataArray, '{n}.TravelCountry.country_code', array('%s - %s', '{n}.TravelCountry.country_code', '{n}.TravelCountry.country_name'));



        }







        //$log = $this->TravelCountry->getDataSource()->getLog(false, false);



        //debug($log);







        $this->set(compact('DataArray'));



    }







    public function get_supplier_by_city($model = null, $field_name = null) {







        $this->layout = 'ajax';



        $ConValue = $this->data[$model][$field_name];



        $DataArray = array();







        if ($ConValue) {















            $DataArray = $this->TravelCountry->find



                    (



                    'all', array



                (



                'fields' => array('TravelCountry.country_code', 'TravelCountry.country_name'),



                'conditions' => array



                    (



                    'TravelCountry.country_code IN (SELECT pf_country_code FROM travel_country_suppliers WHERE supplier_code = "' . $ConValue . '" AND active = TRUE AND wtb_status = 1)',



                    'TravelCountry.country_status' => '1','TravelCountry.active' => 'TRUE','TravelCountry.wtb_status' => '1'



                ),



                'order' => 'TravelCountry.country_name ASC'



                    )



            );







            $DataArray = Set::combine($DataArray, '{n}.TravelCountry.country_code', array('%s - %s', '{n}.TravelCountry.country_code', '{n}.TravelCountry.country_name'));



        }







        $this->set(compact('DataArray'));



    }







    public function get_supplier_country_by_city() {







        $this->layout = 'ajax';



        $country_code = $this->data['country_id'];



        $supplier_code = $this->data['supplier_code'];







        $DataArray = array();







        if ($country_code) {











            $DataArray = $this->TravelCity->find



                    (



                    'all', array



                (



                'fields' => array('TravelCity.city_code', 'TravelCity.city_name'),



                'conditions' => array



                    (



                    'TravelCity.city_code NOT IN (SELECT pf_city_code FROM travel_city_suppliers WHERE supplier_code = "' . $supplier_code . '" AND city_country_code ="' . trim($country_code) . '")',



                    'TravelCity.city_status' => '1', 'TravelCity.country_code LIKE ' => '%' . trim($country_code) . '%'



                ),



                'order' => 'TravelCity.city_name ASC'



                    )



            );















            $DataArray = Set::combine($DataArray, '{n}.TravelCity.city_code', array('%s - %s', '{n}.TravelCity.city_code', '{n}.TravelCity.city_name'));



        }







        $this->set(compact('DataArray'));



    }







    public function get_hotel_supplier_country_by_city() {







        $this->layout = 'ajax';



        $country_code = $this->data['country_id'];



        $province_id = $this->data['province_id'];



        $supplier_code = $this->data['supplier_code'];



        $user_id = $this->Auth->user('id');



        $city_con = array();



        



        if($this->checkProvince())



            $city_con = $this->checkProvince();



                        



                   



        $DataArray = array();







        if ($country_code) {







            $DataArray = $this->TravelCity->find



                    (



                    'all', array



                (



                'fields' => array('TravelCity.city_code', 'TravelCity.city_name'),



                'conditions' => array



                    (



                    'TravelCity.city_code IN (SELECT pf_city_code FROM travel_city_suppliers WHERE supplier_code = "' . $supplier_code . '" AND city_country_code ="' . $country_code . '" AND active = TRUE AND wtb_status=1 AND province_id ="'.$province_id.'")',



                    'TravelCity.city_status' => '1','TravelCity.active' =>'TRUE','TravelCity.province_id' => $province_id



                ),



                'order' => 'TravelCity.city_name ASC'



                    )



            );











            $DataArray = Set::combine($DataArray, '{n}.TravelCity.city_code', array('%s - %s', '{n}.TravelCity.city_code', '{n}.TravelCity.city_name'));



        }







        $this->set(compact('DataArray'));



    }







    public function get_hotel_by_city_country_supplier() {







        $this->layout = 'ajax';



        $country_code = $this->data['country_code'];



        $city_code = $this->data['city_code'];



        $supplier_code = $this->data['supplier_code'];







        $DataArray = array();







        if ($country_code) {











            $DataArray = $this->TravelHotelLookup->find



                    (



                    'all', array



                (



                'fields' => array('TravelHotelLookup.hotel_code', 'TravelHotelLookup.hotel_name'),



                'conditions' => array



                    (



                    'TravelHotelLookup.hotel_code NOT IN (SELECT hotel_code FROM travel_hotel_room_suppliers WHERE supplier_code = "' . $supplier_code . '" AND hotel_country_code ="' . $country_code . '" AND hotel_city_code ="' . $city_code . '")',



                    'TravelHotelLookup.active' => 'TRUE','TravelHotelLookup.wtb_status' => '1','TravelHotelLookup.status' => '2', 'TravelHotelLookup.city_code LIKE' => '%' . trim($city_code) . '%', 'TravelHotelLookup.country_code LIKE' => '%' . trim($country_code) . '%'



                ),



                'order' => 'TravelHotelLookup.hotel_name ASC'



                    )



            );











            $DataArray = Set::combine($DataArray, '{n}.TravelHotelLookup.hotel_code', array('%s - %s', '{n}.TravelHotelLookup.hotel_code', '{n}.TravelHotelLookup.hotel_name'));



        }







        $this->set(compact('DataArray'));



    }







    public function get_travel_city_by_country($model = null, $field_name = null) {







        $this->layout = 'ajax';



        $array = array();



        $country_code = $this->data[$model][$field_name];







        if ($country_code) {



            $array = $this->TravelCity->find('list', array(



                'conditions' => array(



                    'TravelCity.country_code LIKE ' => '%' . trim($country_code) . '%',



                    'TravelCity.city_status' => '1',



                    'TravelCity.wtb_status' => '1',



                    'TravelCity.active' => 'TRUE'



                ),



                'fields' => 'TravelCity.city_code, TravelCity.city_name',



                'order' => 'TravelCity.city_name ASC'



            ));



        }



        $this->set(compact('array'));



    }







    public function get_travel_hotel_by_city($model = null, $field_name = null) {







        $this->layout = 'ajax';



        $array = array();



        $city_code = $this->data[$model][$field_name];







        if ($city_code) {



            $array = $this->TravelHotelLookup->find('list', array(



                'conditions' => array(



                    'TravelHotelLookup.city_code LIKE' => '%' . trim($city_code) . '%',



                    'TravelHotelLookup.active' => 'TRUE',



                ),



                'fields' => 'TravelHotelLookup.hotel_code, TravelHotelLookup.hotel_name',



                'order' => 'TravelHotelLookup.hotel_name ASC'



            ));



        }



        $this->set(compact('array'));



    }







    public function get_travel_city_by_country_id($model = null, $field_name = null) {







        $this->layout = 'ajax';



        $country_id = $this->data[$model][$field_name];



        $DataArray = array();







        if ($country_id) {



            $DataArray = $this->TravelCity->find('list', array(



                'conditions' => array(



                    'TravelCity.country_id' => $country_id,



                    'TravelCity.city_status' => '1',



                    'TravelCity.wtb_status' => '1',



                    'TravelCity.active' => 'TRUE',



                ),



                'fields' => 'TravelCity.id, TravelCity.city_name',



                'order' => 'TravelCity.city_name ASC'



            ));



        }







        $this->set(compact('DataArray'));



    }



    



     public function get_all_city_by_country_id($model = null, $field_name = null) {







        $this->layout = 'ajax';



        $country_id = $this->data[$model][$field_name];



        $DataArray = array();







        if ($country_id) {



            $DataArray = $this->TravelCity->find('all', array(



                'conditions' => array(



                    'TravelCity.country_id' => $country_id,



                    



                ),



                'fields' => 'TravelCity.id, TravelCity.city_name,TravelCity.city_code',



                'order' => 'TravelCity.city_name ASC'



            ));



        }



        $DataArray = Set::combine($DataArray, '{n}.TravelCity.id', array('%s - %s', '{n}.TravelCity.city_name', '{n}.TravelCity.city_code'));



        $this->set(compact('DataArray'));



    }



    



    public function test_ajax(){



         $this->layout = 'ajax';



         unlink(ROOT . DS . APP_DIR . DS . WEBROOT_DIR .'/js/jquery-latest.js');



         unlink(ROOT . DS . APP_DIR . DS . WEBROOT_DIR .'/js/fixed_table_rc.js');



    }







    public function get_travel_suburb_by_country_id_and_city_id($model = null, $field_name1 = null, $field_name2 = null) {







        $this->layout = 'ajax';



        $country_id = $this->data[$model][$field_name1];



        $city_id = $this->data[$model][$field_name2];



        $DataArray = array();







        if ($country_id) {



            $DataArray = $this->TravelSuburb->find('list', array(



                'conditions' => array(



                    'TravelSuburb.country_id' => $country_id,



                    'TravelSuburb.city_id' => $city_id,



                    'TravelSuburb.status' => '1',



                    'TravelSuburb.wtb_status' => '1',



                    'TravelSuburb.active' => 'TRUE'



                ),



                'fields' => 'TravelSuburb.id, TravelSuburb.name',



                'order' => 'TravelSuburb.name ASC'



            ));



        }







        $this->set(compact('DataArray'));



    }



    



    public function get_all_travel_suburb_by_country_id_and_city_id($model = null, $field_name1 = null, $field_name2 = null) {







        $this->layout = 'ajax';



        $country_id = $this->data[$model][$field_name1];



        $city_id = $this->data[$model][$field_name2];



        $DataArray = array();







        if ($country_id) {



            $DataArray = $this->TravelSuburb->find('list', array(



                'conditions' => array(



                    'TravelSuburb.country_id' => $country_id,



                    'TravelSuburb.city_id' => $city_id,



                    'TravelSuburb.status' => '1',



                    'TravelSuburb.wtb_status' => '1',



                    'TravelSuburb.active' => 'TRUE'



                ),



                'fields' => 'TravelSuburb.id, TravelSuburb.name',



                'order' => 'TravelSuburb.name ASC'



            ));



        }







        $this->set(compact('DataArray'));



    }







    public function get_travel_country_by_continent_id($model = null, $field_name = null) {







        $this->layout = 'ajax';



        $continent_id = $this->data[$model][$field_name];



        $DataArray = array();







        if ($continent_id) {



            $DataArray = $this->TravelCountry->find('all', array(



                'conditions' => array(



                    'TravelCountry.continent_id' => $continent_id,



                    'TravelCountry.country_status' => '1',



                    'TravelCountry.wtb_status' => '1',



                    'TravelCountry.active' => 'TRUE'



                ),



                'fields' => array('TravelCountry.id', 'TravelCountry.country_name', 'TravelCountry.country_code'),



                'order' => 'TravelCountry.country_code ASC'



            ));



            $DataArray = Set::combine($DataArray, '{n}.TravelCountry.id', array('%s - %s', '{n}.TravelCountry.country_code', '{n}.TravelCountry.country_name'));



        }



        



    







        $this->set(compact('DataArray'));



    }



    



    



    



    public function get_all_travel_country_by_continent_id($model = null, $field_name = null) {







        $this->layout = 'ajax';



        $continent_id = $this->data[$model][$field_name];



        $DataArray = array();







        if ($continent_id) {



            $DataArray = $this->TravelCountry->find('all', array(



                'conditions' => array(



                    'TravelCountry.continent_id' => $continent_id,  



                    'TravelCountry.country_status' => '1',



                    'TravelCountry.wtb_status' => '1',



                ),



                'fields' => array('TravelCountry.id', 'TravelCountry.country_name', 'TravelCountry.country_code'),



                'order' => 'TravelCountry.country_name ASC'



            ));



            $DataArray = Set::combine($DataArray, '{n}.TravelCountry.id', array('%s - %s', '{n}.TravelCountry.country_code', '{n}.TravelCountry.country_name'));



        }



        



    







        $this->set(compact('DataArray'));



    }



    



    public function get_all_country_by_continent_id($model = null, $field_name = null) {







        $this->layout = 'ajax';



        $continent_id = $this->data[$model][$field_name];



        $DataArray = array();







        if ($continent_id) {



            $DataArray = $this->TravelCountry->find('all', array(



                'conditions' => array(



                    'TravelCountry.continent_id' => $continent_id                     



                ),



                'fields' => array('TravelCountry.id', 'TravelCountry.country_name', 'TravelCountry.country_code'),



                'order' => 'TravelCountry.country_name ASC'



            ));



            $DataArray = Set::combine($DataArray, '{n}.TravelCountry.id', array('%s - %s', '{n}.TravelCountry.country_code', '{n}.TravelCountry.country_name'));



        }



        



    







        $this->set(compact('DataArray'));



    }







    public function get_travel_city1_by_country_id($model = null, $field_name1 = null, $field_name2 = null) {







        $this->layout = 'ajax';



        $city_code = '';



        $continent_id = $this->data[$model][$field_name1];



        $country_id = $this->data[$model][$field_name2];



        $DataArray = array();







        if ($country_id) {



            $DataArray = $this->TravelCity->find('all', array(



                'conditions' => array(



                    'TravelCity.country_id' => $country_id,



                    'TravelCity.continent_id' => $continent_id,



                    'TravelCity.city_status' => '1',



                    'TravelCity.wtb_status' => '1',



                    'TravelCity.active' => 'TRUE'



                ),



                'fields' => array('TravelCity.id', 'TravelCity.city_name', 'TravelCity.city_code'),



                'order' => 'TravelCity.city_name ASC'



            ));



            



            $DataArray = Set::combine($DataArray, '{n}.TravelCity.id', array('%s - %s', '{n}.TravelCity.city_code', '{n}.TravelCity.city_name'));



      



        }







        $this->set(compact('DataArray'));



    }







    public function get_travel_brand_by_chain_id($model = null, $field_name = null) {







        $this->layout = 'ajax';



        $chain_id = $this->data[$model][$field_name];



        $DataArray = array();







        if ($chain_id > 1) {



            $DataArray = $this->TravelBrand->find('list', array(



                'conditions' => array(



                    'TravelBrand.brand_chain_id' => $chain_id,



                    'TravelBrand.brand_status' => '1',



                    'TravelBrand.wtb_status' => '1',



                    'TravelBrand.brand_active' => 'TRUE'



                ),



                'fields' => 'TravelBrand.id, TravelBrand.brand_name',



                'order' => 'TravelBrand.brand_name ASC'



            ));



        }



        $DataArray = array('1' => 'No Brand') + $DataArray;



        $this->set(compact('DataArray'));



    }







    public function get_travel_area_by_suburb_id($model = null, $field_name = null) {







        $this->layout = 'ajax';



        $suburb_id = $this->data[$model][$field_name];



        $DataArray = array();







        if ($suburb_id) {



            $DataArray = $this->TravelArea->find('list', array(



                'conditions' => array(



                    'TravelArea.suburb_id' => $suburb_id,



                    'TravelArea.area_status' => '1',



                    'TravelArea.wtb_status' => '1',



                    'TravelArea.area_active' => 'TRUE'



                ),



                'fields' => 'TravelArea.id, TravelArea.area_name',



                'order' => 'TravelArea.area_name ASC'



            ));



        }







        $this->set(compact('DataArray'));



    }



    



    public function get_all_travel_area_by_suburb_id($model = null, $field_name = null) {







        $this->layout = 'ajax';



        $suburb_id = $this->data[$model][$field_name];



        $DataArray = array();







        if ($suburb_id) {



            $DataArray = $this->TravelArea->find('list', array(



                'conditions' => array(



                    'TravelArea.suburb_id' => $suburb_id,



                    'TravelArea.area_status' => '1',



                    'TravelArea.wtb_status' => '1',



                    'TravelArea.area_active' => 'TRUE'



                ),



                'fields' => 'TravelArea.id, TravelArea.area_name',



                'order' => 'TravelArea.area_name ASC'



            ));



        }







        $this->set(compact('DataArray'));



    }







    public function get_dig_product_description_by_proId($model = null, $field_name = null) {







        $this->layout = 'ajax';



        $product_id = $this->data[$model][$field_name];



        //   $product_id = $this->data['product_id'];



        $DataArray = array();







        if ($product_id) {



            $DataArray = $this->DigMediaProduct->find('first', array(



                'conditions' => array(



                    'DigMediaProduct.id' => $product_id,



                ),



                'fields' => 'DigMediaProduct.product_description',



            ));



        }







        $this->set(compact('DataArray'));



    }







    public function get_dig_product_format_by_product_id($model = null, $field_name = null) {







        $this->layout = 'ajax';



        $product_id = $this->data[$model][$field_name];



        $DataArray = array();







        if ($product_id) {



            $DataArray = $this->DigMediaProduct->find('first', array(



                'conditions' => array(



                    'DigMediaProduct.id' => $product_id,



                ),



                'fields' => 'DigMediaProduct.product_delivery_format',



            ));



        }







        $this->set(compact('DataArray'));



    }







    public function get_dig_person_dtl_by_person_id($model = null, $field_name = null) {







        $this->layout = 'ajax';



        $id = $this->data[$model][$field_name];



        $DataArray = array();



        $DigUsedByTeams = array();



        $DigUsedByPersons = array();







        if ($id) {



            $DataArray = $this->DigPerson->findById($id);







            $DigUsedByTeams = $this->Channel->find('list', array('fields' => 'Channel.id, Channel.channel_name', 'conditions' => array('Channel.id' => $DataArray['DigPerson']['person_used_by_team'])));



            $DigUsedByTeams = array('0' => 'All Teams') + $DigUsedByTeams;



            $DigUsedByPersons = $this->User->find('all', array('fields' => array('User.id', 'User.fname', 'User.lname'), 'conditions' => array('User.id' => $DataArray['DigPerson']['person_used_by_person']), 'order' => 'User.fname asc'));



            $DigUsedByPersons = Set::combine($DigUsedByPersons, '{n}.User.id', array('%s %s', '{n}.User.fname', '{n}.User.lname'));



            // $this->set(compact('DigUsedByTeams','DigUsedByPersons'));



        }







        $this->set(compact('DataArray', 'DigUsedByTeams', 'DigUsedByPersons'));



    }







    public function get_travel_chain_by_city_id($model = null, $field_name = null) {







        $this->layout = 'ajax';



        $city_id = $this->data[$model][$field_name];



        $DataArray = array();







        if ($chain_id > 1) {



            $DataArray = $this->TravelChain->find('list', array(



                'conditions' => array(



                    'TravelChain.chain_hq_city_id' => $city_id,



                    'TravelChain.chain_status' => '1',



                    'TravelChain.wtb_status' => '1',



                    'TravelChain.chain_active' => 'TRUE'



                ),



                'fields' => 'TravelChain.id, TravelChain.chain_name',



                'order' => 'TravelChain.chain_name ASC'



            ));



        }



        $DataArray = array('1' => 'No Chain') + $DataArray;



        $this->set(compact('DataArray'));



    }







    public function get_dig_topic_html_by_topic_id($model = null, $field_name = null) {







        $this->layout = 'ajax';



        $id = $this->data[$model][$field_name];



        $DataArray = array();







        if ($id) {



            $DataArray = $this->DigTopic->find('first', array(



                'conditions' => array(



                    'DigTopic.id' => $id,



                ),



            ));



        }







        $this->set(compact('DataArray'));



    }







    public function get_travel_suburb_by_hotel_code($model = null, $field_name = null) {







        $this->layout = 'ajax';



        $hotel_code = $this->data[$model][$field_name];



        $hotelArray = $this->TravelHotelLookup->find('first', array('conditions' => array('hotel_code' => $hotel_code), 'fields' => 'suburb_id'));







        $DataArray = array();







        if ($hotelArray['TravelHotelLookup']['suburb_id']) {







            $DataArray = $this->TravelSuburb->find('list', array(



                'conditions' => array(



                    'TravelSuburb.id' => $hotelArray['TravelHotelLookup']['suburb_id'],



                ),



                'fields' => 'TravelSuburb.id, TravelSuburb.name',



                'order' => 'TravelSuburb.name ASC'



            ));



        }







        $this->set(compact('DataArray'));



    }







    public function get_travel_area_by_hotel_code($model = null, $field_name = null) {







        $this->layout = 'ajax';



        $hotel_code = $this->data[$model][$field_name];



        $hotelArray = $this->TravelHotelLookup->find('first', array('conditions' => array('hotel_code' => $hotel_code), 'fields' => 'area_id'));







        $DataArray = array();







        if ($hotelArray['TravelHotelLookup']['area_id']) {







            $DataArray = $this->TravelArea->find('list', array(



                'conditions' => array(



                    'TravelArea.id' => $hotelArray['TravelHotelLookup']['area_id'],



                ),



                'fields' => 'TravelArea.id, TravelArea.area_name',



                'order' => 'TravelArea.area_name ASC'



            ));



        }







        $this->set(compact('DataArray'));



    }







    public function get_travel_chain_by_hotel_code($model = null, $field_name = null) {







        $this->layout = 'ajax';



        $hotel_code = $this->data[$model][$field_name];



        $hotelArray = $this->TravelHotelLookup->find('first', array('conditions' => array('hotel_code' => $hotel_code), 'fields' => 'chain_id'));







        $DataArray = array();







        if ($hotelArray['TravelHotelLookup']['chain_id']) {







            $DataArray = $this->TravelChain->find('list', array(



                'conditions' => array(



                    'TravelChain.id' => $hotelArray['TravelHotelLookup']['chain_id'],



                ),



                'fields' => 'TravelChain.id, TravelChain.chain_name',



                'order' => 'TravelChain.chain_name ASC'



            ));



        }







        $this->set(compact('DataArray'));



    }







    public function get_travel_brand_by_hotel_code($model = null, $field_name = null) {







        $this->layout = 'ajax';



        $hotel_code = $this->data[$model][$field_name];



        $hotelArray = $this->TravelHotelLookup->find('first', array('conditions' => array('hotel_code' => $hotel_code), 'fields' => 'brand_id'));







        $DataArray = array();







        if ($hotelArray['TravelHotelLookup']['brand_id']) {







            $DataArray = $this->TravelBrand->find('list', array(



                'conditions' => array(



                    'TravelBrand.id' => $hotelArray['TravelHotelLookup']['brand_id'],



                ),



                'fields' => 'TravelBrand.id, TravelBrand.brand_name',



                'order' => 'TravelBrand.brand_name ASC'



            ));



        }







        $this->set(compact('DataArray'));



    }







    public function get_travel_website_by_hotel_code($model = null, $field_name = null) {







        $this->layout = 'ajax';



        $hotel_code = $this->data[$model][$field_name];



        $DataArray = $this->TravelHotelLookup->find('first', array('conditions' => array('hotel_code' => $hotel_code), 'fields' => 'url_hotel'));



        // $DataArray = array();



        //  echo $DataArray['TravelHotelLookup']['url_hotel'];



        $this->set(compact('DataArray'));



    }



    



    public function get_travel_hotel_address_by_hotel_code($model = null, $field_name = null) {







        $this->layout = 'ajax';



        $hotel_code = $this->data[$model][$field_name];



        $DataArray = $this->TravelHotelLookup->find('first', array('conditions' => array('hotel_code' => $hotel_code), 'fields' => 'address'));



        // $DataArray = array();



        //  echo $DataArray['TravelHotelLookup']['url_hotel'];



        $this->set(compact('DataArray'));



    }







    public function get_level_pattern_html_by_structure_id($model = null, $field_name = null) {







        $this->layout = 'ajax';



        $id = $this->data[$model][$field_name];



        $DataArray = array();



        $DigLevel1 = array();



        $DigLevel2 = array();



        $DigLevel3 = array();



        $DigLevel4 = array();



        $DigLevel5 = array();



        $DigLevel6 = array();



        $DigLevel7 = array();



        $DigLevel8 = array();







        if ($id) {



            $DataArray = $this->DigStructure->findById($id, array('fields' => 'structure_level_1', 'structure_level_2', 'structure_level_3', 'structure_level_4', 'structure_level_5', 'structure_level_6', 'structure_level_7', 'structure_level_8'));



        }







        if ($DataArray['DigStructure']['structure_level_1'])



            $DigLevel1 = $this->DigLevel->findById($DataArray['DigStructure']['structure_level_1'], array('fields' => 'level_pattern_1', 'level_pattern_2', 'level_pattern_3', 'level_pattern_4', 'level_pattern_5', 'level_pattern_6', 'level_pattern_7', 'level_pattern_8'));



        if ($DataArray['DigStructure']['structure_level_1'])



            $DigLevel1 = $this->DigLevel->findById($DataArray['DigStructure']['structure_level_1'], array('fields' => 'level_pattern_1', 'level_pattern_2', 'level_pattern_3', 'level_pattern_4', 'level_pattern_5', 'level_pattern_6', 'level_pattern_7', 'level_pattern_8'));







        if ($DataArray['DigStructure']['structure_level_2'])



            $DigLevel2 = $this->DigLevel->findById($DataArray['DigStructure']['structure_level_2'], array('fields' => 'level_pattern_1', 'level_pattern_2', 'level_pattern_3', 'level_pattern_4', 'level_pattern_5', 'level_pattern_6', 'level_pattern_7', 'level_pattern_8'));







        if ($DataArray['DigStructure']['structure_level_3'])



            $DigLevel3 = $this->DigLevel->findById($DataArray['DigStructure']['structure_level_3'], array('fields' => 'level_pattern_1', 'level_pattern_2', 'level_pattern_3', 'level_pattern_4', 'level_pattern_5', 'level_pattern_6', 'level_pattern_7', 'level_pattern_8'));







        if ($DataArray['DigStructure']['structure_level_4'])



            $DigLevel4 = $this->DigLevel->findById($DataArray['DigStructure']['structure_level_4'], array('fields' => 'level_pattern_1', 'level_pattern_2', 'level_pattern_3', 'level_pattern_4', 'level_pattern_5', 'level_pattern_6', 'level_pattern_7', 'level_pattern_8'));







        if ($DataArray['DigStructure']['structure_level_5'])



            $DigLevel5 = $this->DigLevel->findById($DataArray['DigStructure']['structure_level_5'], array('fields' => 'level_pattern_1', 'level_pattern_2', 'level_pattern_3', 'level_pattern_4', 'level_pattern_5', 'level_pattern_6', 'level_pattern_7', 'level_pattern_8'));







        if ($DataArray['DigStructure']['structure_level_6'])



            $DigLevel6 = $this->DigLevel->findById($DataArray['DigStructure']['structure_level_6'], array('fields' => 'level_pattern_1', 'level_pattern_2', 'level_pattern_3', 'level_pattern_4', 'level_pattern_5', 'level_pattern_6', 'level_pattern_7', 'level_pattern_8'));







        if ($DataArray['DigStructure']['structure_level_7'])



            $DigLevel7 = $this->DigLevel->findById($DataArray['DigStructure']['structure_level_7'], array('fields' => 'level_pattern_1', 'level_pattern_2', 'level_pattern_3', 'level_pattern_4', 'level_pattern_5', 'level_pattern_6', 'level_pattern_7', 'level_pattern_8'));







        if ($DataArray['DigStructure']['structure_level_8'])



            $DigLevel8 = $this->DigLevel->findById($DataArray['DigStructure']['structure_level_8'], array('fields' => 'level_pattern_1', 'level_pattern_2', 'level_pattern_3', 'level_pattern_4', 'level_pattern_5', 'level_pattern_6', 'level_pattern_7', 'level_pattern_8'));











        $this->set(compact('DataArray', 'DigLevel1', 'DigLevel2', 'DigLevel3', 'DigLevel4', 'DigLevel5', 'DigLevel6', 'DigLevel7', 'DigLevel8'));



    }







    public function ajax_get_travel_city_by_country_id() {







        $this->layout = 'ajax';



        $country_id = $this->data['country_id'];







        $DataArray = array();







        if ($country_id) {



            $DataArray = $this->TravelCity->find('list', array(



                'conditions' => array(



                    'TravelCity.country_id' => $country_id,



                    'TravelCity.city_status' => '1',



                    'TravelCity.wtb_status' => '1',



                    'TravelCity.active' => 'TRUE'



                ),



                'fields' => 'TravelCity.id, TravelCity.city_code',



                'order' => 'TravelCity.city_code ASC'



            ));



        }







        $this->set(compact('DataArray'));



    }







    public function ajax_get_travel_item() {







        $this->layout = 'ajax';



        $country_id = $this->data['country_id'];



        $city_id = $this->data['city_id'];



        $item_type = $this->data['item_type'];



        $model = $this->data['model'];



        $DataArray = array();







        if ($item_type == '1') { //for hotel



            $DataArray = $this->TravelHotelRoomSupplier->find('list', array(



                'joins' => array(



                    array(



                        'table' => 'travel_hotel_lookups',



                        'alias' => 'TravelHotelLookup',



                        'conditions' => array(



                            'TravelHotelLookup.hotel_code = TravelHotelRoomSupplier.hotel_code',



                            'TravelHotelLookup.active' => 'TRUE',



                        )



                    )



                ),



                'conditions' => array('TravelHotelRoomSupplier.excluded' => 'FALSE'),



                'fields' => array('TravelHotelLookup.id','TravelHotelLookup.hotel_name')



            ));



        }



        else if($item_type == '2'){ //SightSeeing



            $DataArray = $this->SightSeeingElement->find('list', array(



                'conditions' => array(



                    'SightSeeingElement.CityId' => $city_id,



                    'SightSeeingElement.CountryId' => $country_id,                    



                    'SightSeeingElement.IsActive' => 'TRUE'



                ),



                'fields' => 'SightSeeingElement.id, SightSeeingElement.SightSeeingName',



                'order' => 'SightSeeingElement.SightSeeingName ASC'



            ));



        }



        else if($item_type == '3'){ //Transfer



            $DataArray = $this->TransferElement->find('list', array(



                'conditions' => array(



                    'TransferElement.FromCityId' => $city_id,



                    'TransferElement.CountryId' => $country_id,                    



                    'TransferElement.IsActive' => 'TRUE'



                ),



                'fields' => 'TransferElement.id, TransferElement.ServiceName',



                'order' => 'TransferElement.ServiceName ASC'



            ));



        }



        



         //$log = $this->TravelHotelRoomSupplier->getDataSource()->getLog(false, false);       



         //debug($log);



        



        $this->set(compact('DataArray', 'model'));



    }



    



    public function get_province_by_continent_country($model = null, $field_name1 = null, $field_name2 = null) {







        $this->layout = 'ajax';



        $continent_id = $this->data[$model][$field_name1];



        $country_id = $this->data[$model][$field_name2];



        $Provinces = array();



        



         $proArr = array();



            if($this->checkProvince())



            $proArr = $this->checkProvince();







        if ($country_id) {



            $Provinces = $this->Province->find('list', array(



                'conditions' => array(



                    'Province.continent_id' => $continent_id,



                    'Province.country_id' => $country_id,



                    'Province.status' => '1',



                    'Province.wtb_status' => '1',



                    'Province.active' => 'TRUE',



                    'Province.id' => $proArr,



                ),



                'fields' => array('Province.id', 'Province.name'),



                'order' => 'Province.name ASC'



            ));



      



        }







        $this->set(compact('Provinces'));



    }



    



    public function get_province_by_country_code($model = null, $field_name = null) {







        $proArr = array();



                if($this->checkProvince())



                    $proArr = $this->checkProvince();



        $this->layout = 'ajax';       



        $country_code = trim($this->data[$model][$field_name]);



        $Provinces = array();







        if ($country_code) {



            $Provinces = $this->Province->find('list', array(



                'conditions' => array(                    



                    'Province.country_code' => $country_code,



                    'Province.status' => '1',



                    'Province.wtb_status' => '1',



                    'Province.active' => 'TRUE',



                    'Province.id' => $proArr



                ),



                'fields' => array('Province.id', 'Province.name'),



                'order' => 'Province.name ASC'



            ));



      



        }







        $this->set(compact('Provinces'));



    }



    



    public function get_travel_city_by_province($model = null, $field_name = null) {







        $this->layout = 'ajax';



        $province_id = $this->data[$model][$field_name];







        $DataArray = array();







        if ($province_id) {



            $DataArray = $this->TravelCity->find('all', array(



                'conditions' => array(



                    'TravelCity.province_id' => $province_id,



                    'TravelCity.city_status' => '1',



                    'TravelCity.wtb_status' => '1',



                    'TravelCity.active' => 'TRUE'



                ),



                'fields' => array('TravelCity.id', 'TravelCity.city_code', 'TravelCity.city_name'),



                'order' => 'TravelCity.city_code ASC'



            ));



            



            $DataArray = Set::combine($DataArray, '{n}.TravelCity.id', array('%s - %s', '{n}.TravelCity.city_code', '{n}.TravelCity.city_name'));



        }







        $this->set(compact('DataArray'));



    }



    



    public function get_all_travel_city_by_province($model = null, $field_name = null) {







        $this->layout = 'ajax';



        $province_id = $this->data[$model][$field_name];







        $DataArray = array();







        if ($province_id) {



            $DataArray = $this->TravelCity->find('list', array(



                'conditions' => array(



                    'TravelCity.province_id' => $province_id,



                ),



                'fields' => array('TravelCity.id','TravelCity.city_name'),



                'order' => 'TravelCity.city_code ASC'



            ));



            



            //$DataArray = Set::combine($DataArray, '{n}.TravelCity.id', array('%s - %s', '{n}.TravelCity.city_code', '{n}.TravelCity.city_name'));



        }







        $this->set(compact('DataArray'));



    }



    



    public function get_city_code_by_province_id($model = null, $field_name = null) {







        $this->layout = 'ajax';



        $array = array();



       



        $province_id= $this->data[$model][$field_name];







        if ($province_id) {



            $array = $this->TravelCity->find('all', array(



                'conditions' => array(



                    'TravelCity.province_id' => $province_id,



                    'TravelCity.city_status' => '1',



                    'TravelCity.wtb_status' => '1',



                    'TravelCity.active' => 'TRUE'



                ),



                'fields' => array('TravelCity.city_code', 'TravelCity.city_name'),



                'order' => 'TravelCity.city_name ASC'



            ));



            



            $array = Set::combine($array, '{n}.TravelCity.city_code', array('%s - %s', '{n}.TravelCity.city_code', '{n}.TravelCity.city_name'));



        }



        $this->set(compact('array'));



    }



    



     public function get_list_question_by_question_id() {







        $this->layout = 'ajax'; 



        $DataArray = array();



        $country_con = array();



        $province_con = array();



        $city_con = array();



        $suburb_con = array();



        $continent_con = array();



        $hotel_con = array();



        $chain_con = array();



        $question_id = $this->data['question_id'];



        $continent_id = $this->data['continent_id'];



        $country_id = $this->data['country_id'];



        $province_id = $this->data['province_id'];



        $city_id = $this->data['city_id'];



        $suburb_id = $this->data['suburb_id'];



        $chain_id = $this->data['chain_id'];



        $brand_id = $this->data['brand_id'];



        $hotel_id = $this->data['hotel_id'];



        $model = $this->data['model'];



        



        if($question_id == '2'){ //province



            $continent_con = array('id' => $continent_id,'continent_status' => '1','wtb_status' => '1','active' => 'TRUE');



        }



        if($question_id == '3'){ //province



            $country_con = array('id' => $country_id,'wtb_status' => '1','active' => 'TRUE','country_status' => '1');



        }



        elseif($question_id == '4'){



            $province_con = array('id' => $province_id,'wtb_status' => '1','active' => 'TRUE','status' => '1');



        }



        elseif($question_id == '5'){



            $city_con = array('id' => $city_id);



        }



        elseif($question_id == '6'){



            $suburb_con = array('city_id' => $city_id);



        }



        elseif($question_id == '27'){



            $hotel_con = array('continent_id' => $continent_id,'country_id' => $country_id,'province_id' => $province_id,'city_id' => $city_id,'`TravelHotelLookup`.`id` !='.$hotel_id);



        }



        elseif($question_id == '30'){



            $chain_con = array('id' => $chain_id);



        }



    







        if ($question_id) {



           $DataArray = $this->LookupQuestion->find('all', array('fields' => 'LookupQuestion.id, LookupQuestion.question','conditions' => array('LookupQuestion.parent_id' => $question_id), 'order' => 'LookupQuestion.id ASC'));



      



        }



  



      $TravelLookupContinent = $this->TravelLookupContinent->find('list', array('fields' => 'id,continent_name', 'conditions' => $continent_con, 'order' => 'continent_name ASC'));



      $TravelCountries = $this->TravelCountry->find('list', array('fields' => 'id, country_name', 'conditions' => $country_con, 'order' => 'country_name ASC'));



      



      $Provinces = $this->Province->find('list', array(



                'conditions' =>                                 



                    $province_con



                ,



                'fields' => array('Province.id', 'Province.name'),



                'order' => 'Province.name ASC'



            ));



      



      $TravelCities = $this->TravelCity->find('all', array(



                'conditions' =>  array('wtb_status' => '1','active' => 'TRUE','city_status' => '1',$city_con)



                ,



                'fields' => array('TravelCity.id','TravelCity.city_code', 'TravelCity.city_name'),



                'order' => 'TravelCity.city_name ASC'



            ));



      



      $TravelCities = Set::combine($TravelCities, '{n}.TravelCity.id', array('%s - %s', '{n}.TravelCity.city_code', '{n}.TravelCity.city_name'));



      



      $TravelSuburbs = $this->TravelSuburb->find('list', array(



                'conditions' => array(



                                   



                    'TravelSuburb.status' => '1',



                    'TravelSuburb.wtb_status' => '1',



                    'TravelSuburb.active' => 'TRUE',



                    $suburb_con



                ),



                'fields' => 'TravelSuburb.id, TravelSuburb.name',



                'order' => 'TravelSuburb.name ASC'



            ));



      



      $TravelChains = $this->TravelChain->find('list', array(



                'conditions' => array(



                                   



                    'TravelChain.chain_status' => '1',



                    'TravelChain.wtb_status' => '1',



                    'TravelChain.chain_active' => 'TRUE',



                    $chain_con



                ),



                'fields' => 'TravelChain.id, TravelChain.chain_name',



                'order' => 'TravelChain.chain_name ASC'



            ));



      



      $TravelHotelLookups = $this->TravelHotelLookup->find



                    (



                    'all', array



                (



                'fields' => array('TravelHotelLookup.id', 'TravelHotelLookup.hotel_name', 'TravelHotelLookup.hotel_code'),



                'conditions' => array



                    (                    



                    'TravelHotelLookup.active' => 'TRUE','TravelHotelLookup.wtb_status' => '1','TravelHotelLookup.status' => '2',$hotel_con



                ),



                'order' => 'TravelHotelLookup.hotel_name ASC'



                    )



            );



       $TravelHotelLookups = Set::combine($TravelHotelLookups, '{n}.TravelHotelLookup.id', array('%s | %s | %s', '{n}.TravelHotelLookup.hotel_name','{n}.TravelHotelLookup.hotel_code', '{n}.TravelHotelLookup.id'));



      



      $TechnicalIssue = $this->LookupQuestion->find('list', array(



                'conditions' => array('LookupQuestion.parent_id' => 21),



                'fields' => 'LookupQuestion.question, LookupQuestion.question',



                'order' => 'LookupQuestion.id ASC'



            ));



    



        $this->set(compact('DataArray','TravelChains','model','TravelHotelLookups','TravelLookupContinent','TravelCountries','Provinces','TravelCities','TravelSuburbs','TechnicalIssue'));



    }



    



    public function ajax_get_travel_country_by_continent_id() {







        $this->layout = 'ajax';



        $continent_id = $this->data['continent_id'];



        $model = $this->data['model'];



        $DataArray = array();







        if ($continent_id) {



            $DataArray = $this->TravelCountry->find('list', array(



                'conditions' => array(



                    'TravelCountry.continent_id' => $continent_id,



                   



                ),



                'fields' => array('TravelCountry.id', 'TravelCountry.country_name'),



                'order' => 'TravelCountry.country_name ASC'



            ));            



        }       



        $this->set(compact('DataArray','model'));



    }



    



    public function ajax_get_province_by_country_id() {







        $this->layout = 'ajax';



        $country_id = $this->data['country_id'];



        $model = $this->data['model'];



        $Provinces = array();







        if ($country_id) {



            $Provinces = $this->Province->find('list', array(



                'conditions' => array(



                    'Province.country_id' => $country_id,



                    



                ),



                'fields' => array('Province.id', 'Province.name'),



                'order' => 'Province.name ASC'



            ));



            



            



      



        }







        $this->set(compact('Provinces'));



    }



    



    public function ajax_get_travel_city_by_province() {







        $this->layout = 'ajax';



        $province_id = $this->data['province_id'];



        $model = $this->data['model'];



        $DataArray = array();







        if ($province_id) {



            $DataArray = $this->TravelCity->find('all', array(



                'conditions' => array(



                    'TravelCity.province_id' => $province_id,



                    



                ),



                'fields' => array('TravelCity.id', 'TravelCity.city_code', 'TravelCity.city_name'),



                'order' => 'TravelCity.city_code ASC'



            ));



            



            $DataArray = Set::combine($DataArray, '{n}.TravelCity.id', array('%s - %s', '{n}.TravelCity.city_code', '{n}.TravelCity.city_name'));



        }







        $this->set(compact('DataArray','model'));



    }



    



    public function ajax_get_travel_suburb_by_city() {







        $this->layout = 'ajax';



        $city_id = $this->data['city_id'];



        $model = $this->data['model'];



        $DataArray = array();







        if ($city_id) {



            $DataArray = $this->TravelSuburb->find('list', array(



                'conditions' => array(                   



                    'TravelSuburb.city_id' => $city_id,



                   



                ),



                'fields' => 'TravelSuburb.id, TravelSuburb.name',



                'order' => 'TravelSuburb.name ASC'



            ));



            



            



        }







        $this->set(compact('DataArray','model'));



    }



    



    public function ajax_get_travel_area_by_suburb() {







        $this->layout = 'ajax';



        $suburb_id = $this->data['suburb_id'];



        $model = $this->data['model'];



        $DataArray = array();







        if ($suburb_id) {



            $DataArray = $this->TravelArea->find('list', array(



                'conditions' => array(



                    'TravelArea.suburb_id' => $suburb_id,



                    



                ),



                'fields' => 'TravelArea.id, TravelArea.area_name',



                'order' => 'TravelArea.area_name ASC'



            ));



        }







        $this->set(compact('DataArray','model'));



    }



    



    public function ajax_get_travel_brand_by_chain() {







        $this->layout = 'ajax';



        $chain_id = $this->data['chain_id'];



        $model = $this->data['model'];



        $DataArray = array();







        if ($chain_id) {



            $DataArray = $this->TravelBrand->find('list', array(



                'conditions' => array(



                    'TravelBrand.brand_chain_id' => $chain_id,



                    



                ),



                'fields' => 'TravelBrand.id, TravelBrand.brand_name',



                'order' => 'TravelBrand.brand_name ASC'



            ));



        }







        $this->set(compact('DataArray','model'));



    }



    



    public function get_supplier_city_by_country_id($model = null, $field_name = null) {







        $this->layout = 'ajax';



        $country_id = $this->data[$model][$field_name];



        $country_code = $this->Common->getSupplierCountryCode($country_id);



        $DataArray = array();







        if ($country_code) {



            $DataArray = $this->SupplierCity->find('list', array(



                'conditions' => array(



                    'SupplierCity.country_code' => $country_code,



                    



                ),



                'fields' => 'SupplierCity.id, SupplierCity.name',



                'order' => 'SupplierCity.name ASC'



            ));



        }



        



       // return $DataArray;







        $this->set(compact('DataArray'));



    }



    



    public function get_supplier_city_code($model = null){



        



        $this->layout = 'ajax';



        $supplier_id = $this->data[$model]['supplier_id'];



        $continent_id = $this->data[$model]['continent_id'];



        $country_id = $this->data[$model]['country_id'];



        $province_id = $this->data[$model]['province_id'];



        $city_id = $this->data[$model]['city_id'];



        



        $DataArray = array();







        if ($city_id) {



            $DataArray = $this->TravelCitySupplier->find('list',ARRAY('fields' => 'supplier_city_code,city_name','conditions' => 



             array('supplier_id' => $supplier_id,'city_continent_id' => $continent_id,'city_country_id' => $country_id,'province_id' => $province_id,'city_id' => $city_id), 'order' => 'TravelCitySupplier.supplier_city_code ASC'));



        



            $DataArray = Set::combine($DataArray, '{n}.TravelCitySupplier.supplier_city_code', array('%s - %s', '{n}.TravelCitySupplier.supplier_city_code', '{n}.TravelCitySupplier.city_name'));



            }



        



       // return $DataArray;







        $this->set(compact('DataArray'));



    }



    



    public function get_travel_table_by_type_id($model = null) {







        $this->layout = 'ajax';



        $DataArray = array();



        $type_id = $this->data[$model]['type_id'];



        if($type_id == '1')



            $DataArray = array('TravelCountry' => 'Country', 'TravelCity' => 'City', 'TravelHotelLookup' => 'Hotel', 'TravelCountrySupplier' => 'Country Mapping', 'TravelCitySupplier' => 'City Mapping', 'TravelHotelRoomSupplier' => 'Hotel Mapping', 'TravelSuburb' => 'Suburb', 'TravelArea' => 'Area', 'TravelLookupContinent' => 'Continent', 'TravelChain' => 'Chain', 'TravelBrand' => 'Brand','Province' => 'Province','TravelSupplier' => 'Supplier',);



        elseif($type_id == '2')



            $DataArray = array('TravelLookupChainPresence' => 'Lookup Chain Presence', 'TravelLookupChainSegment' => 'Lookup Chain Segment', 'TravelLookupBrandPresence' => 'Lookup Brand Presence', 'TravelLookupBrandSegment' => 'Lookup Brand Segment','lookupValueTravelAllocation' => 'Lookup Allocation'



                ,'TravelLookupPropertyType' => 'Lookup Property Type','TravelLookupRateType' => 'Lookup Rate Type',



                'TravelLookupValueContractStatus' => 'Lookup Contract Status','TravelMappingType' => 'Lookup Mapping Type','TravelSupplierStatus' => 'Lookup Supplier Status',



                'LookupAgentNatureOfBusiness' => 'Lookup AgentNature Business','LookupAgentProcurementType' => 'Lookup Agent Procurement Type',



                'LookupAgentSource' => 'Lookup Agent Source','LookupAgentStatus' => 'Lookup Agent Status'); 







        



       // return $DataArray;







        $this->set(compact('DataArray'));



    }



    



    public function generate_sequence_no($model = null,$screen = null){



        $this->layout = '';



        //$model = $this->data['model'];



        $this->request->data['TravelLookupSequence']['screen'] = $screen;



        $this->TravelLookupSequence->create();



        $this->TravelLookupSequence->save($this->request->data);       



        $last_id = $this->TravelLookupSequence->getLastInsertId();



        $this->set(compact('last_id','model'));



    }



    



    public function get_user_list_by_summary_type(){

        $this->layout = '';
        $user_id = $this->Auth->user('id');
        $channel_id = $this->Session->read("channel_id");
        $role_id = $this->Session->read("role_id");        
        $personArr = array();
        $exclude_sales = '';
        $Select = '--Select--';
        $summary_type = $this->data['Report']['summary_type'];
        if($summary_type == '2'){ //Approver

            if($role_id == '64' || $role_id == '68') {	                         
		$Select = 'All';
                
                $personArr = array();
                
                $persons = $this->ProvincePermission->find('all', array('fields' => array('User.id', 'User.fname','User.lname'),                    
           'joins' => array(
                array(
                    'table' => 'users',
                    'alias' => 'User',
                    'conditions' => array(
                                        'OR' => array(
                                            'ProvincePermission.approval_id = User.id',
                                            'ProvincePermission.maaping_approval_id = User.id'))
					                    
                ) 

            ),
            'conditions' => $personArr,
            'group' => 'User.id',
            'order' => 'User.fname ASC'));                
             $persons = Set::combine($persons, '{n}.User.id', array('%s %s', '{n}.User.fname', '{n}.User.lname')); 
             
            } elseif($role_id == '62') {
		$personArr = array('OR' => array('ProvincePermission.approval_id' => $user_id));  

                $persons = $this->ProvincePermission->find('all', array('fields' => array('User.id', 'User.fname','User.lname'),                    
           'joins' => array(
                array(
                    'table' => 'users',
                    'alias' => 'User',
                    'conditions' => array(
                                            'ProvincePermission.approval_id = User.id')
					                    
                ) 

            ),
            'conditions' => $personArr,
            'group' => 'User.id',
            'order' => 'User.fname ASC'));                
             $persons = Set::combine($persons, '{n}.User.id', array('%s %s', '{n}.User.fname', '{n}.User.lname')); 
             
            } elseif($role_id == '61') {
		$personArr = array('OR' => array('ProvincePermission.maaping_approval_id' => $user_id));                                                

                $persons = $this->ProvincePermission->find('all', array('fields' => array('User.id', 'User.fname','User.lname'),                    
           'joins' => array(
                array(
                    'table' => 'users',
                    'alias' => 'User',
                    'conditions' => array(
                                            'ProvincePermission.maaping_approval_id = User.id')
					                    
                ) 

            ),
            'conditions' => $personArr,
            'group' => 'User.id',
            'order' => 'User.fname ASC'));                
             $persons = Set::combine($persons, '{n}.User.id', array('%s %s', '{n}.User.fname', '{n}.User.lname')); 
             
            }
/*            
            else{
		$personArr = array('OR' => array('ProvincePermission.approval_id' => $user_id,'ProvincePermission.maaping_approval_id' => $user_id));                                
                
            } 
  */          
/*              
                $persons = $this->ProvincePermission->find('all', array('fields' => array('User.id', 'User.fname','User.lname'),                    
           'joins' => array(
                array(
                    'table' => 'users',
                    'alias' => 'User',
                    'conditions' => array(
                                        'OR' => array(
                                            'ProvincePermission.approval_id = User.id',
                                            'ProvincePermission.maaping_approval_id = User.id'))
					                    
                ) 

            ),
            'conditions' => $personArr,
            'group' => 'User.id',
            'order' => 'User.fname ASC'));                
             $persons = Set::combine($persons, '{n}.User.id', array('%s %s', '{n}.User.fname', '{n}.User.lname')); 
*/
           // }
        }elseif($summary_type == '1'){//oprations

		if($role_id == '65' || $role_id == '28') {				
                        $personArr = array('OR' => array('ProvincePermission.user_id' => $user_id));
		}elseif($role_id == '61' || $role_id == '62') {			
			$Select = 'All';
                        $personArr = array('OR' => array('ProvincePermission.approval_id' => $user_id,'ProvincePermission.maaping_approval_id' => $user_id));
		}elseif($role_id == '64') {		
			$Select = 'All';
                        $personArr = array(); 
		}elseif($role_id == '68') {
			$Select = 'All';
                        $exclude_sales = 'Y';
                        $personArr = array();             
		}		
            
                if ($exclude_sales == 'Y') { 
                        $persons = $this->ProvincePermission->find('all', array('fields' => array('User.id', 'User.fname','User.lname'),
                       'joins' => array(
                            array(
                                'table' => 'users',
                                'alias' => 'User',
                                'conditions' => array(
                                                    'ProvincePermission.user_id = User.id',
                                                    'User.t_sales_role_id IS NULL')
                            ) 
                        ),
                        'conditions' => $personArr,
                        'group' => 'User.id',
                        'order' => 'User.fname ASC'));                 
                         $persons = Set::combine($persons, '{n}.User.id', array('%s %s', '{n}.User.fname', '{n}.User.lname'));   
                } else {
                        $persons = $this->ProvincePermission->find('all', array('fields' => array('User.id', 'User.fname','User.lname'),
                       'joins' => array(
                            array(
                                'table' => 'users',
                                'alias' => 'User',
                                'conditions' => array(
                                                    'ProvincePermission.user_id = User.id')
                            ) 
                        ),
                        'conditions' => $personArr,
                        'group' => 'User.id',
                        'order' => 'User.fname ASC'));                 
                         $persons = Set::combine($persons, '{n}.User.id', array('%s %s', '{n}.User.fname', '{n}.User.lname'));                       
                }           
		
        }
        $this->set(compact('persons','Select'));


    }

    public function get_activity_user_list_by_summary_type(){

        $this->layout = '';
        $user_id = $this->Auth->user('id');
        $channel_id = $this->Session->read("channel_id");
        $role_id = $this->Session->read("role_id");        
        $personArr = array();
        $exclude_sales = '';
        $Select = '--Select--';
        $summary_type = $this->data['Report']['summary_type'];
        if($summary_type == '2'){ //Approver

            if($role_id == '64' || $role_id == '68') {	                         
		$Select = 'All';
                
                $personArr = array();

                $persons = $this->ProvincePermission->find('all', array('fields' => array('User.id', 'User.fname','User.lname'),                    
           'joins' => array(
                array(
                    'table' => 'users',
                    'alias' => 'User',
                    'conditions' => array(
                                        'OR' => array(
                                            'ProvincePermission.approval_id = User.id',
                                            'ProvincePermission.maaping_approval_id = User.id'))
					                    
                ) 

            ),
            'conditions' => $personArr,
            'group' => 'User.id',
            'order' => 'User.fname ASC'));                
             $persons = Set::combine($persons, '{n}.User.id', array('%s %s', '{n}.User.fname', '{n}.User.lname')); 
             
            } elseif($role_id == '62') {
		$personArr = array('OR' => array('ProvincePermission.approval_id' => $user_id));  

                $persons = $this->ProvincePermission->find('all', array('fields' => array('User.id', 'User.fname','User.lname'),                    
           'joins' => array(
                array(
                    'table' => 'users',
                    'alias' => 'User',
                    'conditions' => array(
                                            'ProvincePermission.approval_id = User.id')
					                    
                ) 

            ),
            'conditions' => $personArr,
            'group' => 'User.id',
            'order' => 'User.fname ASC'));                
             $persons = Set::combine($persons, '{n}.User.id', array('%s %s', '{n}.User.fname', '{n}.User.lname')); 
             
            } elseif($role_id == '61') {
		$personArr = array('OR' => array('ProvincePermission.maaping_approval_id' => $user_id));                                                

                $persons = $this->ProvincePermission->find('all', array('fields' => array('User.id', 'User.fname','User.lname'),                    
           'joins' => array(
                array(
                    'table' => 'users',
                    'alias' => 'User',
                    'conditions' => array(
                                            'ProvincePermission.maaping_approval_id = User.id')
					                    
                ) 

            ),
            'conditions' => $personArr,
            'group' => 'User.id',
            'order' => 'User.fname ASC'));                
             $persons = Set::combine($persons, '{n}.User.id', array('%s %s', '{n}.User.fname', '{n}.User.lname')); 
             
            }
/*            
            else{
		$personArr = array('OR' => array('ProvincePermission.approval_id' => $user_id,'ProvincePermission.maaping_approval_id' => $user_id));                                
                
            } 
  */          
/*              
                $persons = $this->ProvincePermission->find('all', array('fields' => array('User.id', 'User.fname','User.lname'),                    
           'joins' => array(
                array(
                    'table' => 'users',
                    'alias' => 'User',
                    'conditions' => array(
                                        'OR' => array(
                                            'ProvincePermission.approval_id = User.id',
                                            'ProvincePermission.maaping_approval_id = User.id'))
					                    
                ) 

            ),
            'conditions' => $personArr,
            'group' => 'User.id',
            'order' => 'User.fname ASC'));                
             $persons = Set::combine($persons, '{n}.User.id', array('%s %s', '{n}.User.fname', '{n}.User.lname')); 
*/
           // }
        }elseif($summary_type == '1'){//oprations

            
		if($role_id == '65' || $role_id == '28') {				
                        $personArr = array('OR' => array('ProvincePermission.user_id' => $user_id));
		}elseif($role_id == '61' || $role_id == '62') {			
			$Select = 'All';
                        $personArr = array('OR' => array('ProvincePermission.approval_id' => $user_id,'ProvincePermission.maaping_approval_id' => $user_id));
		}elseif($role_id == '64') {		
			$Select = 'All';
                        $personArr = array(); 
		}elseif($role_id == '68') {
			$Select = 'All';
                        $exclude_sales = 'Y';
                        $personArr = array();             
		}
/*		
            if($role_id == '64' || $role_id == '68') {	                         
		$Select = 'All';
            }

            if($role_id == '68') {	                         
		$exclude_sales = 'Y';
            }
            
           $personArr = array('OR' => array('ProvincePermission.user_id' => $user_id));
            $personArr = array();            
*/            
                if ($exclude_sales == 'Y') { 
                        $persons = $this->ProvincePermission->find('all', array('fields' => array('User.id', 'User.fname','User.lname'),
                       'joins' => array(
                            array(
                                'table' => 'users',
                                'alias' => 'User',
                                'conditions' => array(
                                                    'ProvincePermission.user_id = User.id',
                                                    'User.t_sales_role_id IS NULL')
                            ) 
                        ),
                        'conditions' => $personArr,
                        'group' => 'User.id',
                        'order' => 'User.fname ASC'));                 
                         $persons = Set::combine($persons, '{n}.User.id', array('%s %s', '{n}.User.fname', '{n}.User.lname'));   
                } else {
                        $persons = $this->ProvincePermission->find('all', array('fields' => array('User.id', 'User.fname','User.lname'),
                       'joins' => array(
                            array(
                                'table' => 'users',
                                'alias' => 'User',
                                'conditions' => array(
                                                    'ProvincePermission.user_id = User.id')
                            ) 
                        ),
                        'conditions' => $personArr,
                        'group' => 'User.id',
                        'order' => 'User.fname ASC'));                 
                         $persons = Set::combine($persons, '{n}.User.id', array('%s %s', '{n}.User.fname', '{n}.User.lname'));                       
                }           
		
        }
        $this->set(compact('persons','Select'));


    }



    public function get_image_province_by_continent_country($model = null, $field_name1 = null, $field_name2 = null) {



        $this->layout = 'ajax';

        $continent_id = $this->data[$model][$field_name1];

        $country_id = $this->data[$model][$field_name2];

        $Provinces = array();



         $proArr = array();



         if($this->checkImageProvince())

         $proArr = $this->checkImageProvince();



         if ($country_id) {

            $Provinces = $this->Province->find('list', array(

                'conditions' => array(

                    'Province.continent_id' => $continent_id,

                    'Province.country_id' => $country_id,

                    'Province.status' => '1',

                    'Province.wtb_status' => '1',

                    'Province.active' => 'TRUE',

                    'Province.id' => $proArr,

                ),

                'fields' => array('Province.id', 'Province.name'),

                'order' => 'Province.name ASC'

            ));



       }

        $this->set(compact('Provinces'));       

    }

}
