<?php
class RestrictionsController extends AppController {
	var $name = 'Restrictions';
    var $uses = array('Restriction', 'Client', 'Station', 'Trail');

    function index() {
        $this->Restriction->recursive = 0;
        $this->set('restrictions', $this->paginate());
        //$restrictions = $this->Restriction->find('all');
        //$this->set(compact('restrictions'));
    }

    function add() {
        if (!empty($this->data)) {
            $this->Restriction->create();
            if ($this->Restriction->save($this->data)) {
                $this->Session->setFlash(__('The restriction has been saved', true));
                $this->redirect(array('action' => 'add'));
            } else {
                $this->Session->setFlash(__('The restriction could not be saved. Please, try again.', true));
            }
        }
        //$this->set('restrictions', $this->Restriction->find('all', array('order' => array('Restriction.model ASC'), 'conditions' => array('Restriction.client_id' => $this->Client->id))));
        $this->set('restrictions', $this->Restriction->find('all'));//, array('order' => array('Restriction.model ASC'))));
        $stations = $this->Station->find('list');//, array('conditions'=>array('Client.role =' => 'cust')));
        $this->set(compact('stations'));
        $trails = $this->Trail->find('list');// array('conditions'=>array('Client.role =' => 'cust')));
        $this->set(compact('trails'));
        $clients = $this->Client->find('list', array('conditions'=>array('Client.role =' => 'cust')));
        $this->set(compact('clients'));
    }

    function edit($id = null) {
        if (!$id && empty($this->data)) {
            $this->Session->setFlash(__('Invalid restriction', true));
            $this->redirect(array('action' => 'index'));
        }
        if (!empty($this->data)) {
            if ($this->Restriction->save($this->data)) {
                $this->Session->setFlash(__('The restriction has been saved', true));
                return $this->redirect(array('action' => 'index', $this->Restriction->id));
            } else {
                $this->Session->setFlash(__('The restriction could not be saved. Please, try again.', true));
            }
        }
        if (empty($this->data)) {
            $this->data = $this->Restriction->read(null, $id);
        }
        //$this->set('restrictions', $this->Restriction->find('all', array('order' => array('Restriction.model ASC'), 'conditions' => array('Restriction.client_id' => $this->Client->id))));
        $this->set('restrictions', $this->Restriction->find('all')); //, array('order' => array('Restriction.model ASC'))));
        $stations = $this->Station->find('list');//, array('conditions'=>array('Client.role =' => 'cust')));
        $this->set(compact('stations'));
        $trails = $this->Trail->find('list');//, array('conditions'=>array('Client.role =' => 'cust')));
        $this->set(compact('trails'));
        $clients = $this->Client->find('list', array('conditions'=>array('Client.role =' => 'cust')));
        $this->set(compact('clients'));
    }

    function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for restriction', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Restriction->delete($id)) {
			$this->Session->setFlash(__('Restriction deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Restriction was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}

}
