<?php

/**
 * Builder controller.
 *
 * This file will render views from views/builders/
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
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('CakeEmail', 'Network/Email');
/**
 * Email sender
 */
App::uses('AppController', 'Controller');

App::uses('Xml', 'Utility');

/**
 * Builder controller
 *
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class AdminController extends AppController {

    var $uses = array('SupplierCountry', 'ProvincePermission', 'TravelCountry', 'Province', 'SupplierCity', 'SupplierHotel', 'TravelFetchTable', 'SupplierHotel', 'TravelSupplier', 'Common', 'SupplierHotel',
        'TravelActionItem', 'TravelSuburb', 'TravelArea', 'TravelBrand', 'TravelChain', 'TravelLookupPropertyType',
        'TravelLookupRateType', 'LogCall', 'TravelHotelRoomSupplier', 'User', 'TravelRemark', 'TravelCountrySupplier', 'TravelLookupContinent', 'Mappinge', 'TravelCity', 'TravelCitySupplier', 'TravelHotelLookup', 'TravelHotelRoomSupplier', 'SupportTicket');

    function index() {
        
    }

    function reports() {
        
    }

    function data() {
        
    }

    function administration() {
        
    }

    public function fetch_hotels() {

        $search_condition = array();
        $supplier_id = '';
        $type_id = '';
        $user_id = '';
        $country_id = '';
        $city_id = '';
        $status = '';
        $SupplierCities = array();

        if ($this->request->is('post') || $this->request->is('put')) {

            if (!empty($this->data['TravelFetchTable']['supplier_id'])) {
                $supplier_id = $this->data['TravelFetchTable']['supplier_id'];
                array_push($search_condition, array('TravelFetchTable.supplier_id' => $supplier_id));
            }
            if (!empty($this->data['TravelFetchTable']['type_id'])) {
                $type_id = $this->data['TravelFetchTable']['type_id'];
                array_push($search_condition, array('TravelFetchTable.type_id' => $type_id));
            }
            if (!empty($this->data['TravelFetchTable']['user_id'])) {
                $user_id = $this->data['TravelFetchTable']['user_id'];
                array_push($search_condition, array('TravelFetchTable.user_id' => $user_id));
            }

            if (!empty($this->data['TravelFetchTable']['country_id'])) {
                $country_id = $this->data['TravelFetchTable']['country_id'];
                $country_code = $this->Common->getSupplierCountryCode($country_id);
                array_push($search_condition, array('TravelFetchTable.country_id' => $country_id));
                $SupplierCities = $this->SupplierCity->find('list', array(
                    'conditions' => array(
                        'SupplierCity.country_code' => $country_code,
                    ),
                    'fields' => 'SupplierCity.id, SupplierCity.name',
                    'order' => 'SupplierCity.name ASC'
                ));
            }

            if (!empty($this->data['TravelFetchTable']['status'])) {
                $status = $this->data['TravelFetchTable']['status'];
                array_push($search_condition, array('TravelFetchTable.status' => $status));
            }
        } elseif ($this->request->is('get')) {


            if (!empty($this->request->params['TravelFetchTable']['supplier_id'])) {
                $supplier_id = $this->request->params['TravelFetchTable']['supplier_id'];
                array_push($search_condition, array('TravelFetchTable.supplier_id' => $supplier_id));
            }
            if (!empty($this->request->params['TravelFetchTable']['type_id'])) {
                $type_id = $this->request->params['TravelFetchTable']['type_id'];
                array_push($search_condition, array('TravelFetchTable.type_id' => $type_id));
            }
            if (!empty($this->request->params['TravelFetchTable']['user_id'])) {
                $user_id = $this->request->params['TravelFetchTable']['user_id'];
                array_push($search_condition, array('TravelFetchTable.user_id' => $user_id));
            }

            if (!empty($this->request->params['named']['country_id'])) {
                $country_id = $this->request->params['named']['country_id'];
                $country_code = $this->Common->getSupplierCountryCode($country_id);
                array_push($search_condition, array('TravelFetchTable.country_id' => $country_id));
                $SupplierCities = $this->SupplierCity->find('list', array(
                    'conditions' => array(
                        'SupplierCity.country_code' => $country_code,
                    ),
                    'fields' => 'SupplierCity.id, SupplierCity.name',
                    'order' => 'SupplierCity.name ASC'
                ));
            }

            if (!empty($this->request->params['named']['city_id'])) {
                $city_id = $this->request->params['named']['city_id'];
                array_push($search_condition, array('TravelFetchTable.city_id' => $city_id));
            }
            if (!empty($this->request->params['named']['status'])) {
                $status = $this->request->params['named']['status'];
                array_push($search_condition, array('TravelFetchTable.status' => $status));
            }
        }

        $this->paginate['order'] = array('TravelFetchTable.id' => 'desc');
        $this->set('TravelFetchTables', $this->paginate("TravelFetchTable", $search_condition));

        $SupplierCityCount = $this->SupplierCity->find('count');
        $SupplierCountryCount = $this->SupplierCountry->find('count');
        $SupplierHotelCount = $this->SupplierHotel->find('count');
        $TravelSuppliers = $this->TravelSupplier->find('list', array('fields' => 'id,supplier_code', 'order' => 'supplier_code ASC'));
        $SupplierCountries = $this->SupplierCountry->find('list', array('fields' => 'id,name', 'order' => 'name ASC'));
        $users = $this->User->find('all', array('fields' => array('User.id', 'User.fname', 'User.lname'),
            'conditions' => array('User.id' => array('1', '169')), 'order' => 'User.fname asc'));
        $users = Set::combine($users, '{n}.User.id', array('%s %s', '{n}.User.fname', '{n}.User.lname'));

        $this->set(compact('SupplierCityCount', 'users', 'SupplierCountryCount', 'SupplierHotelCount', 'SupplierCountries', 'TravelSuppliers', 'supplier_id', 'type_id', 'user_id', 'country_id', 'city_id', 'status', 'SupplierCities'));
    }

    public function add_hotel() {

        $location_URL = 'http://dev.wtbnetworks.com/TravelXmlManagerv001/ProEngine.Asmx';
        $action_URL = 'http://www.travel.domain/ProcessXML';
        $user_id = $this->Auth->user('id');

        if ($this->request->is('post') || $this->request->is('put')) {

            $country_id = $this->data['SupplierHotel']['country_id'];
            $city_id = $this->data['SupplierHotel']['city_id'];
            $supplier_id = $this->data['SupplierHotel']['supplier_id'];

            $supplier_code = $this->Common->getSupplierCode($supplier_id);
            $supplier_name = $this->Common->getSupplierName($supplier_id);
            $country_code = $this->Common->getSupplierCountryCode($country_id);
            $country_name = $this->Common->getSupplierCountryName($country_id);
            $city_code = $this->Common->getSupplierCityCode($city_id);
            $city_name = $this->Common->getSupplierCityName($city_id);
            $CreatedDate = date('Y-m-d') . 'T' . date('h:i:s');

            $content_xml_str = '<soap:Body>
                                            <ProcessXML xmlns="http://www.travel.domain/">
                                                <RequestInfo>
                                                    <GetDirectSupplierStaticData>
                                                        <RequestAuditInfo>
                                                            <RequestType>PXML_DirectSupplier_GetStaticData_Prod</RequestType>
                                                            <RequestTime>' . $CreatedDate . '</RequestTime>
                                                            <RequestResource>Silkrouters</RequestResource>
                                                        </RequestAuditInfo>
                                                        <RequestParameters>
                                                            <SupplierDataType>Hotel</SupplierDataType>
                                                            <SupplierId>' . $supplier_id . '</SupplierId>
                                                            <CountryCode>' . $country_code . '</CountryCode>
                                                            <CityCode>' . $city_code . '</CityCode>
                                                            <HotelCode></HotelCode>
                                                        </RequestParameters>
                                                    </GetDirectSupplierStaticData>
                                                </RequestInfo>
                                            </ProcessXML>
                                        </soap:Body>';


            $log_call_screen = 'Supplier - Add';

            $xml_string = Configure::read('travel_start_xml_str') . $content_xml_str . Configure::read('travel_end_xml_str');
            $client = new SoapClient(null, array(
                'location' => $location_URL,
                'uri' => '',
                'trace' => 1,
            ));

            try {
                $order_return = $client->__doRequest($xml_string, $location_URL, $action_URL, 1);
                
               
                //$xmlparser = xml_parser_create();
                //xml_parse_into_struct($xmlparser,$order_return,$values);
                //xml_parser_free($xmlparser);;
                //$xml_arr = xml_to_object($order_return);
                //$xml_arr = $this->Common->xml2array($order_return);
                //echo htmlentities($xml_string);
                // echo '<br>-------------------';
                // echo htmlentities($order_return);
                //pr($xml_arr);
                //$xmlObject = new Xml($xmlString);
                //$xmlObject = new Xml();
//$xmlArray = Xml::toArray($order_return);
                $xmlArray = Xml::toArray(Xml::build($order_return));
               
                $dataArray = $xmlArray['Envelope']['soap:Body']['ProcessXMLResponse']['ProcessXMLResult']['SupplierData_Hotel']['ResponseAuditInfo']['root']['LocalHotelList']['item'];
                    
                if(count($dataArray) > 3){
                   
                     $ValArr =$dataArray;
                }
                else  {                   
                    $ValArr[] =$dataArray;                    
                }
                
                $total_volume = count($ValArr);
               

                if (count($ValArr)) {

                    $this->request->data['TravelFetchTable']['supplier_id'] = $supplier_id;
                    $this->request->data['TravelFetchTable']['user_id'] = $user_id;
                    $this->request->data['TravelFetchTable']['country_id'] = $country_id;
                    $this->request->data['TravelFetchTable']['city_id'] = $city_id;
                    $this->request->data['TravelFetchTable']['total_volume'] = $total_volume;
                    $this->request->data['TravelFetchTable']['status'] = '1';
                    $this->request->data['TravelFetchTable']['type_id'] = '1';

                    $this->TravelFetchTable->save($this->data['TravelFetchTable']);
                    $fetch_id = $this->TravelFetchTable->getLastInsertId();

                    if ($fetch_id) {
                 
                        foreach ($ValArr as $value) {                            
                         
                            if ($this->SupplierHotel->find('count', array('conditions' => array(
                                            'supplier_id' => $supplier_id,
                                            'city_id' => $city_id,
                                            'country_id' => $country_id,
                                            'hotel_code' => $value['Id']['@'],
                                ))) == 0) {
                                $save[] = array('SupplierHotel' => array(
                                        'city_id' => $city_id,
                                        'fetch_id' => $fetch_id,
                                        'city_code' => $city_code,
                                        'city_name' => $city_name,
                                        'country_id' => $country_id,
                                        'country_name' => $country_name,
                                        'country_code' => $country_code,
                                        'hotel_code' => $value['Id']['@'],
                                        'hotel_name' => $value['Name']['@'],
                                        'supplier_id' => $supplier_id,
                                        'supplier_code' => $supplier_code,
                                        'status' => '1',
                                        'supplier_name' => $supplier_name
                                ));
                            }
                        }
                   
            
                        
                        $inserted_volume = count($save);
                        
                        $this->TravelFetchTable->updateAll(array('TravelFetchTable.inserted_volume' => "'" . $inserted_volume . "'"), array('TravelFetchTable.id' => $fetch_id));




                        if ($inserted_volume) {
                            if ($this->SupplierHotel->saveAll($save, array('validate' => true))) {
                                //if ($this->SupplierHotel->saveMany($save)) {

                                $this->Session->setFlash('Data inserted successfully', 'success');
                                $this->redirect(array('action' => 'fetch_hotels'));
                            }
                        } else {
                            $this->Session->setFlash('Unable to insert data.', 'failure');
                            $this->redirect(array('action' => 'fetch_hotels'));
                        }
                    } else {
                        $this->Session->setFlash('Unable to insert data.', 'failure');
                        $this->redirect(array('action' => 'fetch_hotels'));
                    }
                }
            } catch (SoapFault $exception) {
                var_dump(get_class($exception));
                var_dump($exception);
            }
        }
        $TravelSuppliers = $this->TravelSupplier->find('list', array('fields' => 'id,supplier_code', 'order' => 'supplier_code ASC'));
        $SupplierCountries = $this->SupplierCountry->find('list', array('fields' => 'id,name', 'order' => 'name ASC'));
        $this->set(compact('SupplierCountries', 'TravelSuppliers'));
    }

    public function add_country() {

        $location_URL = 'http://dev.wtbnetworks.com/TravelXmlManagerv001/ProEngine.Asmx';
        $action_URL = 'http://www.travel.domain/ProcessXML';
        $user_id = $this->Auth->user('id');


        if ($this->request->is('post') || $this->request->is('put')) {

            $CreatedDate = date('Y-m-d') . 'T' . date('h:i:s');
            $supplier_id = $this->data['SupplierCountry']['supplier_id'];
            $supplier_code = $this->Common->getSupplierCode($supplier_id);
            $supplier_name = $this->Common->getSupplierName($supplier_id);

            $content_xml_str = '<soap:Body>
                                <ProcessXML xmlns="http://www.travel.domain/">
                                    <RequestInfo>
                                        <GetDirectSupplierStaticData>
                                            <RequestAuditInfo>
                                                <RequestType>PXML_DirectSupplier_GetStaticData_Prod</RequestType>
                                                <RequestTime>' . $CreatedDate . '</RequestTime>
                                                <RequestResource>Silkrouters</RequestResource>
                                            </RequestAuditInfo>
                                            <RequestParameters>
                                                <SupplierDataType>Country</SupplierDataType>
                                                <SupplierId>' . $supplier_id . '</SupplierId>
                                                <CountryCode></CountryCode>
                                                <CityCode></CityCode>
                                                <HotelCode></HotelCode>
                                            </RequestParameters>
                                        </GetDirectSupplierStaticData>
                                    </RequestInfo>
                                </ProcessXML>
                            </soap:Body>';


            $log_call_screen = 'Supplier Country - Add';

            $xml_string = Configure::read('travel_start_xml_str') . $content_xml_str . Configure::read('travel_end_xml_str');
            $client = new SoapClient(null, array(
                'location' => $location_URL,
                'uri' => '',
                'trace' => 1,
            ));

            try {
                $order_return = $client->__doRequest($xml_string, $location_URL, $action_URL, 1);

                $xmlArray = Xml::toArray(Xml::build($order_return));

                $dataArray = $xmlArray['Envelope']['soap:Body']['ProcessXMLResponse']['ProcessXMLResult']['SupplierData_Country']['ResponseAuditInfo']['root']['a:item'];
                
                if(count($dataArray) > 3){
                    
                     $ValArr =$dataArray;
                }
                else  {                   
                    $ValArr[] =$dataArray;
                    
                }
                
                $total_volume = count($ValArr);
                //if($total_volume){
                //pr($ValArr);
                //die;
                //$total_volume = $this->SupplierCountry->find('count');
                $this->request->data['TravelFetchTable']['supplier_id'] = $supplier_id;
                $this->request->data['TravelFetchTable']['user_id'] = $user_id;
                $this->request->data['TravelFetchTable']['country_id'] = '';
                $this->request->data['TravelFetchTable']['city_id'] = '';
                $this->request->data['TravelFetchTable']['total_volume'] = $total_volume;
                $this->request->data['TravelFetchTable']['status'] = '1';
                $this->request->data['TravelFetchTable']['type_id'] = '2';

                $this->TravelFetchTable->save($this->data['TravelFetchTable']);
                $fetch_id = $this->TravelFetchTable->getLastInsertId();
                if ($fetch_id) {
                    foreach ($ValArr as $value) {
                        if ($this->SupplierCountry->find('count', array('conditions' => array(
                                        'supplier_id' => $supplier_id,
                                        'code' => $value['Code']['@'],
                            ))) == 0) {
                            $save[] = array('SupplierCountry' => array(
                                    'item' => $value['@item'],
                                    'code' => $value['Code']['@'],
                                    'name' => $value['Name']['@'],
                                    'supplier_id' => $supplier_id,
                                    'supplier_code' => $supplier_code,
                                    'supplier_name' => $supplier_name,
                                    'status' => '1',
                                    'fetch_id' => $fetch_id,
                            ));
                        }
                    }
                    $inserted_volume = count($save);
                    $this->TravelFetchTable->updateAll(array('TravelFetchTable.inserted_volume' => "'" . $inserted_volume . "'"), array('TravelFetchTable.id' => $fetch_id));
                    if ($inserted_volume) {
                        $this->SupplierCountry->create();
                        if ($this->SupplierCountry->saveMany($save)) {
                            $this->Session->setFlash('Data inserted successfully', 'success');
                            $this->redirect(array('action' => 'fetch_hotels'));
                        }
                    } else {
                        $this->Session->setFlash('Unable to insert data.', 'failure');
                        $this->redirect(array('action' => 'fetch_hotels'));
                    }
                } else {
                    $this->Session->setFlash('Unable to insert data.', 'failure');
                    $this->redirect(array('action' => 'fetch_hotels'));
                }



                //}
                //}
            } catch (SoapFault $exception) {
                var_dump(get_class($exception));
                var_dump($exception);
            }
        }

        $TravelSuppliers = $this->TravelSupplier->find('list', array('fields' => 'id,supplier_code', 'order' => 'supplier_code ASC'));
        $this->set(compact('TravelSuppliers'));
    }

    public function supplier_country() {

        $search_condition = array();
        
        if (count($this->params['pass'])) {

           foreach ($this->params['pass'] as $key => $value) {
                array_push($search_condition, array('SupplierCountry.' . $key => $value));
                
            }                
        } elseif (count($this->params['named'])) {

            foreach ($this->params['named'] as $key => $value) {
                array_push($search_condition, array('SupplierCountry.' . $key => $value));
               
            }
        }

	 if ($this->request->is('post') || $this->request->is('put')) {  

            if (isset($this->request->data['SupplierCountry']['supplier_id']) && $this->request->data['SupplierCountry']['supplier_id']!='') {
					
					array_push($search_condition, array('SupplierCountry.supplier_id' => $this->request->data['SupplierCountry']['supplier_id'] ));
		
			}			
	 }
        
        
        $this->paginate['order'] = array('SupplierCountry.id' => 'asc');
        $this->set('SupplierCountries', $this->paginate("SupplierCountry", $search_condition));

        $SupplierCityCount = $this->SupplierCity->find('count');
        $SupplierCountryCount = $this->SupplierCountry->find('count');
        $SupplierHotelCount = $this->SupplierHotel->find('count');
		
		$TravelSuppliers = $this->TravelSupplier->find('list', array('fields' => 'id,supplier_code', 'order' => 'supplier_code ASC'));
		
        $this->set(compact('SupplierCityCount', 'SupplierCountryCount', 'SupplierHotelCount','TravelSuppliers'));
    }

    public function add_city() {
        $location_URL = 'http://dev.wtbnetworks.com/TravelXmlManagerv001/ProEngine.Asmx';
        $action_URL = 'http://www.travel.domain/ProcessXML';
        $user_id = $this->Auth->user('id');


        if ($this->request->is('post') || $this->request->is('put')) {

            $supplier_id = $this->data['SupplierCity']['supplier_id'];
            $country_id = $this->data['SupplierCity']['country_id'];
            $supplier_code = $this->Common->getSupplierCode($supplier_id);
            $supplier_name = $this->Common->getSupplierName($supplier_id);
            $country_code = $this->Common->getSupplierCountryCode($country_id);
            $country_name = $this->Common->getSupplierCountryName($country_id);
            $CreatedDate = date('Y-m-d') . 'T' . date('h:i:s');

            $content_xml_str = '<soap:Body>
                                    <ProcessXML xmlns="http://www.travel.domain/">
                                        <RequestInfo>
                                            <GetDirectSupplierStaticData>
                                                <RequestAuditInfo>
                                                    <RequestType>PXML_DirectSupplier_GetStaticData_Prod</RequestType>
                                                    <RequestTime>' . $CreatedDate . '</RequestTime>
                                                    <RequestResource>Silkrouters</RequestResource>
                                                </RequestAuditInfo>
                                                <RequestParameters>
                                                    <SupplierDataType>City</SupplierDataType>
                                                    <SupplierId>' . $supplier_id . '</SupplierId>
                                                    <CountryCode>' . $country_code . '</CountryCode>
                                                    <CityCode></CityCode>
                                                    <HotelCode></HotelCode>
                                                </RequestParameters>
                                            </GetDirectSupplierStaticData>
                                        </RequestInfo>
                                    </ProcessXML>
                                </soap:Body>';


            $log_call_screen = 'Supplier - Add';

            $xml_string = Configure::read('travel_start_xml_str') . $content_xml_str . Configure::read('travel_end_xml_str');
            $client = new SoapClient(null, array(
                'location' => $location_URL,
                'uri' => '',
                'trace' => 1,
            ));

            try {
                $order_return = $client->__doRequest($xml_string, $location_URL, $action_URL, 1);

                $xmlArray = Xml::toArray(Xml::build($order_return));

                $dataArray = $xmlArray['Envelope']['soap:Body']['ProcessXMLResponse']['ProcessXMLResult']['SupplierData_City']['ResponseAuditInfo']['root']['CityInfo']['item'];
                
                if(count($dataArray) > 3){                    
                     $ValArr =$dataArray;
                }
                else  {                   
                    $ValArr[] =$dataArray;                    
                }
                
                
                $total_volume = count($ValArr);

                //$total_volume = $this->SupplierCity->find('count');
                $this->request->data['TravelFetchTable']['supplier_id'] = $supplier_id;
                $this->request->data['TravelFetchTable']['user_id'] = $user_id;
                $this->request->data['TravelFetchTable']['country_id'] = $country_id;
                $this->request->data['TravelFetchTable']['city_id'] = '';
                $this->request->data['TravelFetchTable']['total_volume'] = $total_volume;
                $this->request->data['TravelFetchTable']['status'] = '1';
                $this->request->data['TravelFetchTable']['type_id'] = '3';
                $this->TravelFetchTable->save($this->data['TravelFetchTable']);
                $fetch_id = $this->TravelFetchTable->getLastInsertId();
                if ($fetch_id) {
                    foreach ($ValArr as $value) {
                        if ($this->SupplierCity->find('count', array('conditions' => array(
                                        'supplier_id' => $supplier_id,
                                        'code' => $value['CityCode']['@'],
                                        'country_id' => $country_id,
                            ))) == 0) {
                            $save[] = array('SupplierCity' => array(
                                    'fetch_id' => $fetch_id,
                                    'country_code' => $country_code,
                                    'country_id' => $country_id,
                                    'country_name' => $country_name,
                                    'code' => $value['CityCode']['@'],
                                    'name' => $value['Name']['@'],
                                    'supplier_id' => $supplier_id,
                                    'supplier_code' => $supplier_code,
                                    'status' => '1',
                                    'supplier_name' => $supplier_name
                            ));
                        }
                    }
                    $inserted_volume = count($save);
                    $this->TravelFetchTable->updateAll(array('TravelFetchTable.inserted_volume' => "'" . $inserted_volume . "'"), array('TravelFetchTable.id' => $fetch_id));

                    if ($inserted_volume) {
                        $this->SupplierCity->create();
                        if ($this->SupplierCity->saveMany($save)) {
                            $this->Session->setFlash('Data inserted successfully', 'success');
                            $this->redirect(array('action' => 'fetch_hotels'));
                        }
                    } else {
                        $this->Session->setFlash('Unable to insert data.', 'failure');
                        $this->redirect(array('action' => 'fetch_hotels'));
                    }
                } else {
                    $this->Session->setFlash('Unable to insert data.', 'failure');
                    $this->redirect(array('action' => 'fetch_hotels'));
                }
            } catch (SoapFault $exception) {
                var_dump(get_class($exception));
                var_dump($exception);
            }
        }

        $TravelSuppliers = $this->TravelSupplier->find('list', array('fields' => 'id,supplier_code', 'order' => 'supplier_code ASC'));
        $SupplierCountries = $this->SupplierCountry->find('list', array('fields' => 'id,name', 'order' => 'name ASC'));
        $this->set(compact('SupplierCountries', 'TravelSuppliers'));
    }

    public function supplier_city() {

        $search_condition = array();
        
        if (count($this->params['pass'])) {

           foreach ($this->params['pass'] as $key => $value) {
                array_push($search_condition, array('SupplierCity.' . $key => $value));
                
            }                
        } elseif (count($this->params['named'])) {

            foreach ($this->params['named'] as $key => $value) {
                array_push($search_condition, array('SupplierCity.' . $key => $value));
               
            }
        }
		
		
	 if ($this->request->is('post') || $this->request->is('put')) {  

            if (isset($this->request->data['SupplierCity']['supplier_id']) && $this->request->data['SupplierCity']['supplier_id']!='') {
					
					array_push($search_condition, array('SupplierCity.supplier_id' => $this->request->data['SupplierCity']['supplier_id'] ));
		
			}	

			if (isset($this->request->data['SupplierCity']['country_id']) && $this->request->data['SupplierCity']['country_id']!='') {
					
					array_push($search_condition, array('SupplierCity.country_id' => $this->request->data['SupplierCity']['country_id'] ));
		
			}
	 }
      
        
        $this->paginate['order'] = array('SupplierCity.id' => 'asc');
        $this->set('SupplierCities', $this->paginate("SupplierCity", $search_condition));	
        $SupplierCityCount = $this->SupplierCity->find('count');
        $SupplierCountryCount = $this->SupplierCountry->find('count');
        $SupplierHotelCount = $this->SupplierHotel->find('count');
		
		
		$TravelSuppliers = $this->TravelSupplier->find('list', array('fields' => 'id,supplier_code', 'order' => 'supplier_code ASC'));

        $SupplierCountries = $this->SupplierCountry->find('list', array('fields' => 'id,name', 'order' => 'name ASC'));

        $this->set(compact('SupplierCountries', 'TravelSuppliers'));
        $this->set(compact('SupplierCityCount', 'SupplierCountryCount', 'SupplierHotelCount'));
    }

    public function supplier_hotel_mappings() {

        $location_URL = 'http://dev.wtbnetworks.com/TravelXmlManagerv001/ProEngine.Asmx';
        $action_URL = 'http://www.travel.domain/ProcessXML';
        $user_id = $this->Auth->user('id');

        if ($this->request->is('post') || $this->request->is('put')) {


            $content_xml_str = '<soap:Body>
                                            <ProcessXML xmlns="http://www.travel.domain/">
                                                <RequestInfo>
                                                    <GetDirectSupplierStaticData>
                                                        <RequestAuditInfo>
                                                            <RequestType>PXML_DirectSupplier_GetStaticData_Prod</RequestType>
                                                            <RequestTime>2016-07-20T15:59:45</RequestTime>
                                                            <RequestResource>CompanyCode</RequestResource>
                                                        </RequestAuditInfo>
                                                        <RequestParameters>
                                                            <SupplierDataType>Hotel</SupplierDataType>
                                                            <SupplierId>1</SupplierId>
                                                            <CountryCode>64</CountryCode>
                                                            <CityCode>108</CityCode>
                                                            <HotelCode></HotelCode>
                                                        </RequestParameters>
                                                    </GetDirectSupplierStaticData>
                                                </RequestInfo>
                                            </ProcessXML>
                                        </soap:Body>';


            $log_call_screen = 'Supplier - Add';

            $xml_string = Configure::read('travel_start_xml_str') . $content_xml_str . Configure::read('travel_end_xml_str');
            $client = new SoapClient(null, array(
                'location' => $location_URL,
                'uri' => '',
                'trace' => 1,
            ));

            try {
                $order_return = $client->__doRequest($xml_string, $location_URL, $action_URL, 1);
                //$xmlparser = xml_parser_create();
                //xml_parse_into_struct($xmlparser,$order_return,$values);
                //xml_parser_free($xmlparser);;
                //$xml_arr = xml_to_object($order_return);
                //$xml_arr = $this->Common->xml2array($order_return);
                // echo htmlentities($xml_string);
                // echo '<br>-------------------';
                // echo htmlentities($order_return);
                //pr($xml_arr);
                //$xmlObject = new Xml($xmlString);
                //$xmlObject = new Xml();
//$xmlArray = Xml::toArray($order_return);
                $xmlArray = Xml::toArray(Xml::build($order_return));

                $ValArr = $xmlArray['Envelope']['soap:Body']['ProcessXMLResponse']['ProcessXMLResult']['SupplierData_Hotel']['ResponseAuditInfo']['root']['LocalHotelList']['item'];
                // PR($ValArr);
                //die;
                foreach ($ValArr as $value) {
                    //echo  $value['Code']['@'];
                    $save[] = array('SupplierHotel' => array(
                            'city_code' => '108',
                            'city_name' => 'BANGKOK',
                            'country_name' => 'THAILAND',
                            'country_code' => '64',
                            'id' => $value['Id']['@'],
                            'hotel_name' => $value['Name']['@'],
                    ));
                }
                $this->SupplierHotel->create();
                $this->SupplierHotel->saveMany($save);
            } catch (SoapFault $exception) {
                var_dump(get_class($exception));
                var_dump($exception);
            }
        }
    }

    public function supplier_hotels() {

        $search_condition = array();
        
        if (count($this->params['pass'])) {

           foreach ($this->params['pass'] as $key => $value) {
                array_push($search_condition, array('SupplierHotel.' . $key => $value));
                
            }                
        } elseif (count($this->params['named'])) {

            foreach ($this->params['named'] as $key => $value) {
                array_push($search_condition, array('SupplierHotel.' . $key => $value));
               
            }
        }
		
		
		
		 if ($this->request->is('post') || $this->request->is('put')) {  

            if (isset($this->request->data['SupplierHotel']['supplier_id']) && $this->request->data['SupplierHotel']['supplier_id']!='') {
					
					array_push($search_condition, array('SupplierHotel.supplier_id' => $this->request->data['SupplierHotel']['supplier_id'] ));
		
			}	

			if (isset($this->request->data['SupplierHotel']['country_id']) && $this->request->data['SupplierHotel']['country_id']!='') {
					
					array_push($search_condition, array('SupplierHotel.country_id' => $this->request->data['SupplierHotel']['country_id'] ));
		
			}
			
			if (isset($this->request->data['SupplierHotel']['city_id']) && $this->request->data['SupplierHotel']['city_id']!='') {
					
					array_push($search_condition, array('SupplierHotel.city_id' => $this->request->data['SupplierHotel']['city_id'] ));
		
			}
	 }
        
        $this->paginate['order'] = array('SupplierHotel.id' => 'asc');        
        $this->set('SupplierHotels', $this->paginate("SupplierHotel", $search_condition));
		
		$TravelSuppliers = $this->TravelSupplier->find('list', array('fields' => 'id,supplier_code', 'order' => 'supplier_code ASC'));

        $SupplierCountries = $this->SupplierCountry->find('list', array('fields' => 'id,name', 'order' => 'name ASC'));

        $this->set(compact('SupplierCountries', 'TravelSuppliers'));
        $SupplierCityCount = $this->SupplierCity->find('count');
        $SupplierCountryCount = $this->SupplierCountry->find('count');
        $SupplierHotelCount = $this->SupplierHotel->find('count');
        $this->set(compact('SupplierCityCount', 'SupplierCountryCount', 'SupplierHotelCount'));
    }

    public function country_mapping($id = null) {

        $condition = '';

        if (!$id) {
            throw new NotFoundException(__('Invalid Country'));
        }

        $SupplierCountries = $this->SupplierCountry->findById($id);
        $search_condition = ARRAY();


        if (count($SupplierCountries)) {
            $country_name = $SupplierCountries['SupplierCountry']['name'];
//array_push($search_condition, array("TravelCountry.country_name LIKE '%$arr[$indexOfFirstLetter]%'"));

            for ($indexOfFirstLetter = 0; $indexOfFirstLetter <= strlen($country_name); $indexOfFirstLetter++) {

                for ($indexOfLastLetter = $indexOfFirstLetter + 1; $indexOfLastLetter <= strlen($country_name); $indexOfLastLetter++) {
                    $arr[] = substr($country_name, $indexOfFirstLetter, 4);

                    if (strlen($arr[$indexOfFirstLetter]) == '4') {
                        array_push($search_condition, array("TravelCountry.country_name LIKE '%$arr[$indexOfFirstLetter]%'"));
                    }
                    $indexOfFirstLetter++;
                }
            }

            //pr($search_condition);
            //die;

            $TravelCountries = $this->TravelCountry->find
                    (
                    'all', array
                (
                'conditions' => array
                    ('OR' =>
                    $search_condition
                ),
                'order' => 'TravelCountry.country_name ASC',
                    )
            );

            $this->set(compact('TravelCountries'));
        }

        //$log = $this->TravelCountry->getDataSource()->getLog(false, false);       
        //debug($log);
        //die;

        $this->request->data = $SupplierCountries;
    }

    public function city_mapping($id = null) {

        $condition = array();
        $search_condition = array();
        $condition = array();
        if (!$id) {
            throw new NotFoundException(__('Invalid City'));
        }

        $SupplierCities = $this->SupplierCity->findById($id);



        if (count($SupplierCities)) {

            $city_name = $SupplierCities['SupplierCity']['name'];
            $country_name = $SupplierCities['SupplierCity']['country_name'];


            for ($indexOfFirstLetter = 0; $indexOfFirstLetter <= strlen($city_name); $indexOfFirstLetter++) {
                for ($indexOfLastLetter = $indexOfFirstLetter + 1; $indexOfLastLetter <= strlen($city_name); $indexOfLastLetter++) {
                    $new_arr[] = substr($city_name, $indexOfFirstLetter, 4);

                    if (strlen($new_arr[$indexOfFirstLetter]) == '4') {
                        array_push($condition, array("TravelCity.city_name LIKE '%$new_arr[$indexOfFirstLetter]%'"));
                    }

                    //pr($new_arr);
                    //array_push($search_condition, ARRAY('OR'));
                    //$condition[] = array("TravelCity.city_name LIKE '%$new_arr[$indexOfFirstLetter]%'");
                    //array_push($search_condition,  array("TravelCity.city_name LIKE '%$new_arr[$indexOfFirstLetter]%'"));
                    /*
                      $condition .= "(TravelCity.city_name LIKE '%" . $new_arr[$indexOfFirstLetter] . "%')";
                      if ($indexOfFirstLetter < strlen($city_name) - 1)
                      $condition .= 'OR';
                      $search_condition[] = $condition;
                     * 
                     */
                    $indexOfFirstLetter++;
                }
            }
            //pr($condition);
            //die;
            array_push($search_condition, array('OR' => $condition, 'TravelCity.country_name like' => '%'. $country_name . '%'));
            //pr($search_condition);
            // die;
            /*
              $TravelCities = $this->TravelCity->find
              (
              'all', array
              (

              'conditions' => array
              (
              $condition
              //'TravelCity.city_name like' => '%'.$city_name.'%'
              ),
              'order' => 'TravelCity.id ASC',
              )
              );
             * 
             */
            $this->paginate['order'] = array('TravelCity.city_name' => 'asc');
            $this->set('TravelCities', $this->paginate("TravelCity", $search_condition));
            // $this->set(compact('TravelCities'));
        }

        // pr($condition);
        //$log = $this->TravelCity->getDataSource()->getLog(false, false);       
        //debug($log);
        //die;

        $this->request->data = $SupplierCities;
    }

    public function add_country_mapping() {

        //$mapped = $this->data['mapped'];
        $dummy_status = $this->Auth->user('dummy_status');
        $role_id = $this->Session->read("role_id");
        $user_id = $this->Auth->user('id');

        if ($this->request->is('post') || $this->request->is('put')) {

            if (isset($this->data['mapped'])) {
                $supplier_country_id = $this->data['Common']['supplier_country_id'];
                $country_id = $this->data['Common']['country_id'];
                //die;
                $SupplierCountries = $this->SupplierCountry->findById($supplier_country_id);
                $TravelCountries = $this->TravelCountry->findById($country_id);

                $this->set(compact('SupplierCountries', 'TravelCountries'));
            } elseif (isset($this->data['add'])) {
                $supplier_country_id = $this->data['SupplierCountry']['supplier_country_id'];
                $country_id = $this->data['SupplierCountry']['country_id'];
                //die;
                $SupplierCountries = $this->SupplierCountry->findById($supplier_country_id);
                $TravelCountries = $this->TravelCountry->findById($country_id);

                $next_action_by = '169';  //overseer 136 44 is sarika 152 - ojas
                $flag = 0;
                $search_condition = array();
                $condition = '';
                $success = '';

                $this->request->data['Mappinge']['supplier_code'] = $SupplierCountries['SupplierCountry']['supplier_code'];
                $this->request->data['Mappinge']['mapping_type'] = '1'; // supplier country
                $this->request->data['Mappinge']['country_wtb_code'] = $TravelCountries['TravelCountry']['country_code'];
                $this->request->data['Mappinge']['country_supplier_code'] = $SupplierCountries['SupplierCountry']['code'];

                $this->request->data['TravelCountrySupplier']['country_suppliner_status'] = '1'; // 1 for Submission For Approval [None] of the travel_action_item_types
                $this->request->data['TravelCountrySupplier']['excluded'] = 'FALSE'; // 2 for No of lookup_value_statuses
                $this->request->data['TravelCountrySupplier']['wtb_status'] = '1'; // 1 for True
                $this->request->data['TravelCountrySupplier']['active'] = 'FALSE'; // 2 for No of lookup_value_statuses
                $this->request->data['TravelCountrySupplier']['supplier_id'] = $SupplierCountries['SupplierCountry']['supplier_id'];
                $this->request->data['TravelCountrySupplier']['supplier_code'] = $SupplierCountries['SupplierCountry']['supplier_code'];
                $this->request->data['TravelCountrySupplier']['supplier_country_code'] = $SupplierCountries['SupplierCountry']['code'];
                $this->request->data['TravelCountrySupplier']['pf_country_code'] = $TravelCountries['TravelCountry']['country_code'];
                $this->request->data['TravelCountrySupplier']['country_supplier_id'] = $SupplierCountries['SupplierCountry']['id'];
                //$country_name_arr = $this->TravelCountry->findByCountryCode($this->data['Mapping']['pf_country_code'], array('fields' => 'country_name', 'id', 'continent_id', 'continent_name'));

                $this->request->data['TravelCountrySupplier']['country_name'] = $TravelCountries['TravelCountry']['country_name'];
                $this->request->data['TravelCountrySupplier']['country_id'] = $TravelCountries['TravelCountry']['id'];
                $this->request->data['TravelCountrySupplier']['country_continent_id'] = $TravelCountries['TravelCountry']['continent_id'];
                $this->request->data['TravelCountrySupplier']['country_continent_name'] = $TravelCountries['TravelCountry']['continent_name'];
                $this->request->data['TravelCountrySupplier']['country_mapping_name'] = strtoupper('[SUPP/COUNTRY] | ' . $SupplierCountries['SupplierCountry']['supplier_code'] . ' | ' . $TravelCountries['TravelCountry']['country_code'] . ' - ' . $TravelCountries['TravelCountry']['country_name']);
                $this->request->data['TravelCountrySupplier']['created_by'] = $user_id;

                $tr_remarks['TravelRemark']['remarks_level'] = '2'; // for Mapping Country from travel_action_remark_levels
                $tr_remarks['TravelRemark']['remarks'] = 'New Supplier Country Record Created';


                $tr_action_item['TravelActionItem']['level_id'] = '2'; // for agent travel_action_remark_levels
                $tr_action_item['TravelActionItem']['description'] = 'New Supplier Country Record Created - Submission For Approval';


                $this->TravelCountrySupplier->save($this->request->data['TravelCountrySupplier']);
                $country_supplier_id = $this->TravelCountrySupplier->getLastInsertId();
                if ($country_supplier_id) {

                    $this->request->data['Mappinge']['country_supplier_id'] = $country_supplier_id;
                    $tr_remarks['TravelRemark']['country_supplier_id'] = $country_supplier_id;
                    $tr_action_item['TravelActionItem']['country_supplier_id'] = $country_supplier_id;
                    $flag = 1;


                    $this->request->data['Mappinge']['created_by'] = $user_id;
                    $this->request->data['Mappinge']['status'] = '1'; // 1 for Submission For Approval [None] of the travel_action_item_types
                    $this->request->data['Mappinge']['exclude'] = '2'; // 2 for No of lookup_value_statuses
                    $this->request->data['Mappinge']['dummy_status'] = $dummy_status;
                    $this->Mappinge->save($this->request->data['Mappinge']);

                    $tr_remarks['TravelRemark']['created_by'] = $user_id;
                    $tr_remarks['TravelRemark']['remarks_time'] = date('g:i A');

                    $tr_remarks['TravelRemark']['dummy_status'] = $dummy_status;
                    $this->TravelRemark->save($tr_remarks);

                    /*
                     * ********************** Action *********************
                     */

                    $tr_action_item['TravelActionItem']['type_id'] = '1'; // 1 for Submission For Approval [None] of the travel_action_item_types
                    $tr_action_item['TravelActionItem']['action_item_active'] = 'Yes';
                    $tr_action_item['TravelActionItem']['action_item_source'] = $role_id;
                    $tr_action_item['TravelActionItem']['created_by_id'] = $user_id;
                    $tr_action_item['TravelActionItem']['created_by'] = $user_id;
                    $tr_action_item['TravelActionItem']['dummy_status'] = $dummy_status;
                    $tr_action_item['TravelActionItem']['next_action_by'] = $next_action_by;
                    $tr_action_item['TravelActionItem']['parent_action_item_id'] = '';
                    $this->TravelActionItem->save($tr_action_item);
                    $ActionId = $this->TravelActionItem->getLastInsertId();
                    $ActionUpdateArr['TravelActionItem']['parent_action_item_id'] = "'" . $ActionId . "'";
                    $this->TravelActionItem->updateAll($ActionUpdateArr['TravelActionItem'], array('TravelActionItem.id' => $ActionId));
                    $this->SupplierCountry->updateAll(array('SupplierCountry.status' => "'2'"), array('SupplierCountry.id' => $SupplierCountries['SupplierCountry']['id']));
                    $this->Session->setFlash('Your changes have been submitted. Waiting for approval at the moment...', 'success');
                    $this->redirect(array('action' => 'supplier_country'));
                }
            } elseif (isset($this->data['inserted'])) {


                $screen = '5'; // fetch hotel table of  
                $supplier_country_id = $this->data['Common']['supplier_country_id'];
                $supplier_country_name = $this->data['Common']['supplier_country_name'];
                $supplier_country_code = $this->data['Common']['supplier_country_code'];


                $about = $supplier_country_name . ' | ' . $supplier_country_code . ' | ' . $supplier_country_id;

                $answer = '37'; // table of lookup_questions
                $this->request->data['SupportTicket']['status'] = '1'; // 1 = open
                $this->request->data['SupportTicket']['opend_by'] = 'SENDER';
                $this->request->data['SupportTicket']['active'] = 'TRUE';
                $this->request->data['SupportTicket']['ip_address'] = $_SERVER['REMOTE_ADDR'];
                $this->request->data['SupportTicket']['question_id'] = 'What is the issue?';
                $this->request->data['SupportTicket']['about'] = $about;
                $this->request->data['SupportTicket']['answer'] = $answer;
                $this->request->data['SupportTicket']['urgency'] = '2'; //Moderate
                $this->request->data['SupportTicket']['description'] = 'Request for country creation';

                $department_id = $this->SupportTicket->getDepartmentByQuestionId($answer);
                $this->request->data['SupportTicket']['next_action_by'] = $this->SupportTicket->getNextActionByDepartmentId($department_id);
                $this->request->data['SupportTicket']['department_id'] = $department_id;
                $this->request->data['SupportTicket']['type'] = '1'; // Internal
                $this->request->data['SupportTicket']['created_by'] = $user_id;
                $this->request->data['SupportTicket']['last_action_by'] = $user_id;
                $this->request->data['SupportTicket']['screen'] = $screen;
                $this->request->data['SupportTicket']['response_issue_id'] = $answer;
                if ($this->SupportTicket->save($this->request->data['SupportTicket'])) {
                    $this->SupplierCountry->updateAll(array('SupplierCountry.status' => "'4'"), array('SupplierCountry.id' => $supplier_country_id));
                    $this->Session->setFlash('Your ticket has been successfully created.', 'success');
                    $this->redirect(array('action' => 'supplier_country'));
                }
            }
        }
    }

    public function add_city_mapping() {

        //$mapped = $this->data['mapped'];
        $dummy_status = $this->Auth->user('dummy_status');
        $role_id = $this->Session->read("role_id");
        $user_id = $this->Auth->user('id');

        if ($this->request->is('post') || $this->request->is('put')) {
            //pr($this->data);
            // die;
            if (isset($this->data['mapped'])) {
                $supplier_city_id = $this->data['Common']['supplier_city_id'];
                $city_id = $this->data['Common']['city_id'];
                //die;
                $SupplierCities = $this->SupplierCity->findById($supplier_city_id);
                $TravelCities = $this->TravelCity->findById($city_id);

                $this->set(compact('SupplierCities', 'TravelCities'));
            } elseif (isset($this->data['add'])) {
                $supplier_city_id = $this->data['SupplierCity']['supplier_city_id'];
                $city_id = $this->data['SupplierCity']['city_id'];

                $SupplierCities = $this->SupplierCity->findById($supplier_city_id);
                $TravelCities = $this->TravelCity->findById($city_id);

                $next_action_by = '169';  //overseer 136 44 is sarika 152 - ojas
                $flag = 0;
                $search_condition = array();
                $condition = '';
                $success = '';

                $this->request->data['Mappinge']['supplier_code'] = $SupplierCities['SupplierCity']['supplier_code'];
                $this->request->data['Mappinge']['mapping_type'] = '2'; // supplier country
                $this->request->data['Mappinge']['city_wtb_code'] = $TravelCities['TravelCity']['city_code'];
                $this->request->data['Mappinge']['city_supplier_code'] = $SupplierCities['SupplierCity']['code'];
                $this->request->data['Mappinge']['country_wtb_code'] = $TravelCities['TravelCity']['country_code'];

                $this->request->data['TravelCitySupplier']['city_supplier_status'] = '1'; // 1 for Submission For Approval [None] of the travel_action_item_types
                $this->request->data['TravelCitySupplier']['active'] = 'FALSE'; // 2 for No of lookup_value_statuses
                $this->request->data['TravelCitySupplier']['excluded'] = 'FALSE'; // 2 for No of lookup_value_statuses
                $this->request->data['TravelCitySupplier']['wtb_status'] = '1'; // 1 = true
                $this->request->data['TravelCitySupplier']['supplier_id'] = $SupplierCities['SupplierCity']['supplier_id'];
                $this->request->data['TravelCitySupplier']['supplier_code'] = $SupplierCities['SupplierCity']['supplier_code'];
                $this->request->data['TravelCitySupplier']['supplier_city_code'] = $SupplierCities['SupplierCity']['code'];
                $this->request->data['TravelCitySupplier']['pf_city_code'] = $TravelCities['TravelCity']['city_code'];
                $this->request->data['TravelCitySupplier']['city_country_code'] = $TravelCities['TravelCity']['country_code'];
                $this->request->data['TravelCitySupplier']['province_id'] = $TravelCities['TravelCity']['province_id'];
                $this->request->data['TravelCitySupplier']['province_name'] = $TravelCities['TravelCity']['province_name'];

                $this->request->data['TravelCitySupplier']['city_name'] = $TravelCities['TravelCity']['city_name'];
                $this->request->data['TravelCitySupplier']['city_id'] = $TravelCities['TravelCity']['id'];
                $this->request->data['TravelCitySupplier']['city_mapping_name'] = strtoupper('[SUPP/CITY] | ' . $SupplierCities['SupplierCity']['supplier_code'] . ' | ' . $TravelCities['TravelCity']['country_code'] . ' | ' . $TravelCities['TravelCity']['city_code'] . ' - ' . $TravelCities['TravelCity']['city_name']);
                $this->request->data['TravelCitySupplier']['created_by'] = $user_id;

                $this->request->data['TravelCitySupplier']['city_supplier_id'] = $SupplierCities['SupplierCity']['id'];
                $this->request->data['TravelCitySupplier']['city_country_name'] = $TravelCities['TravelCity']['country_name'];
                $this->request->data['TravelCitySupplier']['city_country_id'] = $TravelCities['TravelCity']['country_id'];
                $this->request->data['TravelCitySupplier']['city_continent_id'] = $TravelCities['TravelCity']['continent_id'];
                $this->request->data['TravelCitySupplier']['city_continent_name'] = $TravelCities['TravelCity']['continent_name'];
                $this->request->data['TravelCitySupplier']['supplier_coutry_code'] = $SupplierCities['SupplierCity']['country_code'];
                $this->request->data['Mappinge']['country_supplier_code'] = $SupplierCities['SupplierCity']['country_code'];

                $tr_remarks['TravelRemark']['remarks_level'] = '3'; // for Mapping City from travel_action_remark_levels
                $tr_remarks['TravelRemark']['remarks'] = 'New Supplier City Record Created';


                $tr_action_item['TravelActionItem']['level_id'] = '3'; // for agent travel_action_remark_levels            
                $tr_action_item['TravelActionItem']['description'] = 'New Supplier City Record Created - Submission For Approval';


                $this->TravelCitySupplier->save($this->request->data['TravelCitySupplier']);
                $city_supplier_id = $this->TravelCitySupplier->getLastInsertId();
                if ($city_supplier_id) {
                    $this->request->data['Mappinge']['city_supplier_id'] = $city_supplier_id;
                    $tr_remarks['TravelRemark']['city_supplier_id'] = $city_supplier_id;
                    $tr_action_item['TravelActionItem']['city_supplier_id'] = $city_supplier_id;
                    $flag = 1;


                    $this->request->data['Mappinge']['created_by'] = $user_id;
                    $this->request->data['Mappinge']['status'] = '1'; // 1 for Submission For Approval [None] of the travel_action_item_types
                    $this->request->data['Mappinge']['exclude'] = '2'; // 2 for No of lookup_value_statuses
                    $this->request->data['Mappinge']['dummy_status'] = $dummy_status;
                    $this->Mappinge->save($this->request->data['Mappinge']);

                    $tr_remarks['TravelRemark']['created_by'] = $user_id;
                    $tr_remarks['TravelRemark']['remarks_time'] = date('g:i A');

                    $tr_remarks['TravelRemark']['dummy_status'] = $dummy_status;
                    $this->TravelRemark->save($tr_remarks);

                    /*
                     * ********************** Action *********************
                     */

                    $tr_action_item['TravelActionItem']['type_id'] = '1'; // 1 for Submission For Approval [None] of the travel_action_item_types
                    $tr_action_item['TravelActionItem']['action_item_active'] = 'Yes';
                    $tr_action_item['TravelActionItem']['action_item_source'] = $role_id;
                    $tr_action_item['TravelActionItem']['created_by_id'] = $user_id;
                    $tr_action_item['TravelActionItem']['created_by'] = $user_id;
                    $tr_action_item['TravelActionItem']['dummy_status'] = $dummy_status;
                    $tr_action_item['TravelActionItem']['next_action_by'] = $next_action_by;
                    $tr_action_item['TravelActionItem']['parent_action_item_id'] = '';
                    $this->TravelActionItem->save($tr_action_item);
                    $ActionId = $this->TravelActionItem->getLastInsertId();
                    $ActionUpdateArr['TravelActionItem']['parent_action_item_id'] = "'" . $ActionId . "'";
                    $this->TravelActionItem->updateAll($ActionUpdateArr['TravelActionItem'], array('TravelActionItem.id' => $ActionId));
                    $this->SupplierCity->updateAll(array('SupplierCity.status' => "'2'"), array('SupplierCity.id' => $SupplierCities['SupplierCity']['id']));
                    $this->Session->setFlash('Your changes have been submitted. Waiting for approval at the moment...', 'success');
                    $this->redirect(array('action' => 'supplier_city'));
                }
            } elseif (isset($this->data['inserted'])) {


                $screen = '6'; // fetch city table of  lookup_screens
                $supplier_city_id = $this->data['Common']['supplier_city_id'];
                $supplier_city_name = $this->data['Common']['supplier_city_name'];
                $supplier_city_code = $this->data['Common']['supplier_city_code'];
                //$supplier_country_code = $this->data['Common']['supplier_country_code'];

                $about = $supplier_city_name . ' | ' . $supplier_city_code . ' | ' . $supplier_city_id;

                $answer = '38'; // table of lookup_questions
                $this->request->data['SupportTicket']['status'] = '1'; // 1 = open
                $this->request->data['SupportTicket']['opend_by'] = 'SENDER';
                $this->request->data['SupportTicket']['active'] = 'TRUE';
                $this->request->data['SupportTicket']['ip_address'] = $_SERVER['REMOTE_ADDR'];
                $this->request->data['SupportTicket']['question_id'] = 'What is the issue?';
                $this->request->data['SupportTicket']['about'] = $about;
                $this->request->data['SupportTicket']['answer'] = $answer;
                $this->request->data['SupportTicket']['urgency'] = '2'; //Moderate
                $this->request->data['SupportTicket']['description'] = 'Request for country creation';

                $department_id = $this->SupportTicket->getDepartmentByQuestionId($answer);
                $this->request->data['SupportTicket']['next_action_by'] = $this->SupportTicket->getNextActionByDepartmentId($department_id);
                $this->request->data['SupportTicket']['department_id'] = $department_id;
                $this->request->data['SupportTicket']['type'] = '1'; // Internal
                $this->request->data['SupportTicket']['created_by'] = $user_id;
                $this->request->data['SupportTicket']['last_action_by'] = $user_id;
                $this->request->data['SupportTicket']['screen'] = $screen;
                $this->request->data['SupportTicket']['response_issue_id'] = $answer;
                if ($this->SupportTicket->save($this->request->data['SupportTicket'])) {
                    $this->SupplierCity->updateAll(array('SupplierCity.status' => "'4'"), array('SupplierCity.id' => $supplier_city_id));
                    $this->Session->setFlash('Your ticket has been successfully created.', 'success');
                    $this->redirect(array('action' => 'supplier_city'));
                }
            }
        }
    }

    public function hotel_mapping($id = null,$country_id = null,$city_id = null) {

        $location_URL = 'http://dev.wtbnetworks.com/TravelXmlManagerv001/ProEngine.Asmx';
        $action_URL = 'http://www.travel.domain/ProcessXML';
        $user_id = $this->Auth->user('id');
        $CreatedDate = date('Y-m-d') . 'T' . date('h:i:s');
        $condition = array();
        $search_condition = array();

        if (!$id) {
            throw new NotFoundException(__('Invalid Hotel'));
        }

        $SupplierHotels = $this->SupplierHotel->findById($id);

        $content_xml_str = '<soap:Body>
        <ProcessXML xmlns="http://www.travel.domain/">
            <RequestInfo>
                <GetDirectSupplierStaticData>
                    <RequestAuditInfo>
                        <RequestType>PXML_DirectSupplier_GetStaticData_Prod</RequestType>
                        <RequestTime>' . $CreatedDate . '</RequestTime>
                        <RequestResource>Silkrouters</RequestResource>
                    </RequestAuditInfo>
                    <RequestParameters>
                        <SupplierDataType>HotelDetail</SupplierDataType>
                        <SupplierId>' . $SupplierHotels['SupplierHotel']['supplier_id'] . '</SupplierId>
                        <CountryCode></CountryCode>
                        <CityCode></CityCode>
                        <HotelCode>' . $SupplierHotels['SupplierHotel']['hotel_code'] . '</HotelCode>
                    </RequestParameters>
                </GetDirectSupplierStaticData>
            </RequestInfo>
        </ProcessXML>
    </soap:Body>';

        $log_call_screen = 'Supplier - Add';

        $xml_string = Configure::read('travel_start_xml_str') . $content_xml_str . Configure::read('travel_end_xml_str');
        $client = new SoapClient(null, array(
            'location' => $location_URL,
            'uri' => '',
            'trace' => 1,
        ));

        try {
            $order_return = $client->__doRequest($xml_string, $location_URL, $action_URL, 1);
            $xmlArray = Xml::toArray(Xml::build($order_return));

            $address = $xmlArray['Envelope']['soap:Body']['ProcessXMLResponse']['ProcessXMLResult']['SupplierData_HotelDetail']['ResponseAuditInfo']['root']['Address']['@'];
        } catch (SoapFault $exception) {
            var_dump(get_class($exception));
            var_dump($exception);
        }

        $this->SupplierHotel->updateAll(array('SupplierHotel.address' => "'" . $address . "'"), array('SupplierHotel.id' => $id));


        if (count($SupplierHotels)) {

            $hotel_name = $SupplierHotels['SupplierHotel']['hotel_name'];
            $country_name = $SupplierHotels['SupplierHotel']['country_name'];
            $city_name = $SupplierHotels['SupplierHotel']['city_name'];


            for ($indexOfFirstLetter = 0; $indexOfFirstLetter <= strlen($hotel_name); $indexOfFirstLetter++) {
                for ($indexOfLastLetter = $indexOfFirstLetter + 1; $indexOfLastLetter <= strlen($hotel_name); $indexOfLastLetter++) {
                    $new_arr[] = substr($hotel_name, $indexOfFirstLetter, 4);
                  
                    if (strlen($new_arr[$indexOfFirstLetter]) == '4') {
                        array_push($condition, array("TravelHotelLookup.hotel_name LIKE '%$new_arr[$indexOfFirstLetter]%'"));
                    }
                  
                    $indexOfFirstLetter++;
                }
            }
           
            array_push($search_condition, array('OR' => $condition, 'TravelHotelLookup.country_id' => $country_id, 'TravelHotelLookup.city_id' => $city_id));
           
            $this->paginate['order'] = array('TravelHotelLookup.hotel_name' => 'asc');
            $this->set('TravelHotelLookups', $this->paginate("TravelHotelLookup", $search_condition));
           
        }
        $this->set(compact('address'));


        $this->request->data = $SupplierHotels;
    }

    public function add_hotel_mapping() {

        //$mapped = $this->data['mapped'];
        $dummy_status = $this->Auth->user('dummy_status');
        $role_id = $this->Session->read("role_id");
        $location_URL = 'http://dev.wtbnetworks.com/TravelXmlManagerv001/ProEngine.Asmx';
        $action_URL = 'http://www.travel.domain/ProcessXML';
        $user_id = $this->Auth->user('id');
        $CreatedDate = date('Y-m-d') . 'T' . date('h:i:s');
        $address = '';
        $TravelHotelLookups = array();
        $SupplierHotels = array();
        $submit = '';


        if ($this->request->is('post') || $this->request->is('put')) {

            if (isset($this->data['mapped'])) {
                $supplier_hotel_id = $this->data['Common']['supplier_hotel_id'];
                $hotel_id = $this->data['Common']['hotel_id'];
                $submit = 'TRUE';
                $SupplierHotels = $this->SupplierHotel->findById($supplier_hotel_id);
                $TravelHotelLookups = $this->TravelHotelLookup->findById($hotel_id);


                $this->set(compact('TravelHotelLookups', 'SupplierHotels', 'submit'));
            } elseif (isset($this->data['add'])) {
                $supplier_hotel_id = $this->data['SupplierHotel']['supplier_hotel_id'];
                $hotel_id = $this->data['SupplierHotel']['hotel_id'];

                $SupplierHotels = $this->SupplierHotel->findById($supplier_hotel_id);
                $TravelHotelLookups = $this->TravelHotelLookup->findById($hotel_id);

                //$next_action_by = '169';  //overseer 136 44 is sarika 152 - ojas
                $flag = 0;
                $search_condition = array();
                $condition = '';
                $success = '';

                $this->request->data['Mappinge']['supplier_code'] = $SupplierHotels['SupplierHotel']['supplier_code'];
                $this->request->data['Mappinge']['mapping_type'] = '3'; // supplier hotel
                $this->request->data['Mappinge']['hotel_wtb_code'] = $TravelHotelLookups['TravelHotelLookup']['hotel_code'];
                $this->request->data['Mappinge']['hotel_supplier_code'] = $SupplierHotels['SupplierHotel']['hotel_code'];
                $this->request->data['Mappinge']['city_wtb_code'] = $TravelHotelLookups['TravelHotelLookup']['city_code'];
                $this->request->data['Mappinge']['country_wtb_code'] = $TravelHotelLookups['TravelHotelLookup']['country_code'];

                $this->request->data['TravelHotelRoomSupplier']['hotel_supplier_status'] = '1'; // 1 for Submission For Approval [None] of the travel_action_item_types
                $this->request->data['TravelHotelRoomSupplier']['active'] = 'FALSE'; // 2 for No of lookup_value_statuses
                $this->request->data['TravelHotelRoomSupplier']['excluded'] = 'FALSE'; // 2 for No of lookup_value_statuses
                $this->request->data['TravelHotelRoomSupplier']['wtb_status'] = '1'; // 1 = true
                $this->request->data['TravelHotelRoomSupplier']['hotel_code'] = $TravelHotelLookups['TravelHotelLookup']['hotel_code'];
                $this->request->data['TravelHotelRoomSupplier']['supplier_code'] = $SupplierHotels['SupplierHotel']['supplier_code'];
                $this->request->data['TravelHotelRoomSupplier']['supplier_id'] = $SupplierHotels['SupplierHotel']['supplier_id'];
                //$hotel_name_arr = $this->TravelHotelLookup->findByHotelCode($this->data['Mapping']['hotel_code'], array('fields' => 'hotel_name', 'id'));
                $this->request->data['TravelHotelRoomSupplier']['hotel_mapping_name'] = strtoupper('[SUPP/HOTEL] | ' . $SupplierHotels['SupplierHotel']['supplier_code'] . ' | ' . $TravelHotelLookups['TravelHotelLookup']['country_code'] . ' | ' . $TravelHotelLookups['TravelHotelLookup']['city_code'] . ' | ' . $TravelHotelLookups['TravelHotelLookup']['hotel_code'] . ' - ' . $TravelHotelLookups['TravelHotelLookup']['hotel_name']);
                $this->request->data['TravelHotelRoomSupplier']['hotel_name'] = $TravelHotelLookups['TravelHotelLookup']['hotel_name'];
                $this->request->data['TravelHotelRoomSupplier']['hotel_id'] = $TravelHotelLookups['TravelHotelLookup']['id'];
                $this->request->data['TravelHotelRoomSupplier']['hotel_country_code'] = $TravelHotelLookups['TravelHotelLookup']['country_code'];
                $this->request->data['TravelHotelRoomSupplier']['supplier_item_code1'] = $SupplierHotels['SupplierHotel']['hotel_code'];
                $this->request->data['TravelHotelRoomSupplier']['hotel_country_code'] = $TravelHotelLookups['TravelHotelLookup']['country_code'];
                $this->request->data['TravelHotelRoomSupplier']['hotel_city_code'] = $TravelHotelLookups['TravelHotelLookup']['city_code'];
                //$TravelAreas = $this->TravelArea->find('first', array('fields' => array('area_name'), 'conditions' => array('id' => $this->data['Mapping']['hotel_area_id'])));
                $this->request->data['TravelHotelRoomSupplier']['hotel_area_id'] = $TravelHotelLookups['TravelHotelLookup']['area_id'];
                $this->request->data['TravelHotelRoomSupplier']['hotel_area_name'] = $TravelHotelLookups['TravelHotelLookup']['area_name'];
                //$TravelBrands = $this->TravelBrand->find('first', array('fields' => array('TravelBrand.brand_name'), 'conditions' => array('TravelBrand.id' => $this->data['Mapping']['hotel_brand_id'])));
                $this->request->data['TravelHotelRoomSupplier']['hotel_brand_id'] = $TravelHotelLookups['TravelHotelLookup']['brand_id'];
                $this->request->data['TravelHotelRoomSupplier']['hotel_brand_name'] = $TravelHotelLookups['TravelHotelLookup']['brand_name'];
                //$TravelSuburbs = $this->TravelSuburb->find('first', array('fields' => array('TravelSuburb.name'), 'conditions' => array('TravelSuburb.id' => $this->data['Mapping']['hotel_suburb_id'])));
                $this->request->data['TravelHotelRoomSupplier']['hotel_suburb_id'] = $TravelHotelLookups['TravelHotelLookup']['suburb_id'];
                $this->request->data['TravelHotelRoomSupplier']['hotel_suburb_name'] = $TravelHotelLookups['TravelHotelLookup']['suburb_name'];
                //$TravelChains = $this->TravelChain->find('first', array('fields' => array('TravelChain.chain_name'), 'conditions' => array('TravelChain.id' => $this->data['Mapping']['hotel_chain_id'])));        
                $this->request->data['TravelHotelRoomSupplier']['hotel_chain_id'] = $TravelHotelLookups['TravelHotelLookup']['chain_id'];
                $this->request->data['TravelHotelRoomSupplier']['hotel_chain_name'] = $TravelHotelLookups['TravelHotelLookup']['chain_name'];
                $this->request->data['TravelHotelRoomSupplier']['created_by'] = $user_id;
                $this->request->data['TravelHotelRoomSupplier']['province_id'] = $TravelHotelLookups['TravelHotelLookup']['province_id'];
                $this->request->data['TravelHotelRoomSupplier']['province_name'] = $TravelHotelLookups['TravelHotelLookup']['province_name'];

                //$supp_country_code = $this->TravelCountrySupplier->find('first', array('fields' => array('supplier_country_code', 'country_id', 'country_name', 'country_continent_id', 'country_continent_name'), 'conditions' => array('supplier_code' => $this->data['Mapping']['hotel_supplier_code'], 'pf_country_code' => $this->data['Mapping']['hotel_country_code'])));
                //$supp_country_code = $this->TravelCountrySupplier->find('first', array('fields' => array('supplier_country_code'), 'conditions' => array('supplier_code' => $this->data['Mapping']['hotel_supplier_code'], 'pf_country_code' => $this->data['Mapping']['hotel_country_code'])));
                $this->request->data['TravelHotelRoomSupplier']['supplier_item_code4'] = $SupplierHotels['SupplierHotel']['country_code'];
                $this->request->data['Mappinge']['country_supplier_code'] = $SupplierHotels['SupplierHotel']['country_code'];
                $this->request->data['TravelHotelRoomSupplier']['hotel_country_id'] = $TravelHotelLookups['TravelHotelLookup']['country_id'];
                $this->request->data['TravelHotelRoomSupplier']['hotel_country_name'] = $TravelHotelLookups['TravelHotelLookup']['country_name'];
                $this->request->data['TravelHotelRoomSupplier']['hotel_continent_id'] = $TravelHotelLookups['TravelHotelLookup']['continent_id'];
                $this->request->data['TravelHotelRoomSupplier']['hotel_continent_name'] = $TravelHotelLookups['TravelHotelLookup']['continent_name'];
                $this->request->data['TravelHotelRoomSupplier']['hotel_supplier_id'] = $SupplierHotels['SupplierHotel']['id'];

                //$supp_city_code = $this->TravelCitySupplier->find('first', array('fields' => array('supplier_city_code', 'city_id', 'city_name'), 'conditions' => array('supplier_code' => $this->data['Mapping']['hotel_supplier_code'], 'pf_city_code' => $this->data['Mapping']['hotel_city_code'], 'city_country_code' => $this->data['Mapping']['hotel_country_code'])));
                $this->request->data['TravelHotelRoomSupplier']['supplier_item_code3'] = $SupplierHotels['SupplierHotel']['city_code'];
                $this->request->data['TravelHotelRoomSupplier']['hotel_city_id'] = $TravelHotelLookups['TravelHotelLookup']['city_id'];
                $this->request->data['TravelHotelRoomSupplier']['hotel_city_name'] = $TravelHotelLookups['TravelHotelLookup']['city_name'];
                $this->request->data['Mappinge']['city_supplier_code'] = $SupplierHotels['SupplierHotel']['city_code'];

                $tr_remarks['TravelRemark']['remarks_level'] = '4'; // for Mapping City from travel_action_remark_levels
                $tr_remarks['TravelRemark']['remarks'] = 'New Supplier Hotel Record Created';

                $tr_action_item['TravelActionItem']['level_id'] = '4'; // for agent travel_action_remark_levels                 
                $tr_action_item['TravelActionItem']['description'] = 'New Supplier Hotel Record Created - Submission For Approval';

        
            $continent_id = $TravelHotelLookups['TravelHotelLookup']['continent_id'];
            $country_id = $TravelHotelLookups['TravelHotelLookup']['country_id'];
            $province_id = $TravelHotelLookups['TravelHotelLookup']['province_id'];  
         

            $permissionArray = $this->ProvincePermission->find('first', array('conditions' => array('continent_id' => $continent_id, 'country_id' => $country_id, 'province_id' => $province_id, 'user_id' => $user_id)));
            if (isset($permissionArray['ProvincePermission']['maaping_approval_id']))
            $next_action_by = $permissionArray['ProvincePermission']['maaping_approval_id'];
            else
            $next_action_by = '169';
                    
                $this->TravelHotelRoomSupplier->save($this->request->data['TravelHotelRoomSupplier']);
                //$this->TravelHotelLookup->updateAll(array('TravelHotelLookup.active' => "'FALSE'"), array('TravelHotelLookup.id' => $hotel_name_arr['TravelHotelLookup']['id']));
                $hotel_supplier_id = $this->TravelHotelRoomSupplier->getLastInsertId();
                if ($hotel_supplier_id) {
                    $this->request->data['Mappinge']['hotel_supplier_id'] = $hotel_supplier_id;
                    $tr_remarks['TravelRemark']['hotel_supplier_id'] = $hotel_supplier_id;
                    $tr_action_item['TravelActionItem']['hotel_supplier_id'] = $hotel_supplier_id;
                    $flag = 1;
                }

                $this->request->data['Mappinge']['created_by'] = $user_id;
                $this->request->data['Mappinge']['status'] = '1'; // 1 for Submission For Approval [None] of the travel_action_item_types
                $this->request->data['Mappinge']['exclude'] = '2'; // 2 for No of lookup_value_statuses
                $this->request->data['Mappinge']['dummy_status'] = $dummy_status;
                $this->Mappinge->save($this->request->data['Mappinge']);

                $tr_remarks['TravelRemark']['created_by'] = $user_id;
                $tr_remarks['TravelRemark']['remarks_time'] = date('g:i A');

                $tr_remarks['TravelRemark']['dummy_status'] = $dummy_status;
                $this->TravelRemark->save($tr_remarks);

                /*
                 * ********************** Action *********************
                 */

                $tr_action_item['TravelActionItem']['type_id'] = '1'; // 1 for Submission For Approval [None] of the travel_action_item_types
                $tr_action_item['TravelActionItem']['action_item_active'] = 'Yes';
                $tr_action_item['TravelActionItem']['action_item_source'] = $role_id;
                $tr_action_item['TravelActionItem']['created_by_id'] = $user_id;
                $tr_action_item['TravelActionItem']['created_by'] = $user_id;
                $tr_action_item['TravelActionItem']['dummy_status'] = $dummy_status;
                $tr_action_item['TravelActionItem']['next_action_by'] = $next_action_by;
                $tr_action_item['TravelActionItem']['parent_action_item_id'] = '';
                $this->TravelActionItem->save($tr_action_item);
                $ActionId = $this->TravelActionItem->getLastInsertId();
                $ActionUpdateArr['TravelActionItem']['parent_action_item_id'] = "'" . $ActionId . "'";
                $this->TravelActionItem->updateAll($ActionUpdateArr['TravelActionItem'], array('TravelActionItem.id' => $ActionId));
                $this->SupplierHotel->updateAll(array('SupplierHotel.status' => "'2'"), array('SupplierHotel.id' => $SupplierHotels['SupplierHotel']['id']));
                $this->Session->setFlash('Your changes have been submitted. Waiting for approval at the moment...', 'success');
                $this->redirect(array('action' => 'supplier_hotels'));
            } elseif (isset($this->data['inserted'])) {

               
                $screen = '4'; // fetch hotel table of  
                $supplier_hotel_id = $this->data['Common']['supplier_hotel_id'];
                $hotel_id = $this->data['Common']['hotel_id'];

                $hotel_code = $this->Common->getSupplierHotelCode($supplier_hotel_id);
                $hotel_name = $this->Common->getSupplierHotelName($supplier_hotel_id);
                $about = $hotel_name . ' | Code: ' . $hotel_code . ' | Hotel Id: ' . $supplier_hotel_id;
           
                $answer = '36'; // table of lookup_questions
                $this->request->data['SupportTicket']['status'] = '1'; // 1 = open
                $this->request->data['SupportTicket']['opend_by'] = 'SENDER';
                $this->request->data['SupportTicket']['active'] = 'TRUE';
                $this->request->data['SupportTicket']['ip_address'] = $_SERVER['REMOTE_ADDR'];
                $this->request->data['SupportTicket']['question_id'] = 'What is the issue?';
                $this->request->data['SupportTicket']['about'] = $about;
                $this->request->data['SupportTicket']['answer'] = $answer;
                $this->request->data['SupportTicket']['urgency'] = '2'; //Moderate
                $this->request->data['SupportTicket']['description'] = 'Request for hotel creation';

                $department_id = $this->SupportTicket->getDepartmentByQuestionId($answer);
                $this->request->data['SupportTicket']['next_action_by'] = $this->SupportTicket->getNextActionByDepartmentId($department_id);
                $this->request->data['SupportTicket']['department_id'] = $department_id;
                $this->request->data['SupportTicket']['type'] = '1'; // Internal
                $this->request->data['SupportTicket']['created_by'] = $user_id;
                $this->request->data['SupportTicket']['last_action_by'] = $user_id;
                $this->request->data['SupportTicket']['screen'] = $screen;
                $this->request->data['SupportTicket']['response_issue_id'] = $answer;
                if ($this->SupportTicket->save($this->request->data['SupportTicket'])) {
                    $this->SupplierHotel->updateAll(array('SupplierHotel.status' => "'4'"), array('SupplierHotel.id' => $supplier_hotel_id));
                    $this->Session->setFlash('Your ticket has been successfully created.', 'success');
                    $this->redirect(array('action' => 'supplier_hotels'));
                }
            } elseif (isset($this->data['review'])) {
                $supplier_hotel_id = $this->data['Common']['supplier_hotel_id'];
                $hotel_id = $this->data['Common']['hotel_id'];
                $submit = 'FALSE';
                $SupplierHotels = $this->SupplierHotel->findById($supplier_hotel_id);

                $TravelHotelLookups = $this->TravelHotelLookup->findById($hotel_id);

                $this->set(compact('SupplierHotels', 'TravelHotelLookups', 'submit'));
            } elseif (isset($this->data['review_add'])) {

                //pr($this->data);
                //die;
                $screen = '4'; // fetch hotel table of  
                $supplier_hotel_id = $this->data['SupplierHotel']['supplier_hotel_id'];
                //$hotel_id = $this->data['Common']['hotel_id'];

                $hotel_code = $this->Common->getSupplierHotelCode($supplier_hotel_id);
                $hotel_name = $this->Common->getSupplierHotelName($supplier_hotel_id);
                $about = $hotel_name . ' | ' . $hotel_code . ' | ' . $supplier_hotel_id;

                $answer = '36'; // table of lookup_questions
                $this->request->data['SupportTicket']['status'] = '1'; // 1 = open
                $this->request->data['SupportTicket']['opend_by'] = 'SENDER';
                $this->request->data['SupportTicket']['active'] = 'TRUE';
                $this->request->data['SupportTicket']['ip_address'] = $_SERVER['REMOTE_ADDR'];
                $this->request->data['SupportTicket']['question_id'] = 'What is the issue?';
                $this->request->data['SupportTicket']['about'] = $about;
                $this->request->data['SupportTicket']['answer'] = $answer;
                $this->request->data['SupportTicket']['urgency'] = '2'; //Moderate
                $this->request->data['SupportTicket']['description'] = $this->data['SupplierHotel']['comment'];

                $department_id = $this->SupportTicket->getDepartmentByQuestionId($answer);
                $this->request->data['SupportTicket']['next_action_by'] = $this->SupportTicket->getNextActionByDepartmentId($department_id);
                $this->request->data['SupportTicket']['department_id'] = $department_id;
                $this->request->data['SupportTicket']['type'] = '1'; // Internal
                $this->request->data['SupportTicket']['created_by'] = $user_id;
                $this->request->data['SupportTicket']['last_action_by'] = $user_id;
                $this->request->data['SupportTicket']['screen'] = $screen;
                $this->request->data['SupportTicket']['response_issue_id'] = $answer;
                if ($this->SupportTicket->save($this->request->data['SupportTicket'])) {
                    $this->SupplierHotel->updateAll(array('SupplierHotel.status' => "'6'"), array('SupplierHotel.id' => $supplier_hotel_id));
                    $this->Session->setFlash('Your ticket has been successfully created.', 'success');
                    $this->redirect(array('action' => 'supplier_hotels'));
                }
            }
        }
    }

    public function hotel_review($supplier_hotel_id = null) {

        $screen = '4'; // fetch hotel table of  
        $supplier_hotel_id = $this->data['Common']['supplier_hotel_id'];
        //$hotel_id = $this->data['Common']['hotel_id'];

        $hotel_code = $this->Common->getSupplierHotelCode($supplier_hotel_id);
        $hotel_name = $this->Common->getSupplierHotelName($supplier_hotel_id);
        $about = $hotel_name . ' | ' . $hotel_code . ' | ' . $supplier_hotel_id;

        $answer = '36'; // table of lookup_questions
        $this->request->data['SupportTicket']['status'] = '1'; // 1 = open
        $this->request->data['SupportTicket']['opend_by'] = 'SENDER';
        $this->request->data['SupportTicket']['active'] = 'TRUE';
        $this->request->data['SupportTicket']['ip_address'] = $_SERVER['REMOTE_ADDR'];
        $this->request->data['SupportTicket']['question_id'] = 'What is the issue?';
        $this->request->data['SupportTicket']['about'] = $about;
        $this->request->data['SupportTicket']['answer'] = $answer;
        $this->request->data['SupportTicket']['urgency'] = '2'; //Moderate
        $this->request->data['SupportTicket']['description'] = 'Request for hotel creation';

        $department_id = $this->SupportTicket->getDepartmentByQuestionId($answer);
        $this->request->data['SupportTicket']['next_action_by'] = $this->SupportTicket->getNextActionByDepartmentId($department_id);
        $this->request->data['SupportTicket']['department_id'] = $department_id;
        $this->request->data['SupportTicket']['type'] = '1'; // Internal
        $this->request->data['SupportTicket']['created_by'] = $user_id;
        $this->request->data['SupportTicket']['last_action_by'] = $user_id;
        $this->request->data['SupportTicket']['screen'] = $screen;
        $this->request->data['SupportTicket']['response_issue_id'] = $answer;
        if ($this->SupportTicket->save($this->request->data['SupportTicket'])) {
            $this->SupplierHotel->updateAll(array('SupplierHotel.status' => "'6'"), array('SupplierHotel.id' => $supplier_hotel_id));
            $this->Session->setFlash('Your ticket has been successfully created.', 'success');
            $this->redirect(array('action' => 'supplier_hotels'));
        }
    }

    public function hotel_add($supplier_hotel_id = null) {

        $SupplierHotels = $this->SupplierHotel->findById($supplier_hotel_id);


        $location_URL = 'http://dev.wtbnetworks.com/TravelXmlManagerv001/ProEngine.Asmx';
        $action_URL = 'http://www.travel.domain/ProcessXML';
        $user_id = $this->Auth->user('id');
        $CreatedDate = date('Y-m-d') . 'T' . date('h:i:s');
        $hotel_name = '';
        $star = '';
        $gps_prm_1 = '';
        $gps_prm_2 = '';
        $reservation_contact = '';
        $address = '';
        $location = '';
        $fax = '';
        $hotel_comment = '';
        $url_hotel = '';
        $reservation_email = '';
        $TravelCountries = array();
        $TravelCities = array();
        $TravelSuburbs = array();
        $TravelAreas = array();
        $TravelBrands = array();
        $Provinces = array();
        $user_id = $this->Auth->user('id');
        $role_id = $this->Session->read("role_id");
        $dummy_status = $this->Auth->user('dummy_status');
        $actio_itme_id = '';
        $flag = 0;

        /*
          $continent_id = $TravelHotelLookups['TravelHotelLookup']['continent_id'];
          $country_id = $TravelHotelLookups['TravelHotelLookup']['country_id'];
          $province_id = $TravelHotelLookups['TravelHotelLookup']['province_id'];
         * 
         */

        //$permissionArray = $this->ProvincePermission->find('first', array('conditions' => array('continent_id' => $continent_id, 'country_id' => $country_id, 'province_id' => $province_id, 'user_id' => $user_id)));
        //if (isset($permissionArray['ProvincePermission']['approval_id']))
        //$next_action_by = $permissionArray['ProvincePermission']['approval_id'];
        //else
        $next_action_by = '169';


        if ($this->request->is('post') || $this->request->is('put')) {


            //$continent_id = $this->data->request['TravelHotelLookup']['continent_id'];
            //$continent_id = $this->data->request['TravelHotelLookup']['continent_id'];
            //overseer 136 44 is sarika 152 - ojas



            $image1 = '';
            $image2 = '';
            $image3 = '';
            $image4 = '';


            if (is_uploaded_file($this->request->data['TravelHotelLookup']['image1']['tmp_name'])) {
                $image1 = $this->Image->upload($TravelHotelLookups['TravelHotelLookup']['hotel_img1'], $this->request->data['TravelHotelLookup']['image1'], $this->uploadDir, 'image1');
                $this->request->data['TravelHotelLookup']['hotel_img1'] = $image1;
            } else {
                unset($this->request->data['TravelHotelLookup']['image1']);
            }

            if (is_uploaded_file($this->request->data['TravelHotelLookup']['image2']['tmp_name'])) {
                $image2 = $this->Image->upload($TravelHotelLookups['TravelHotelLookup']['hotel_img2'], $this->request->data['TravelHotelLookup']['image2'], $this->uploadDir, 'image2');
                $this->request->data['TravelHotelLookup']['hotel_img2'] = $image2;
            } else {
                unset($this->request->data['TravelHotelLookup']['image2']);
            }

            if (is_uploaded_file($this->request->data['TravelHotelLookup']['image3']['tmp_name'])) {
                $image2 = $this->Image->upload($TravelHotelLookups['TravelHotelLookup']['hotel_img3'], $this->request->data['TravelHotelLookup']['image3'], $this->uploadDir, 'image3');
                $this->request->data['TravelHotelLookup']['hotel_img3'] = $image2;
            } else {
                unset($this->request->data['TravelHotelLookup']['image3']);
            }

            if (is_uploaded_file($this->request->data['TravelHotelLookup']['image4']['tmp_name'])) {
                $image2 = $this->Image->upload($TravelHotelLookups['TravelHotelLookup']['hotel_img4'], $this->request->data['TravelHotelLookup']['image4'], $this->uploadDir, 'image4');
                $this->request->data['TravelHotelLookup']['hotel_img4'] = $image2;
            } else {
                unset($this->request->data['TravelHotelLookup']['image4']);
            }

            if (is_uploaded_file($this->request->data['TravelHotelLookup']['image5']['tmp_name'])) {
                $image2 = $this->Image->upload($TravelHotelLookups['TravelHotelLookup']['hotel_img5'], $this->request->data['TravelHotelLookup']['image5'], $this->uploadDir, 'image5');
                $this->request->data['TravelHotelLookup']['hotel_img5'] = $image2;
            } else {
                unset($this->request->data['TravelHotelLookup']['image5']);
            }

            if (is_uploaded_file($this->request->data['TravelHotelLookup']['image6']['tmp_name'])) {
                $image2 = $this->Image->upload($TravelHotelLookups['TravelHotelLookup']['hotel_img6'], $this->request->data['TravelHotelLookup']['image6'], $this->uploadDir, 'image6');
                $this->request->data['TravelHotelLookup']['hotel_img6'] = $image2;
            } else {
                unset($this->request->data['TravelHotelLookup']['image6']);
            }

            if (is_uploaded_file($this->request->data['TravelHotelLookup']['logo_image1']['tmp_name'])) {
                $image3 = $this->Image->upload($TravelHotelLookups['TravelHotelLookup']['logo'], $this->request->data['TravelHotelLookup']['logo_image2'], $this->uploadDir . '/logo', 'logo');
                $this->request->data['TravelHotelLookup']['logo'] = $image3;
            } else {
                unset($this->request->data['TravelHotelLookup']['image3']);
            }

            if (is_uploaded_file($this->request->data['TravelHotelLookup']['logo_image2']['tmp_name'])) {
                $image4 = $this->Image->upload($TravelHotelLookups['TravelHotelLookup']['logo1'], $this->request->data['TravelHotelLookup']['logo_image2'], $this->uploadDir . '/logo', 'logo1');
                $this->request->data['TravelHotelLookup']['logo1'] = $image4;
            } else {
                unset($this->request->data['TravelHotelLookup']['image4']);
            }


            $this->request->data['TravelHotelLookup']['active'] = 'FALSE';
            $this->request->data['TravelHotelLookup']['created_by'] = $user_id;
            $this->request->data['TravelHotelLookup']['status'] = '4';

            /*             * ************************TravelHotelLookup Action ********************** */
            $travel_action_item['TravelActionItem']['hotel_id'] = $id;
            $travel_action_item['TravelActionItem']['level_id'] = '7';  // for hotel travel_action_remark_levels 
            $travel_action_item['TravelActionItem']['type_id'] = '4'; // for Change Submitted of travel_action_item_types
            $travel_action_item['TravelActionItem']['next_action_by'] = $next_action_by;
            $travel_action_item['TravelActionItem']['action_item_active'] = 'Yes';
            $travel_action_item['TravelActionItem']['description'] = 'Hotel Record Updated - Re-Submission For Approval';
            $travel_action_item['TravelActionItem']['action_item_source'] = $role_id;
            $travel_action_item['TravelActionItem']['created_by_id'] = $user_id;
            $travel_action_item['TravelActionItem']['created_by'] = $user_id;
            $travel_action_item['TravelActionItem']['dummy_status'] = $dummy_status;
            $travel_action_item['TravelActionItem']['parent_action_item_id'] = $actio_itme_id;


            /*             * ********************TravelHotelLookup Remarks ******************************** */
            $travel_remarks['TravelRemark']['hotel_id'] = $id;
            $travel_remarks['TravelRemark']['remarks'] = 'Edit Hotel Record';
            $travel_remarks['TravelRemark']['created_by'] = $user_id;
            $travel_remarks['TravelRemark']['remarks_time'] = date('g:i A');
            $travel_remarks['TravelRemark']['remarks_level'] = '7';  // for hotel country travel_action_remark_levels 
            $travel_remarks['TravelRemark']['dummy_status'] = $dummy_status;


            //$this->TravelHotelLookup->id = $id;
            if ($this->TravelHotelLookup->save($this->request->data['TravelHotelLookup'])) {
                $this->SupplierHotel->updateAll(array('SupplierHotel.status' => "'5'"), array('SupplierHotel.id' => $supplier_hotel_id));
                $this->TravelActionItem->save($travel_action_item);
                $ActionId = $this->TravelActionItem->getLastInsertId();
                $this->TravelActionItem->id = $ActionId;
                $this->TravelActionItem->saveField('parent_action_item_id', $ActionId);
                $this->TravelRemark->save($travel_remarks);

                if ($actio_itme_id) {
                    $this->TravelActionItem->saveField('parent_action_item_id', $actio_itme_id);
                    $this->TravelActionItem->updateAll(array('TravelActionItem.action_item_active' => "'No'"), array('TravelActionItem.id' => $actio_itme_id));
                }
                $this->Session->setFlash('Your changes have been submitted. Waiting for approval at the moment...', 'success');
            }

            if ($flag == 1)
                $this->redirect(array('controller' => 'travel_action_items', 'action' => 'index'));
            else
                $this->redirect(array('controller' => 'travel_hotel_lookups', 'action' => 'index'));
            // $this->redirect(array('controller' => 'messages','action' => 'index','properties','my-properties'));
        }

        $content_xml_str = '<soap:Body>
        <ProcessXML xmlns="http://www.travel.domain/">
            <RequestInfo>
                <GetDirectSupplierStaticData>
                    <RequestAuditInfo>
                        <RequestType>PXML_DirectSupplier_GetStaticData_Prod</RequestType>
                        <RequestTime>' . $CreatedDate . '</RequestTime>
                        <RequestResource>Silkrouters</RequestResource>
                    </RequestAuditInfo>
                    <RequestParameters>
                        <SupplierDataType>HotelDetail</SupplierDataType>
                        <SupplierId>' . $SupplierHotels['SupplierHotel']['supplier_id'] . '</SupplierId>
                        <CountryCode></CountryCode>
                        <CityCode></CityCode>
                        <HotelCode>' . $SupplierHotels['SupplierHotel']['hotel_code'] . '</HotelCode>
                    </RequestParameters>
                </GetDirectSupplierStaticData>
            </RequestInfo>
        </ProcessXML>
    </soap:Body>';

        $log_call_screen = 'Supplier - Add';

        $xml_string = Configure::read('travel_start_xml_str') . $content_xml_str . Configure::read('travel_end_xml_str');
        $client = new SoapClient(null, array(
            'location' => $location_URL,
            'uri' => '',
            'trace' => 1,
        ));

        try {
            $order_return = $client->__doRequest($xml_string, $location_URL, $action_URL, 1);
            $xmlArray = Xml::toArray(Xml::build($order_return));
            //pr($xmlArray);
            //die;
            $hotel_name = $xmlArray['Envelope']['soap:Body']['ProcessXMLResponse']['ProcessXMLResult']['SupplierData_HotelDetail']['ResponseAuditInfo']['root']['Name']['@'];
            $star = $xmlArray['Envelope']['soap:Body']['ProcessXMLResponse']['ProcessXMLResult']['SupplierData_HotelDetail']['ResponseAuditInfo']['root']['Rating']['@'];
            $gps_prm_1 = $xmlArray['Envelope']['soap:Body']['ProcessXMLResponse']['ProcessXMLResult']['SupplierData_HotelDetail']['ResponseAuditInfo']['root']['Latitude']['@'];
            $gps_prm_2 = $xmlArray['Envelope']['soap:Body']['ProcessXMLResponse']['ProcessXMLResult']['SupplierData_HotelDetail']['ResponseAuditInfo']['root']['Longitude']['@'];
            $reservation_contact = $xmlArray['Envelope']['soap:Body']['ProcessXMLResponse']['ProcessXMLResult']['SupplierData_HotelDetail']['ResponseAuditInfo']['root']['Phone']['@'];
            $address = $xmlArray['Envelope']['soap:Body']['ProcessXMLResponse']['ProcessXMLResult']['SupplierData_HotelDetail']['ResponseAuditInfo']['root']['Address']['@'];
            $location = $xmlArray['Envelope']['soap:Body']['ProcessXMLResponse']['ProcessXMLResult']['SupplierData_HotelDetail']['ResponseAuditInfo']['root']['Address']['@'];
            $fax = $xmlArray['Envelope']['soap:Body']['ProcessXMLResponse']['ProcessXMLResult']['SupplierData_HotelDetail']['ResponseAuditInfo']['root']['Fax']['@'];
            $hotel_comment = $xmlArray['Envelope']['soap:Body']['ProcessXMLResponse']['ProcessXMLResult']['SupplierData_HotelDetail']['ResponseAuditInfo']['root']['LongDesc']['@'];
            $url_hotel = $xmlArray['Envelope']['soap:Body']['ProcessXMLResponse']['ProcessXMLResult']['SupplierData_HotelDetail']['ResponseAuditInfo']['root']['Website']['@'];
            $reservation_email = $xmlArray['Envelope']['soap:Body']['ProcessXMLResponse']['ProcessXMLResult']['SupplierData_HotelDetail']['ResponseAuditInfo']['root']['Email']['@'];
        } catch (SoapFault $exception) {
            var_dump(get_class($exception));
            var_dump($exception);
        }

        $TravelLookupContinents = $this->TravelLookupContinent->find('list', array('fields' => 'id,continent_name', 'conditions' => array('continent_status' => 1, 'wtb_status' => 1, 'active' => 'TRUE'), 'order' => 'continent_name ASC'));

        $TravelChains = $this->TravelChain->find('list', array('fields' => 'id,chain_name', 'conditions' => array('chain_status' => 1, 'wtb_status' => 1, 'chain_active' => 'TRUE', array('NOT' => array('id' => 1))), 'order' => 'chain_name ASC'));
        $TravelChains = array('1' => 'No Chain') + $TravelChains;


        if ($TravelHotelLookups['TravelHotelLookup']['continent_id']) {
            $TravelCountries = $this->TravelCountry->find('list', array(
                'conditions' => array(
                    'TravelCountry.continent_id' => $TravelHotelLookups['TravelHotelLookup']['continent_id'],
                    'TravelCountry.country_status' => '1',
                    'TravelCountry.wtb_status' => '1',
                    'TravelCountry.active' => 'TRUE'
                ),
                'fields' => 'TravelCountry.id, TravelCountry.country_name',
                'order' => 'TravelCountry.country_name ASC'
            ));
        }


        if ($TravelHotelLookups['TravelHotelLookup']['country_id']) {
            $TravelCities = $this->TravelCity->find('all', array(
                'conditions' => array(
                    'TravelCity.country_id' => $TravelHotelLookups['TravelHotelLookup']['country_id'],
                    'TravelCity.continent_id' => $TravelHotelLookups['TravelHotelLookup']['continent_id'],
                    'TravelCity.city_status' => '1',
                    'TravelCity.wtb_status' => '1',
                    'TravelCity.active' => 'TRUE',
                    'TravelCity.province_id' => $TravelHotelLookups['TravelHotelLookup']['province_id'],
                ),
                'fields' => array('TravelCity.id', 'TravelCity.city_name', 'TravelCity.city_code'),
                'order' => 'TravelCity.city_name ASC'
            ));
            $TravelCities = Set::combine($TravelCities, '{n}.TravelCity.id', array('%s - %s', '{n}.TravelCity.city_code', '{n}.TravelCity.city_name'));


            $Provinces = $this->Province->find('list', array(
                'conditions' => array(
                    'Province.country_id' => $TravelHotelLookups['TravelHotelLookup']['country_id'],
                    'Province.continent_id' => $TravelHotelLookups['TravelHotelLookup']['continent_id'],
                    'Province.status' => '1',
                    'Province.wtb_status' => '1',
                    'Province.active' => 'TRUE',
                ),
                'fields' => array('Province.id', 'Province.name'),
                'order' => 'Province.name ASC'
            ));
        }


        if ($TravelHotelLookups['TravelHotelLookup']['city_id']) {
            $TravelSuburbs = $this->TravelSuburb->find('list', array(
                'conditions' => array(
                    'TravelSuburb.country_id' => $TravelHotelLookups['TravelHotelLookup']['country_id'],
                    'TravelSuburb.city_id' => $TravelHotelLookups['TravelHotelLookup']['city_id'],
                    'TravelSuburb.status' => '1',
                    'TravelSuburb.wtb_status' => '1',
                    'TravelSuburb.active' => 'TRUE'
                ),
                'fields' => 'TravelSuburb.id, TravelSuburb.name',
                'order' => 'TravelSuburb.name ASC'
            ));
        }


        if ($TravelHotelLookups['TravelHotelLookup']['suburb_id']) {
            $TravelAreas = $this->TravelArea->find('list', array(
                'conditions' => array(
                    'TravelArea.suburb_id' => $TravelHotelLookups['TravelHotelLookup']['suburb_id'],
                    'TravelArea.area_status' => '1',
                    'TravelArea.wtb_status' => '1',
                    'TravelArea.area_active' => 'TRUE'
                ),
                'fields' => 'TravelArea.id, TravelArea.area_name',
                'order' => 'TravelArea.area_name ASC'
            ));
        }


        if ($TravelHotelLookups['TravelHotelLookup']['chain_id'] > 1) {
            $TravelBrands = $this->TravelBrand->find('list', array(
                'conditions' => array(
                    'TravelBrand.brand_chain_id' => $TravelHotelLookups['TravelHotelLookup']['chain_id'],
                    'TravelBrand.brand_status' => '1',
                    'TravelBrand.wtb_status' => '1',
                    'TravelBrand.brand_active' => 'TRUE'
                ),
                'fields' => 'TravelBrand.id, TravelBrand.brand_name',
                'order' => 'TravelBrand.brand_name ASC'
            ));
        }
        $TravelBrands = array('1' => 'No Brand') + $TravelBrands;

        $TravelLookupPropertyTypes = $this->TravelLookupPropertyType->find('list', array('fields' => 'id,value', 'order' => 'value ASC'));
        $TravelLookupRateTypes = $this->TravelLookupRateType->find('list', array('fields' => 'id,value', 'order' => 'value ASC'));
        $TravelHotelRoomSuppliers = $this->TravelHotelRoomSupplier->find('all', array('conditions' => array('TravelHotelRoomSupplier.hotel_id' => $id)));


        $this->set(compact('TravelLookupContinents', 'TravelChains', 'TravelCountries', 'TravelCities', 'TravelSuburbs', 'TravelAreas', 'TravelBrands', 'TravelHotelRoomSuppliers', 'Provinces', 'TravelLookupPropertyTypes', 'TravelLookupRateTypes', 'hotel_name', 'star', 'gps_prm_1', 'gps_prm_2', 'reservation_contact', 'address', 'location', 'hotel_comment', 'url_hotel', 'reservation_email'));
    }

    public function country_add($supplier_country_id = null) {

        $location_URL = 'http://dev.wtbnetworks.com/TravelXmlManagerv001/ProEngine.Asmx';
        $action_URL = 'http://www.travel.domain/ProcessXML';
        $user_id = $this->Auth->user('id');
        $xml_error = 'FALSE';

        $SupplierCountries = $this->SupplierCountry->findById($supplier_country_id);
        $country_name = $SupplierCountries['SupplierCountry']['name'];
        $country_code = $SupplierCountries['SupplierCountry']['code'];

        if ($this->request->is('post')) {

            $this->request->data['TravelCountry']['created_by'] = $user_id;
            $this->request->data['TravelCountry']['active'] = 'TRUE';
            $this->request->data['TravelCountry']['country_status'] = '1';
            $this->request->data['TravelCountry']['wtb_status'] = '1';
            $this->TravelCountry->create();
            if ($this->TravelCountry->save($this->request->data)) {
                $this->SupplierCountry->updateAll(array('SupplierCountry.status' => "'5'"), array('SupplierCountry.id' => $supplier_country_id));
                $CountryId = $this->TravelCountry->getLastInsertId();
                $CountryName = $this->data['TravelCountry']['country_name'];
                $CountryCode = $this->data['TravelCountry']['country_code'];
                $ContinentId = $this->data['TravelCountry']['continent_id'];
                $ContinentName = $this->data['TravelCountry']['continent_name'];
                $CountryComment = $this->data['TravelCountry']['country_comment'];
                $Active = 'true';
                $CountryStatus = 'true';
                $WtbStatus = 'true';
                $TopCountry = strtolower($this->data['TravelCountry']['top_country']);
                $CreatedDate = date('Y-m-d') . 'T' . date('h:i:s');

                $content_xml_str = '<soap:Body>
                                        <ProcessXML xmlns="http://www.travel.domain/">
                                            <RequestInfo>
                                                <ResourceDataRequest>
                                                    <RequestAuditInfo>
                                                        <RequestType>PXML_WData_Country</RequestType>
                                                        <RequestTime>' . $CreatedDate . '</RequestTime>
                                                        <RequestResource>Silkrouters</RequestResource>
                                                    </RequestAuditInfo>
                                                    <RequestParameters>                        
                                                        <ResourceData>
                                                            <ResourceDetailsData srno="1" actiontype="AddNew">
                                                                <CountryId>' . $CountryId . '</CountryId>
                                                                <CountryCode>' . $CountryCode . '</CountryCode>
                                                                <CountryName>' . $CountryName . '</CountryName>
                                                                <CountryNameJP></CountryNameJP>
                                                                <CountryNameFR></CountryNameFR>
                                                                <CountryNameCN></CountryNameCN>
                                                                <CountryNameCNT></CountryNameCNT>
                                                                <CountryNameDE></CountryNameDE>
                                                                <CountryNameIT></CountryNameIT>
                                                                <CountryNameES></CountryNameES>
                                                                <CountryNameKR></CountryNameKR>
                                                                <CountryNameTEMP1></CountryNameTEMP1>
                                                                <CountryNameTEMP2></CountryNameTEMP2>
                                                                <CountryNameTEMP3></CountryNameTEMP3>
                                                                <CountryPhone></CountryPhone>
                                                                <RegionId></RegionId>
                                                                <ContinentId>' . $ContinentId . '</ContinentId>
                                                                <ContinentCode>NA</ContinentCode>
                                                                <ContinentName>' . $ContinentName . '</ContinentName>
                                                                <CountryStatus>' . $CountryStatus . '</CountryStatus>
                                                                <WtbStatus>' . $WtbStatus . '</WtbStatus>
                                                                <Active>' . $Active . '</Active>
                                                                <IsUpdate>false</IsUpdate>
                                                                <PFTActive>0</PFTActive>
                                                                <SSActive>false</SSActive>
                                                                <ActiveMap>false</ActiveMap>
                                                                <ActiveGuide>false</ActiveGuide>
                                                                <CountryComment>' . $CountryComment . '</CountryComment>
                                                                <CountryDescription></CountryDescription>
                                                                <Tax>0</Tax>
                                                                <Service>0</Service>
                                                                <CountryNameURL></CountryNameURL>
                                                                <CountryURLTEMP1></CountryURLTEMP1>
                                                                <CountryURLTEMP2></CountryURLTEMP2>
                                                                <CountryURLTEMP3></CountryURLTEMP3>
                                                                <Priority>0</Priority>
                                                                <TopDestination>false</TopDestination>
                                                                <IsUpdated>0</IsUpdated>
                                                                <CapitalCity></CapitalCity>
                                                                <TopCountry>false</TopCountry>
                                                                <ApprovedBy>0</ApprovedBy>
                                                                <ApprovedDate>1111-01-01T00:00:00</ApprovedDate>
                                                                <CreatedBy>' . $user_id . '</CreatedBy>
                                                                <CreatedDate>' . $CreatedDate . '</CreatedDate>                                      
                                                              </ResourceDetailsData>             
                                                    </ResourceData>
                                                    </RequestParameters>
                                                </ResourceDataRequest>
                                            </RequestInfo>
                                        </ProcessXML>
                                    </soap:Body>';


                $log_call_screen = 'Country - Add';

                $xml_string = Configure::read('travel_start_xml_str') . $content_xml_str . Configure::read('travel_end_xml_str');
                $client = new SoapClient(null, array(
                    'location' => $location_URL,
                    'uri' => '',
                    'trace' => 1,
                ));

                try {
                    $order_return = $client->__doRequest($xml_string, $location_URL, $action_URL, 1);

                    $xml_arr = $this->xml2array($order_return);
                    //echo htmlentities($xml_string);
                    //pr($xml_arr);
                    //die;

                    if ($xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_COUNTRY']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0] == '201') {
                        $log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_COUNTRY']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0];
                        $log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_COUNTRY']['RESPONSEAUDITINFO']['UPDATEINFO']['STATUS'][0];
                        $xml_msg = "Foreign record has been successfully created [Code:$log_call_status_code]";
                        $this->TravelCountry->updateAll(array('TravelCountry.wtb_status' => "'1'", 'TravelCountry.is_update' => "'Y'"), array('TravelCountry.id' => $CountryId));
                    } else {

                        $log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_COUNTRY']['RESPONSEAUDITINFO']['ERRORINFO']['ERROR'][0];
                        $log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_COUNTRY']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0]; // RESPONSEID
                        $xml_msg = "There was a problem with foreign record creation [Code:$log_call_status_code]";
                        $this->TravelCountry->updateAll(array('TravelCountry.wtb_status' => "'2'"), array('TravelCountry.id' => $CountryId));
                        $xml_error = 'TRUE';
                    }
                } catch (SoapFault $exception) {
                    var_dump(get_class($exception));
                    var_dump($exception);
                }


                $this->request->data['LogCall']['log_call_nature'] = 'Production';
                $this->request->data['LogCall']['log_call_type'] = 'Outbound';
                $this->request->data['LogCall']['log_call_parms'] = trim($xml_string);
                $this->request->data['LogCall']['log_call_status_code'] = $log_call_status_code;
                $this->request->data['LogCall']['log_call_status_message'] = $log_call_status_message;
                $this->request->data['LogCall']['log_call_screen'] = $log_call_screen;
                $this->request->data['LogCall']['log_call_counterparty'] = 'WTBNETWORKS';
                $this->request->data['LogCall']['log_call_by'] = $user_id;
                $this->LogCall->save($this->request->data['LogCall']);
                $message = 'Local record has been successfully created.<br />' . $xml_msg;
                $a = date('m/d/Y H:i:s', strtotime('-1 hour'));
                $date = new DateTime($a, new DateTimeZone('Asia/Calcutta'));
                if ($xml_error == 'TRUE') {
                    $Email = new CakeEmail();

                    $Email->viewVars(array(
                        'request_xml' => trim($xml_string),
                        'respon_message' => $log_call_status_message,
                        'respon_code' => $log_call_status_code,
                    ));

                    $to = 'biswajit@wtbglobal.com';
                    $cc = 'infra@sumanus.com';

                    $Email->template('XML/xml', 'default')->emailFormat('html')->to($to)->cc($cc)->from('admin@silkrouters.com')->subject('XML Error [' . $log_call_screen . '] Open By [' . $this->User->Username($user_id) . '] Date [' . date("m/d/Y H:i:s", $date->format('U')) . ']')->send();
                }
                $this->Session->setFlash($message, 'success');
                $this->redirect(array('controller' => 'support_tickets', 'action' => 'index'));
            } else {
                $this->Session->setFlash('Unable to add Country.', 'failure');
            }
        }

        $TravelLookupContinents = $this->TravelLookupContinent->find('list', array('fields' => 'id,continent_name', 'conditions' => array('continent_status' => 1, 'wtb_status' => 1, 'active' => 'TRUE'), 'order' => 'continent_name ASC'));
        $this->set(compact('TravelLookupContinents', 'country_name', 'country_code'));
    }

    public function city_add($supplier_city_id = null) {

        $location_URL = 'http://dev.wtbnetworks.com/TravelXmlManagerv001/ProEngine.Asmx';
        $action_URL = 'http://www.travel.domain/ProcessXML';
        $user_id = $this->Auth->user('id');
        $xml_error = 'FALSE';

        $SupplierCities = $this->SupplierCity->findById($supplier_city_id);
        $TravelCountrySuppliers = $this->TravelCountrySupplier->findByCountrySupplierId($SupplierCities['SupplierCity']['country_id']);
        $country_id = $TravelCountrySuppliers['TravelCountrySupplier']['country_id'];
        $city_name = $SupplierCities['SupplierCity']['name'];
        $city_code = $SupplierCities['SupplierCity']['code'];

        if ($this->request->is('post')) {

            $this->request->data['TravelCity']['created_by'] = $user_id;
            $this->request->data['TravelCity']['city_status'] = '1';
            $this->request->data['TravelCity']['wtb_status'] = '1';
            $this->request->data['TravelCity']['active'] = 'TRUE';
            $this->TravelCity->create();
            if ($this->TravelCity->save($this->request->data)) {
                $this->SupplierCity->updateAll(array('SupplierCity.status' => "'5'"), array('SupplierCity.id' => $supplier_city_id));
                $CityId = $this->TravelCity->getLastInsertId();
                $CityName = $this->data['TravelCity']['city_name'];
                $CityCode = $this->data['TravelCity']['city_code'];
                $CountryId = $this->data['TravelCity']['country_id'];
                $CountryCode = $this->data['TravelCity']['country_code'];
                $CountryName = $this->data['TravelCity']['country_name'];
                $ContinentId = $this->data['TravelCity']['continent_id'];
                $ContinentName = $this->data['TravelCity']['continent_name'];
                $ProvinceId = $this->data['TravelCity']['province_id'];
                $ProvinceName = $this->data['TravelCity']['province_name'];
                $CityDescription = $this->data['TravelCity']['city_description'];
                $TopCity = strtolower($this->data['TravelCity']['top_city']);
                $Active = 'true';

                $CreatedDate = date('Y-m-d') . 'T' . date('h:i:s');

                $content_xml_str = '<soap:Body>
                                        <ProcessXML xmlns="http://www.travel.domain/">
                                            <RequestInfo>
                                                <ResourceDataRequest>
                                                    <RequestAuditInfo>
                                                        <RequestType>PXML_WData_City</RequestType>
                                                        <RequestTime>' . $CreatedDate . '</RequestTime>
                                                        <RequestResource>Silkrouters</RequestResource>
                                                    </RequestAuditInfo>
                                                    <RequestParameters>                        
                                                        <ResourceData>
                                                            <ResourceDetailsData srno="1" actiontype="AddNew">
                                                                <CityId>' . $CityId . '</CityId>
                                                                <CityCode><![CDATA[' . $CityCode . ']]></CityCode>
                                                                <CityName><![CDATA[' . $CityName . ']]></CityName>
                                                                <CountryId>' . $CountryId . '</CountryId>
                                                                <CountryCode><![CDATA[' . $CountryCode . ']]></CountryCode>
                                                                <CountryName><![CDATA[' . $CountryName . ']]></CountryName>
                                                                <ContinentId>' . $ContinentId . '</ContinentId>
                                                                <ContinentCode>NA</ContinentCode>
                                                                <ContinentName><![CDATA[' . $ContinentName . ']]></ContinentName>
                                                                <ProvinceId>' . $ProvinceId . '</ProvinceId>
                                                                <ProvinceName><![CDATA[' . $ProvinceName . ']]></ProvinceName>
                                                                <RegionId></RegionId>
                                                                <CityNameJP></CityNameJP>
                                                                <CityNameFR></CityNameFR>
                                                                <CityNameDE>NA</CityNameDE>
                                                                <CityNameCN>NA</CityNameCN>
                                                                <CityNameCNT>NA</CityNameCNT>
                                                                <CityNameIT>NA</CityNameIT>
                                                                <CityNameES>NA</CityNameES>
                                                                <CityNameKR>NA</CityNameKR>
                                                                <CityNameTEMP1>NA</CityNameTEMP1>
                                                                <CityNameTEMP2>NA</CityNameTEMP2>
                                                                <CityNameTEMP3>NA</CityNameTEMP3>
                                                                <City_Keyword>NA</City_Keyword>
                                                                <CityURL>NA</CityURL>
                                                                <CityNameURL>NA</CityNameURL>
                                                                <CityURLTEMP1>NA</CityURLTEMP1>
                                                                <CityURLTEMP2>NA</CityURLTEMP2>
                                                                <CityURLTEMP3>NA</CityURLTEMP3>
                                                                <CityDomainName>NA</CityDomainName>
                                                                <CityTitle>NA</CityTitle>
                                                                <CityDescription><![CDATA[' . $CityDescription . ']]></CityDescription>
                                                                <CityKeyword>NA</CityKeyword>
                                                                <ActiveMap>false</ActiveMap>
                                                                <ActiveGuide>false</ActiveGuide>
                                                                <IsUpdated>0</IsUpdated>
                                                                <PFTActive>1</PFTActive>
                                                                <SSActive>true</SSActive>
                                                                <TopDestination>true</TopDestination>
                                                                <StateCode>NA</StateCode>
                                                                <IsXML>true</IsXML>
                                                                <Active>' . $Active . '</Active>
                                                                <TopCity>NA</TopCity>
                                                                <Status>true</Status>
                                                                <WtbStatus>true</WtbStatus>                                                                
                                                                <ApprovedBy>0</ApprovedBy>
                                                                <ApprovedDate>1111-01-01T00:00:00</ApprovedDate>
                                                                <CreatedBy>' . $user_id . '</CreatedBy>
                                                                <CreatedDate>' . $CreatedDate . '</CreatedDate>
                                                            </ResourceDetailsData>
                         
                                                    </ResourceData>
                                                    </RequestParameters>
                                                </ResourceDataRequest>
                                            </RequestInfo>
                                        </ProcessXML>
                                    </soap:Body>';


                $log_call_screen = 'City - Add';

                $xml_string = Configure::read('travel_start_xml_str') . $content_xml_str . Configure::read('travel_end_xml_str');
                $client = new SoapClient(null, array(
                    'location' => $location_URL,
                    'uri' => '',
                    'trace' => 1,
                ));

                try {
                    $order_return = $client->__doRequest($xml_string, $location_URL, $action_URL, 1);

                    $xml_arr = $this->xml2array($order_return);
                    //echo htmlentities($xml_string);
                    // pr($xml_arr);
                    // die;

                    if ($xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_CITY']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0] == '201') {
                        $log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_CITY']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0];
                        $log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_CITY']['RESPONSEAUDITINFO']['UPDATEINFO']['STATUS'][0];
                        $xml_msg = "Foreign record has been successfully created [Code:$log_call_status_code]";
                        $this->TravelCity->updateAll(array('TravelCity.wtb_status' => "'1'", 'TravelCity.is_update' => "'Y'"), array('TravelCity.id' => $CityId));
                    } else {

                        $log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_CITY']['RESPONSEAUDITINFO']['ERRORINFO']['ERROR'][0];
                        $log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_CITY']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0]; // RESPONSEID
                        $xml_msg = "There was a problem with foreign record creation [Code:$log_call_status_code]";
                        $this->TravelCity->updateAll(array('TravelCity.wtb_status' => "'2'"), array('TravelCity.id' => $CityId));
                        $xml_error = 'TRUE';
                    }
                } catch (SoapFault $exception) {
                    var_dump(get_class($exception));
                    var_dump($exception);
                }


                $this->request->data['LogCall']['log_call_nature'] = 'Production';
                $this->request->data['LogCall']['log_call_type'] = 'Outbound';
                $this->request->data['LogCall']['log_call_parms'] = trim($xml_string);
                $this->request->data['LogCall']['log_call_status_code'] = $log_call_status_code;
                $this->request->data['LogCall']['log_call_status_message'] = $log_call_status_message;
                $this->request->data['LogCall']['log_call_screen'] = $log_call_screen;
                $this->request->data['LogCall']['log_call_counterparty'] = 'WTBNETWORKS';
                $this->request->data['LogCall']['log_call_by'] = $user_id;

                $this->LogCall->save($this->request->data['LogCall']);
                if ($xml_error == 'TRUE') {
                    $Email = new CakeEmail();

                    $Email->viewVars(array(
                        'request_xml' => trim($xml_string),
                        'respon_message' => $log_call_status_message,
                        'respon_code' => $log_call_status_code,
                    ));

                    $to = 'biswajit@wtbglobal.com';
                    $cc = 'infra@sumanus.com';

                    $Email->template('XML/xml', 'default')->emailFormat('html')->to($to)->cc($cc)->from('admin@silkrouters.com')->subject('XML Error [' . $log_call_screen . '] Open By [' . $this->User->Username($user_id) . '] Date [' . date('d/m/y H:i:s') . ']')->send();
                }


                $message = 'Local record has been successfully added.<br />' . $xml_msg;
                $this->Session->setFlash($message, 'success');
                $this->redirect(array('controller' => 'support_tickets', 'action' => 'index'));
            } else {
                $this->Session->setFlash('Unable to add City.', 'failure');
            }
        }



        $TravelLookupContinents = $this->TravelLookupContinent->find('list', array('fields' => 'id,continent_name', 'conditions' => array('continent_status' => 1, 'wtb_status' => 1, 'active' => 'TRUE'), 'order' => 'continent_name ASC'));
        $this->set(compact('TravelLookupContinents', 'country_id', 'city_name', 'city_code'));
    }

}
