<?php
class VisitorsController extends AppController {

	var $name = 'Visitors';

	function beforeFilter()
	    {
		parent::BeforeFilter();
		$this->Auth->allow('display', 'getvisitors', 'getid', 'isavailable');
	    }

	    function getvisitors()
	    {
		return $this->Visitor->find('all');
	    }
	
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
			if ($this->Visitor->save($this->data)) {
				$this->Session->setFlash(__('The visitor has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The visitor could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid visitor', true));
			$this->redirect(array('action' => 'index'));
		}
        $vi = $this->Visitor->findById($id);
        if (!$vi) {
            $this->Session->setFlash(__('Invalid visitor', true));
            $this->redirect(array('action' => 'index'));
        }
		if (!empty($this->data)) {
			if ($this->Visitor->save($this->data)) {
				$this->Session->setFlash(__('The visitor has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The visitor could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Visitor->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for visitor', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Visitor->delete($id)) {
			$this->Session->setFlash(__('Visitor deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Visitor was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}

	// mando el rol, devuelve el id
	function getid($role)
	{
		$id = null;
		$visitors = $this->Visitor->findAllByRole($role);
		foreach($visitors as $visitor):
			$id = $visitor['Visitor']['id'];
			break;
		endforeach;
		return $id;
	}

	// pregunta si un visitor esta ligado a un documento
	function isavailable($thisvisitor, $document_id)
	{
		$this->loadModel('DocumentsVisitor');

		$visitors = $this->DocumentsVisitor->findAllByDocumentId($document_id);
		
		foreach($visitors as $visitor):
			if($visitor['Visitor']['role'] === $thisvisitor)
				return true;
		endforeach;

		return false;
	}
	//nada ...
}
