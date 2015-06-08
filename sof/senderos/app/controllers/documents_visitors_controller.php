<?php
class DocumentsVisitorsController extends AppController {

	var $name = 'DocumentsVisitor';

	function index() {
		$this->DocumentsVisitor->recursive = 0;
		$this->set('documentsVisitors', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid association', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('documentsVisitors', $this->DocumentsVisitor->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->DocumentsVisitor->create();
			if ($this->DocumentsVisitor->save($this->data)) {
				$this->Session->setFlash(__('The association has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The association could not be saved. Please, try again.', true));
			}
		}
		$documents = $this->DocumentsVisitor->Document->find('list');
		$visitors = $this->DocumentsVisitor->Visitor->find('list');
		$this->set(compact('documents', 'visitors'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid association', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->DocumentsVisitor->save($this->data)) {
				$this->Session->setFlash(__('The association has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The association could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->DocumentsVisitor->read(null, $id);
		}
		$documents = $this->DocumentsVisitor->Document->find('list');
		$visitors = $this->DocumentsVisitor->Visitor->find('list');
		$this->set(compact('documents', 'documents'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for association', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->DocumentsLanguage->delete($id)) {
			$this->Session->setFlash(__('Association deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Association was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}

	//nada ...
}
