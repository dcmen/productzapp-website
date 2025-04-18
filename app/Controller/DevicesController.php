<?php
App::uses('AppController', 'Controller');
Configure::load('api');
class DevicesController extends AppController {

	public $components = array('Paginator','CurlApi');
        
        public function beforeFilter() {
            parent::beforeFilter();
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
            $url = Configure::read('api.api_url').'api/user/redeemcodeactiveadmin';
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
                $l = $result->codes;
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
        function create_code_active(){
            $this->layout = null;
            $this->autoRender = false;
            $url = Configure::read('api.api_url').'api/user/createcodeactive';
            $header = array(
                'sessionid:'.CakeSession::read('Auth.User.session_id')
            );

            $body = array(
                "user_id" => CakeSession::read('Auth.User._id')
            );
            $result = json_decode($this->CurlApi->to($url)->withData( json_encode($body))->withOption('HTTPHEADER', $header)->post());
            if($result->status == 'success'){
                $data['msg'] = 'Create Code OK';
            }
            echo json_encode($data);
        }
        function code_random($length = 6) {
            $this->layout = null;
            $this->autoRender = FALSE;
            $chars = "ABCDEFGHIJKMNOQRSTUVWXYZ0123456789";
            srand((double)microtime()*1000000);
            $i = 0;
            $pass = '' ;
            while ($i < $length) {
                $num = rand() % 33;
                $tmp = substr($chars, $num, 1);
                $pass = $pass . $tmp;
                $i++;
            }
            return $pass;
        }

        public function view($id = null) {
		if (!$this->RedeemCode->exists($id)) {
			throw new NotFoundException(__('Invalid redeem code'));
		}
		$options = array('conditions' => array('RedeemCode.' . $this->RedeemCode->primaryKey => $id));
		$this->set('redeemCode', $this->RedeemCode->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->RedeemCode->create();
			if ($this->RedeemCode->save($this->request->data)) {
				$this->Session->setFlash(__('The redeem code has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The redeem code could not be saved. Please, try again.'));
			}
		}
		$users = $this->RedeemCode->User->find('list');
		$this->set(compact('users'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->RedeemCode->exists($id)) {
			throw new NotFoundException(__('Invalid redeem code'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->RedeemCode->save($this->request->data)) {
				$this->Session->setFlash(__('The redeem code has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The redeem code could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('RedeemCode.' . $this->RedeemCode->primaryKey => $id));
			$this->request->data = $this->RedeemCode->find('first', $options);
		}
		$users = $this->RedeemCode->User->find('list');
		$this->set(compact('users'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->RedeemCode->id = $id;
		if (!$this->RedeemCode->exists()) {
			throw new NotFoundException(__('Invalid redeem code'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->RedeemCode->delete()) {
			$this->Session->setFlash(__('The redeem code has been deleted.'));
		} else {
			$this->Session->setFlash(__('The redeem code could not be deleted. Please, try again.'));
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
