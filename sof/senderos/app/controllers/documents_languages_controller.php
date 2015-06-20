<?php
class DocumentsLanguagesController extends AppController {

	var $name = 'DocumentsLanguages';

	function index() {
		$this->DocumentsLanguage->recursive = 0;
		$this->set('documentsLanguages', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid association', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('documentsLanguages', $this->DocumentsLanguage->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->DocumentsLanguage->create();
			if ($this->DocumentsLanguage->save($this->data)) {
				$this->Session->setFlash(__('The association has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The association could not be saved. Please, try again.', true));
			}
		}
		$documents = $this->DocumentsLanguage->Document->find('list');
		$languages = $this->DocumentsLanguage->Language->find('list');
		$this->set(compact('documents', 'languages'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid association', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->DocumentsLanguage->save($this->data)) {
				$this->Session->setFlash(__('The association has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The association could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->DocumentsLanguage->read(null, $id);
		}
		$documents = $this->DocumentsLanguage->Document->find('list');
		$languages = $this->DocumentsLanguage->Language->find('list');
		$this->set(compact('documents', 'languages'));
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
