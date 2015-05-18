<?php
class PointsController extends AppController {

	var $name = 'Points';
	
	var $helpers = array('Html','Ajax','Javascript');
	var $components = array('RequestHandler');

    function beforeFilter() {
        $this->Auth->allow('index', 'view', 'display');
    }
	
	function index() {
		$this->Point->recursive = 0;
		$this->set('points', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid point', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('point', $this->Point->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Point->create();
			if ($this->Point->save($this->data)) {
				$this->Session->setFlash(__('The point has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The point could not be saved. Please, try again.', true));
			}
		}
		$trails = $this->Point->Trail->find('list');
		$this->set(compact('trails'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid point', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Point->save($this->data)) {
				$this->Session->setFlash(__('The point has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The point could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Point->read(null, $id);
		}
		$trails = $this->Point->Trail->find('list');
		$this->set(compact('trails'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for point', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Point->delete($id)) {
			$this->Session->setFlash(__('Point deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Point was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	
	function getinfo($id)
	{
		$this->autoRender = false; // No renderiza mediate el fichero .ctp

		$this->set('point', $this->Point->read(null, $id));

		$response = $this->viewVars['point']['Point']['name'].'<br>';
		$response .= $this->viewVars['point']['Point']['description'].'<br>';
		$response .= $this->viewVars['point']['Point']['cordx'].'<br>';
		$response .= $this->viewVars['point']['Point']['cordy'].'<br>';

		echo $response;
	}
}
