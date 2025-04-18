<?php
App::uses('AppController', 'Controller');
/**
 * FollowedCars Controller
 *
 * @property FollowedCar $FollowedCar
 * @property PaginatorComponent $Paginator
 */
class FollowedCarsController extends AppController {

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
		$this->FollowedCar->recursive = 0;
		$this->set('followedCars', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->FollowedCar->exists($id)) {
			throw new NotFoundException(__('Invalid followed car'));
		}
		$options = array('conditions' => array('FollowedCar.' . $this->FollowedCar->primaryKey => $id));
		$this->set('followedCar', $this->FollowedCar->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->FollowedCar->create();
			if ($this->FollowedCar->save($this->request->data)) {
				$this->Session->setFlash(__('The followed car has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The followed car could not be saved. Please, try again.'));
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
		if (!$this->FollowedCar->exists($id)) {
			throw new NotFoundException(__('Invalid followed car'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->FollowedCar->save($this->request->data)) {
				$this->Session->setFlash(__('The followed car has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The followed car could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('FollowedCar.' . $this->FollowedCar->primaryKey => $id));
			$this->request->data = $this->FollowedCar->find('first', $options);
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
		$this->FollowedCar->id = $id;
		if (!$this->FollowedCar->exists()) {
			throw new NotFoundException(__('Invalid followed car'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->FollowedCar->delete()) {
			$this->Session->setFlash(__('The followed car has been deleted.'));
		} else {
			$this->Session->setFlash(__('The followed car could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
