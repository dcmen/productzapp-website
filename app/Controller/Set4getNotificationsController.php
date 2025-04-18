<?php
App::uses('AppController', 'Controller');
/**
 * Set4getNotifications Controller
 *
 * @property Set4getNotification $Set4getNotification
 * @property PaginatorComponent $Paginator
 */
class Set4getNotificationsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Set4getNotification->recursive = 0;
		$this->set('set4getNotifications', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Set4getNotification->exists($id)) {
			throw new NotFoundException(__('Invalid set4get notification'));
		}
		$options = array('conditions' => array('Set4getNotification.' . $this->Set4getNotification->primaryKey => $id));
		$this->set('set4getNotification', $this->Set4getNotification->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Set4getNotification->create();
			if ($this->Set4getNotification->save($this->request->data)) {
				$this->Session->setFlash(__('The set4get notification has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The set4get notification could not be saved. Please, try again.'));
			}
		}
		$users = $this->Set4getNotification->User->find('list');
		$cars = $this->Set4getNotification->Car->find('list');
		$set4gets = $this->Set4getNotification->Set4get->find('list');
		$this->set(compact('users', 'cars', 'set4gets'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Set4getNotification->exists($id)) {
			throw new NotFoundException(__('Invalid set4get notification'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Set4getNotification->save($this->request->data)) {
				$this->Session->setFlash(__('The set4get notification has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The set4get notification could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Set4getNotification.' . $this->Set4getNotification->primaryKey => $id));
			$this->request->data = $this->Set4getNotification->find('first', $options);
		}
		$users = $this->Set4getNotification->User->find('list');
		$cars = $this->Set4getNotification->Car->find('list');
		$set4gets = $this->Set4getNotification->Set4get->find('list');
		$this->set(compact('users', 'cars', 'set4gets'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Set4getNotification->id = $id;
		if (!$this->Set4getNotification->exists()) {
			throw new NotFoundException(__('Invalid set4get notification'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Set4getNotification->delete()) {
			$this->Session->setFlash(__('The set4get notification has been deleted.'));
		} else {
			$this->Session->setFlash(__('The set4get notification could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
