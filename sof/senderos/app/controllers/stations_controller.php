<?php
class StationsController extends AppController {

	var $name = 'Stations';

    function beforeFilter() {
		parent::BeforeFilter();
        $this->Auth->allow('station', 'display');
    }
	
	function index() {
		$this->Station->recursive = 0;
		$this->set('stations', $this->paginate());
		
		if($_SESSION['role'] === 'restricted')
		{
			$this->loadModel('Restriction');
			$this->set('restrictions',$this->Restriction->findAllByClientId($_SESSION['client_id']));
		}
	}

    /*
     * Funcion para index de los visitantes
     * */


    function station() {
        $this->Station->recursive = 0;
        $this->set('stations', $this->paginate());

        if($_SESSION['role'] === 'restricted')
        {
            $this->loadModel('Restriction');
            $this->set('restrictions',$this->Restriction->findAllByClientId($_SESSION['client_id']));
        }
    }

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid station', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('station', $this->Station->read(null, $id));
		
		if($_SESSION['role'] === 'restricted')
		{
			$this->loadModel('Restriction');
			$this->set('restrictions',$this->Restriction->findAllByClientId($_SESSION['client_id']));
		}
	}

	function add() {
		if (!empty($this->data)) {
			$this->Station->create();
			if ($this->Station->save($this->data)) {
				$this->Session->setFlash(__('The station has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The station could not be saved. Please, try again.', true));
			}
		}
		
		if($_SESSION['role'] === 'restricted')
		{
			$this->loadModel('Restriction');
			$this->set('restrictions',$this->Restriction->findAllByClientId($_SESSION['client_id']));
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid station', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Station->save($this->data)) {
				$this->Session->setFlash(__('The station has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The station could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Station->read(null, $id);
			$this->set('station',$this->data );
		}
		
		if($_SESSION['role'] === 'restricted')
		{
			$this->loadModel('Restriction');
			$this->set('restrictions',$this->Restriction->findAllByClientId($_SESSION['client_id']));
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for station', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Station->delete($id)) {
			$this->Session->setFlash(__('Station deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Station was not deleted', true));
		$this->redirect(array('action' => 'index'));
		
		if($_SESSION['role'] === 'restricted')
		{
			$this->loadModel('Restriction');
			$this->set('restrictions',$this->Restriction->findAllByClientId($_SESSION['client_id']));
		}
	}
}
