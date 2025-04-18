<?php
App::uses('AppController', 'Controller');
/**
 * RedeemCodes Controller
 *
 * @property RedeemCode $RedeemCode
 * @property PaginatorComponent $Paginator
 */
class RedeemCodesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');
        
        public function beforeFilter() {
            parent::beforeFilter();
            $this->Auth->allow(array('view_code','add_code'));
        }
/**
 * index method
 *
 * @return void
 */
	public function index() {
            $this->layout = 'admintrator';
            $this->Paginator->settings = array(
                'recursive' => 1,
                'limit' => 20,
                'maxLimit' => 100,
                'order' => 'RedeemCode.user_id DESC'
            );
            $this->set('redeemCodes', $this->Paginator->paginate());
	}
        function Create_code(){
            $this->layout = null;
            $this->autoRender = false;
            //$error = 0;
            for($i=0;$i <= 1000;$i++){
                $this->RedeemCode->create();
                $pass = $this->code_random(6);
                $check = $this->RedeemCode->findByCode($pass);
                if(!$check){
                    $arr['code'] = $pass;
                    $this->RedeemCode->save($arr);
                    //$error++;
                }
            }
            $data['msg'] = 'Create Code OK';
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
        
        public function view_code(){
            $this->layout = null;
            $this->autoRender = FALSE;
            $code = $this->RedeemCode->find('first',array('conditions' => array(
                'RedeemCode.user_id' => ''
            ),
                'fields' => array('RedeemCode.code')));
            if($code){
                $data['code'] = $code['RedeemCode']['code'];
            }else{
                $data['code'] = '';
            }
            echo json_encode($data);
        }
        
        public function add_code(){
            $this->layout = null;
            $this->autoRender = FALSE;
            $user_id = ($this->Session->read('Auth.User.id'))?$this->Session->read('Auth.User.id'):$this->Session->read('User.id');
            if($this->request->data){
                $code = $this->request->data['code'];
                $check = $this->RedeemCode->find('first',array(
                        'conditions' => array(
                        'RedeemCode.code' => $code,
                        'RedeemCode.user_id' => '',
                        ),
                        'fields' => array('RedeemCode.id','RedeemCode.code','RedeemCode.user_id')
                ));
                
                $this->loadModel('PurchaseApp');
                $check_user = $this->PurchaseApp->find('first',array(
                        'conditions' => array(
                        'PurchaseApp.user_id' => $user_id,
                        ),

                ));
                
                if($check && !$check_user){
                    $arr['id'] = $check['RedeemCode']['id'];
                    $arr['user_id'] = $this->Session->read('User.id');
                    
                    $this->loadModel('User');
                    $user_info = $this->User->find('first', array(
                        'conditions' => array(
                            'User.id' => $this->Session->read('User.id'),
                            )
                        )
                    );
                    if($this->RedeemCode->save($arr)){
                        $arr_p['redeem_code_id'] = $this->RedeemCode->id;
                        $arr_p['user_id'] = $user_info['User']['id'];
                        $arr_p['purchased_date'] = time();
                        $arr_p['expired_date'] = time() + 30*86400;
                        $this->PurchaseApp->create();
                        $this->PurchaseApp->save($arr_p);
                        
                        
                        $this->Auth->Session->write('Auth.User.id',$user_info['User']['id']);
                        $this->Auth->Session->write('Auth.User.email',$user_info['User']['email']);
                        $this->Auth->Session->write('Auth.User.name',$user_info['User']['name']);
                        $this->Auth->Session->write('Auth.User.avatar',$user_info['User']['avatar_file_name']);
                        $this->Auth->Session->write('Auth.User.license_number',$user_info['User']['license_number']);
                        
                        $data['error'] = 0;
                    }else{
                        $data['error'] = 1;
                        $data['msg'] = 'Save not sussesfull';
                    }
                    
                }else if($check && $check_user['PurchaseApp']['redeem_code_id'] == ''){
                    $arr['id'] = $check['RedeemCode']['id'];
                    $arr['user_id'] = $user_id;
                    if($this->RedeemCode->save($arr)){
                        $data['error'] = 0;
                        $arr_p['id'] = $check_user['PurchaseApp']['id'];
                        $arr_p['redeem_code_id'] = $check['RedeemCode']['id'];
                        $arr_p['expired_date'] = $check_user['PurchaseApp']['expired_date'] + 30*86400;
                        $this->PurchaseApp->save($arr_p);
                    }else{
                        $data['error'] = 1;
                        $data['msg'] = 'Save not sussesfull';
                    }
                }else{
                    $data['error'] = 1;
                    $data['msg'] = 'Code is wrong.Please check back information!';
                }
            }else{
                $data['error'] = 1;
                $data['msg'] = 'Not exits value';
            }
            echo json_encode($data);
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
}
