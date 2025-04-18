<?php

App::uses('AppController', 'Controller', 'Lib','Html');
Configure::load('api');
class InviteNetworksController extends AppController {

    public $components = array('Curl', 'Paginator', 'RequestHandler','CurlApi');
    public $helpers = array(
        'Layout',
        'Html'
    );
    
    public function resendInviteNetwork() {
        $this->autoRender = false;
        $this->layout = null;
        
        if ($this->request->data) {
            // call api
            $url = Configure::read('api.api_url').'api/user/reinvitenetwork';
            $header = array(
                'sessionid:'.$this->Session->read('Auth.User.session_id'),
            );
            $body = array(               
                "invite_id" => $this->request->data['invite_id'],
                "sender_id" => $this->request->data['sender_id'],
                "sender_name" => $this->request->data['sender_name'],
                "request_email" => $this->request->data['request_email']
            );
            $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());
            if($result && isset($result->status) && $result->status == 'success'){
                $data['error'] = 0;
            }else{
                $data['error'] = 1;
            }
        } else {
            $data['error'] = 1;
            $data['msg'] = "Error";
        }
        
        echo json_encode($data);
    }
    
    public function add_network() {
        $this->autoRender = false;
        if ($this->request->data) {
            $url = Configure::read('api.api_url').'api/user/invitenetwork';
            $header = array(
                'sessionid:'.$this->Session->read('Auth.User.session_id'),
            );
            $request_id = $this->request->data['request_id'];
            //get user request
            $url_rq = Configure::read('api.api_url').'api/user/getuserbyid?user_id='.$request_id;
            $result_rq = json_decode($this->CurlApi->to($url_rq)->withOption('HTTPHEADER', $header)->get())->user;
            $arr_e[] = $result_rq->email;
            $body = array(               
                "sender_id" => $this->Session->read('Auth.User._id'),
                "sender_name" => $this->Session->read('Auth.User.name'),
                "arr_request_email" => $arr_e
            );

            $result = json_decode($this->Curl->_curl_header_body($url,$header,$body));	
            if($result->status == 'success'){
                $data['error'] = 0;
            }else{
                $data['error'] = 1;
            }
        } else {
            $data['error'] = 1;
            $data['msg'] = "Error";
        }
        
        echo json_encode($data);
    }

    public function dis_add_network() {
        $this->autoRender = false;
        if ($this->request->data) {
            $request_id = $this->request->data['request_id'];
            $user_id = $this->request->data['user_id'];
            //$url = Configure::read('api.api_url').'api/user/cancelinvitenetwork?invite_id=gsdgsdgsdgwetweerw';
            
            $this->loadModel('User');
            $request = $this->User->find('first',array(
                'conditions' => array(
                    'User.id' => $request_id),
                'fields' => array('User.id','User.email')
                )
            );
            $this->loadModel('Network');
            $check = $this->Network->find('first', array('conditions' => array(
                    'Network.user_id' => $user_id  ,
                    'Network.member_id' => $request_id,
            )));
            if ($check) {
                $this->Network->Delete($check['Network']['id']);
                $data['error'] = 0;
            } else {
                $data['error'] = 1;
            }
        } else {
            $data['error'] = 1;
        }
        echo json_encode($data);
    }
    
    public function delete(){
        $this->autoRender = false;
        if($this->request->data){
            $id = $this->request->data['id'];
            $url = Configure::read('api.api_url').'api/user/cancelinvitenetwork?invite_id='.$id;
            $header = array(
                'sessionid:'.$this->Session->read('Auth.User.session_id'),
            );
            $result = json_decode($this->CurlApi->to($url)->withOption('HTTPHEADER', $header)->get());
        }
    }
    public function accept_invite(){
        $this->autoRender = false;
        
        if($this->request->data){
            $url = Configure::read('api.api_url').'api/user/acceptinvitenetwork';
            $header = array(
                'sessionid:'.$this->Session->read('Auth.User.session_id')
            );
            $body = array(
                'dealer_email' => $this->Session->read('Auth.User.email'),
                'requester_id' => $this->request->data['id'],
                'requester_email' => $this->request->data['request_email'],
                'dealer_name' => $this->Session->read('Auth.User.name'),
                'dealer_id' => $this->Session->read('Auth.User._id'),
            );
        
            $result = json_decode($this->CurlApi->to($url)->withData( json_encode($body))->withOption('HTTPHEADER', $header)->post());
        }
    }
}

