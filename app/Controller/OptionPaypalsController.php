<?php
App::uses('AppController', 'Controller');
/**
 * OptionPaypals Controller
 *
 * @property OptionPaypal $OptionPaypal
 * @property PaginatorComponent $Paginator
 */
class OptionPaypalsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator','CurlApi');

/**
 * index method
 *
 * @return void
 */
	public function index() {
            $this->layout = 'admintrator';
            $url = Configure::read('api.api_url').'api/user/pricesellappadmin';
            $header = array(
                'sessionid:'.$this->Session->read('Auth.User.session_id')
            );
            $body = array(
                'userid' => $this->Session->read('Auth.User._id')
            );
            $result = json_decode($this->CurlApi->to($url)->withData( json_encode($body))->withOption('HTTPHEADER', $header)->post());
            if(isset($result) && $result->options != null){
                $list = $result->options;
            }else{
                $list = '';
            }
            $this->set(compact('list'));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->OptionPaypal->exists($id)) {
			throw new NotFoundException(__('Invalid option paypal'));
		}
		$options = array('conditions' => array('OptionPaypal.' . $this->OptionPaypal->primaryKey => $id));
		$this->set('optionPaypal', $this->OptionPaypal->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
            $this->layout = 'admintrator';
            if($this->request->data){
                $url = Configure::read('api.api_url').'api/user/addpricesellappadmin';
                
                $header = array(
                    'sessionid:'.$this->Session->read('Auth.User.session_id')
                );
                $body = array(
                    'title' => $this->request->data['OptionPaypal']['title'],
                    'number_month' => $this->request->data['OptionPaypal']['number_month'],
                    'price' => $this->request->data['OptionPaypal']['price'],
                );
                $result = json_decode($this->CurlApi->to($url)->withData( json_encode($body))->withOption('HTTPHEADER', $header)->post());
                if($result->status == 'success'){
                    $this->Session->setFlash(__('The option paypal has been saved.'));
                    return $this->redirect(array('action' => 'index'));
                }else{
                    $this->Session->setFlash(__('The option paypal could not be saved. Please, try again.'));
                }
            }
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
            $this->layout = 'admintrator';
            if($this->request->data){
                $url = Configure::read('api.api_url').'api/user/editpricesellappadmin';
                
                $header = array(
                    'sessionid:'.$this->Session->read('Auth.User.session_id')
                );
                $body = array(
                    '_id' => $id,
                    'title' => $this->request->data['OptionPaypal']['title'],
                    'number_month' => $this->request->data['OptionPaypal']['number_month'],
                    'price' => $this->request->data['OptionPaypal']['price'],
                );
                $result = json_decode($this->CurlApi->to($url)->withData( json_encode($body))->withOption('HTTPHEADER', $header)->post());
                if($result->status == 'success'){
                    $this->Session->setFlash(__('The option paypal has been saved.'));
                    return $this->redirect(array('action' => 'index'));
                }else{
                    $this->Session->setFlash(__('The option paypal could not be saved. Please, try again.'));
                }
            }
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->OptionPaypal->id = $id;
		if (!$this->OptionPaypal->exists()) {
			throw new NotFoundException(__('Invalid option paypal'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->OptionPaypal->delete()) {
			$this->Session->setFlash(__('The option paypal has been deleted.'));
		} else {
			$this->Session->setFlash(__('The option paypal could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
