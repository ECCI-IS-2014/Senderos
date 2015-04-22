<?php
class TrailsController extends AppController {

	var $name = 'Trails';

	function index() {
		$this->Trail->recursive = 0;
		$this->set('trails', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid trail', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('trail', $this->Trail->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Trail->create();
			if ($this->Trail->save($this->data)) {
				$this->Session->setFlash(__('The trail has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The trail could not be saved. Please, try again.', true));
			}
		}
		$stations = $this->Trail->Station->find('list');
		$this->set(compact('stations'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid trail', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Trail->save($this->data)) {
				$this->Session->setFlash(__('The trail has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The trail could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Trail->read(null, $id);
		}
		$stations = $this->Trail->Station->find('list');
		$this->set(compact('stations'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for trail', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Trail->delete($id)) {
			$this->Session->setFlash(__('Trail deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Trail was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
