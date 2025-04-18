<?php
App::uses('AppController', 'Controller');
/**
 * Setandforgets Controller
 *
 * @property Setandforget $Setandforget
 * @property PaginatorComponent $Paginator
 */
class SetandforgetsController extends AppController {

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
		$this->Setandforget->recursive = 0;
		$this->set('setandforgets', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Setandforget->exists($id)) {
			throw new NotFoundException(__('Invalid setandforget'));
		}
		$options = array('conditions' => array('Setandforget.' . $this->Setandforget->primaryKey => $id));
		$this->set('setandforget', $this->Setandforget->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Setandforget->create();
			if ($this->Setandforget->save($this->request->data)) {
				$this->Session->setFlash(__('The setandforget has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The setandforget could not be saved. Please, try again.'));
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
		if (!$this->Setandforget->exists($id)) {
			throw new NotFoundException(__('Invalid setandforget'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Setandforget->save($this->request->data)) {
				$this->Session->setFlash(__('The setandforget has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The setandforget could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Setandforget.' . $this->Setandforget->primaryKey => $id));
			$this->request->data = $this->Setandforget->find('first', $options);
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
		$this->Setandforget->id = $id;
		if (!$this->Setandforget->exists()) {
			throw new NotFoundException(__('Invalid setandforget'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Setandforget->delete()) {
			$this->Session->setFlash(__('The setandforget has been deleted.'));
		} else {
			$this->Session->setFlash(__('The setandforget could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
