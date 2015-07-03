<?php
class ClientsController extends AppController {
	var $name = 'Clients';
    var $components = array('Auth');

	function index() {
		$this->Client->recursive = 0;
        if($this->Session->read("Auth.Client.role") == 'cust') {
            $this->paginate = array('conditions' => array('Client.id' => $this->Session->read("Auth.Client.id")));
        }
        $clients = $this->paginate();
        $this->set(compact('clients'));
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid client', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('client', $this->Client->read(null, $id));
	}

	function add()
    {
        if (!empty($this->data))
        {
            if ($this->data['Client']['password'] == $this->Auth->password($this->data['Client']['password_confirm']))
            {
                $this->Client->create();
                if ($this->Client->save($this->data))
                {
                    $this->Session->setFlash(__('The client has been saved', true));
                    $this->redirect(array('action' => 'index'));
                } else {
                    unset($this->data['Client']['password']);
                    unset($this->data['Client']['password_confirm']);
                    $this->Session->setFlash(__('Client could not be saved. Try again.', true));
                }
            }
            else
            {
                unset($this->data['Client']['password']);
                unset($this->data['Client']['password_confirm']);
                $this->Session->setFlash(__('Passwords do not match', true));
            }
        }
	}

	function edit($id = null) {
        if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid client', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
            if ($this->Client->save($this->data)) {
				$this->Session->setFlash(__('The changes have been saved', true));
                return $this->redirect(array('action' => 'view', $this->Client->id));
			} else {
				$this->Session->setFlash(__('The changes could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
            $this->data = $this->Client->read(null, $id);
            $this->data['Client']['password'] = $this->Client->find('first', array('fields' => array('Client.password')));
            //unset($this->data['Client']['password']);
            //unset($this->data['Client']['password_confirm']);
		}
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
		$this->Session->setFlash(__('Client could not be deleted', true));
		$this->redirect(array('action' => 'index'));
	}

    function change($id = null) {
        if (!$id && empty($this->data)) {
            $this->Session->setFlash(__('Invalid client', true));
            $this->redirect(array('action' => 'index'));
        }
        $cl = $this->Client->findById($id);
        if (!$cl) {
            $this->Session->setFlash(__('Invalid client', true));
            $this->redirect(array('action' => 'index'));
        }
        if (!empty($this->data)) {
            $this->Client->id=$id;
            if ($this->data['Client']['password'] == $this->data['Client']['password_confirm']) {
                if ($this->Client->saveField("password", $this->Auth->password($this->data['Client']['password']))) {
                    $this->Session->setFlash(__('The changes have been saved', true));
                    return $this->redirect(array('action' => 'view', $this->Client->id));
                } else {
                    $this->Session->setFlash(__('The changes could not be saved. Please, try again.', true));
                }
            }
            else{
                $this->data = $this->Client->read(null, $id);
                unset($this->data['Client']['password']);
                unset($this->data['Client']['password_confirm']);
                $this->Session->setFlash(__('Passwords do not match', true));
            }
        }
        if (empty($this->data)) {
            $this->data = $this->Client->read(null, $id);
            unset($this->data['Client']['password']);
            //unset($this->data['Client']['password_confirm']);
        }
    }

    /*$this->data['Client']['id'] = $this->Client->find('first', array('fields' => array('Client.id')));
    $this->data['Client']['username'] = $this->Client->find('first', array('fields' => array('Client.username')));
    $this->data['Client']['name'] = $this->Client->find('first', array('fields' => array('Client.name')));
    $this->data['Client']['lastname'] = $this->Client->find('first', array('fields' => array('Client.lastname')));
    $this->data['Client']['role'] = $this->Client->find('first', array('fields' => array('Client.role')));
    $this->data['Client']['country_id'] = $this->Client->find('first', array('fields' => array('Client.country_id')));*/

	/*
    function login() {
    } */
	function login() {
		$_SESSION['lan2'] = 'en';
        if( !(empty($this->data)) && $this->Auth->user() ){
            $rolUser = $this->Session->read("Auth.Client.role") ;
            if($rolUser == 'admin'){
                $_SESSION['role'] = 'administrator';
            }else{
                if($rolUser == 'cust'){
                    $_SESSION['role'] = 'restricted';
					$_SESSION['client_id'] = $this->Session->read("Auth.Client.id") ;
                }
            }
            //Debugger::dump($_SESSION);
            //trace($_SESSION);
            $this->redirect($this->Auth->redirect());
        }
    }

    function logout() {
	    $_SESSION['role'] = null;
        $_SESSION['language'] = null;
        $this->redirect($this->Auth->logout());

    }

    function beforeFilter() {
        parent::beforeFilter();
		$this->Auth->allow('add', 'logout');
		$this->Auth->autoRedirect = false;
    }
}
