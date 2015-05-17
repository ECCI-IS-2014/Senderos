<?php
class ClientsController extends AppController {
	var $name = 'Clients';
    var $components = array('Auth');

	function index() {
		$this->Client->recursive = 0;
		$this->set('clients', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid client', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('client', $this->Client->read(null, $id));
	}

	function add() {
        if (!empty($this->data)) {
			$this->Client->create();
			if ($this->Client->save($this->data)) {
				$this->Session->setFlash(__('The client has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The client could not be saved. Please, try again.', true));
			}
		}
		$countries = $this->Client->Country->find('list', array('fields' => array('Country.name')));
		$this->set(compact('countries'));
	}
	
	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid client', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Client->save($this->data)) {
				$this->Session->setFlash(__('The client has been saved', true));
                return $this->redirect(array('action' => 'view', $this->Client->id));
			} else {
				$this->Session->setFlash(__('The client could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Client->read(null, $id);
		}
		$countries = $this->Client->Country->find('list');
		$this->set(compact('countries'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for client', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Client->delete($id)) {
			$this->Session->setFlash(__('Client deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Client was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}

    function change($id = null) {
        if (!$id && empty($this->data)) {
            $this->Session->setFlash(__('Invalid client', true));
            $this->redirect(array('action' => 'index'));
        }
        if (!empty($this->data)) {
            if ($this->Client->saveField('password', AuthComponent::password($this->request->data['Client']['new_password']))) {
                $this->Session->setFlash(__('The client has been saved', true));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The client could not be saved. Please, try again please.', true));
            }
        }
        if (empty($this->data)) {
            $this->data = $this->Client->read(null, $id);
        }
    }

    /**
     *  El AuthComponent proporciona la funcionalidad necesaria
     *  para el acceso (login), por lo que se puede dejar esta función en blanco.
     */
    function login() {
    }

    function logout() {
        $this->redirect($this->Auth->logout());

    }

    /**
     *
     */
    function beforeFilter() {
        parent::beforeFilter();
		$this->Auth->allow('add', 'logout');
    }
}
