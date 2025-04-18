<?php
App::uses('AppController', 'Controller');
/**
 * Historylogins Controller
 *
 * @property Historylogin $Historylogin
 * @property PaginatorComponent $Paginator
 */
class HistoryloginsController extends AppController {

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
		$this->Historylogin->recursive = 0;
		$this->set('historylogins', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Historylogin->exists($id)) {
			throw new NotFoundException(__('Invalid historylogin'));
		}
		$options = array('conditions' => array('Historylogin.' . $this->Historylogin->primaryKey => $id));
		$this->set('historylogin', $this->Historylogin->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Historylogin->create();
			if ($this->Historylogin->save($this->request->data)) {
				$this->Session->setFlash(__('The historylogin has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The historylogin could not be saved. Please, try again.'));
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
		if (!$this->Historylogin->exists($id)) {
			throw new NotFoundException(__('Invalid historylogin'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Historylogin->save($this->request->data)) {
				$this->Session->setFlash(__('The historylogin has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The historylogin could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Historylogin.' . $this->Historylogin->primaryKey => $id));
			$this->request->data = $this->Historylogin->find('first', $options);
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
		$this->Historylogin->id = $id;
		if (!$this->Historylogin->exists()) {
			throw new NotFoundException(__('Invalid historylogin'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Historylogin->delete()) {
			$this->Session->setFlash(__('The historylogin has been deleted.'));
		} else {
			$this->Session->setFlash(__('The historylogin could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
