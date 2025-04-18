<?php
App::uses('AppController', 'Controller');
Configure::load('api');
class PurchaseAppsController extends AppController {

	public $components = array('Paginator','CurlApi');
        public function beforeFilter() {
            parent::beforeFilter();
            $this->Auth->allow(array('getoptionpaypal','in_app_purchase'));
        }
        public function getoptionpaypal(){
            $url_paid = Configure::read('api.api_url').'api/user/getoptionpaypal';
            $return = json_decode($this->CurlApi->to($url_paid)->post())->option_paypals;
            if($return->option_paypals != null){
                return $return->option_paypals;
            }else{
                return null;
            }
        }
        public function index() {
                $this->layout = 'admintrator';
                $limit_u = (isset($this->params['url']['limit']) && $this->params['url']['limit'] != '') ? $this->params['url']['limit'] : '';
                if(isset($this->params['url']['page'])){
                    $page = $this->params['url']['page'];
                }else{
                    $page = 0;
                }
                $limit = ($limit_u != '')? $limit_u : 20;
                $start = ($page == '' || $page == 1) ? 0 : $limit * ($page - 1);
                $url = Configure::read('api.api_url').'api/user/getpurchaseappsadmin';
                $header = array(
                    'sessionid:'.CakeSession::read('Auth.User.session_id')
                );

                $body = array(
                    "user_id" => CakeSession::read('Auth.User._id'),
                    'start' => $start,
                    "limit" => $limit
                );
                $result = json_decode($this->CurlApi->to($url)->withData( json_encode($body))->withOption('HTTPHEADER', $header)->post());
                if($result != null){
                    $l = $result->users;
                    $total = $result->total;
                    $total_ = count($l);
                    for($i = 0; $i < $total_ ; $i++){
                        $ar[] = $l[$i];
                    }
                    if(isset($ar)){
                        $list = $ar;
                        $maxpages = $this->Page($total, $limit);
                    }else{
                        $list = '';
                        $maxpages = 0;
                    }
                }else{
                    $list = '';
                    $maxpages = 0;
                    $total = 0;
                }
                $this->set(compact(array('list','maxpages','total','limit')));
            
	}
        
        public function in_app_purchase() {
            //$helpers = array('Common');
            $this->set('title_for_layout', 'In-app Purchase');
            $this->layout = 'cz_home';

            //get remain time
            $url = Configure::read('api.api_url') . 'api/user/remaintimeapp';
            $header = array(
                'sessionid:' . CakeSession::read('Auth.User.session_id')
            );
            $body = array(
                "user_id" => CakeSession::read('Auth.User._id')
            );
            $rs = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());
            $remainTime = null;
            if (isset($rs->retime)) {
                $remainTime = $rs->retime;
            }
            $this->set(compact('remainTime', 'paid', 'purchase'));
        }
        
        public function view($id = null) {
		if (!$this->PurchaseApp->exists($id)) {
			throw new NotFoundException(__('Invalid purchase app'));
		}
		$options = array('conditions' => array('PurchaseApp.' . $this->PurchaseApp->primaryKey => $id));
		$this->set('purchaseApp', $this->PurchaseApp->find('first', $options));
	}

	public function add() {
		if ($this->request->is('post')) {
			$this->PurchaseApp->create();
			if ($this->PurchaseApp->save($this->request->data)) {
				$this->Session->setFlash(__('The purchase app has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The purchase app could not be saved. Please, try again.'));
			}
		}
		$users = $this->PurchaseApp->User->find('list');
		$codes = $this->PurchaseApp->Code->find('list');
		$this->set(compact('users', 'codes'));
	}

	public function edit($id = null) {
		if (!$this->PurchaseApp->exists($id)) {
			throw new NotFoundException(__('Invalid purchase app'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->PurchaseApp->save($this->request->data)) {
				$this->Session->setFlash(__('The purchase app has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The purchase app could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('PurchaseApp.' . $this->PurchaseApp->primaryKey => $id));
			$this->request->data = $this->PurchaseApp->find('first', $options);
		}
		$users = $this->PurchaseApp->User->find('list');
		$codes = $this->PurchaseApp->Code->find('list');
		$this->set(compact('users', 'codes'));
	}

	public function delete($id = null) {
		$this->PurchaseApp->id = $id;
		if (!$this->PurchaseApp->exists()) {
			throw new NotFoundException(__('Invalid purchase app'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->PurchaseApp->delete()) {
			$this->Session->setFlash(__('The purchase app has been deleted.'));
		} else {
			$this->Session->setFlash(__('The purchase app could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
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
