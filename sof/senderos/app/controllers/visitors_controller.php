<?php
class VisitorsController extends AppController {

	var $name = 'Visitors';

	function index() {
		$this->Visitor->recursive = 0;
		$this->set('visitors', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid visitor', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('visitor', $this->Visitor->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Visitor->create();
            $tipo = $this->data['Visitor']['role'];
            switch($tipo){
                case 0:
                    $tipo = 'Tourist';
                    break;
                case 1:
                    $tipo = 'Student';
                    break;
                case 2:
                    $tipo = 'Scientific';
                    break;
            }
            $this->data['Visitor']['role'] = $tipo;
			if ($this->Visitor->save($this->data)) {
				$this->Session->setFlash(__('The association has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The association could not be saved. Please, try again.', true));
			}
		}
		$documents = $this->Visitor->Document->find('list');
		$this->set(compact('documents'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid visitor', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
            $tipo = $this->data['Visitor']['role'];
            switch($tipo){
                case 0:
                    $tipo = 'Tourist';
                    break;
                case 1:
                    $tipo = 'Student';
                    break;
                case 2:
                    $tipo = 'Scientific';
                    break;
            }
            $this->data['Visitor']['role'] = $tipo;
			if ($this->Visitor->save($this->data)) {
				$this->Session->setFlash(__('The association has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The association could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Visitor->read(null, $id);
		}
		$documents = $this->Visitor->Document->find('list');
		$this->set(compact('documents'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for association', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Visitor->delete($id)) {
			$this->Session->setFlash(__('Association deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Association was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
