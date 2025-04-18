<?php

App::uses('AppController', 'Controller', 'Lib', 'Html');
Configure::load('api');

class CompaniesController extends AppController {

    public $components = array('Curl', 'RequestHandler', 'CurlApi');
    public $helpers = array(
        'Layout',
        'Html'
    );

    public function index() {
        $this->layout = 'admintrator';
        $this->set('title_for_layout', 'Manage Dealerships');
        // get params
        $keyword = (isset($this->params['url']['key'])) ? $this->params['url']['key'] : '';
        $filter = (isset($this->params['url']['filter'])) ? $this->params['url']['filter'] : '';
        $fieldsort = (isset($this->params['url']['fieldsort']) && $this->params['url']['fieldsort'] != '') ? $this->params['url']['fieldsort'] : '';
        $sort = (isset($this->params['url']['sort']) && $this->params['url']['sort'] != '') ? $this->params['url']['sort'] : 'desc';
        // pagination
        $page = (isset($this->params['url']['page']) && $this->params['url']['page']) ? $this->params['url']['page'] : 1;
        $limit = (isset($this->params['url']['limit']) && $this->params['url']['limit']) ? $this->params['url']['limit'] : 20;
        $start = $limit * ($page - 1);
        // call api
        $url = Configure::read('api.api_url') . 'api/user/getallcompanyadmin';
        $header = array(
            'sessionid:' . CakeSession::read('Auth.User.session_id')
        );
        $body = array(
            "keyword" => $keyword,
            "filter" => $filter,
            "limit" => $limit,
            "start" => $start,
            'time_zones' => $this->Session->read('time_zones')
        );
        $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());
        if ($result && isset($result->company) && $result->company) {
            $list = $result->company;
            $total = $result->total;
            $maxpages = $this->Page($total, $limit);
        } else {
            $list = null;
            $maxpages = 0;
            $total = 0;
        }
        
        $this->set(compact('list', 'total', 'maxpages', 'limit', 'page', 'keyword', 'filter', 'fieldsort', 'sort'));
    }

    public function recent_car_count() {
        $this->layout = 'admintrator';
        $this->set('title_for_layout', 'Recent Car Count');
        // get params
        $company_id = (isset($this->params['url']['company_id'])) ? $this->params['url']['company_id'] : '';
        $dealership_name = (isset($this->params['url']['dealership_name'])) ? $this->params['url']['dealership_name'] : '';
        // pagination
        $page = (isset($this->params['url']['page']) && $this->params['url']['page']) ? $this->params['url']['page'] : 1;
        $limit = (isset($this->params['url']['limit']) && $this->params['url']['limit']) ? $this->params['url']['limit'] : 20;
        $start = $limit * ($page - 1);
        // call api
        $url = Configure::read('api.api_url') . 'api/user/getlistlatesdatedatafeed';
        $header = array(
            'sessionid:' . CakeSession::read('Auth.User.session_id')
        );
        $body = array(
            "limit" => $limit,
            "start" => $start,
            "company_id" => $company_id,
            "time_zones" => $this->Session->read('time_zones')
        );
        $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());
        //debug($result); die();
        if ($result && isset($result->latest_date_list) && $result->latest_date_list) {
            $list = $result->latest_date_list;
            $total = $result->total;
            $maxpages = $this->Page($total, $limit);
        } else {
            $list = null;
            $maxpages = 0;
            $total = 0;
        }
        
        $this->set(compact('list', 'total', 'maxpages', 'limit', 'page', 'dealership_name'));
    }
    public function address_company() {
        $this->layout = 'admintrator';
        $this->set('title_for_layout', 'Address company');
        // get params
        $company_id = (isset($this->params['url']['company_id'])) ? $this->params['url']['company_id'] : '';
        $dealership_name = (isset($this->params['url']['dealership_name'])) ? $this->params['url']['dealership_name'] : '';
        // pagination
        $page = (isset($this->params['url']['page']) && $this->params['url']['page']) ? $this->params['url']['page'] : 1;
        $limit = (isset($this->params['url']['limit']) && $this->params['url']['limit']) ? $this->params['url']['limit'] : 20;
        $start = $limit * ($page - 1);
        // call api
        $url = Configure::read('api.api_url') . 'api/user/getaddressofcompany';
        $header = array(
            'sessionid:' . CakeSession::read('Auth.User.session_id')
        );
        $body = array(
            "limit" => $limit,
            "start" => $start,
            "company_id" => $company_id,
            "time_zones" => $this->Session->read('time_zones')
        );
        $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());
        //debug($result); die();
        if ($result && isset($result->company) && $result->company) {
            $list = $result->company;
            //$total = $result->company['car_number'];
            //$maxpages = $this->Page($total, $limit);
        } else {
            $list = null;
            $maxpages = 0;
            $total = 0;
        }
        //debug($list);die();
        $this->set(compact('list', 'maxpages', 'page', 'dealership_name','company_id'));
    }
    
    public function show() {
        $this->layout = 'admintrator';
        $this->set('title_for_layout', 'Dealership Detail');
        // call api
        $id = (isset($this->params['url']['id'])) ? $this->params['url']['id'] : '';
        $url = Configure::read('api.api_url') . 'api/user/getcompanydetail?company_id=' . $id;
        $header = array(
            'sessionid:' . $this->Session->read('Auth.User.session_id')
        );
        $rs = json_decode($this->CurlApi->to($url)->withOption('HTTPHEADER', $header)->get());
        if ($rs->status == 'success') {
            $rs = $rs->company;
            $this->set(compact('rs'));
        }
    }
    public function add() {
        $this->layout = 'admintrator';
        $this->set('title_for_layout', 'Add Dealership');
        
        $list_datafeed = '';
        $url = Configure::read('api.api_url') . 'api/user/getalldatafeeds';
        $header = array(
            'sessionid:' . $this->Session->read('Auth.User.session_id')
        );
        $rs = json_decode($this->CurlApi->to($url)->withOption('HTTPHEADER', $header)->post());
        if ($rs->status == 'success') {
            $list_datafeed = $rs->datafeed;
        }
        $this->set(compact('title', 'list_datafeed'));
    }

    public function edit() {
        $this->layout = 'admintrator';
        $this->set('title_for_layout', 'Edit Dealership');
        // get params
        $id = (isset($this->params['url']['id'])) ? $this->params['url']['id'] : '';
        // call api
        $url = Configure::read('api.api_url') . 'api/user/getcompanydetail?company_id=' . $id;
        $header = array(
            'sessionid:' . $this->Session->read('Auth.User.session_id')
        );
        $rs = json_decode($this->CurlApi->to($url)->withOption('HTTPHEADER', $header)->get());
        // get datafeed
        $url = Configure::read('api.api_url') . 'api/user/getalldatafeeds';
        $list_datafeed = json_decode($this->CurlApi->to($url)->withOption('HTTPHEADER', $header)->post());
        if ($list_datafeed->status == 'success') {
            $list_datafeed = $list_datafeed->datafeed;
        }
        
        if ($rs && isset($rs->company) && $rs->company) {
            $rs = $rs->company;
        }
        else {
            $rs = null;
        }
        $this->set(compact('rs', 'list_datafeed'));
    }

    public function store() {
        $name = $this->request->data['name'];
        $license = $this->request->data['license'];
        $email = $this->request->data['email'];
        $address = $this->request->data['address'];
        $website = $this->request->data['website'];
        $telephone = $this->request->data['telephone'];
        $datafeed_number = $this->request->data['datafeed_number'];
        $list_datafeed = $this->request->data['datafeed'];

        $arr_list_datafeed = [];
        foreach ($list_datafeed as $item) {
            array_push($arr_list_datafeed, $item);
        }
        $url = Configure::read('api.api_url') . 'api/user/addoreditcompany';
        $header = array(
            'sessionid:' . CakeSession::read('Auth.User.session_id')
        );

        $body = array(
            "license_number" => $license,
            "name" => $name,
            "email" => $email,
            "address" => $address,
            "website" => $website,
            "telephone" => $telephone,
            "datafeed_number" => $datafeed_number,
            "arr_id_datafeed" => $arr_list_datafeed
        );

        $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());
        if ($result->status == 'success') {
            $this->Session->setFlash('Added successfully');
        } else {
            if ($result->code == 205) {
                $this->Session->setFlash($result->response);
            } else {
                $this->Session->setFlash('Added not successfully');
            }
            return $this->redirect('/admin_company_add');
        }
        return $this->redirect('/admin_company');
    }

    public function update() {
        // get params
        $dealershipId = $this->request->data['_id'];
        $name = $this->request->data['name'];
        $license = $this->request->data['license'];
        $datafeeds = isset($this->request->data['datafeed'])? $this->request->data['datafeed'] : '';
        $telephone = $this->request->data['telephone'];
        $email = $this->request->data['email'];
        $website = $this->request->data['website'];
        $fax = $this->request->data['fax'];
        $abn = $this->request->data['abn'];
        $acn = $this->request->data['acn'];
        $dun = $this->request->data['dun'];
        // call api
        $url = Configure::read('api.api_url') . 'api/user/editcompany';
        $header = array(
            'sessionid:' . CakeSession::read('Auth.User.session_id')
        );
        $body = array(
            "company_id" => $dealershipId,
            "name" => $name,
            "license_number" => $license,
            "email" => $email,
            "website" => $website,
            "telephone" => $telephone,
            "fax" => $fax,
            "abn" => $abn,
            "acn" => $acn,
            "dun" => $dun,
            "arr_id_datafeed" => $datafeeds
        );
        
        $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());

        if ($result->status == 'success') {
            $this->Session->setFlash('Updated successfully');
        } else {
            if ($result->code == 205) {
                $this->Session->setFlash($result->response, 'default', array('class' => 'error'));
            } else {
                $this->Session->setFlash('Failure', 'default', array('class' => 'error'));
            }
            return $this->redirect('/admin_company_edit?id=' . $dealershipId);
        }
        return $this->redirect('/admin_company');
    }
    public function editaddress(){
        $this->layout = 'admintrator';
        $this->set('title_for_layout', 'Edit address company');
        // get params
        $dealer = (isset($this->params['url']['_id'])) ? $this->params['url']['_id'] : '';
        $company_id=(isset($this->params['url']['company_id'])) ? $this->params['url']['company_id'] : '';
        $dealership_name=(isset($this->params['url']['dealership_name'])) ? $this->params['url']['dealership_name'] : '';
        $id = (isset($this->params['url']['_id'])) ? $this->params['url']['_id'] : '';
        // call api
        $url = Configure::read('api.api_url') . 'api/user/getaddressdetail?branch_address_id=' . $id;
        //debug($url);die();
        $header = array(
            'sessionid:' . $this->Session->read('Auth.User.session_id')
        );
        $rs = json_decode($this->CurlApi->to($url)->withOption('HTTPHEADER', $header)->get());


        if ($rs && isset($rs->company) && $rs->company) {
            $rs = $rs->company;
        }
        else {
            $rs = null;
        }
        $this->set(compact('rs','dealership_name','company_id'));
    }

    public function delete() {
        $id = (isset($this->params['url']['id'])) ? $this->params['url']['id'] : '';
        $page = (isset($this->params['url']['page'])) ? $this->params['url']['page'] : '1';
        $key = (isset($this->params['url']['key'])) ? $this->params['url']['key'] : '';
        $url = Configure::read('api.api_url') . 'api/user/removecompany';
        $header = array(
            'sessionid:' . CakeSession::read('Auth.User.session_id')
        );
        $body = array(
            "company_id" => $id
        );
        $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());
        if ($result->status == 'success') {
            $this->Session->setFlash('Deleted successfully');
        } else {
            $this->Session->setFlash('Deleted not successfully');
        }
        return $this->redirect('/admin_company?page=' . $page . '&key=' . $key);
    }
    public function updateaddress() {
        // get params0
        $company_id=$this->request->data['company_id'];
        $dealershipname=$this->request->data['dealershipname'];
        $branch_address_id = $this->request->data['branch_address_id'];
        $address1 = $this->request->data['address1'];
        $address2 = $this->request->data['address2'];
        $address3 = $this->request->data['address2'];
        $suburb = $this->request->data['suburb'];
        $postcode = $this->request->data['postcode'];
        $state = $this->request->data['state'];
        $country = $this->request->data['country'];
        $datafeeds = isset($this->request->data['datafeedId'])? $this->request->data['datafeedId'] : '';

         if(sizeof($datafeeds)>0){
             if($datafeeds[0]!=""){
                 $datafeeds=explode(",",$datafeeds[0]);
             }else{
                 $datafeeds= array();
             }

         }else{
             $datafeeds= array();
         }
        // call api
        $url = Configure::read('api.api_url') . 'api/user/editaddress';
        $header = array(
            'sessionid:' . CakeSession::read('Auth.User.session_id')
        );
        $body = array(
            "branch_address_id"=>$branch_address_id,
            "address1" => $address1,
            "address2" => $address2,
            "address3" => $address3,
            "suburb" => $suburb,
            "postcode" => $postcode,
            "state" => $state,
            "country" => $country,
            "list_datafeed_id" => $datafeeds
        );

        $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());
        if ($result->status == 'success') {
            $this->Session->setFlash('Updated successfully');
        } else {
            if ($result->code == 205) {
                $this->Session->setFlash($result->response, 'default', array('class' => 'error'));
            }else if($result->code == 203)
                {
                    $this->Session->setFlash('Datafeed Id existed in system', 'default', array('class' => 'error'));
                    return $this->redirect('/admin_address_edit?company_id='.$company_id.'&dealership_name=' .$dealershipname.'&_id='.$branch_address_id);

                }
            else {
                $this->Session->setFlash('Failure', 'default', array('class' => 'error'));
            }
            return $this->redirect('/companies/address_company?company_id='.$company_id .'&dealership_name=' .$dealershipname);
        }
        return $this->redirect('/companies/address_company?company_id='.$company_id .'&dealership_name=' .$dealershipname);
    }
    function export_dealership_data(){
        $this->autoRender = FALSE;
        // get params
        $keyword = (isset($this->request->data['key']))?$this->request->data['key'] : '';
        $filter = (isset($this->request->data['filter']))?$this->request->data['filter'] : 0;
        $index = (isset($this->request->data['id']))?$this->request->data['id'] : 0;
        $limit = 500;
        $start = ($index - 1) * $limit;
        // call api
        $url = Configure::read('api.api_url').'api/user/exportdealership';
        $header = array(
            'sessionid:'.CakeSession::read('Auth.User.session_id')
        );
        $body = array(
            "keyword" => $keyword,
            "start" => $start,
            "limit" => $limit,
            "filter" => $filter,
            "type" => 0,
            'time_zones' => $this->Session->read('time_zones')
        );
        $result = json_decode($this->CurlApi->to($url)->withData( json_encode($body))->withOption('HTTPHEADER', $header)->post());
        if($result && isset($result->url_excel) && $result->url_excel){
            $data['error'] = 0;
            $data['id'] = $index;
            $data['link'] = $result->url_excel;
        }else{
            $data['error'] = 1;
            $data['rs'] = $result;
        }
        return json_encode($data);
    }

    public function Page($total, $limit) {
        if ($total % $limit != 0) {
            if ($total / $limit > round($total / $limit)) {
                return round($total / $limit) + 1;
            } else {
                return round($total / $limit);
            }
        } else {
            return $total / $limit;
        }
    }

}
