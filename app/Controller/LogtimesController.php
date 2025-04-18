<?php
App::uses('AppController', 'Controller');
Configure::load('api');
class LogtimesController extends AppController {

	public $components = array('Paginator','CurlApi');

	public function index() {
            $this->layout = 'admintrator';
            if(isset($this->params['url']['date_star'])){
                $date_star = strtotime($this->params['url']['date_star']);
            }else{
                $date_star = strtotime('01-' . date('m-Y') . ' 0:0:0');
            }
            if(isset($this->params['url']['date_end'])){
                $date_end = strtotime($this->params['url']['date_end']);
            }else{
                $date_end = strtotime(date('d-m-Y') . ' 23:59:0');
            }
            $this->set(compact('date_star','date_end'));
	}
        
        public function CountLoginTime($time,$os){
            $url = Configure::read('api.api_url').'api/user/viewlogtimeadmin';
            $header = array(
                'sessionid:'.CakeSession::read('Auth.User.session_id')
            );
            $body = array(
                "user_id" => CakeSession::read('Auth.User._id'),
                "logtime" => $time,
                "os" => $os
            );

            $result = json_decode($this->CurlApi->to($url)->withData( json_encode($body))->withOption('HTTPHEADER', $header)->post());
            return $result->total;
        }
        public function view($id = null) {
		if (!$this->Logtime->exists($id)) {
			throw new NotFoundException(__('Invalid logtime'));
		}
		$options = array('conditions' => array('Logtime.' . $this->Logtime->primaryKey => $id));
		$this->set('logtime', $this->Logtime->find('first', $options));
	}

	public function add() {
		if ($this->request->is('post')) {
			$this->Logtime->create();
			if ($this->Logtime->save($this->request->data)) {
				$this->Session->setFlash(__('The logtime has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The logtime could not be saved. Please, try again.'));
			}
		}
		$users = $this->Logtime->User->find('list');
		$this->set(compact('users'));
	}

	public function edit($id = null) {
		if (!$this->Logtime->exists($id)) {
			throw new NotFoundException(__('Invalid logtime'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Logtime->save($this->request->data)) {
				$this->Session->setFlash(__('The logtime has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The logtime could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Logtime.' . $this->Logtime->primaryKey => $id));
			$this->request->data = $this->Logtime->find('first', $options);
		}
		$users = $this->Logtime->User->find('list');
		$this->set(compact('users'));
	}

	public function delete($id = null) {
		$this->Logtime->id = $id;
		if (!$this->Logtime->exists()) {
			throw new NotFoundException(__('Invalid logtime'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Logtime->delete()) {
			$this->Session->setFlash(__('The logtime has been deleted.'));
		} else {
			$this->Session->setFlash(__('The logtime could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
