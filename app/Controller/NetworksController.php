<?php

App::uses('AppController', 'Controller', 'Lib','Html');
Configure::load('api');
class NetworksController extends AppController {

    public $components = array('Curl', 'Paginator', 'RequestHandler','CurlApi');
    public $helpers = array(
        'Layout',
        'GoogleMap',
        'Html'
    );
    
    public function block_network() {
        // get ajax
        $ajax = isset($this->params['url']['ajax']) ? $this->params['url']['ajax'] : '';
        // pagination
        $limit = (isset($this->params['url']['limit']) && $this->params['url']['limit']) ? $this->params['url']['limit'] : 2;
        $page = (isset($this->params['url']['page']) && $this->params['url']['page'])? $this->params['url']['page'] : 1;
        $start = $limit * ($page - 1);
        
        // call api
        $url = Configure::read('api.api_url').'api/user/getblockmynetwork';
        $header = array(
            'sessionid:'.$this->Session->read('Auth.User.session_id')
        );
        $body = array(
            'user_id' => $this->Session->read('Auth.User._id'),
            'limit' => $limit,
            'start' => $start
        );
        $result = json_decode($this->CurlApi->to($url)->withData( json_encode($body))->withOption('HTTPHEADER', $header)->post());
        //debug($url); debug(json_encode($body)); debug($header); debug($result); die();
        if ($result != null && $result->status == 'success' && $result->networks != null) {
            $list = $result->networks;
            $total = $result->total;
            $maxpages = $this->Page($total, $limit);
        } else {
            $list = null;
            $total = 0;
            $maxpages = 0;
        }
        
        $this->set(compact('list', 'total', 'maxpages', 'limit', 'page'));
        
        if ($ajax == 0) {
            $helpers = array('Common');
            $this->set('title_for_layout', 'Block');
            $this->set('breadcrumb', [
                (object) ['title' => 'Home'],
                (object) ['title' => 'My Network'],
                (object) ['title' => 'Block', 'active' => true]
            ]);
            $this->layout = 'cz_home';
            $this->render('block_network');
        } else {
            $this->layout = null;
            $this->render('block_network_ajax');
        }
    }
    
    public function send_invite_network() {
        $this->layout = null;
        $this->autoRender = false;
        
        if ($this->request->data) {
            // get params
            $arrEmail = $this->request->data['email'];
            // call api
            $url = Configure::read('api.api_url').'api/user/invitenetwork';
            $header = array(
                'sessionid:'.$this->Session->read('Auth.User.session_id'),
            );
            $body = array(               
                "sender_id" => $this->Session->read('Auth.User._id'),
                "sender_name" => $this->Session->read('Auth.User.name'),
                "arr_request_email" => $arrEmail
            );

            $result = json_decode($this->Curl->_curl_header_body($url,$header,$body));
            if($result->status == 'success'){
                $data['error'] = 0;
            }else{
                $data['error'] = 1;
            }
        } else {
            $data['error'] = 1;
        }
        
        echo json_encode($data);
    }
    
    public function add_network() {
        // get ajax
        $ajax = isset($this->params['url']['ajax']) ? $this->params['url']['ajax'] : '';
        if ($ajax) {
            $keyword = (isset($this->params['url']['keywork']) && $this->params['url']['keywork']) ? $this->params['url']['keywork'] : '';
            
            // call api
            $url = Configure::read('api.api_url').'api/user/searchcardealer';
            $header = array(
                'sessionid:'.$this->Session->read('Auth.User.session_id')
            );
            $body = array(
                'user_id' => $this->Session->read('Auth.User._id'),
                'keywords' => $keyword
            );
            $result = json_decode($this->CurlApi->to($url)->withData( json_encode($body))->withOption('HTTPHEADER', $header)->post());
            //debug($result);die();
            if ($result && isset($result->dealers) && $result->dealers) {
                $list = $result->dealers;
                $total = sizeof($result->dealers);
            } else {
                $list = null;
                $total = 0;
            }
            
            $this->set(compact(array('list', 'total')));
            $this->layout = null;
            $this->autoRender = false;
            
            $this->render('add_network_ajax');
        }
        else {
            $this->set('title_for_layout', 'Add Dealer to Network');
            $this->layout = 'cz_home';
        }
    }
    
    public function mynetwork() {
        // get parameters
        if($this->request->data){
            $id = $this->request->data['id'];
            foreach($id as $k) {
                $ar_id .= $k.'|';
            }
            return $this->redirect('/view_stock?id='.  $ar_id);
        }
        
        $key = (isset($this->params['url']['key']) && $this->params['url']['key'] != '') ? $this->params['url']['key'] : '';
        // get ajax
        $ajax = isset($this->params['url']['ajax']) ? $this->params['url']['ajax'] : '';
        // pagination
        $limit = (isset($this->params['url']['limit']) && $this->params['url']['limit']) ? $this->params['url']['limit'] : 12;
        $page = (isset($this->params['url']['page']) && $this->params['url']['page'])? $this->params['url']['page'] : 1;
        $start = $limit * ($page - 1);
        
        // call api
        $url = Configure::read('api.api_url').'api/user/getmynetwork';
        $header = array(
            'sessionid:'.$this->Session->read('Auth.User.session_id')
        );
        $body = array(
            'user_id' => $this->Session->read('Auth.User._id'),
            'user_email' =>$this->Session->read('Auth.User.email'),
            'keyword' => $key,
            'type' => 1,
            'limit' => $limit,
            'start' => $start,
            'total' => 1
        );
        $result = json_decode($this->CurlApi->to($url)->withData( json_encode($body))->withOption('HTTPHEADER', $header)->post());
        //debug($result); die();
        
        if ($result && isset($result->status) && $result->status == 'success' ) {
            $count_invite = $result->count_invite;
            $count_block = $result->count_block;
            $list = $result->networks;
            $total = $result->count_network;
            $maxpages = $this->Page($total, $limit);
        }
        else {
            $count_invite = 0;
            $count_block = 0;
            $list = null;
            $total = 0;
            $maxpages = 0;
        }
        
        $this->set(compact('list', 'total', 'maxpages', 'limit', 'page', 'count_invite', 'count_block', 'key'));
        
        if ($ajax == 0) {
            $this->helpers = array('Common');
            $this->set('title_for_layout', 'My Network');
            $this->layout = 'cz_home';
            $this->render('mynetwork');
        } else {
            $this->layout = null;
            $this->render('mynetwork_ajax');
        }
    }
    
    public function network_info_user() {
        $id = $this->params['url']['id'];
        $this->set('title_for_layout','My Network');
        $this->layout = 'home';
        
        $url = Configure::read('api.api_url').'api/user/getprofile?user_id='.$id;
        $header = array(
            'sessionid:'.$this->Session->read('Auth.User.session_id')
        );
        
        $info = json_decode($this->CurlApi->to($url)->withOption('HTTPHEADER', $header)->get())->info;
        
        $lat = '';
        $lng = '';
        
        if ($info->company_address) {
            $address = $info->company_address;
            $local_car = str_replace(' ', '+', $address);
            $geocode = file_get_contents('http://maps.google.com/maps/api/geocode/json?address=' . $local_car . '&sensor=false');
            $output = json_decode($geocode);
            $lat = $output->results[0]->geometry->location->lat;
            $lng = $output->results[0]->geometry->location->lng;
        }
        else if($info->latitude && $info->longitude) {
            $lat = $info->latitude;
            $lng = $info->longitude;
        }
      
        $this->set(compact('info','address','lat','lng'));
    }
    
    public function request_network() {
        // get parameters
        $type = (isset($this->params['url']['type']))? $this->params['url']['type'] : 0;
        // get ajax
        $ajax = isset($this->params['url']['ajax']) ? $this->params['url']['ajax'] : '';
        // pagination
        $limit = (isset($this->params['url']['limit']) && $this->params['url']['limit']) ? $this->params['url']['limit'] : 6;
        $page = (isset($this->params['url']['page']) && $this->params['url']['page'])? $this->params['url']['page'] : 1;
        $start = $limit * ($page - 1);

        // call api
        $header = array(
            'userid:'.$this->Session->read('Auth.User._id'),
            'sessionid:'.$this->Session->read('Auth.User.session_id')
        );
        $url = Configure::read('api.api_url').'api/user/getinvitenetwork';
        $body = array(
            'email_dealer' => $this->Session->read('Auth.User.email'),
            'user_id' => $this->Session->read('Auth.User._id'),
            'type' => $type,
            'limit' => $limit,
            'start' => $start
        );
        $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());
        //debug(json_encode($body)); debug($result); die();
        
        if ($result && isset($result->list_request) && $result->list_request) {
            $list = $result->list_request;
            $total = $result->total;
            $maxpages = $this->Page($total, $limit);
            //debug($total);die();
        }
        else {
            $list = null;
            $total = 0;
            $maxpages = 0;
        }
        
        $this->set(compact(array('list', 'total', 'maxpages', 'limit', 'page', 'type')));
        if ($ajax == 0) {
            $helpers = array('Common');
            $this->set('title_for_layout', 'Requests');
            $this->layout = 'cz_home';
            
            $this->layout = 'cz_home';
            $this->render('request_network');
        } else {
            $this->layout = null;
            $this->render('request_network_ajax');
        }
    }
    
    public function group() {
        // get parameters
        $key = (isset($this->params['url']['key']) && $this->params['url']['key'] != '') ? $this->params['url']['key'] : '';
        
        // get ajax
        $ajax = isset($this->params['url']['ajax']) ? $this->params['url']['ajax'] : '';
        // pagination
        $limit = (isset($this->params['url']['limit']) && $this->params['url']['limit']) ? $this->params['url']['limit'] : 12;
        $page = (isset($this->params['url']['page']) && $this->params['url']['page'])? $this->params['url']['page'] : 1;
        $start = $limit * ($page - 1);
        
        // call api
        $url = Configure::read('api.api_url').'api/user/getallgroupmynetwork';
        $header = array(
            'sessionid:'.$this->Session->read('Auth.User.session_id')
        );
        $body = array(
            "user_id" => CakeSession::read('Auth.User._id'),
            "start" => $start,
            "limit" => $limit,
            "keyword" => $key
        );
        $result = json_decode($this->CurlApi->to($url)->withData( json_encode($body))->withOption('HTTPHEADER', $header)->post());
        
        if($result->status == 'success' && $result->results != null) {
            $list = $result->results;
            $total = $result->total;
            $maxpages = $this->Page($total, $limit);
        } else {
            $list = '';
            $maxpages = 0;
            $total = 0;
        }
        
        $this->set(compact(array('list', 'total', 'maxpages', 'limit', 'page', 'key')));
        if ($ajax == 0) {
            $helpers = array('Common');
            $this->set('title_for_layout', 'Groups');
            $this->layout = 'cz_home';
            $this->render('group');
        } else {
            $this->layout = null;
            $this->render('group_ajax');
        }
    }

    public function group_detail($id = null) {
        $helpers = array('Common');
	$this->set('title_for_layout', 'Group Detail');
	$this->set('breadcrumb', [
		(object) ['title' => 'Home'], 
                (object) ['title' => 'My Groups'], 
		(object) ['title' => 'Group Detail', 'active' => true]
	]);
	$this->layout = 'cz_home';
        
        // get parameters
        $key = (isset($this->params['url']['key']) && $this->params['url']['key'] != '') ? $this->params['url']['key'] : '';
        $editgroup = (isset($this->params['url']['editgroup']) && $this->params['url']['editgroup'] != '') ? $this->params['url']['editgroup'] : '';
        // pagination
        $limit = (isset($this->params['url']['limit']) && $this->params['url']['limit']) ? $this->params['url']['limit'] : 6;
        $page = (isset($this->params['url']['page']) && $this->params['url']['page'])? $this->params['url']['page'] : 1;
        $start = $limit * ($page - 1);
        
        // get group detail
        $url = Configure::read('api.api_url').'api/user/getallgroupmember';
        $header = array(
            'sessionid:' . CakeSession::read('Auth.User.session_id')
        );
        $body = array(
            "group_id" => $id,
            "limit" => $limit,
            "start" => $start,
            "keyword" => $key
        );
        $result = json_decode($this->CurlApi->to($url)->withData( json_encode($body))->withOption('HTTPHEADER', $header)->post());
        //debug($result); die();
        if($result->status == 'success'){
            $group_name = $result->title;
            $list = $result->result;
            $total = $result->count_member;
            $maxpages = $this->Page($total, $limit);
        }else{
            $group_name = '';
            $list = '';
            $maxpages = '';
            $total = 0;
        }
        
        $this->set(compact('list','id','maxpages','total','group_name', 'editgroup'));
    }
    
    public function getlistdealernotingroup() {
        // get parameters
        //$group_id = $this->request->data['group_id'];
        $group_id = $this->params['url']['group_id'];
        
        // get group detail
        $url = Configure::read('api.api_url').'api/user/getallgroupmember';
        $header = array(
            'sessionid:' . CakeSession::read('Auth.User.session_id')
        );
        $body = array(
            "group_id" => $group_id,
            "limit" => 200,
            "start" => 0,
            "keyword" => ''
        );
        $result = json_decode($this->CurlApi->to($url)->withData( json_encode($body))->withOption('HTTPHEADER', $header)->post());
        //debug($result); die();
        if($result->status == 'success'){
            $list = $result->result;
        }else{
            $list = null;
        }
        
        // get list dealer in network
        $url = Configure::read('api.api_url').'api/user/getmynetwork';
        $body = array(
            'user_id' => $this->Session->read('Auth.User._id'),
            'user_email' =>$this->Session->read('Auth.User.email'),
            'keyword' => '',
            'type' => 1,
            'limit' => 200,
            'start' => 0,
            'total' => 1
        );
        $rs = json_decode($this->CurlApi->to($url)->withData( json_encode($body))->withOption('HTTPHEADER', $header)->post());

        $listnetwork = array();
        if($rs && $rs->status == 'success' && $rs->networks != null){
            $data['error'] = 0;
            $arrMemberInGroup = array();
            foreach ($list as $member) {
                $arrMemberInGroup[] = $member->member_id;
            }
            foreach ($rs->networks as $network) {
                if (!in_array($network->_id, $arrMemberInGroup)) {
                    $listnetwork[] = $network;
                }
            }
        }else {
            $data['error'] = 1;
            $listnetwork = null;
        }
        
        $this->set(compact('listnetwork', 'group_id'));
        
        $this->layout = null;
        $this->render('modal_add_group_member');
    }
    
    public function add_group_member() {
        $this->autoRender = false;
        // get parameters
        $group_id = $this->request->data['group_id'];
        $member_id = $this->request->data['member_id'];
        // call api
        $url_add = Configure::read('api.api_url').'api/user/addgroupmember';
        $header = array(
            'sessionid:'.$this->Session->read('Auth.User.session_id')
        );
        $body_add = array(
            "group_id" => $group_id,
            "member_arr_id" => $member_id
        );
        $result = json_decode($this->CurlApi->to($url_add)->withData( json_encode($body_add))->withOption('HTTPHEADER', $header)->post());
        
        if($result && $result->status == 'success'){
            $this->Session->setFlash('Successfull!', 'flash_custom', array('type' => 0));
        }
        else {
            $this->Session->setFlash('Failure!', 'flash_custom', array('type' => 1));
        }
        
        return $this->redirect('/group_detail/' . $group_id);
    }
    public function add_group(){
        if($this->request->data){ // post add group
            $this->autoRender = false;
            if(isset($this->request->data['member_id'])){
                $member_id = $this->request->data['member_id'];
            }else{
                $member_id = '';
            }
            $url_add = Configure::read('api.api_url').'api/user/addnewgroupandmember';
            $header = array(
                'sessionid:'.$this->Session->read('Auth.User.session_id')
            );
            $body_add = array(
                "user_id" => CakeSession::read('Auth.User._id'), 
                "name" => $this->request->data['name'],
                "member_id" => $member_id
            );
            $result = json_decode($this->CurlApi->to($url_add)->withData( json_encode($body_add))->withOption('HTTPHEADER', $header)->post());
            
            if($result->status == 'success'){
                $data['error'] = 0;
            }else if($result->code == 205){
                $data['error'] = 1;
                $data['msg'] = 'Group name already exists in system';
            }else{
                $data['error'] = 1;
                $data['msg'] = 'Added not successfully.';
            }
            echo json_encode($data);
            
        } else { // get view add group
            // get parameters
            $key = (isset($this->params['url']['key']) && $this->params['url']['key'] != '')?$this->params['url']['key']:'';
            // get ajax
            $ajax = isset($this->params['url']['ajax']) ? $this->params['url']['ajax'] : '';
            // pagination
            $limit = (isset($this->params['url']['limit']) && $this->params['url']['limit']) ? $this->params['url']['limit'] : 50;
            $page = (isset($this->params['url']['page']) && $this->params['url']['page'])? $this->params['url']['page'] : 1;
            $start = $limit * ($page - 1);
            // get list dealer in network
            $url = Configure::read('api.api_url').'api/user/getmynetwork';
            $header = array(
                'sessionid:'.$this->Session->read('Auth.User.session_id')
            );
            $body = array(
                'user_id' => $this->Session->read('Auth.User._id'),
                'user_email' =>$this->Session->read('Auth.User.email'),
                'keyword' => $key,
                'type' => 1,
                'limit' => $limit,
                'start' => $start,
                'total' => 1
            );
            $result = json_decode($this->CurlApi->to($url)->withData( json_encode($body))->withOption('HTTPHEADER', $header)->post());
            
            if($result->status == 'success' && $result->networks != null){
                $list = $result->networks;
                $total = $result->count_network;
                $maxpages = $this->Page($total, $limit);
            }else{
                $list = '';
                $maxpages = 0;
                $total = 0;
            }

            $this->set(compact('list','maxpages','total','limit','s_page','key'));
            
            if ($ajax == 0) { // return view add group
                $helpers = array('Common');
                $this->set('title_for_layout', 'Add New Group');
                $this->set('breadcrumb', [
                        (object) ['title' => 'Home'], 
                        (object) ['title' => 'My Groups'], 
                        (object) ['title' => 'Add New Group', 'active' => true]
                ]);
                $this->layout = 'cz_home';
                $this->render('add_group');
            } else { // return list dealer
                $this->layout = null;
                $this->render('add_group_ajax');
            }
        }
    }
    
    public function remove_groupmember_ajax() {
        $this->autoRender = false;
        // get parameters
        $groupmMemberId = $this->request->data['groupmember_id'];
        // call api
        $url = Configure::read('api.api_url').'api/user/deletegroupmember?groupmeber_id=' . $groupmMemberId;
        $header = array(
            'sessionid:'.$this->Session->read('Auth.User.session_id')
        );
        $result = json_decode($this->CurlApi->to($url)->withOption('HTTPHEADER', $header)->get());
        
        if($result->status == 'success'){
            $data['error'] = 0;
        }
        else {
            $data['error'] = 1;
        }
        
        echo json_encode($data);
    }
    
    public function edit_group($id = null){
        $this->autoRender = false;
        if(isset($this->request->data['member_id'])){
            $member_id = $this->request->data['member_id'];
        }else{
            $member_id = '';
        }
        $url_add = Configure::read('api.api_url').'api/user/editgroup';
        $header = array(
            'sessionid:'.$this->Session->read('Auth.User.session_id')
        );
        $body_add = array(
            "group_id" => $id, 
            "name" => $this->request->data['name'],
            "member_id" => $member_id
        );
        $result = json_decode($this->CurlApi->to($url_add)->withData(json_encode($body_add))->withOption('HTTPHEADER', $header)->post());
        if($result->status == 'success'){
            $this->Session->setFlash('Edited successfull!', 'flash_custom', array('type' => 0));
        }else if($result->code == 205){
            $this->Session->setFlash('Group name already exists in system', 'flash_custom', array('type' => 1));
        }else{
            $this->Session->setFlash('Edited not successfully', 'flash_custom', array('type' => 1));
        }
        return $this->redirect('/group_detail/' . $id);
    }
    
    public function deletegroup(){
        $this->autoRender = false;
        $id = $this->request->data['id'];
        $url = Configure::read('api.api_url').'api/user/deletegroups?group_id='.$id;
        $header = array(
            'sessionid:'.$this->Session->read('Auth.User.session_id')
        );
        $result = json_decode($this->CurlApi->to($url)->withOption('HTTPHEADER', $header)->get());
        if($result->status == 'success'){
            $data['error'] = 0;
        }else{
            $data['error'] = 1;
            $data['msg'] = 'Removed successfully';
        }
        echo json_encode($data);
    }
    public function network_del(){
        $this->autoRender = false;
        $id = $this->request->data['id'];
        $url = Configure::read('api.api_url').'api/user/removenetwork';
        $header = array(
            'userid:'.$this->Session->read('Auth.User._id'),
            'sessionid:'.$this->Session->read('Auth.User.session_id')
        );
        $body = array(
            "user_id" => $this->Session->read('Auth.User._id'),
            "member_id" => $id
        );

        $result = json_decode($this->CurlApi->to($url)->withData( json_encode($body))->withOption('HTTPHEADER', $header)->post());
        if($result->status == 'success'){
            $data['error'] = 0;
        }else{
            $data['error'] = 1;
            $data['msg'] = 'Removed not successfully';
            $data['result'] = $result;
        }
        echo json_encode($data);
    }
    
    public function blockuser(){
        $this->autoRender = FALSE;
        $user_id = $this->request->data['id'];
        $url = Configure::read('api.api_url').'api/user/blocknetwork';
        $header = array(
            'userid:'.$this->Session->read('Auth.User._id'),
            'sessionid:'.$this->Session->read('Auth.User.session_id')
        );
        $body = array(
            'user_id' => $this->Session->read('Auth.User._id'),
            'blocker_id' => $user_id
        );
        $result = json_decode($this->CurlApi->to($url)->withData( json_encode($body))->withOption('HTTPHEADER', $header)->post());
        if($result->status == 'success'){
            $data['error'] = 0;
        }else{
            $data['error'] = 1;
        }
        echo json_encode($data);
    }
    public function unblockuser(){
        $this->autoRender = FALSE;
        $user_id = $this->request->data['id'];
        $url = Configure::read('api.api_url').'api/user/unlocknetwork';
        $header = array(
            'userid:'.$this->Session->read('Auth.User._id'),
            'sessionid:'.$this->Session->read('Auth.User.session_id')
        );
        $body = array(
            'user_id' => $this->Session->read('Auth.User._id'),
            'blocker_id' => $user_id
        );
        $result = json_decode($this->CurlApi->to($url)->withData( json_encode($body))->withOption('HTTPHEADER', $header)->post());
        if($result->status == 'success'){
            $data['error'] = 0;
        }else{
            $data['error'] = 1;
        }
        echo json_encode($data);
    }   
    public function Page($total,$limit){
        if($total % $limit != 0){
            if($total / $limit > round($total / $limit)){
                return round($total / $limit) + 1;
            }else{
                return round($total / $limit);
            }

        }else{
            return $total / $limit;
        }
    } 
}

