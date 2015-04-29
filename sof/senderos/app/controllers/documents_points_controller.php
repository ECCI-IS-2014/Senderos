<?php
class DocumentsPointsController extends AppController {

	var $name = 'DocumentsPoints';

	function index() {
		$this->DocumentsPoint->recursive = 0;
		$this->set('documentsPoints', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid association', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('documentsPoint', $this->DocumentsPoint->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->DocumentsPoint->create();
			if ($this->DocumentsPoint->save($this->data)) {
				$this->Session->setFlash(__('The association has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The association could not be saved. Please, try again.', true));
			}
		}
		$documents = $this->DocumentsPoint->Document->find('list');
		$points = $this->DocumentsPoint->Point->find('list');
		$this->set(compact('documents', 'points'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid association', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->DocumentsPoint->save($this->data)) {
				$this->Session->setFlash(__('The association has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The association could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->DocumentsPoint->read(null, $id);
		}
		$documents = $this->DocumentsPoint->Document->find('list');
		$points = $this->DocumentsPoint->Point->find('list');
		$this->set(compact('documents', 'points'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for association', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->DocumentsPoint->delete($id)) {
			$this->Session->setFlash(__('Association deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Association was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
