<?php
App::uses('AppController', 'Controller');
/**
 * DataSourceCars Controller
 *
 * @property DataSourceCar $DataSourceCar
 * @property PaginatorComponent $Paginator
 */
class DataSourceCarsController extends AppController {

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
		$this->DataSourceCar->recursive = 0;
		$this->set('dataSourceCars', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->DataSourceCar->exists($id)) {
			throw new NotFoundException(__('Invalid data source car'));
		}
		$options = array('conditions' => array('DataSourceCar.' . $this->DataSourceCar->primaryKey => $id));
		$this->set('dataSourceCar', $this->DataSourceCar->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->DataSourceCar->create();
			if ($this->DataSourceCar->save($this->request->data)) {
				$this->Session->setFlash(__('The data source car has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The data source car could not be saved. Please, try again.'));
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
		if (!$this->DataSourceCar->exists($id)) {
			throw new NotFoundException(__('Invalid data source car'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->DataSourceCar->save($this->request->data)) {
				$this->Session->setFlash(__('The data source car has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The data source car could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('DataSourceCar.' . $this->DataSourceCar->primaryKey => $id));
			$this->request->data = $this->DataSourceCar->find('first', $options);
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
		$this->DataSourceCar->id = $id;
		if (!$this->DataSourceCar->exists()) {
			throw new NotFoundException(__('Invalid data source car'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->DataSourceCar->delete()) {
			$this->Session->setFlash(__('The data source car has been deleted.'));
		} else {
			$this->Session->setFlash(__('The data source car could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
