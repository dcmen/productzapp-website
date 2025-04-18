<?php
App::uses('AppController', 'Controller');
Configure::load('api');
class TransfersController extends AppController {
    public $components = array('Paginator','CurlApi');
    public function index() {
        $this->set('title_for_layout','Transfers');
        $this->layout = 'home';
        $url = Configure::read('api.api_url').'api/user/gettransfernewversion';
        $header = array(
            'sessionid:'.$this->Session->read('Auth.User.session_id')
        );
        $body = array(
            "user_id" => CakeSession::read('Auth.User._id'),
            "time_zones" => "+07:00"
        );
        $result = json_decode($this->CurlApi->to($url)->withData( json_encode($body))->withOption('HTTPHEADER', $header)->post());

        $type = (isset($this->params['url']['type']))?$this->params['url']['type']:'transferring';
        if($type == 'transferring' || !$type){
            $transfer = $result->transfer->transfering;
        }else{
            $transfer = $result->transfer->transfered;
        }
        if($transfer != null){
            foreach($transfer as $rs):
                $list[] = $rs->cars;
                $receiver = $rs->other_transfers_info;
            endforeach;
        }else{
            $list = null;
            $receiver = null;
        }
        $this->set(compact(array('type','list','receiver')));
    }
  
}
