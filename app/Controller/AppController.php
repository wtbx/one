<?php
ob_start();
ini_set('memory_limit', '-1');
set_time_limit(0);
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
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
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

    //var $components = array('Auth', 'Session');

    public $components = array(
        'Auth' => array(
            'authorize' => 'Controller',
            'loginRedirect' => array(
                'admin' => false,
                'controller' => 'users',
                'action' => 'dashboard',
            ),
            //'logoutRedirect' => array('controller' => 'users', 'action' => 'demo'),
            'loginError' => 'Invalid account specified',
            'authError' => 'You do not have sufficient permission to access this section',
        ),
        'Session',
        'Export.Export'
    );
    var $helpers = array('Html', 'Session', 'Js', 'Form', 'Text', 'Time', 'Paginator','Custom');
    


    //  public $dummy_status = $this->Auth->user('dummy_status');
    public $paginate = array(
        'paramType' => 'querystring',
        'limit' => 500,
        'maxLimit' => 3000
    );

    public $paginateaction = array(
        'paramType' => 'querystring',
        'limit' => 100,
        'maxLimit' => 100
    );
    
    public function beforeFilter() {
        $direction = '';
        $sort = ''; 
        
        
        
        if($this->request->query){
            if(isset($this->request->query['direction'])&& isset($this->request->query['sort'])){
            $direction=$this->request->query['direction'];
            $sort=$this->request->query['sort'];
            }
        }
        $this->loadModel('Event');
        $this->loadModel('ActionItem');
        $this->loadModel('TravelActionItem');
        $this->loadModel('DigActionItem');
        $this->loadModel('SupportTicket');
        $self_id = $this->Auth->user("id");
        $this->set('title_for_layout', 'SilkRouters Private Distribution Network');

        $user_fname = $this->Auth->user("fname");
        $user_lname = $this->Auth->user("lname");
        $industry = $this->Session->read("industry");

        $count_events = $this->Event->find('count', array('conditions' => array('DATE(Event.start_date)' => date('Y-m-d'), 'Event.user_id' => $self_id), 'order' => 'Event.start_date, Event.description'));
        $this->set('count_events', $count_events);

        $count_action = $this->ActionItem->find('count', array('conditions' => array('ActionItem.action_item_active' => 'Yes', 'ActionItem.next_action_by' => $self_id)));
        $this->set('count_action', $count_action);
        
        $ticket_count = $this->SupportTicket->find('count', array('conditions' => array('OR' => array('SupportTicket.created_by' => $self_id,'SupportTicket.next_action_by' => $self_id),'SupportTicket.active' => 'TRUE')));
        $this->set('ticket_count', $ticket_count);

        $travel_count_action = $this->TravelActionItem->find('count', array('conditions' => array('TravelActionItem.action_item_active' => 'Yes', 'TravelActionItem.next_action_by' => $self_id)));
        $this->set(compact('travel_count_action'));
        
        $dig_count_action = $this->DigActionItem->find('count', array('conditions' => array('DigActionItem.action_item_active' => 'Yes', 'DigActionItem.next_action_by' => $self_id)));
        $this->set(compact('dig_count_action'));

        $this->set(compact('industry','direction','sort','self_id'));
        $this->set('fname', $user_fname);
        $this->set('lname', $user_lname);
        $this->Auth->allow(array('get_suburb_by_city', 'get_area_by_suburb', 'get_list_builder_by_project_id', 'get_unit_by_project_id', 'get_project_legal_list_by_project_id',
            'get_project_legal_details_by_prolegal_id', 'get_project_unit_details_by_unit_id', 'get_client_details_by_client_id', 'get_project', 'get_project_by_city', 'get_prmember_by_channel_id',
            'get_amenity_by_groupId', 'get_area_by_city', 'get_phone_office_by_cityid', 'get_builder_by_cityid', 'get_pribuilder_by_cityid', 'get_contactbuilder_by_builderid',
            'get_secobuilder_by_cityid', 'get_tertibuilder_by_cityid', 'get_type_2_by_type1_id', 'get_activity_with_by_activity_level', 'get_channel_by_city_id',
            'get_phoneofficer_by_city_id', 'get_project_by_level', 'get_associate_by_cityid', 'getAllEventRecords', 'countDetailRecord','test_ajax', 'get_list_initiated_by_city',
            'get_list_managed_by_city', 'get_builder_contact_details', 'get_list_projectmanaged_by_city', 'get_list_by_country_code', 'get_activity_desc_by_typeId',
            'get_client_phone_email', 'get_activity_info_by_id', 'get_project_by_builder_id', 'get_builder_legal_name_by_builder_id', 'get_builder_builder_legal_name_details_by_legal_id',
            'get_city_by_county_id', 'get_property_category_by_type_id', 'get_supplier_by_country', 'get_supplier_by_city',
            'get_supplier_country_by_city', 'get_hotel_supplier_country_by_city', 'get_hotel_by_city_country_supplier', 'home', 'dashboard', 'error', 'logout', 'get_travel_city_by_country', 'get_travel_hotel_by_city',
            'get_travel_city_by_country_id', 'get_travel_suburb_by_country_id_and_city_id','get_travel_country_by_continent_id',
            'get_travel_city1_by_country_id','get_travel_brand_by_chain_id','get_travel_area_by_suburb_id',
            'get_dig_product_description_by_proId','get_dig_product_format_by_product_id','get_dig_person_dtl_by_person_id','get_travel_chain_by_city_id','get_dig_topic_html_by_topic_id',
            'get_travel_suburb_by_hotel_code','get_travel_area_by_hotel_code','get_travel_chain_by_hotel_code','get_travel_brand_by_hotel_code','get_travel_website_by_hotel_code','get_level_pattern_html_by_structure_id',
            'ajax_get_travel_city_by_country_id','ajax_get_travel_item','get_travel_hotel_address_by_hotel_code','demo','get_province_by_continent_country','get_province_by_country_code',
            'get_travel_city_by_province','get_city_code_by_province_id','get_all_travel_country_by_continent_id','get_all_travel_city_by_province',
            'get_all_travel_suburb_by_country_id_and_city_id','get_all_travel_area_by_suburb_id','get_list_question_by_question_id','ajax_get_travel_country_by_continent_id',
            'ajax_get_province_by_country_id','ajax_get_travel_city_by_province','ajax_get_travel_suburb_by_city','ajax_get_travel_area_by_suburb',
            'get_all_country_by_continent_id','get_all_city_by_country_id','get_supplier_city_by_country_id','ajax_get_travel_brand_by_chain','get_supplier_city_code','get_travel_table_by_type_id','generate_sequence_no','get_user_list_by_summary_type','my_activity_report'
            ));
    }

    public function isAuthorized($user = null) {

        $isAllowed = false;

        $user_role = $this->Session->read('role_id');

        if ($user_role == '')
            $user_role = $this->Auth->user("role_id");

        if (isset($user_role) && $user_role <> "") {
            $isAllowed = $this->checkAccessRights($user_role);
        }
        if ($isAllowed) {
            return $isAllowed;
        } else {
            // set a Restrict permission.
            // $this->view('Messages/index');
            $this->redirect(array('controller' => 'messages', 'action' => 'error'));
            //  $this->Session->setFlash('You are not authorized to access this page', 'default', array(), 'restrict');
            // $this->render();
        }
    }

    public function checkAccessRights($role) {
        $this->loadModel('PermissionSet');
        $permissions = $this->PermissionSet->find('all', array(
            'fields' => '*',
            'joins' => array(
                array(
                    'table' => 'controller_sets',
                    'alias' => 'ControllerSet',
                    'type' => 'INNER',
                    'conditions' => array(
                        'PermissionSet.controller_id = ControllerSet.id'
                    )
                )
            ),
            'conditions' => array(
                'PermissionSet.role_id' => $role,
                'ControllerSet.controller_name' => $this->params['controller']
            )
        ));
        //pr($permissions);//exit;

        $flag = 0;
        foreach ($permissions as $permission) {
            if ($permission['ControllerSet']['action_name'] == $this->params['action']) {
                $flag = 1;
                break;
            }
        }


        if ($flag == 0) {

            return false;
        } else {

            return true;
        }
    }

    function beforeRender() {

        if ($this->name == 'CakeError') {
            $this->layout = 'error';
        }
    }

    public function generateRandomAlpha($length = 10) {
        $pool = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $lchr = strlen($pool) - 1;
        $ranid = "";
        for ($i = 0; $i < $length; $i++) {
            $ranid .= $pool[mt_rand(0, $lchr)];
        }
        return $ranid;
    }

    public function generateRandomNumber($length = 10) {
        $pool = "1234567890";
        $lchr = strlen($pool) - 1;
        $ranid = "";
        for ($i = 0; $i < $length; $i++) {
            $ranid .= $pool[mt_rand(0, $lchr)];
        }
        return $ranid;
    }

    function recordActivity() {

// The following line makes this script work for CakePHP installations that use either mod_rewrite or CakePHP's own URL shortening tricks.
        $pages = str_replace("/index.php", '', $_SERVER['PHP_SELF']);
        $pages = explode("/", $pages);
// You will probably all reconise this, we are just getting all the values we need to store and assigning them to CakePHP.
    }

    function xml2array($xml) {
        $opened = array();
        $array = array();
        $xml_parser = xml_parser_create();
        xml_parse_into_struct($xml_parser, $xml, $xmlarray);
        
        $arrsize = sizeof($xmlarray);
        for ($j = 0; $j < $arrsize; $j++) {
            $val = $xmlarray[$j];
            switch ($val["type"]) {
                case "open":
                    $opened[$val["tag"]] = $array;
                    unset($array);
                    break;
                case "complete":
                    $array[$val["tag"]][] = $val["value"];
                    break;
                case "close":
                    $opened[$val["tag"]] = $array;
                    $array = $opened;
                    break;
            }
        }
        return $array;
    }
    
    public function checkProvince(){
        $this->loadModel('ProvincePermission','Province');
        $user_id = $this->Auth->user('id');
        
         if($this->ProvincePermission->find('count',array('conditions' => array('ProvincePermission.user_id' => $user_id))))
                 return $this->ProvincePermission->find('list',array('fields' => array('ProvincePermission.province_id','ProvincePermission.province_id'),'conditions' => array('ProvincePermission.user_id' => $user_id)));
         else 
                 return $this->Province->find('list',array('fields' => array('Province.id','Province.id')));
    }
    
    public function checkImageProvince(){
        $this->loadModel('ImagePermission','Province');
        $user_id = $this->Auth->user('id');
        
         if($this->ImagePermission->find('count',array('conditions' => array('ImagePermission.user_id' => $user_id))))
                 return $this->ImagePermission->find('list',array('fields' => array('ImagePermission.province_id','ImagePermission.province_id'),'conditions' => array('ImagePermission.user_id' => $user_id)));
         //else 
                // return $this->Province->find('list',array('fields' => array('Province.id','Province.id')));
    }
    
    public function hotelProvince(){
        $this->loadModel('ProvincePermission','Province');
        $user_id = $this->Auth->user('id');
        
         if($this->ProvincePermission->find('count',array('conditions' => array('ProvincePermission.user_id' => $user_id))))
                 return $this->ProvincePermission->find('list',array('fields' => array('ProvincePermission.province_id','ProvincePermission.province_id'),'conditions' => array('ProvincePermission.user_id' => $user_id)));
         
    }
}
