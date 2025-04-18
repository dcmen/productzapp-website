<?php
App::uses('AppController', 'Controller');
Configure::load('api');
class CustomersController extends AppController {

	public $components = array('Paginator','CurlApi');

	public function index() {
		$this->Customer->recursive = 0;
		$this->set('customers', $this->Paginator->paginate());
	}
        public function delcustomer(){
            $this->autoRender = FALSE;
            if($this->request->data){
                $str_id = rtrim($this->request->data['str_id'],"|");
                $arr = explode( '|', $str_id);
                $customer = "[";
                for($i=0;$i<sizeof($arr);$i++){
                    if($i != sizeof($arr) - 1){
                        $customer .= '"'.$arr[$i].'",';
                    }else{
                        $customer .= '"'.$arr[$i].'"';
                    }
                }
                $customer .= "]";
                $url = Configure::read('api.api_url').'api/user/delscustomer?customers='.$customer;
                $header = array(
                    'sessionid:'.$this->Session->read('Auth.User.session_id')
                );
                $result = json_decode($this->CurlApi->to($url)->withOption('HTTPHEADER', $header)->get());
                if ($result && $result->status && $result->status == 'success') {
                    echo json_encode(['error' => 0]);
                }
                else {
                    echo json_encode(['error' => 1]);
                }
            }
        }


        public function view($id = null) {
		if (!$this->Customer->exists($id)) {
			throw new NotFoundException(__('Invalid customer'));
		}
		$options = array('conditions' => array('Customer.' . $this->Customer->primaryKey => $id));
		$this->set('customer', $this->Customer->find('first', $options));
	}

	public function add() {
		if ($this->request->is('post')) {
			$this->Customer->create();
			if ($this->Customer->save($this->request->data)) {
				$this->Session->setFlash(__('The customer has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The customer could not be saved. Please, try again.'));
			}
		}
	}

	public function edit($id = null) {
		if (!$this->Customer->exists($id)) {
			throw new NotFoundException(__('Invalid customer'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Customer->save($this->request->data)) {
				$this->Session->setFlash(__('The customer has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The customer could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Customer.' . $this->Customer->primaryKey => $id));
			$this->request->data = $this->Customer->find('first', $options);
		}
	}

	public function delete($id = null) {
		$this->Customer->id = $id;
		if (!$this->Customer->exists()) {
			throw new NotFoundException(__('Invalid customer'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Customer->delete()) {
			$this->Session->setFlash(__('The customer has been deleted.'));
		} else {
			$this->Session->setFlash(__('The customer could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
